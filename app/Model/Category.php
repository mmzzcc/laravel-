<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='tp_category';
    protected $primaryKey='cate_id';
    public $timestamps=false;
}
