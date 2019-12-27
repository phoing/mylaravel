<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户添加页面</title>
</head>
<body>

<h3>用户添加页面</h3>
<form action="{{ route('add') }}" method="post">
{{ csrf_field() }}
<p>用户名：<input type="text" name="uname"></p>
<p>密 码：<input type="text" name="password"></p>
<input type="submit" value="添加">
</form>
</body>
</html>