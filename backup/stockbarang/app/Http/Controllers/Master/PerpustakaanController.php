<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\JenisPerpustakaan;
use App\Model\KategoriPerpustakaan;
use App\Model\Perpustakaan;
use DataTables;
use JsValidator;

class PerpustakaanController extends Controller
{
    public function dataperpustakaan($id)
    {
        $data = KategoriPerpustakaan::find($id);
        return view('admin.master.perpustakaan.perpustakaan_index', [
            'data' => $data,
            'JsValidator' => JsValidator::make($this->rulesCreate())
        ]);
    }

    public function rulesCreate()
    {
      return [
          'nama_perpustakaan' => 'required',
      ];
    }

    public function data($id)
    {
        $model = Perpustakaan::query()->where('kategoriperpustakaan_id', $id)->orderBy('perpustakaan_id','asc');
        return Datatables::of($model)
            ->addColumn('action', function ($data) {
                return '
                <div align="center">
                <a onclick="editForm('.$data->perpustakaan_id.')"  class="btn btn-warning btn-shadow btn-sm">
                    <i class="fa fa-pencil"></i>
                </a>
                <a onclick="deleteData('.$data->perpustakaan_id.')" class="btn btn-danger btn-shadow btn-sm">
                 <i class="fa fa-trash"></i>
                </a>
                </div>
                ';
            })
            ->addIndexColumn('perpustakaan_id')
            ->toJson();
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rulesCreate());

        $cek = Perpustakaan::where('kategoriperpustakaan_id', $request->kategoriperpustakaan_id)->where('perpustakaan_nama', $request->nama_perpustakaan)->first();

        if($cek != null) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = new Perpustakaan;
          $db->perpustakaan_nama = $request->nama_perpustakaan;
          $db->kategoriperpustakaan_id = $request->kategoriperpustakaan_id;
          $db->perpustakaan_no = $request->perpustakaan_no;
          $db->perpustakaan_akredetasi = $request->perpustakaan_akredetasi;
          if ($db->save()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
        }
    }

    public function editJson($id)
    {
        $db = Perpustakaan::find($id);
        echo json_encode($db);
    }

    public function update(Request $request, $id)
    {
      $data = $this->validate($request, $this->rulesCreate());

      $cek = Perpustakaan::where('kategoriperpustakaan_id', $request->kategoriperpustakaan_id)->where('perpustakaan_nama', $request->nama_perpustakaan)->first();

      if($cek != NULL && $cek->perpustakaan_id != $id) {
        return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
      } else {
        $db = Perpustakaan::find($id);
        $db->perpustakaan_nama = $request->nama_perpustakaan;
        $db->perpustakaan_akredetasi = $request->perpustakaan_akredetasi;
        if ($db->update()) {
          return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }
      }
    }

    public function destroy($id)
    {
        $db = Perpustakaan::find($id);
        $db->delete();
    }
}
