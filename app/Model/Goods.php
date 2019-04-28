<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table='tp_goods';
    protected $primaryKey='goods_id';
    public $timestamps=false;
}
