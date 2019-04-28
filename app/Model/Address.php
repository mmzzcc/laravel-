<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table='tp_address';
    protected $primaryKey='address_id';
    public $timestamps=false;
}
