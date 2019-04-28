@extends('layouts.index')
@section('content')
     <div class="head-top">
      <img src="{{asset('/index/images/head.jpg')}}" />
      <dl>
       <dt><a href="user.html"><img src="/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <span class="username">三级分销终身荣誉会员</span>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     @if(empty($data))
     <ul class="reg-login-click">
      <li><a href="login">登录</a></li>
      <li><a href="register" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     @else
     <div>
     
       <span style="color: red ;font-size: 14px;">欢迎三级分销会员:{{$userName}}</span>
       <span style="margin-right:200px "><a href="logout">退出</a></span>
     </div>
    
    @endif
     <div id="sliderA" class="slider">
      <img src="{{asset('/index/images/image1.jpg')}}" />
      <img src="{{asset('/index/images/image2.jpg')}}" />
      <img src="{{asset('/index/images/image3.jpg')}}" />
      <img src="{{asset('/index/images/image4.jpg')}}" />
      <img src="{{asset('/index/images/image5.jpg')}}" />
     </div><!--sliderA/-->
     <ul class="pronav">
     @foreach($cateInfo as $v)
      <li><a href="">{{$v['cate_name']}}</a></li>
      @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
     @foreach($goodsInfo as $v)
      <div class="index-pro1-list" goods_id="{{$v['goods_id']}}" >
       <dl>
        <dt><a href="detail?goods_id={{$v['goods_id']}}" ><img src="index/uploads/{{$v['goods_img']}}" /></a></dt>
        <dd class="ip-text"><a href="detail?goods_id={{$v['goods_id']}}">{{$v['goods_name']}}</a><span>已售：{{$v['goods_number']}}</span></dd>
        <dd class="ip-price"><strong>¥{{$v['shop_price']}}</strong> <span>¥599</span></dd>
       </dl>
      </div>
      @endforeach
     </div><!--prolist/-->
     <!-- <div class="joins"><a href="fenxiao.html"><img src="/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div> -->
     @extends('public.foot')
     @endsection