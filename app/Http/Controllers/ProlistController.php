<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProlistController extends Controller
{
    //详情展示
    public function prolist(){
    	return view('prolist.prolist');
    }
}
