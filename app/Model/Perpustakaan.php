<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Perpustakaan extends Model
{
    protected $table = 'tb_perpustakaan';
    protected $primaryKey = 'perpustakaan_id';

    public function jenisperpustakaan()
    {
        return $this->belongsTo('App\Model\JenisPerpustakaan','jenisperpustakaan_id');
    }

}
