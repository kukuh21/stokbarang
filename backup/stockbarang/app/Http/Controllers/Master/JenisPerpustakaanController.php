<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\JenisPerpustakaan;
use DataTables;
use JsValidator;

class JenisPerpustakaanController extends Controller
{
    public function index()
    {
        return view('admin.master.jenisperpustakaan.jenisperpustakaan_index', [
            'JsValidator' => JsValidator::make($this->rulesCreate())
        ]);
    }

    public function data()
    {
        $model = JenisPerpustakaan::query()->orderBy('jenisperpustakaan_id','asc');
        return Datatables::of($model)
            ->addColumn('action', function ($data) {
                return '
                <div align="center">
                <a onclick="editForm('.$data->jenisperpustakaan_id.')"  class="btn btn-warning btn-shadow btn-sm">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="'.route('kategoriperpus',$data->jenisperpustakaan_id).'"  class="btn btn-primary btn-shadow btn-sm">
                    <i class="fa fa-bank"></i>
                </a>
                <a onclick="deleteData('.$data->jenisperpustakaan_id.')" class="btn btn-danger btn-shadow btn-sm">
                 <i class="fa fa-trash"></i>
                </a>
                </div>
                ';
            })
            ->addIndexColumn('jenisperpustakaan_id')
            ->toJson();
    }

    public function rulesCreate()
    {
      return [
          'jenis_perpustakaan' => 'required',
      ];
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rulesCreate());

        $cek = JenisPerpustakaan::where('jenisperpustakaan_nama', $request->jenis_perpustakaan)->first();

        if($cek != null) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = new JenisPerpustakaan;
          $db->jenisperpustakaan_nama = $request->jenis_perpustakaan;
          $db->jenisperpustakaan_koleksi = $request->jenisperpustakaan_koleksi;
          if ($db->save()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
        }
    }

    public function edit($id)
    {
        $db = JenisPerpustakaan::find($id);
        echo json_encode($db);
    }

    public function update(Request $request, $id)
    {
      $data = $this->validate($request, $this->rulesCreate());

      $cek = JenisPerpustakaan::where('jenisperpustakaan_nama', $request->jenis_perpustakaan)->first();

      if($cek != NULL && $cek->jenisperpustakaan_id != $id) {
        return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
      } else {
        $db = JenisPerpustakaan::find($id);
        $db->jenisperpustakaan_nama = $request->jenis_perpustakaan;
        $db->jenisperpustakaan_koleksi = $request->jenisperpustakaan_koleksi;
        if ($db->update()) {
          return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }
      }
    }

    public function destroy($id)
    {
        $db = JenisPerpustakaan::find($id);
        $db->delete();
    }
}
