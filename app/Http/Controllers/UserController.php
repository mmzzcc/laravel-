<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUserPost;
use App\Http\Controllers\CommonController;
use Validator;
use App\Users;
class UserController extends CommonController
{
   
    //添加
    public function add(){
    	return view('user.add');
    }
    //处理添加 
    public function addHandle(){
    	$data=request()->except('_token');
    	// dd($data);
    	if (!empty($data['pic'])) {
    		$data['pic']=$this ->upload($data['pic']);
    	}
        //验证
        //第一种
        $rule=[
            'name'=>'required|unique:user|max:20|min:2',
            'phone'=>'required|digits:11',
            'age'=>'required|integer',
            'sex'=>'required'
        ];
        $msg=[
                'name.required'=>'用户名不能为空',
                'name.unique'=>'用户已存在',
                'name.max'=>'用户名长度为20个字符',
                'name.min'=>'用户名最短为2个字符',
                'phone.required'=>'手机号不能为空',
                'phone.digits'=>'手机号为11位数字',
                'age.required'=>'年龄不能为空',
                'age.integer'=>'年龄为阿拉伯数字',
                'sex.required'=>'性别不能为空'
        ];
        // request()->validate($rule,$msg);
        // 第二种
        // public function addHandle(StoreUserPost $request)
        //第三种
        $Validator=Validator::make($data,$rule,$msg);
        $errors=$Validator->errors();
        // dd($errors);
        foreach ($errors->all() as $v) {
                $this->abort($v,'add');die;
            }
        $data['pwd']=encrypt($data['pwd']);
        // dd($data['pwd']);
    	$res=Db::table('user')->insert($data);
    	if ($res) {
    		$this->abort('添加成功','index');
    	}else{
    		$this->abort('添加失败','add');
    	}
    }

    //列表展示
    public function index(){
        // session(['username'=>'mcool']);
        // $user=session('username');
        //  // request()->session()->forget('username');
        // $all=request()->session()->all();
        // // dd($all);
       // return response('hello word')->cookie('text','mcool',6);
        
        $query=request()->all();
        // dd($query);
        $where=[];
        $name=$query['name']??'';
        $age=$query['age']??'';
        $page=$query['page']??1;
        if ($name) {
            $where[]=['name','like',"%$name%"];
        }
        if ($age) {
            $where['age']=$age;
        }
        $page=config('app.pageSize');
    	$data=Db::table('user')->where($where)->orderBy('id','desc')->paginate($page);
    	// dd($data);
    	return view('user.index',compact('data','name','age','query'));
    }

    //删除
    public function del(){
    	$id=request()->input('id');
    	// dd($id);
    	$res=Db::delete('delete from user where id=?',[$id]);
    	// dd($res);
    	if ($res) {
    		$this->abort('删除成功','index');
    	}else{
    		$this->abort('删除失败','index');
    	}
    }
    //修改
    public function edit(){
    	$id=request()->input('id');
    	// dd($id);
    	$data=Db::select('select * from user where id=?',[$id]);
    	// dd($data);
    	return view('user.edit',['data'=>$data]);
    }
    //处理修改
    public function editHandle(){
    	$data=request()->except('_token');
        if (!empty($data['pic'])) {
            $data['pic']=$this ->upload($data['pic']);
        }
    	// dd($data);
         $rule=[
            'name'=>'required|max:20|min:2',
            'phone'=>'required|digits:11',
            'age'=>'required|integer',
            'sex'=>'required'
        ];
        $msg=[
                'name.required'=>'用户名不能为空',
                'name.unique'=>'用户已存在',
                'name.max'=>'用户名长度为20个字符',
                'name.min'=>'用户名最短为2个字符',
                'phone.required'=>'手机号不能为空',
                'phone.digits'=>'手机号为11位数字',
                'age.required'=>'年龄不能为空',
                'age.integer'=>'年龄为阿拉伯数字',
                'sex.required'=>'性别不能为空'
        ];
        request()->validate($rule,$msg);
        $user=new Users;
        $res=$user->where('id',$data['id'])->update($data);

    	if ($res) {
    		$this->abort('修改成功','index');
    	}else{
    		$this->abort('修改失败',"edit?id={$data['id']}");
    	}
    }
   //验证唯一性
    public function checkName(){
        $username=request()->input('name')??'';
        $id=request()->input('id')??'';
        // dd($id);
        if (!$username) {
            $this->no('请填写用户名');
            return;
        }
        if ($id) {
            $where=[
                ['id','!=',$id],
                ['name','=',$username]
            ];
        }else{
            $where=[
                'name'=>$username
            ];
        }
        $res=Db::table('user')->where($where)->count();
        // dd($res);
        if ($res>0) {
            $this->no('用户名已存在');
            return;
        }else{
            $this->ok();
        }
    }
}

