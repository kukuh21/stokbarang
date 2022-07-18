<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'barang_id';

    public function scopeSatuan($query)
    {
        $query->leftJoin('tb_satuan','tb_barang.satuan_id','=','tb_satuan.satuan_id');
    }
}
