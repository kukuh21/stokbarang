<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Satuan;
use DB;
use Carbon\Carbon;
use DataTables;
use JsValidator;

class SatuanController extends Controller
{
    public function index()
    {
        return view('admin.master.satuan.satuan_index', [
            'JsValidator' => JsValidator::make($this->rulesCreate())
        ]);
    }

    public function data()
    {
        $model = Satuan::query()->orderBy('satuan_id','asc');
        return Datatables::of($model)
            ->addColumn('action', function ($data) {
                return '
                <div align="center">
                <a onclick="editForm('.$data->satuan_id.')"  class="btn btn-warning btn-shadow btn-sm">
                    <i class="fa fa-pencil"></i>
                </a>
                <a onclick="deleteData('.$data->satuan_id.')" class="btn btn-danger btn-shadow btn-sm">
                 <i class="fa fa-trash"></i>
                </a>
                </div>
                ';
            })
            ->addIndexColumn('satuan_id')
            ->toJson();
    }

    public function rulesCreate()
    {
      return [
          'satuan' => 'required',
      ];
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rulesCreate());

        $cek = Satuan::where('satuan_nama', $request->satuan)->first();

        if($cek != null) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = new Satuan;
          $db->satuan_nama = $request->satuan;
          if ($db->save()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
        }
    }

    public function edit($id)
    {
        $db = Satuan::find($id);
        echo json_encode($db);
    }

    public function update(Request $request, $id)
    {
      $data = $this->validate($request, $this->rulesCreate());

      $cek = Satuan::where('satuan_nama', $request->satuan)->first();

      if($cek != NULL && $cek->satuan_id != $id) {
        return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
      } else {
        $db = Satuan::find($id);
        $db->satuan_nama = $request->satuan;
        if ($db->update()) {
          return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }
      }
    }

    public function destroy($id)
    {
        $db = Satuan::find($id);
        $db->delete();
    }
}
