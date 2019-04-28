@extends('layouts.index')
@section('content')
<body>
  <div class="maincont">
   <header>
    <a  class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
    <div class="head-mid">
     <h1>收货地址</h1>
    </div>
   </header>
   <div class="head-top">
    <img src="{{asset('images/head.jpg')}}" />
   </div><!--head-top/-->
  
    <div class="lrBox">
     <div class="lrList"><input type="text" id="address_name" placeholder="收货人" /></div>
   
    
      <select id="province" class="changearea">
       <option value="0" selected="selected">省份/直辖市</option>
       @foreach($addressInfo as $v)
       <option value="{{$v['id']}}">{{$v['name']}}</option>
       @endforeach
      </select>
     
     
      <select id="city" class="changearea">
       <option>区县</option>
        <option value="0" selected="selected" >请选择...</option> 
      </select>
    
     
      <select id="area" class="changearea">
       <option>详细地址</option> 
        <option value="0" selected="selected" >请选择...</option> 
      </select>
    
    
       <div class="lrList"><input type="text" id="address_detail" placeholder="详细地址" /></div>
     <div class="lrList"><input type="text" id="address_tel" placeholder="手机" /></div>
    </div><!--lrBox/-->
    <div class="lrSub">
     <input type="submit" id="add_b" value="保存" />
    </div>
   

<script type="text/javascript">
$(function(){
//三级联动
$('.changearea').change(function(){
var _this=$(this);
var _option="<option value='0' select='selected'>--请选择--</option>";
_this.nextAll('select').html(_option);
var id=_this.val();
alert(id);
$.ajaxSetup({     
            headers: {         
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')   
            } 
         }); 
  $.ajax({
      url:'getarea',
      data:{id:id},
      method:'post',
      success:function(res){
          for(var i in res){
            _option+="<option value='"+res[i]['id']+"'>"+res[i]['name']+"</option>";
          }
          _this.next('select').html(_option);
      },
      dataType:'json'
      
  })
});

//添加
$('#add_b').click(function(){
var obj={};
  obj.province=$('#province').val();
  obj.city=$('#city').val();
  obj.area=$('#area').val();
  obj.address_name=$('#address_name').val();
  obj.address_detail=$('#address_detail').val();
  obj.address_tel=$('#address_tel').val();
  // console.log(obj);
  $.ajax({
    url:"addressadd",
    method:'post',
    data:obj,
    dataType:'json',
    success:function(res){
        if(res.code==1){
          alert('添加成功');
          location.href="address";
   }
})

</script>>
@endsection('content')
