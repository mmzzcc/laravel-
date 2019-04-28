@extends('layouts.index')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="login">登陆</a></h3>
      @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="u_email"  placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="u_code" placeholder="输入短信验证码" /> 

       <button class="code" id="sendEmailCode">获取验证码</button></div>
       <div class="lrList"><input type="password" name="u_pwd" placeholder="设置密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" name="u_repwd" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" id="btn" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     @extends('public.foot')
<script type="text/javascript">
$(function(){
  layui.use(['layer'],function(){
    var layer=layui.layer;
    var _token=$('input[name="_token"]').val();
    $(document).on('click','.code',function(){
      var _this=$(this);
      var u_email=$('input[name="u_email"]').val();
      var flag=false;
      if (u_email=='') {
        layer.msg('请填写邮箱或手机号',{icon:2});
        return false;
      }
      //判断是邮箱还是手机 根据长度
      if (u_email.length>11) {
        var reg=/^\w+@\w+.com$/i;
        if (!reg.test(u_email)) {
          layer.msg('邮箱格式不正确',{icon:2});
          return false;
        }else{
          //验证唯一性
          $.ajax({
              url:"checkEmail",
              method:'post',
              async:false,
              data:{u_email:u_email,_token:_token},
              success:function(res){
                if (res.code==2) {
                  layer.msg(res.font,{icon:res.code});
                  flag=false;
                }else{
                  flag=true;
                }
              },
              dataType:"json"
          });
          if (flag==false) {
            return false;
          }
          //发送邮箱验证码
          $.post(
            "sendEmail",
            {u_email:u_email,_token:_token},
            function(msg){
              layer.msg(msg.font,{icon:msg.code});
            },
            'json'
          );
        } 
      }else{
        //手机号注册
        var u_phone=$('input[name="u_email"]').val();
        var reg=/^1[34578]\d{9}$/;
        if (u_phone=='') {
          layer.msg('请填写邮箱或手机号',{icon:2});
          return false;
        }else if(!reg.test(u_phone)){
          layer.msg('手机号格式不正确',{icon:2});
          return false;
        }else{
          //验证唯一性
          $.ajax({
              url:"checkPhone",
              method:'post',
              async:false,
              data:{u_email:u_email,_token:_token},
              success:function(res){
                if (res.code==2) {
                  layer.msg(res.font,{icon:res.code});
                  flag=false;
                }else{
                  flag=true;
                }
              },
              dataType:"json"
          });
          if (flag==false) {
            return false;
          }
          //发送手机号验证码
          $.post(
            "sendPhone",
            {u_email:u_email,_token:_token},
            function(msg){
              layer.msg(msg.font,{icon:msg.code});
            },
            'json'
          );
        }
      }

      //秒数倒计时
      $('.code').text(60+'s');
      setI=setInterval(timeLess,1000);
      //秒数倒计时
      function timeLess(){
        var _time=parseInt($('.code').text());
          if (_time<=0) {
            $('.code').text('获取验证码');
            clearInterval(setI);
            //可以点
            $('#sendEmailCode').css('pointerEvents','auto');
          }else{
            _time=_time-1;
            $('.code').text(_time+'s');
            //不可以点
            $('#sendEmailCode').css('pointerEvents','none');  
        }
      } 
      return false;
    })
    $(document).on('click','#btn',function(){
      var obj={};
      var u_email=$('input[name="u_email"]').val();
      obj.u_code=$('input[name="u_code"]').val();
      obj.u_pwd=$('input[name="u_pwd"]').val();
      obj.u_repwd=$('input[name="u_repwd"]').val();
      var reg=/^\w{6,18}$/;
      var reg1=/^\w+@\w+.com$/i;
      var reg2=/^1[34578]\d{9}$/;
     
      if (u_email.length>11) {
        obj.u_email=u_email;
          if (u_email=='') {
          layer.msg('请填写邮箱或手机号',{icon:2});
          return false;
        }
        if (!reg1.test(u_email)) {
          layer.msg('邮箱格式不正确',{icon:2});
          return false;
        }else{
          //验证唯一性
          $.ajax({
              url:"checkEmail",
              method:'post',
              async:false,
              data:{u_email:u_email,_token:_token},
              success:function(res){
                if (res.code==2) {
                  layer.msg(res.font,{icon:res.code});
                  flag=false;
                }else{
                  flag=true;
                }
              },
              dataType:"json"
          });
          if (flag==false) {
            return false;
          }
        }
      }else{
        obj.u_phone=u_email;
           if (u_email=='') {
          layer.msg('请填写邮箱或手机号',{icon:2});
          return false;
        }else if(!reg2.test(u_email)){
          layer.msg('手机号格式不正确',{icon:2});
          return false;
        }else{ 
          //验证唯一性
          $.ajax({
              url:"checkPhone",
              method:'post',
              async:false,
              data:{u_email:u_email,_token:_token},
              success:function(res){
                if (res.code==2) {
                  layer.msg(res.font,{icon:res.code});
                  flag=false;
                }else{
                  flag=true;
                }
              },
              dataType:"json"
          });
          if (flag==false) {
            return false;
          }
        }
      }
      if (obj.u_pwd=='') {
        layer.msg('请填写密码',{icon:2});
        return false;
      }else if(!reg.test(obj.u_pwd)){
        layer.msg('密码格式不正确',{icon:2});
        return false;
      }else if(obj.u_repwd==''){
        layer.msg('请填写确定密码',{icon:2});
        return false;
      }else if(obj.u_pwd!=obj.u_repwd){
        layer.msg('两次密码不一致',{icon:2});
        return false;
      }
        $.ajax({
          url:"doRegister",
          method:'post',
          data:{obj,_token},
          success:function(msg){
            layer.msg(msg.font,{icon:msg.code});
            if (msg.code==1) {
              location.href="login";
            }
          },
          dataType:'json'
        });//ajax
        return false; 
    })
  })
})
</script>
@endsection('content')