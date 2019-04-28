@extends('layouts.index')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     @foreach($data as $v)
     <table class="jia-len">
      <tr>
       <th><strong class="orange">商品单价：{{$v['shop_price']}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>商品名称：{{$v['goods_name']}}</strong>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="index/uploads/{{$v['goods_img']}}" width="500" height="500" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
       </th>
       <td width="20%"><a href="cart?goods_id={{$v['goods_id']}}" class="jiesuan" style="text-decoration:none">加入购物车</a></td>
        <td width="30"></td>
       <td width="20%"><a href="pay?goods_id={{$v['goods_id']}}" class="jiesuan" style="text-decoration:none">立即购买</a></td>
      </tr>
     </table>
     @endforeach
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <!--焦点轮换-->
    <!-- <script src="js/jquery.excoloSlider.js"></script> -->
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
     <!--jq加减-->
    <!-- <script src="js/jquery.spinner.js"></script> -->
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
     @extends('public.foot')
     @extends('public.foot')
