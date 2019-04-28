@extends('layouts.index')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="images/head.jpg" />
     </div><!--head-top/-->

     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     <div class="dingdanlist">
    @if($data=='')
        <h1>您的购物车还没有商品，快去选购吧</h1>
    @else
     @foreach($data as $v)
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" id="allBox" /> 全选</a></td>
       </tr>
       <tr goods_id="{{$v['goods_id']}}">
        <td width="4%"><input type="checkbox" class="box"/></td>
        <td class="dingimg" width="15%"><img src="index/uploads/{{$v['goods_img']}}" /></td>
        <td width="50%">
         <h3>{{$v['goods_name']}}</h3>
         <time>下单时间：2019-04-19</time>
        </td>
        <td align="right"><input type="text" class="spinnerExample" /></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v['shop_price']}}</strong></th>
       </tr>
      </table>
    
     </div>
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">￥<font id="count">0</font></strong></td>
       <td width="20%"><a href="/" class="jiesuan">继续选购</a></td>
       <td width="20%"><a href="pay?goods_id={{$v['goods_id']}}" class="jiesuan">去结算</a></td>
      </tr>
     </table>
      @endforeach
      @endif
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <!--jq加减-->
    <script src="js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
<script type="text/javascript">
$(function(){
  layui.use(['layer'],function(){
    var layer=layui.layer;
    //全选 反选
    $('#allBox').click(function(){
        var status=$(this).prop('checked');
         $('.box').prop('checked',status);
         //调用计算总价格函数
         countTotal();
    })
    $('.box').click(function(){
         countTotal();
    })
  //求总价函数
  function countTotal(){
      var _box=$('.box');
      var goods_id='';
      _box.each(function(index){
           if ($(this).prop('checked')==true) {
              goods_id+=$(this).parents('tr').attr('goods_id')+',';
          }
      });
      goods_id=goods_id.substr(0,goods_id.length-1);
      $.ajax({
          url:"countTotal",
          method:'get',
          data:{goods_id},
          success:function(res){
              $('#count').text(res);
          }
      })
    }
  })
})
</script>
@endsection('content')