<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Barang;
use App\Model\Satuan;
use DB;
use Carbon\Carbon;
use DataTables;
use JsValidator;
use Excel;
use File;

class BarangController extends Controller
{
    public function index()
    {
        return view('admin.master.barang.barang_index', [
            'JsValidator' => JsValidator::make($this->rulesCreate()),
            'JsValidatorFile' => JsValidator::make($this->rulesImport()),
            'satuan' => Satuan::all()
        ]);
    }

    public function data()
    {
        $model = Barang::satuan()
                ->select('barang_id','tb_barang.satuan_id','barang_nama','tb_satuan.satuan_nama as satuan_nama','barang_stock')
                ->orderBy('barang_id','asc');
        return Datatables::of($model)
            ->addColumn('statusbarang', function ($data) {
                if($data->barang_stock == 0) {
                    return '
                    <div align="center">
                        <a href="#"  class="btn btn-danger btn-shadow btn-sm">
                            Stock Kosong
                        </a>
                    </div>
                    ';
                } else if($data->barang_stock > 5) {
                    return '
                    <div align="center">
                        <a href="#"  class="btn btn-success btn-shadow btn-sm">
                            Stock Aman
                        </a>
                    </div>
                    ';
                } else {
                    return '
                    <div align="center">
                        <a href="#"  class="btn btn-warning btn-shadow btn-sm">
                            Stock Menipis
                        </a>
                    </div>

                    ';
                }
            })
            ->addColumn('action', function ($data) {
                return '
                <div align="center">
                <a onclick="editForm('.$data->barang_id.')"  class="btn btn-warning btn-shadow btn-sm">
                    <i class="fa fa-pencil"></i>
                </a>
                <a onclick="deleteData('.$data->barang_id.')" class="btn btn-danger btn-shadow btn-sm">
                 <i class="fa fa-trash"></i>
                </a>
                </div>
                ';
            })
            ->addIndexColumn('barang_id')
            ->toJson();
    }

    public function rulesCreate()
    {
      return [
          'barang' => 'required',
          'stock' => 'required',
          'satuan' => 'required'
      ];
    }

    public function rulesImport()
    {
        return [
            'file_import' => 'required|mimes:xlsx'
        ];
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rulesCreate());

        $cek = Barang::where('barang_nama', $request->barang)->first();

        if($cek != null) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = new Barang;
          $db->barang_nama = $request->barang;
          $db->barang_stock = $request->stock;
          $db->satuan_id = $request->satuan;
          if ($db->save()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
        }
    }

    public function edit($id)
    {
        $db = Barang::find($id);
        echo json_encode($db);
    }

    public function update(Request $request, $id)
    {
      $data = $this->validate($request, $this->rulesCreate());

      $cek = Barang::where('barang_nama', $request->stock)->first();

      if($cek != NULL && $cek->barang_id != $id) {
        return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
      } else {
        $db = Barang::find($id);
        $db->barang_nama = $request->barang;
        $db->barang_stock = $request->stock;
        $db->satuan_id = $request->satuan;
        if ($db->update()) {
          return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }
      }
    }

    public function destroy($id)
    {
        $db = Barang::find($id);
        $db->delete();
    }


    public function import(Request $request)
    {
        $data = $this->validate($request, $this->rulesImport());
        if($request->hasFile('file_import')){
            Excel::load($request->file('file_import')->getRealPath(), function ($reader) {
                $data_excel = $reader->select(array('barang','stock'))->get();
                $data_decode = json_decode($data_excel);
                $data = array();
                foreach($data_decode as $list) {
                        // Cek apakah data sudah ada
                        $cek_riwayat = Barang::where('barang_nama', $list->barang)->first();
                        if($cek_riwayat == NULL) {
                            $db = new Barang;
                            $db->barang_nama = $list->barang;
                            $db->barang_stock = $list->stock;
                            $db->save();
                        }
                }

            });
        }

        alert()->success('Data Berhasil Diimport');
        return redirect()->route('barang.index');
    }

    public function print()
    {
        $data = Barang::satuan()->get();

        return view('admin.master.barang.barang_print', [
            'data' => $data
        ]);
    }

    public function export()
    {

    }
}
