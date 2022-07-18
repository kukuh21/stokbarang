<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bidang;
use DB;
use Carbon\Carbon;
use DataTables;
use JsValidator;

class BidangController extends Controller
{
    public function index()
    {
        return view('admin.master.bidang.bidang_index', [
            'JsValidator' => JsValidator::make($this->rulesCreate())
        ]);
    }

    public function data()
    {
        $model = Bidang::query()->orderBy('bidang_id','asc');
        return Datatables::of($model)
            ->addColumn('action', function ($data) {
                return '
                <div align="center">
                <a onclick="editForm('.$data->bidang_id.')"  class="btn btn-warning btn-shadow btn-sm">
                    <i class="fa fa-pencil"></i>
                </a>
                <a onclick="deleteData('.$data->bidang_id.')" class="btn btn-danger btn-shadow btn-sm">
                 <i class="fa fa-trash"></i>
                </a>
                </div>
                ';
            })
            ->addIndexColumn('bidang_id')
            ->toJson();
    }

    public function rulesCreate()
    {
      return [
          'bidang' => 'required',
      ];
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rulesCreate());

        $cek = Bidang::where('bidang_nama', $request->bidang)->first();

        if($cek != null) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = new Bidang;
          $db->bidang_nama = $request->bidang;
          if ($db->save()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
        }
    }

    public function edit($id)
    {
        $db = Bidang::find($id);
        echo json_encode($db);
    }

    public function update(Request $request, $id)
    {
      $data = $this->validate($request, $this->rulesCreate());

      $cek = Bidang::where('bidang_nama', $request->bidang)->first();

      if($cek != NULL && $cek->bidang_id != $id) {
        return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
      } else {
        $db = Bidang::find($id);
        $db->bidang_nama = $request->bidang;
        if ($db->update()) {
          return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }
      }
    }

    public function destroy($id)
    {
        $db = Bidang::find($id);
        $db->delete();
    }
}
