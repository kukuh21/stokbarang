<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'tb_kegiatan';
    protected $primaryKey = 'kegiatan_id';

    public function dataperpustakaan()
    {
        return $this->belongsTo('App\Model\DataPerpustakaan','dataperpustakaan_id');
    }

    public function scopePeriode($query)
    {
        $query->leftJoin('tb_dataperpustakaan','tb_kegiatan.dataperpustakaan_id','=','tb_dataperpustakaan.dataperpustakaan_id');
    }
}
