<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加用户</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">添加用户</h1>
        <p class="lead">增加一个新的用户</p>
    </div>
</div>

<div style="padding: 0 5%;">
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $v)
            <li>{{ $v }}</li>
        @endforeach
    </div>
    @endif
    <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">账号</label>
            <div class="col-sm-10">
                <input type="text" name="username"  class="form-control" id="staticEmail" value="{{ old('username') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">密码</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">重复密码</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" name="email"  class="form-control" id="staticEmail" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">性别</label>

            <div class="form-check form-check-inline" style="padding-left: 15px">
                <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="1" @if(old('sex')==1) checked @endif>
                <label class="form-check-label" for="inlineRadio1">男</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="2" @if(old('sex')==2) checked @endif>
                <label class="form-check-label" for="inlineRadio2">女</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">头像</label>
            <div class="col-sm-10">
                <input type="file" name="pic" id="">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">添加</button>
        <a href="{{ route('admin.user.index') }}" class="btn btn-primary">返回</a>
    </form>
<div/>
</body>
</html>