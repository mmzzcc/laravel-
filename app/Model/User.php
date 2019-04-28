<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //设置主键
    protected $table='tp_user';
    protected $primaryKey='u_id';
    public $timestamps=false;

}
