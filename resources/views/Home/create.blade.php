<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加用户</title>
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
<h3>添加用户</h3>
<a href="{{ route('myuser.index') }}" class="button-a">用户列表</a>
<hr>
@if($errors->any())
    @foreach($errors->all() as $v)
        <li>{{ $v }}</li>
    @endforeach
@endif
<form action="{{ route('myuser.store') }}" method="post">
    @csrf
    <label>
        <p>用户名：<input type="text" name="username" value="{{ old('username') }}"></p>
    </label>
    <label>
        <p>姓名：<input type="text" name="truename" value="{{ old('truename') }}"></p>
    </label>
    <label>
        <p>密码：<input type="text" name="password"></p>
    </label>
    <label>
        <p>确认密码：<input type="text" name="password_confirmation"></p>
    </label>
    <p>
        性别：
    <label>
        <input type="radio" name="gender" value="1" @if(old('gender')==1) checked @endif >男
    </label>
        <label>
            <input type="radio" name="gender" value="2" @if(old('gender')==2) checked @endif>女
        </label>
    </p>
        <p>邮箱：<input type="text" name="email" value="{{ old('email') }}"></p>
    </label>
    <label>
        <p>手机号：<input type="text" name="phone" value="{{ old('phone') }}"></p>
    </label>
    <input type="submit" value="添加">
</form>
</body>
</html>