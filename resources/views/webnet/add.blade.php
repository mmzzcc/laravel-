<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('layui/layui.js')}}"></script>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>友情链接</title>
</head>
<body>
@if ($errors->any())
 <div class="alert alert-danger">
 <ul>
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
@endif
<form action="addHandle" method="post" enctype="multipart/form-data">
  @csrf
  <table border="1" width="700" align="center">
    <tr>
      <td>网站名称</td>
      <td><input type="text" name="w_name" id=""></td>
    </tr>
    <tr>
      <td>网站网址</td>
      <td><input type="text" name="w_net" id=""></td>
    </tr>
    <tr>
      <td>链接类型</td>
      <td><input type="radio" name="w_logonet" id="" value="LOGO链接" checked="">LOGO链接
      <input type="radio" name="w_logonet" id="" value="文字链接">文字链接
      </td>
    </tr>
    <tr>
    <td>图片logo</td>
    <td><input type="text" name="w_text" id="">
      <input type="file" name="w_pic">上传图片
    </td>
    </tr>
    <tr>
      <td>网站联系人</td>
      <td><input type="text" name="w_man" id=""></td>
    </tr>
    <tr>
        <td>网站介绍</td>
        <td><textarea name="w_desc" id="" cols="30" rows="10"></textarea></td>
    </tr>
    <tr>
      <td>是否显示</td>
      <td><input type="radio" name="w_status" id="" value="1" checked="">是
      <input type="radio" name="w_status" id="" value="2">否
      </td>
    </tr>
    <tr>
      <td><button class="btn">提交</button></td>
    </tr>
  </table>
</form>
</body>
</html>
<script type="text/javascript">
  $(function(){
    layui.use(['layer'],function(){
      layer=layui.layer;
        $(document).on('click','.btn',function(){
          var obj={};
          var flag=false;
          obj.w_name=$('input[name="w_name"]').val();
          obj.w_net=$('input[name="w_net"]').val();
          obj._token=$('input[name="_token"]').val();
          var reg=/^\w|[\u4e00-\u9fa5]$/;
          if (obj.w_name=='') {
            layer.msg('网站名不能为空',{icon:2});
            return false;
          }else if(!reg.test(obj.w_name)) {
            layer.msg('网站名为中文数字字母下划线组成',{icon:2});
            return false;
          }else{
              $.ajax({
              url:"checkName",
              method:"get",
              async:false,
              data:{w_name:obj.w_name,_token:obj._token},
              success:function(res){
                if (res.code==2) {
                  layer.msg(res.font,{icon:res.code});
                  flag=false;
                }else{
                  flag=true;
                }
              },
              dataType:'json'
            });
              if (flag==false) {
                return false;
              }
          }
          //验证网站
          var reg1=/(http):\/\/([\w.]+\/?)\S*/;
          if (obj.w_net=='') {
            layer.msg('网站链接不能为空',{icon:2});
            return false;
          }else if (!reg1.test(obj.w_net)){
            layer.msg('网站地址为http://开头',{icon:2});
            return false;
          }
        })
    })
  })
</script>