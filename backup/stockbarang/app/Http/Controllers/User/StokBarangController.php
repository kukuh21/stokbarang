<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Barang;
use DB;
use Carbon\Carbon;
use DataTables;
use JsValidator;
use Excel;
use File;

class StokBarangController extends Controller
{
    public function index()
    {
        return view('user.stokbarang.stokbarang_index');
    }

    public function data()
    {
        $model = Barang::query()->orderBy('barang_id','asc');
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
            ->addIndexColumn('barang_id')
            ->toJson();
    }
}
