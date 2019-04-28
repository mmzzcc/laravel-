<?php

namespace App\Http\Controllers;
use App\model\Goods;
use App\model\Area;
use App\model\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\DB;

class GoodsController extends CommonController
{
    //商品详情页
    public function detail(){
    	$goods_id=request()->input();
    	$goods_model=new Goods;
    	$data=$goods_model->where('goods_id',$goods_id)->get()->toArray();
    	// dd($data);
    	return view('goods.detail',compact('data'));
    }
    public function goodslist(){
    	$goods_model=new Goods;
    	$data=$goods_model->where(['is_on_sale'=>1])->paginate(5);
    	return view('goods.goodslist',compact('data'));
    }
    //购物车列表
    public function cart(){
    	if (session('userInfo')=='') {
    		$this->abort('请登录','login');
    	}
    	$goods_id=request()->input('goods_id');
    	// dd($goods_id);
    	if (isset($goods_id) || !empty($goods_id)) {
    		$goods_model=new Goods;
    		$data=$goods_model->where('goods_id',$goods_id)->get()->toArray();
    	}else{
    		$data=[];
    	}
    	$count=count($data);
    	// dd($data);
    	return view('goods.cart',compact('data','count'));
    }

    public function countTotal(){
    	$goods_id=request()->input('goods_id');
    	// dd($goods_id);
    	$goods_model=new Goods;
    	$data=$goods_model->where('goods_id',$goods_id)->first()->toArray();
    	// dd($data);
    	$countTotal=$data['shop_price'];
    	return json_encode($countTotal);
    }

    //支付列表
    public function pay(){
    	$goods_id=request()->input('goods_id');
    	$goods_model=new Goods;
    	$data=$goods_model->where('goods_id',$goods_id)->first()->toArray();
    	// dd($data);
    	$countTotal=$data['shop_price'];
    	return view('goods.pay',compact('data','countTotal'));
    }

    //订单支付
    public function success(){
    	$shop_price=request()->input('shop_price');
    	return view('goods.success',compact('shop_price'));
    }

    //收货地址
    public function address(){
    	$id=request()->id;
        // dd($id);
        $where=[
            ['pid','=',$id]
        ];
        $area_model=new Area;
        $addressInfo=$area_model->where($where)->get()->toArray();
        // dd($addressInfo);
        if(!empty($addressInfo)){
            return json_encode($addressInfo);
        }
        return view('goods.address',compact('addressInfo'));
    }
    //获取三级联动
    public function getarea(){
        $id=request()->id;
        // dd($id);
        $where=[
            ['pid','=',$id]
        ];
        $area_model=new Area;
        $addressInfo=$area_model->where($where)->get()->toArray();
        dd($addressInfo);
        if(!empty($addressInfo)){
            return json_encode($addressInfo);
        }
    	return view('goods.address',compact('addressInfo'));

    }
   	//添加地址
    public function addressadd(){
        $data=request()->all();
        // dd($data);
        $userInfo=request()->session()->get('userInfo');
        $u_id=$userInfo['u_id'];
        $data['u_id']=$u_id;
        $address_model=new Address;
        $res=$address_model->insert($data);
        if($res){
            echo json_encode(['code'=>1]);
        }else{
            echo json_encode(['code'=>2]);
        }
    }
}

