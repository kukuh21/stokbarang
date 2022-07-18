<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tb_order';
    protected $primaryKey = 'order_id';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function scopeJoinUser($query)
    {
        $query->leftJoin('tb_user','tb_order.user_id','=','tb_user.user_id');
    }

    public function scopeJoinBidang($query)
    {
        $query->leftJoin('tb_bidang','tb_user.bidang_id','=','tb_bidang.bidang_id');
    }
}
