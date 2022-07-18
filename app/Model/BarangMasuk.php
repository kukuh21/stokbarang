<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'tb_barangmasuk';
    protected $primaryKey = 'barangmasuk_id';

    public function barang()
    {
        return $this->belongsTo('App\Model\Barang','barang_id');
    }
}
