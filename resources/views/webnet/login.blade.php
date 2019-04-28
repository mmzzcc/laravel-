<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="doLogin" method="post">
		<table border="1" align="center">
		@csrf
			<tr>
				<td>账号</td>
				<td><input type="text" name="username" id="" placeholder="默认账号admin"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name="pwd" id=""></td>
			</tr>
			<tr>
				<td align="center"><button>登陆</button></td>
			</tr>
		</table>
	</form>
</body>
</html>