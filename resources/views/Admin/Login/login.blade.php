<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">欢迎登录后台管理</h1>
            <p class="lead">这是一个测试中的项目</p>
        </div>
    </div>
    <div style="padding: 0 5%;">
        @if(session()->has('message'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('message') }}
        </div>
        @endif
        <form action="{{ route('admin.login.login') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">账号</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @if($errors->has('username'))
                <small id="emailHelp" class="form-text text-muted">{{ $errors->first('username') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                @if($errors->has('password'))
                    <small id="emailHelp" class="form-text text-muted">{{ $errors->first('password') }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">登录</button>
        </form>
    </div>
</body>
</html>