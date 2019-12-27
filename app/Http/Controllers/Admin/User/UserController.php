<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\User;

class UserController extends Controller
{
    # 列表页
    public function index()
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        $data = User::orderBy('id','desc')->paginate(3);
        return view('admin.user.index',compact('data'));
    }

    # 添加页面
    public function create()
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        return view('admin.user.create');
    }
    # 添加数据
    public function store(Request $request)
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        $data = $this->validate($request,[
            'username' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required|email',
            'sex' => 'required|between:1,2'
        ]);

        $model = User::create($data);

        return redirect(route('admin.user.index'))->with('message','用户【' . $model->username . '】添加成功！');
    }

    # 修改页面
    public function edit(int $id)
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        $data = User::find($id);

        return view('admin.user.edit',compact('data'));
    }
    # 修改数据
    public function update(Request $request,int $id)
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        $data = $this->validate($request,[
            'username' => 'required',
            'email' => 'required|email',
            'sex' => 'required|between:1,2'
        ]);

        $res = User::where('id',$id)->update($data);
        return redirect(route('admin.user.index'))->with('message','用户【' . $data["username"] . '】修改成功');
    }

    # 删除数据
    public function delete(int $id)
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        $res = User::destroy($id);

        return redirect(route('admin.user.index'))->with('message','删除成功');
    }

    # 回收站
    public function trash()
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        $data = User::onlyTrashed()->paginate(3);

        return view('admin.user.trash',compact('data'));
    }

    # 恢复
    public function recover(int $id)
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        $res = User::where('id',$id)->onlyTrashed()->first();
        $res->restore();

        return redirect(route('admin.user.index'))->with('message','用户【' . $res->username . '】恢复成功');
    }

    # 真实删除
    public function destroy(int $id)
    {
        if(!session()->has('admin.user')){
            return redirect(route('admin.login.login'))->with('message','非法登录');
        }
        $res = User::where('id',$id)->onlyTrashed()->first();
        $res->forceDelete();

        return redirect(route('admin.user.trash'))->with('message','用户【' . $res->username . '】删除成功');
    }
}
