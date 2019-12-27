<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户详情</title>
    <style>
        .button-a{
            display: inline-block;
            border: 1px solid #e3342f;
            padding: 5px 20px;
            border-radius: 20px;
            background: #e3342f;
            color: #fff;
        }
    </style>
</head>
<body>
<h3>用户详情</h3>
<a href="{{ route('myuser.index') }}" class="button-a">用户列表</a>
<hr>
    <p>用户名：{{ $data->username }}</p>
    <p>姓名：{{ $data->truename }}</p>
    <p>性别：{{ $data->gender }}</p>
    <p>邮箱：{{ $data->email }}</p>
    <p>手机号：{{ $data->phone }}</p>
</body>
</html>