@extends('layouts.index')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;">新品</a></li>
      <li><a href="javascript:;">销量</a></li>
      <li><a href="javascript:;">价格</a></li>
     </ul><!--pro-select/-->
     @foreach($data as $v)
     <div class="prolist">
      <dl>
       <dt><a href="detail?goods_id={{$v['goods_id']}}"><img src="index/uploads/{{$v['goods_img']}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">{{$v['goods_name']}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v['shop_price']}}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：{{$v['goods_number']}}</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--prolist/-->
     @endforeach
     <dl>
        <dd>{{$data->links()}}</dd>
    </dl>
@extends('public/foot')
@endsection('content')

