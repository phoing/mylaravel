<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\User;
# 图片缩放
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    # 列表页
    public function index()
    {
//        $userModel = User::find(1);
//        dd($userModel->userextinfo()->first());
//        dd($userModel->userextinfo);

//        $userModel = User::where('id',1)->with('userextinfo')->first();
//        $userModel = User::where('id',1)->with('userextinfo:user_id,body')->first();
//        $userModel = User::where('id',1)->with(['userextinfo'=>function($query){}])->first();
//        dd($userModel);

//        $arts = User::find(1);
//        dd($arts->arts()->get()->toArray());
//        dd($arts->arts->toArray());
//        $arts = User::where('id',1)->with('arts')->first();
//        $arts = User::where('id',1)->with('arts:user_id,title')->first();
//        $arts = User::where('id',1)->with(['arts'=>function($query){
//            $query->where('title','like',"%法%");
//        }])->first();
//        dd($arts->toArray());

//        $admins = User::find(1);
//        $ret = $admins->auths()->pluck('name','user_id');
//        dd($ret->toArray());

//        $date = cache()->remember('data',5,function (){
//            return User::all();
//        });
//        dump($date->toArray());

        $data = User::orderBy('id','desc')->paginate(3);
        return view('admin.user.index',compact('data'));
    }

    # 添加页面
    public function create()
    {
        return view('admin.user.create');
    }
    # 添加数据
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'username' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required|email',
            'sex' => 'required|between:1,2'
        ]);

//        dump($file);die;
        if($request->hasFile('pic')){
            $file = $request->file('pic');
            /*$ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('uploads'),$filename);*/

            $filename = $file->store('','user');
            $data['pic'] = '/uploads/' . $filename;

            # 图片缩放
            $img = Image::make(public_path($data['pic']));
            $img->resize(100,100)->save(public_path($data['pic']),100);
        }

        $model = User::create($data);

        return redirect(route('admin.user.index'))->with('message','用户【' . $model->username . '】添加成功！');
    }

    # 修改页面
    public function edit(int $id)
    {
        $data = User::find($id);

        return view('admin.user.edit',compact('data'));
    }
    # 修改数据
    public function update(Request $request,int $id)
    {
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
        $res = User::destroy($id);

        return redirect(route('admin.user.index'))->with('message','删除成功');
    }

    # 回收站
    public function trash()
    {
        $data = User::onlyTrashed()->paginate(3);

        return view('admin.user.trash',compact('data'));
    }

    # 恢复
    public function recover(int $id)
    {
        $res = User::where('id',$id)->onlyTrashed()->first();
        $res->restore();

        return redirect(route('admin.user.index'))->with('message','用户【' . $res->username . '】恢复成功');
    }

    # 真实删除
    public function destroy(int $id)
    {
        $res = User::where('id',$id)->onlyTrashed()->first();
        $res->forceDelete();

        return redirect(route('admin.user.trash'))->with('message','用户【' . $res->username . '】删除成功');
    }
}
