<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KategoriPerpustakaan extends Model
{
    protected $table= 'tb_kategoriperpustakaan';
    protected $primaryKey = 'kategoriperpustakaan_id';

    public function jenisperpustakaan()
    {
        return $this->belongsTo('App\Model\JenisPerpustakaan','jenisperpustakaan_id');
    }
}
