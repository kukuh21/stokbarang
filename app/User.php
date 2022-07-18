<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_user';
    protected $primaryKey = 'user_id';

    public function dataRole($id)
    {
        $data = User::find($id);

        return $data->tipe;
    }

    public function bidang()
    {
        return $this->belongsTo('App\Model\Bidang','bidang_id');
    }
}
