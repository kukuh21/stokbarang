<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DataPerpustakaan extends Model
{
    protected $table = 'tb_dataperpustakaan';
    protected $primaryKey = 'dataperpustakaan_id';

    public function scopeJoinPerpustakaan($query)
    {
        $query->leftJoin('tb_perpustakaan','tb_dataperpustakaan.perpustakaan_id','=','tb_perpustakaan.perpustakaan_id');
    }

    public function scopeJoinKategoriPerpustakaan($query)
    {
        $query->leftJoin('tb_kategoriperpustakaan','tb_perpustakaan.kategoriperpustakaan_id','=','tb_kategoriperpustakaan.kategoriperpustakaan_id');
    }
}
