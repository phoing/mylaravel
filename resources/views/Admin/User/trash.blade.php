<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>回收站</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">回收站</h1>
        <p class="lead">所有被逻辑删除的用户都在这了</p>
    </div>
</div>

<div style="padding: 0 1%;">
    @if(session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    <a href="{{ route('admin.user.index') }}" class="btn btn-primary" style="float: right;margin: 0 0 10px 0">用户列表</a>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">编号</th>
            <th scope="col">用户名</th>
            <th scope="col">邮箱</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
        <tr>
            <th scope="row">{{ $v->id }}</th>
            <td>{{ $v->username }}</td>
            <td>{{ $v->email }}</td>
            <td>
                <a href="{{ route('admin.user.recover',['id' => $v->id]) }}" class="badge badge-pill badge-primary">恢复</a>
                <a href="{{ route('admin.user.destroy',['id' => $v->id]) }}" class="badge badge-pill badge-danger" onclick="if(!confirm('是否删除')){ return false;}">删除</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
</body>
</html>