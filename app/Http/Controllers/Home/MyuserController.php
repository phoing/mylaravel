<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use DB;
use Illuminate\Support\Facades\DB;

class MyuserController extends Controller
{
    private $table = 'user';

    private $db;

    public function __construct()
    {
        $this->db = DB::table($this->table);
    }

    # 列表
    public function index(Request $request)
    {
        $search = $request->get('search');

        $lists = $this->db->when($search,function ($query) use($search){
            $query->where('username','like',"%{$search}%");
        })->paginate(3);
        return view('Home.lists',['lists'=>$lists]);
    }

    # 联想搜索
    public function think(Request $request)
    {
        $search = $request->get('username');
        $data = [];
        if($search){
            $data = $this->db->where('username','like',"%{$search}%")->pluck('username');
        }
        $res = [
            'code' => 200,
            'data' => $data
        ];
        echo json_encode($res);die;
    }

    # 添加页面
    public function create()
    {
        return view('Home.create');
    }

    # 添加功能
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'username' => 'required',
            'truename' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required|email',
            'phone' => 'required|regex:/1[3-9]\d{9}/',
            'gender' => 'required|between:1,3',
        ]);

        $this->db->insert($data);

        return redirect(route('myuser.index'));
    }

    # 修改页面
    public function edit(int $id)
    {
        $data = $this->db->where('id',$id)->first();
        return view('Home.edit',['data'=>$data]);
    }

    # 修改功能
    public function update(Request $request,int $id)
    {
        $data = $this->validate($request,[
            'username' => 'required',
            'truename' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/1[3-9]\d{9}/',
            'gender' => 'required|between:1,3',
        ]);

        $this->db->where('id',$id)->update($data);

        return redirect(route('myuser.index'));
    }

    # 查看详情
    public function detail(int $id)
    {
        $data = $this->db->where('id',$id)->first();
        return view('Home.detail',['data' => $data]);
    }

    # 删除数据
    public function delete(int $id)
    {
        $this->db->where('id',$id)->delete();
        $data = [
            'code' => 200,
            'msg' => '删除成功'
        ];
        echo json_encode($data);die;
//        return redirect(route('myuser.index'));
    }
}
