<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use JsValidator;
use App\User;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Barang;

class OrderController extends Controller
{
    public function index()
    {
        // dd(session('role_name'));
        if(session('role_name') == 'Admin') {
            $user = User::where('tipe','User')->get();
        } else {
            $user = User::where('user_id', authUser())->get();
        }
        return view('admin.transaksi.transaksi_index', [
            'user' => $user
        ]);
    }

    public function data()
    {
        if(session('role_name') == 'Admin') {
            $model = Order::JoinUser()->JoinBidang()
            ->select('order_id','invoice','total','tanggal','nama','bidang_nama')
            ->orderBy('no_urut','asc');
        } else {
            $model = Order::JoinUser()->JoinBidang()
                ->where('tb_order.user_id', authUser())
                ->select('order_id','invoice','total','tanggal','nama','bidang_nama')
                ->orderBy('no_urut','asc');
        }

        return Datatables::of($model)
            ->addColumn('ceklist', function ($data) {
                return '
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" name="chkbox[]" value="'.$data->order_id.'">
                    </div>
                ';
            })
            ->addColumn('tanggal', function ($data) {
                return '
                    <div align="center">
                        '.tanggal_indonesia_huruf($data->tanggal).'
                    </div>
                ';
            })
            ->addColumn('action', function ($data) {
                return '
                <div align="center">
                <a target="_blank" href="'.route('order.orderprint',$data->order_id).'" class="btn btn-info btn-shadow btn-sm">
                    <i class="fa fa-print"></i>
                </a>
                <a href="'.route('order.orderdetail',$data->order_id).'" class="btn btn-warning btn-shadow btn-sm">
                    <i class="fa fa-cart-plus"></i>
                </a>
                <a onclick="deleteData('.$data->order_id.')" class="btn btn-danger btn-shadow btn-sm">
                 <i class="fa fa-trash"></i>
                </a>
                </div>
                ';
            })
            ->addIndexColumn('order_id')
            ->toJson();
    }

    public function create($id)
    {
        $order = new Order;
        $order->user_id = $id;
        $order->total = 0;

        // Kode invoice
        // Cek nomor maksimal berdasarkan tahun surat
        $ceknomor = Order::selectRaw('max(no_urut) as max_nomor')
            ->whereYear('tanggal', date('Y'))
            ->first();

        // Jika ada nomor sebelumnya + 1
        if ($ceknomor->max_nomor) {
            $kode = intval($ceknomor->max_nomor) + 1;
        } else {
            $kode = 1;
        }

        $order->invoice = 'INV'.$kode.'-'.date('m').'-'.date('Y');
        $order->no_urut = $kode;
        $order->tanggal = date('Y-m-d');

        $order->save();


        return redirect()->route('order.orderdetail', $order->order_id);

    }

    public function destroy($id)
    {
        $db = Order::find($id);

        $cek = OrderDetail::where('order_id', $db->order_id)->first();
        if($cek != null) {
            return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Tidak Dapat Dihapus Karena Sudah Melakukan Transaksi'], 200);
        } else {
            $db->delete();
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }

    }

    public function orderdetail($id)
    {
        $data = Order::find($id);
        $barang = Barang::all();

        return view('admin.transaksi.transaksi_detail', [
            'data' => $data,
            'barang' => $barang
        ]);
    }

    public function dataOrderDetail($id)
    {
        $detail = OrderDetail::leftJoin('tb_barang', 'tb_orderdetail.barang_id', '=', 'tb_barang.barang_id')
                            ->leftJoin('tb_satuan', 'tb_barang.satuan_id', '=', 'tb_satuan.satuan_id')
                            ->where('order_id', '=', $id)
                            ->get();
        $no = 0;
        $data = array();
        $total = 0;
        $total_item = 0;
        foreach($detail as $list){
            $no ++;
            $row = array();
            $row[] = $no;
            $row[] = $list->barang_nama;
            $row[] = $list->jumlah;
            $row[] = $list->satuan_nama;
            $row[] = tanggal_indonesia($list->tanggal);
            if($list->status == 'buka') {
                $row[] = "<input style='font-size: 11px; width: 50px;' type='number' name='jumlah_$list->orderdetail_id' value='$list->jumlah' onChange='changeCount($list->orderdetail_id)'>";
                $row[] = '<a onclick="deleteItem('.$list->orderdetail_id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
            } else {
                $row[] = '-';
                $row[] = '-';
            }

            $data[] = $row;

        }


        $output = array("data" => $data);
        return response()->json($output);
    }

    public function orderdetailStore(Request $request)
    {
        $cekBarang = Barang::find($request->barang);

        if($cekBarang->barang_stock == 0) {
            return response()->json(['code'=>400, 'status' => 'Stock Barang Kosong'], 200);
        } else {
            $db = new OrderDetail;
            $db->barang_id = $request->barang;
            $db->order_id = $request->order_id;
            $db->jumlah = 1;
            $db->tanggal = date('Y-m-d');
            if($db->save()) {
                $barang = Barang::find($db->barang_id);
                $barang->barang_stock -= $db->jumlah;
                $barang->update();

                $order = Order::find($db->order_id);
                $order->total += $db->jumlah;
                $order->update();
            }
            return response()->json(['code'=>200, 'status' => 'Barang Berhasil Ditambahkan'], 200);
        }
    }

    public function orderdetailUpdate(Request $request, $id)
    {
        $nama_input = "jumlah_".$id;

        $db = OrderDetail::find($id);

        $total = $request[$nama_input] - $db->jumlah;

        $cekBarang = Barang::find($db->barang_id);
        if($total > $cekBarang->barang_stock) {
            return response()->json(['code'=>400, 'status' => 'Stock Barang Tidak Mencukupi'], 200);
        } else {
            $stocklama = $db->jumlah;
            $db->jumlah = $request[$nama_input];

            if($db->update()) {
                // Update stock barang
                $barang = Barang::find($db->barang_id);
                $barang->barang_stock -= $db->jumlah - $stocklama;
                $barang->update();

                // Update order
                $order = Order::find($db->order_id);
                $order->total += $db->jumlah - $stocklama;
                $order->update();
            }
            return response()->json(['code'=>200, 'status' => 'Barang Berhasil Diupdate'], 200);
        }
    }

    public function orderdetailHapus($id)
    {
       $db = OrderDetail::find($id);

       // Update stock barang
       $barang = Barang::find($db->barang_id);
       $barang->barang_stock += $db->jumlah;
       $barang->update();

       // Update order
       $order = Order::find($db->order_id);
       $order->total -= $db->jumlah;
       $order->update();

       $db->delete();
    }

    public function simpanTransaksi($id)
    {
        $data = OrderDetail::where('order_id', $id)->where('status','buka')->get();

        foreach ($data as $list) {
            $db = OrderDetail::find($list->orderdetail_id);
            $db->status = 'kunci';
            $db->update();
        }

        return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
    }

    public function orderprint($id)
    {
        $data = Order::JoinUser()->JoinBidang()->where('order_id',$id)->get();

        $orderdetail = OrderDetail::leftJoin('tb_barang', 'tb_orderdetail.barang_id', '=', 'tb_barang.barang_id')
        ->leftJoin('tb_satuan', 'tb_barang.satuan_id', '=', 'tb_satuan.satuan_id')
        ->where('order_id', '=', $id)
        ->get();

        foreach ($data as $data_item){
            $orderid = $data_item->order_id;
            $invoice = $data_item->invoice;
            $total = $data_item->total;
            $no_urut = $data_item->no_urut;
            $tanggal = tanggal_indonesia($data_item->tanggal);
            $nama_user = $data_item->nama;
            $nohp_user = $data_item->nohp;
            $tipe_user = $data_item->tipe;
            $bidangnama = $data_item->bidang_nama;
        }

        return view('admin.transaksi.transaksi_print', [
            'orderid' => $orderid,
            'invoice' => $invoice,
            'total' => $total,
            'no_urut' => $no_urut,
            'tanggal' => $tanggal,
            'nama_user' => $nama_user,
            'nohp_user' => $nohp_user,
            'tipe_user' => $tipe_user,
            'bidangnama' => $bidangnama,
            'orderdetail' => $orderdetail
        ]);
    }

    public function orderprintpertanggal(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->tgl_dari));
        $end_date = date('Y-m-d', strtotime($request->tgl_sampai));

        $data = Order::JoinUser()->JoinBidang()->whereBetween('tanggal', [$start_date,$end_date])->get();

        return view('admin.transaksi.transaksi_printpertanggal', [
            "data" => $data
        ]);
    }
}
