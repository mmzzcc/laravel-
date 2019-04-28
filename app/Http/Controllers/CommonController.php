<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class CommonController extends Controller
{
    //内部方法
	public function abort($msg,$url){
		echo "<script>alert('{$msg}');location.href='{$url}'</script>";
	}
    //文件上传
    public function upload($name=''){
        //  dd($name);
        if ($name->isValid()) {
         $extension = $name->extension();
         $store_result = $name->store('user/'.date('Ymd'));
         // $store_result = $photo->storeAs('photo', 'test.jpg');
         return $store_result;
        }
    }
    //成功助手函数
    public function ok($font='操作成功',$code=1){
        echo json_encode(['font'=>$font,'code'=>$code]);
        return;
    }
    //失败助手函数
    public function no($font='操作失败',$code=2){
        echo json_encode(['font'=>$font,'code'=>$code]);
        return;
    }
    //发送邮件
    public function sendMailCode($email)
    {
        $code=rand(111111,999999);
        Mail::send('login/sendMail',['code'=>$code,'name'=>$email],function($message)use($email){
            $message->subject('欢迎注册');
            $message->to($email);
        });
        return $code;
    }
    //发送手机号验证码
    public function sendTel($phone){
        $code=rand(111111,999999);
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "6f7b8ede769b487a97c87fd36ec2f91e";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile=".$phone."&param=code:".$code."&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (curl_exec($curl)) {
            return $code;
        }
    }
    //获取分类的id
    public function getCateId($cateInfo,$parent_id){
        static $id=[];
        foreach ($cateInfo as $k => $v) {
            if ($v['parent_id']==$parent_id) {
                $id[]=$v['cate_id'];
                $this->getCateId($cateInfo,$v['cate_id']);
            }
        }
        return $id;
    }
    
}
