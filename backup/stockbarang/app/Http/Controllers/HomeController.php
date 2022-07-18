<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use JsValidator;
use Alert;
use DataTables;
use PDF;
use App\Model\Barang;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $total_barang = Barang::count();
        $total_barang_aman = Barang::where('barang_stock', '>', 5)->count();
        $total_barang_menipis = Barang::where('barang_stock', '<=', 5)->where('barang_stock', '>=', 1)->count();
        $total_barang_habis = Barang::where('barang_stock', '=', 0)->count();

        return view('home', [
            'totalbarang' => $total_barang,
            'aman' => $total_barang_aman,
            'menipis' => $total_barang_menipis,
            'habis' => $total_barang_habis
        ]);
    }

}
