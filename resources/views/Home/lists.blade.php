<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>列表页</title>
    <style>
        a{
            text-decoration: none;
        }
        ul{
            margin: 0;
            padding: 0;
        }
        li{
            list-style-type: none;
        }
        .pagination:after{
            content: '';
            display: block;
            clear: both;
        }
        .pagination{
            margin:10px;
            padding:10px
        }
        .pagination li{
            float: left;
        }
        .pagination li .page-link{
            display: block;
            border: 1px solid #1d68a7;
            width: 33px;
            height: 33px;
            line-height: 33px;
            text-align: center;
        }
        .search{
            height: 20px;
            width: 300px;
        }
        .sea-list{
            position: absolute;
            border:1px solid #a9a9a9;
            top: 25px;
            left: 0;
            width: 302px;
            background: #fff;
            display: none;
        }
        .sea-lists{
            padding: 5px 0;
        }
        .sea-lists li{
            padding: 5px;
            cursor: pointer;
        }
        .sea-lists li:hover{
            background: #1f6fb2;
        }
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
<h3>用户列表</h3>
<a href="{{ route('myuser.create') }}" class="button-a">添加用户</a>
<hr>
<form action="{{ route('myuser.index') }}" method="get">
    搜索用户名：
    <div style="display:inline-block;position:relative;">
        <input type="text" autocomplete="off" placeholder="输入关键字进行联想搜索" name="search" class="search" oninput="seachange()" onclick="seachange()" value="{{ request()->get('search') }}">
        <div class="sea-list">
            <ul class="sea-lists">
            </ul>
        </div>
    </div>
    <input type="submit" value="搜索一下" />
    <input type="button" value="清空" onclick="location.href='{{ route('myuser.index') }}'">
</form>
<hr>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <td>全选<input type="checkbox" class="all"/></td>
        <td>编号</td>
        <td>用户名</td>
        <td>真实姓名</td>
        <td>性别</td>
        <td>邮箱</td>
        <td>手机号</td>
        <td>编号</td>
    </tr>
    @foreach($lists as $v)
        <tr>
            <td><input type="checkbox" class="che" value="{{ $v->id }}"/></td>
            <td>{{ $v->id }}</td>
            <td><a href="{{ route('myuser.detail',['id'=>$v->id]) }}">{{ $v->username }}</a></td>
            <td>{{ $v->truename }}</td>
            <td>{{ $v->gender }}</td>
            <td>{{ $v->email }}</td>
            <td>{{ $v->phone }}</td>
            <td>
                <a href="{{ route('myuser.edit',['id'=>$v->id]) }}">编辑</a> |
                <a href="javascript:;" class="del" uid="{{ $v->id }}">删除</a>
            </td>
        </tr>
    @endforeach
</table>
<hr>
<input type="button" value="全部删除" class="all-del"><span class="msg"></span>
{{-- 搜素分页 --}}
{{ $lists->appends(request()->except('page'))->links() }}
</body>
</html>
<script src="/js/jquery-1.8.3.js"></script>
<script>
    // 搜索框联想搜索 - change
    function seachange(){
        var val = $('.search').val();
        $.ajax({
           url:'{{ route('myuser.think') }}',
           type:'get',
           data:'username='+val,
           dataType:'json',
           success:function(res){
               $('.sea-lists').html('');
                if(res.code==200){
                    var html = '暂无数据';
                    for(var i = 0;i < res.data.length;i++){
                        if(i == 0) {
                            html = '';
                        }
                        html += "<li class='clickthink'>" + res.data[i] + "</li>";
                    }
                    $('.sea-list').css('display','block');
                    $('.sea-lists').append(html);
                    $(document).on('click',function () {
                        $('.sea-list').css('display','none');
                    })

                    // 搜素框联想搜索 - 点击
                    $('.clickthink').click(function () {
                        $('.search').val($(this).text());
                        $('.sea-list').css('display','none');
                        $('form').submit();
                    });
                }
           }
        });
    }


    // 删除按钮 - 调用 ajax删除
    $('.del').click(function () {
        if(!confirm('是否删除？')){
            return false
        }
        var id = $(this).attr('uid');
        del(id,$(this));
    });

    // ajax删除
    function del(id,that){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
            url:"{{ route('myuser.delete',['id'=>'']) }}"+'/'+id,
            type:'delete',
            data:id,
            dataType:'json',
            success:function(res){
                if(res.code == 200){
                    console.log($(this));
                    that.parent().parent().remove();
                }
            }
        });
    }

    // 全选
    $('.all').click(function () {
        var stat = $(this).prop('checked');
        $('.che').prop('checked',stat);
    });

    // 单选联动全选
    $('.che').click(function () {
        var length = $('.che').length;
        for(var i = 0;i < length;i++){
            var stat = $('.che').eq(i).prop('checked');
            if(!stat){
                $('.all').prop('checked',false);
                return;
            }
            $('.all').prop('checked',true);
        }
    });

    // 多删按钮 - 调用 ajax删除
    $('.all-del').click(function () {
        var length = $('.che').length;
        var num = 0;
        for(var i = 0;i < length;i++){
            var stat = $('.che').eq(i).prop('checked');
            if(stat){
                var id = $('.che').eq(i).val();
                num++;
                del(id,$('.che').eq(i));
            }
        }
        if(num==0){
            $('.msg').text('全选择再按删除！');
        }else{
            $('.msg').text('删除成功！');
        }
    });
</script>