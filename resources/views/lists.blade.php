<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>列表展示-foreach循环</title>
</head>
<body>
<h3>列表展示-foreach循环</h3>
<table border="1">
    <tr>
        <td>编号</td>
        <td>用户名</td>
        <td>密码</td>
    </tr>
    @foreach($list as $k => $v)
    <tr>
        <td>{{ $k+1 }}</td>
        <td>{{ $v->uname }}</td>
        <td>{{ $v->password }}</td>
    </tr>
     @endforeach
</table>
</body>
</html>