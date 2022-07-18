<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BarangMasuk;
use App\Model\Barang;
use DB;
use Carbon\Carbon;
use DataTables;
use JsValidator;
use Excel;
use File;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('admin.barangmasuk.barangmasuk_index', [
            'JsValidator' => JsValidator::make($this->rulesCreate()),
            'barang' => Barang::all()
        ]);
    }

    public function data()
    {
        $model = BarangMasuk::with('barang')->orderBy('barangmasuk_id','desc');
        return Datatables::of($model)
            ->addColumn('tanggal', function ($data) {
                return '
                    <div align="center">
                        '.tanggal_indonesia_huruf($data->barangmasuk_tgl).'
                    </div>
                ';
            })
            ->addColumn('action', function ($data) {
                return '
                <div align="center">
                <a onclick="editForm('.$data->barangmasuk_id.')"  class="btn btn-warning btn-shadow btn-sm">
                    <i class="fa fa-pencil"></i>
                </a>
                <a onclick="deleteData('.$data->barangmasuk_id.')" class="btn btn-danger btn-shadow btn-sm">
                 <i class="fa fa-trash"></i>
                </a>
                </div>
                ';
            })
            ->addIndexColumn('barangmasuk_id')
            ->toJson();
    }

    public function rulesCreate()
    {
      return [
          'barang' => 'required',
          'stock' => 'required'
      ];
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rulesCreate());

          $db = new BarangMasuk;
          $db->barang_id = $request->barang;
          $db->barangmasuk_stock = $request->stock;
          $db->barangmasuk_tgl = date('Y-m-d');

          if ($db->save()) {

            // Update stock barang
            $barang = Barang::find($db->barang_id);
            $barang->barang_stock += $db->barangmasuk_stock;
            $barang->update();

            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
    }

    public function edit($id)
    {
        $db = BarangMasuk::find($id);
        echo json_encode($db);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, $this->rulesCreate());

        $db = BarangMasuk::find($id);
        $db->barang_id = $request->barang;

        $stocklama = $db->barangmasuk_stock;

        $db->barangmasuk_stock = $request->stock;
        $db->barangmasuk_tgl = date('Y-m-d');

        if ($db->update()) {
            // Update stock barang
            $barang = Barang::find($db->barang_id);
            $barang->barang_stock += $db->barangmasuk_stock - $stocklama;
            $barang->update();

            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }
    }

    public function destroy($id)
    {
        $db = BarangMasuk::find($id);

        // Update stock barang
        $barang = Barang::find($db->barang_id);
        $barang->barang_stock -= $db->barangmasuk_stock;
        $barang->update();

        $db->delete();
    }



}
