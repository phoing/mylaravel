<?php

namespace App\Http\Controllers\Admin\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\User;

class LoginController extends Controller
{
    # 登录页面
    public function index()
    {
        return view('admin.login.login');
    }

    # 提交验证
    public function login(Request $request)
    {
        $data = $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);

        $res = User::where($data)->first();

        if($res){
            $user = $res->toArray();
            unset($user['password']);
            session(['admin.user' => $user]);
            return redirect(route('admin.user.index'))->with('message','登录成功！');
        }
        return redirect(route('admin.login.index'))->with('message','登录失败！');
    }
}
