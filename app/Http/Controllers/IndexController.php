<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Category as Cate;
use App\model\Goods;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CommonController;

class IndexController extends CommonController
{
    //
    public function index(){
    	$cate_id=1;
    	$category_model=new Cate;
		$goods_model=new Goods;
    	$cateInfo=$category_model->where(['is_show'=>1,'parent_id'=>0])->get()->toArray();
    	$goodsInfo=$goods_model->where(['is_on_sale'=>1])->get()->toArray();
    	$floorInfo=$this->getFloorInfo($cate_id);
    	if (session('userInfo')!='') {
    		$user=session('userInfo');
	    	$where=[
	    		['u_id'=>$user]
	    	];
	    	$data=Db::table('tp_user')->where($where)->first();
	    	$userName=cache('userName');
	    	// dd($userName);
    		return view('index.index',compact('data','cateInfo','goodsInfo','floorInfo','userName'));
    	}else{
    		return view('index.index',compact('data','cateInfo','goodsInfo','floorInfo'));
    	}
    }

	public function getFloorInfo($cate_id){	
		$category_model=new Cate;
		$goods_model=new Goods;
		$info=[];
		//取出顶级分类数据
		$where=[
			'is_show'=>1,
			'cate_id'=>$cate_id
		];
		$info['topCate']=$category_model->where($where)->first()->toArray();
		// dump($info['topCate']);die;

		//取出二级分类数据
		$where=[
			'is_show'=>1,
			'parent_id'=>$cate_id
		];
		$info['sonCate']=$category_model->where($where)->get()->toArray();
		//取出商品数据
		//查询数据所有的子分类
		$cateInfo=$category_model->where(['is_show'=>1])->get()->toArray();
		//使用递归函数查出所有该顶级分类下的所有子分类
		$c_id=$this->getCateId($cateInfo,$cate_id);
		//就可以查询啦
		$info['goodsCate']=$goods_model->whereIn('cate_id',$c_id)->get()->toArray();
		// dd($info);
		return $info;
	}
}
