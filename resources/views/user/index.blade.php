<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/page.css')}}">
<form action=""><input type="text" name="name" placeholder="按姓名搜索" value="{{ $name }}">
<select name="age" id="">
<option value="">按年龄搜索</option>
<option value="18" @if($age==18) selected @endif >18</option>
<option value="35" @if($age==35) selected @endif >35</option>
</select>
<button>搜索</button>
</form>
<a href="add">添加</a>
<table border="1" width="900" align="center">
	<th>id</th>
	<th>姓名</th>
	<th>性别</th>
	<th>电话</th>
	<th>年龄</th>
	<th>头像</th>
	<th>操作</th>
	@foreach($data as $v)
	<tr>
		<td>{{ $v->id }}</td>
		<td>{{ $v->name }}</td>
		<td> @if($v->sex==0) 男@else 女 @endif </td>
		<td>{{ $v->phone }}</td>
		<td>{{ $v->age }}</td>
		<td><img src="http://uploads.1810.com/{{ $v->pic }}" width="50"></td>
		<td><a href="del?id={{$v->id}}">删除</a>|<a href="edit?id={{$v->id}}">修改</a></td>
	</tr>
	@endforeach
	<tr>
		<td style="text-align: center;" colspan="7">{{ $data->appends($query)->links() }}</td>
	</tr>
</table>
<script type="text/javascript">
$(function(){
	// alert('欢迎光临');
})
</script>

