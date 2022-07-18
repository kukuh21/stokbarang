<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JenisPerpustakaan extends Model
{
    protected $table = 'tb_jenisperpustakaan';
    protected $primaryKey = 'jenisperpustakaan_id';

    public function kategori()
    {
        return $this->hasMany('App\Model\KategoriPerpustakaan','kategoriperpustakaan_id');
    }
}
