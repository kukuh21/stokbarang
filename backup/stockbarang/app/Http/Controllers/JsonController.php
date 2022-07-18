<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Perpustakaan;

class JsonController extends Controller
{
    public function getperpustakaan($id)
    {
        $data = Perpustakaan::where('kategoriperpustakaan_id', $id)->get();

        return $data;
    }
}
