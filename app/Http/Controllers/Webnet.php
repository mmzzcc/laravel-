<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CommonController;
class Webnet extends CommonController
{

    //添加
    public function add(){
    	return view('Webnet.add');
    }
    //唯一性验证
    public function checkName(){
    	$w_name=request()->input('w_name')??'';
        $w_id=request()->input('w_id')??'';
        // dd($w_id);
        if (!$w_name) {
            $this->no('网站名不能为空');
            return;
        }
        if ($w_id) {
            $where=[
                ['w_id','!=',$w_id],
                ['w_name','=',$w_name]
            ];
        }else{
            $where=[
                'w_name'=>$w_name
            ];
        }
        $res=Db::table('webnet')->where($where)->count();
        // dd($res);
        if ($res>0) {
            $this->no('网站名已存在');
            return;
        }else{
            $this->ok();
        }
    }
    //处理添加
    public function addHandle(){
    	$data=request()->except('_token');
    	// dd($data);
    	//上传图片
    	if (!empty($data['w_pic'])) {
    		$data['w_pic']=$this->upload($data['w_pic']);
    	}
    	//验证
    	$rules=[
    		'w_name'=>'required|unique:webnet',
    		'w_net'=>'required'
    	];
    	$msg=[
    		'w_name.required'=>'网站名不能为空',
    		'w_name.unique'=>'网站名已存在',
    		'w_net.required'=>'网站链接不能为空'
    	];
    	request()->validate($rules,$msg);
    	$res=Db::table('webnet')->insert($data);
    	// dd($res);
    	if ($res) {
    		$this->abort('添加成功','index');
    	}else{
    		$this->abort('添加失败','add');
    	}
    }
    //展示
    public function index(){
    	//接收数据
    	$query=request()->all();
        // dd($query);
        $where=[];
        $name=$query['w_name']??'';
        $page=$query['page']??1;
        if ($name) {
            $where[]=['w_name','like',"%$name%"];
        }
        // $page=config('app.pageSize');
    	$data=Db::table('webnet')->where($where)->orderBy('w_id','desc')->paginate(3);
    	// dd($data);
    	return view('webnet.index',compact('data','name','query'));
    }
    //删除
    public function del(){
    	$w_id=request()->input('w_id');
    	$res=Db::table('webnet')->where('w_id',$w_id)->delete();
    	if ($res) {
    		$this->ok('删除成功');
    	}else{
    		$this->no('删除失败');
    	}
    }

    //修改
    public function edit(){
    	$w_id=request()->input('w_id');
    	$data=Db::table('webnet')->where('w_id',$w_id)->first();
    	// dd($data);
    	return view('webnet.edit',['data'=>$data]);
    }

    //处理修改
    public function editHandle(){
		$data=request()->except('_token');
        if (!empty($data['w_pic'])) {
            $data['w_pic']=$this ->upload($data['w_pic']);
        }
    	$rules=[
    		'w_name'=>'required',
    		'w_net'=>'required'
    	];
    	$msg=[
    		'w_name.required'=>'网站名不能为空',
    		'w_net.required'=>'网站链接不能为空'
    	];
        request()->validate($rules,$msg);
        $res=DB::table('webnet')->where('w_id',$data['w_id'])->update($data);
    	$this->abort('修改成功','index');
    }
    //验证登陆
    public function doLogin(){
    	$data=request()->except('_token');
    	if ($data['username']!='admin' && $data['pwd']!='admin') {
    		$this->abort('账号或密码错误');
    	}else{
    		session(['sessionInfo'=>1]);
    		$this->abort('登陆成功','webnet/index');
    	}
    }
}
