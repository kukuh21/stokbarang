<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bidang;
use App\User;
use DB;
use DataTables;
use App\Model\Order;
use JsValidator;
use Alert;

class ManajemenUserController extends Controller
{
    public function index()
    {
        return view('admin.manajemenuser.manajemenuser_index', [
            'bidang' => Bidang::all(),
            'JsValidator' => JsValidator::make($this->rulesCreate())
        ]);
    }

    public function data()
    {
        $model = User::with('bidang')->orderBy('user_id','asc');
        return Datatables::of($model)
            ->addColumn('action', function ($data) {
                return '
                <div align="center">
                <a onclick="editForm('.$data->user_id.')"  class="btn btn-warning btn-shadow btn-sm">
                    <i class="fa fa-pencil"></i>
                </a>
                <a onclick="deleteData('.$data->user_id.')" class="btn btn-danger btn-shadow btn-sm">
                 <i class="fa fa-trash"></i>
                </a>
                </div>
                ';
            })
            ->addIndexColumn('user_id')
            ->toJson();
    }

    public function rulesCreate()
    {
      return [
          'username' => 'required',
          'password' => 'required',
          'nama' => 'required',
          'nohp' => 'required',
          'alamat' => 'required',
          'bidang' => 'required',
      ];
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rulesCreate());

        $cek = User::where('username', $request->username)->first();

        if($cek != null) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = new User;
          $db->username = $request->username;
          $db->password = \Hash::make($request->password);
          $db->tipe = 'User';
          $db->nama = $request->nama;
          $db->nohp = $request->nohp;
          $db->alamat = $request->alamat;
          $db->bidang_id = $request->bidang;

          if ($db->save()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
        }
    }

    public function edit($id)
    {
        $db = User::find($id);
        echo json_encode($db);
    }

    public function update(Request $request, $id)
    {
      $data = $this->validate($request, $this->rulesCreate());

      $cek = User::where('username', $request->username)->first();

      if($cek != NULL && $cek->user_id != $id) {
        return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
      } else {
        $db = User::find($id);
        $db->username = $request->username;
        $db->password = \Hash::make($request->password);
        $db->tipe = 'User';
        $db->nama = $request->nama;
        $db->nohp = $request->nohp;
        $db->alamat = $request->alamat;
        $db->bidang_id = $request->bidang;

        if ($db->update()) {
          return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }
      }
    }

    public function destroy($id)
    {
        $db = User::find($id);

        $cek = Order::where('user_id', $db->user_id)->first();
        if($cek != null) {
            return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Tidak Dapat Dihapus Karena Sudah Melakukan Transaksi'], 200);
        } else {
            $db->delete();
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
        }

    }
}
