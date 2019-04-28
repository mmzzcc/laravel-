<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('layui/layui.js')}}"></script>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加信息</title>
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
	<form action="addHandle" method="post" enctype="multipart/form-data" >
	@csrf
		<table border="1" width="700" align="center">
			<tr>
				<td>姓名</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name="pwd"></td>
			</tr>
			<tr>
				<td>头像</td>
				<td><input type="file" name="pic" ></td>
			</tr>
			<tr>
				<td>性别</td>
				<td><input type="radio" name="sex" value="0">男
					<input type="radio" name="sex" value="1">女
				</td>
			</tr>
			<tr>
				<td>电话</td>
				<td><input type="text" name="phone"></td>
			</tr>
			<tr>
				<td>年龄</td>
				<td><input type="text" name="age"></td>
			</tr>
			<tr>
				<td><button class="btn">提交</button></td>
				<td><input type="reset" value="重置"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<script type="text/javascript">
$(function(){
	layui.use(['layer'],function(){
		var layer=layui.layer;
		
		$(document).on('click','.btn',function(){
			var flag=false;
			var obj={};
			obj.name=$('input[name="name"]').val();
			obj.phone=$('input[name="phone"]').val();
			obj.age=$('input[name="age"]').val();
			obj._token=$('input[name="_token"]').val();
			var reg=/^\w{2,20}$/;
			//验证姓名
			if (obj.name=='') {
				layer.msg('请填写用户名',{icon:5});
				return false;
			}else if(!reg.test(obj.name)) {
				layer.msg('用户名由2-20为数字字母下划线组成',{icon:2});
				return false;
			}else{
					$.ajax({
					url:"checkName",
					method:"post",
					data:{name:obj.name,_token:obj._token},
					async:false,
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
			}
			//验证电话
			if (obj.phone=='') {
				layer.msg('请填写手机号码',{icon:5});
				return false;
			}else{
				var reg=/^\d{11}$/;
				if (!reg.test(obj.phone)) {
					layer.msg('手机号为11位数字',{icon:2});
					return false;
				}
			}
			//验证年龄
			if (obj.age=='') {
				layer.msg('请填写年龄',{icon:5});
				return false;
			}else{
				var reg=/^\d+$/;
				if (!reg.test(obj.age)) {
					layer.msg('年龄为阿拉伯数字',{icon:2});
					return false;
				}
			}
			$('form').submit();
		})
	})
})
</script>