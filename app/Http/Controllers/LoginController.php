<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CommonController;
use App\model\User;

class LoginController extends CommonController
{
    //登陆
    public function login(){
    	return view('login.login');
    }
    //处理登陆
    public function doLogin(){
    	$userData=request()->input('obj');
    	// dd($data);
    	$where=[];
    	if (!empty($userData['u_email'])) {
    		$where=['u_email'=>$userData['u_email']];
    	}else{
    		$where=['u_phone'=>$userData['u_phone']];
    	}
    	$user_model=new User;
    	$data=$user_model->where($where)->first();
		if (!$data) {
			$this->no('用户不存在');
      return;
		}
		$u_pwd=md5($userData['u_pwd']);
		$now=time();
		//错误次数
		$error_num=$data["error_num"];
		//错误时间
		$error_time=$data['error_time'];
		//密码错误
		if ($u_pwd!=$data['u_pwd']) {
			if ($now-$error_time>3600) {
				$errorData=[
					'error_num'=>1,
					'error_time'=>$now
				];
				//入库
					$user_model->where(['u_id'=>$data['u_id']])->update($errorData);
					$this->no('邮箱或密码错误,您还有4次机会！');
					return;
			}else{
				//如果错误次数大于等于3
				if ($error_num>=5) {
					$this->no('账号异常 已锁定,请一小时后再试');
					return;
				}else{
					// 否则继续进行监听 错误信息更新
					$errorData=[
					'error_num'=>$error_num+1,
					'error_time'=>$now
				];
				//入库
				$user_model->where(['u_id'=>$data['u_id']])->update($errorData);
				$count=5-($error_num+1);
				$this->no('邮箱或密码错误,您还有'.$count.'次机会！');
				return;
				}
			}
		}else{
			//密码正确
			if ($error_num>=5 && $now-$error_time<3600) {
				$errorTime=60-ceil(($now-$error_time)/60);
				$this->no('账号已锁定,请'.$errorTime.'分钟后登陆');
				return;
			}
			//登陆成功即代表已通过验证 给该用户错误信息清零
			$errorData=[
				'error_time'=>null,
				'error_num'=>0
			];
			$user_model->where(['u_id'=>$data['u_id']])->update($errorData);
			$sessionInfo=[
				'u_id'=>$data['u_id'],
			];
			session(['userInfo'=>$sessionInfo]);
      // $userName=cache('userName');
      // if (!$userName) {
      //   $userName=$user_model->where(['u_id'=>$data['u_id']])->first()->toArray();
      cache(['userName'=>$data['u_email']],60*24);
      // }
			$this->ok('登陆成功');
		}	
    }

    //退出
    public function logout(){
      session(['userInfo'=>null]);
      $this->abort('退出成功','/');
    }

    //注册
    public function register(){
    	return view('login.register');
    }
    //处理注册
    public function doRegister(){
    	$data=request()->input('obj');
    	unset($data['u_repwd']);
      // dd($emailcode);
      if (isset($data['u_email'])) {
        //验证邮箱验证
        $code=session('sessionCode');
      }else{
        $code=session('sessionTel');
      }
      if ($data['u_code']!=$code) {
        $this->no('验证码错误');
        return;
      }
      $codeTime=request()->session()->get('codeTime');
      if (time()-$codeTime>60*5) {
        $this->no('验证码失效');
        return;
      }
    	$data['u_pwd']=md5($data['u_pwd']);
    	$res=Db::table('tp_user')->insert($data);
    	// dd($res);
    	if ($res) {
    		$this->ok('注册成功');
        return;
    	}else{
    		$this->no('注册失败');
        return;
    	}
    }
    //验证邮箱唯一性
   	public function checkEmail(){
   		$u_email=request()->input('u_email');
    	// dd($u_email);
    	$res=Db::table('tp_user')->where('u_email',$u_email)->count();
    	// dd($res);
    	if ($res) {
    		$this->no('用户已经注册');
    	}else{
    		$this->ok();
    	}
   	}
   	//发送邮箱验证
   	public function sendEmail(){
   		$u_email=request()->input('u_email');
   		// dd($u_email);
   		$res=$this->sendMailCode($u_email);
   		if ($res) {
        session(['sessionCode'=>$res,'codeTime'=>time()]);
   			$this->ok('已发送');
   		}else{
   			$this->no('未知错误,检查网络是否通畅');
   		}
   	}
   	//验证唯一性
   	public function checkPhone(){
   		$u_phone=request()->input('u_email');
    	// dd($u_email);
    	$res=Db::table('tp_user')->where('u_phone',$u_phone)->count();
    	// dd($res);
    	if ($res) {
    		$this->no('用户已经注册');
    	}else{
    		$this->ok();
    	}
   	}
   	//发送手机号验证码
   	public function sendPhone(){
   		$u_phone=request()->input('u_email');
   		$res=$this->sendTel($u_phone);
   		// dd($res);
   		if ($res) {
        session(['sessionTel'=>$res]);
   			$this->ok('已发送');
   		}else{
   			$this->no('未知错误');
   		}
   	}
}
