@extends('layouts.index')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员登陆</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="doLogin" method="post" class="reg-login">
      <h3>还没有三级分销账号？点此<a class="orange" href="register">注册</a></h3>
      @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="account" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" name="u_pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" id="btn" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     @extends('public.foot')

<script type="text/javascript">
$(function(){
  layui.use(['layer'],function(){
      var layer=layui.layer;
      $(document).on('click','#btn',function(){
        var obj={};
        var account=$('input[name="account"]').val();
        var _token=$('input[name="_token"]').val();
        obj.u_pwd=$('input[name="u_pwd"]').val()
        if (account=='' || obj.u_pwd=='') {
          layer.msg('请填写完整信息',{icon:2});
          return false;
        }
        if(account.length>11){
          obj.u_email=account;
        }else{
          obj.u_phone=account;
        }
          $.ajax({
            url:"doLogin",
            method:'post',
            data:{obj,_token},
            success:function(res){
              layer.msg(res.font,{icon:res.code});
              if(res.code==1){
                location.href="/";
              }
            },
            dataType:'json'
          });
          return false;
      })
  })
})
</script>
     @endsection('content')