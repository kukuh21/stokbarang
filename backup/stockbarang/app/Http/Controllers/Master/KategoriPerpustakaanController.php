<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\JenisPerpustakaan;
use App\Model\KategoriPerpustakaan;
use DataTables;
use JsValidator;

class KategoriPerpustakaanController extends Controller
{
    public function kategoriperpus($id)
    {
        $data = JenisPerpustakaan::find($id);
        return view('admin.master.kategoriperpustakaan.kategoriperpustakaan_index', [
            'data' => $data,
            'JsValidator' => JsValidator::make($this->rulesCreate())
        ]);
    }

    public function rulesCreate()
    {
      return [
          'kategori_perpustakaan' => 'required',
      ];
    }

    public function data($id)
    {
        $model = KategoriPerpustakaan::query()->where('jenisperpustakaan_id', $id)->orderBy('kategoriperpustakaan_id','asc');
        return Datatables::of($model)
            ->addColumn('action', function ($data) {
                return '
                <div align="center">
                <a onclick="editForm('.$data->kategoriperpustakaan_id.')"  class="btn btn-warning btn-shadow btn-sm">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="'.route('dataperpustakaan', $data->kategoriperpustakaan_id).'"  class="btn btn-primary btn-shadow btn-sm">
                    <i class="fa fa-rss-square"></i>
                </a>
                <a onclick="deleteData('.$data->kategoriperpustakaan_id.')" class="btn btn-danger btn-shadow btn-sm">
                 <i class="fa fa-trash"></i>
                </a>
                </div>
                ';
            })
            ->addIndexColumn('kategoriperpustakaan_id')
            ->toJson();
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rulesCreate());

        $cek = KategoriPerpustakaan::where('jenisperpustakaan_id', $request->jenisperpustakaan_id)->where('kategoriperpustakaan_nama', $request->kategori_perpustakaan)->first();

        if($cek != null) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = new KategoriPerpustakaan;
          $db->kategoriperpustakaan_nama = $request->kategori_perpustakaan;
          $db->jenisperpustakaan_id = $request->jenisperpustakaan_id;
          if ($db->save()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
        }
    }

    public function editJson($id)
    {
        $db = KategoriPerpustakaan::find($id);
        echo json_encode($db);
    }

    public function update(Request $request, $id)
    {
      $data = $this->validate($request, $this->rulesCreate());

      $cek = KategoriPerpustakaan::where('jenisperpustakaan_id', $request->jenisperpustakaan_id)->where('kategoriperpustakaan_nama', $request->kategori_perpustakaan)->first();

      if($cek != NULL && $cek->kategoriperpustakaan_id != $id) {
        return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
      } else {
        $db = KategoriPerpustakaan::find($id);
        $db->kategoriperpustakaan_nama = $request->kategori_perpustakaan;
        if ($db->update()) {
          return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }
      }
    }

    public function destroy($id)
    {
        $db = KategoriPerpustakaan::find($id);
        $db->delete();
    }

    public static function menuUtama()
    {
        $db = JenisPerpustakaan::all();

        return $db;
    }
}
