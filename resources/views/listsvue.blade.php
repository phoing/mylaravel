<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>列表展示-vue</title>
</head>
<body>
<h3>列表展示-vue</h3>
<div id="app">
    <table border="1">
        <tr>
            <td>编号</td>
            <td>用户名</td>
            <td>密码</td>
        </tr>
        <tr v-for="(list,key) in lists">
            <td>@{{ key+1 }}</td>
            <td>@{{ list.uname }}</td>
            <td>@{{ list.password }}</td>
        </tr>
    </table>
</div>
</body>
</html>
<script src="https://cdn.bootcss.com/vue/2.6.10/vue.js"></script>
<script>
    var app = new Vue({
        el:'#app',
        data:{
            lists:{!! $list !!}
        }
    });
</script>