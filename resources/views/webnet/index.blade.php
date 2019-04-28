<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('layui/layui.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/page.css')}}">
<form action=""><input type="text" name="w_name" placeholder="按网站名称搜索" value="{{ $name }}">
<button>搜索</button>
</form>
<a href="add">添加</a>
<table border="1" width="900" align="center">
	<th>id</th>
	<th>网站名称</th>
	<th>图片logo</th>
	<th>链接类型</th>
	<th>状态</th>
	<th>操作</th>
	@foreach($data as $v)
	<tr>
		<td>{{ $v->w_id }}</td>
		<td>{{ $v->w_name }}</td>
		<td><img src="http://uploads.1810.com/{{ $v->w_pic }}" width="50"></td>
		<td>{{ $v->w_logonet }}</td>
		<td> @if($v->w_status==1) 显示@else 不显示 @endif </td>
		<td><a id="del" w_id="{{$v->w_id}}" href="#">删除</a>|<a href="edit?w_id={{$v->w_id}}">修改</a></td>
	</tr>
	@endforeach
	<tr>
		<td style="text-align: center;" colspan="7">{{ $data->appends($query)->links() }}</td>
	</tr>
</table>
<script type="text/javascript">
layui.use(['layer'],function(){
	var layer=layui.layer;
	$(document).on('click','#del',function(){
		var _this=$(this);
		var w_id=_this.attr('w_id');
		$.ajax({
			url:"del",
			method:"get",
			data:{w_id:w_id},
			async:false,
			success:function(res){
				layer.msg(res.font,{icon:res.code});
				if (res.code==1) {
					location.href="index";
					_this.parents('tr').remove();
				}
			},
			dataType:'json'
		})
	})
})
</script>


