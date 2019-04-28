<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('layui/layui.js')}}"></script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改信息</title>
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
	<form action="editHandle" method="post" enctype="multipart/form-data">
	@csrf
		<table border="1" width="700" align="center">
		@foreach($data as $v)
		<input type="hidden" name="id" value="{{ $v->id }}">
			<tr>
				<td>姓名</td>
				<td><input type="text" name="name" value="{{ $v->name }}"></td>
			</tr>
			<tr>
				<td>性别</td>
				<td><input type="radio" name="sex" value="0" @if($v->sex==0) checked @endif >男
					<input type="radio" name="sex" value="1" @if($v->sex==1) checked @endif >女
				</td>
			</tr>
			<tr>
				<td>原头像</td>
				<td><img src="http://uploads.1810.com/{{$v->pic}}" alt="这是张图片" width="50"></td>
			</tr>
			<tr>
				<td>新头像</td>
				<td><input type="file" name="pic" ></td>
			</tr>
			<tr>
				<td>电话</td>
				<td><input type="text" name="phone" value="{{ $v->phone }}"></td>
			</tr>
			<tr>
				<td>年龄</td>
				<td><input type="text" name="age" value="{{ $v->age }}"></td>
			</tr>
			<tr>
				<td><button class="btn">提交</button></td>
				<td><input type="reset" value="重置"></td>
			</tr>
			@endforeach
		</table>
	</form>
</body>
</html>
<script type="text/javascript">
$(function(){
	layui.use(['layer'],function(){
		// alert(111)
		var layer=layui.layer;
		var flag=false;
		$(document).on('click','.btn',function(){
			var obj={};
			obj.name=$('input[name="name"]').val();
			obj.phone=$('input[name="phone"]').val();
			obj.age=$('input[name="age"]').val();
			obj._token=$('input[name="_token"]').val();
			obj.id=$('input[name="id"]').val();

			//验证姓名
			if (obj.name=='') {
				layer.msg('请填写用户名',{icon:5});
				return false;
			}else{
				var reg=/^\w{2,20}$/;
				if (!reg.test(obj.name)) {
					layer.msg('用户名由2-20为数字字母下划线组成',{icon:2});
					return false;
				}
			}
			$.ajax({
				url:"checkName",
				method:"post",
				data:{name:obj.name,_token:obj._token,id:obj.id},
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
			if (flag==false) {
				return false;
			}else{
				return true;
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