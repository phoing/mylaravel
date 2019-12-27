<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create()
    {
        return view('create');
    }

    public function add(Request $request)
    {
        $data = $request->except('_token');

        $filepath = storage_path('app/data.db');

        $db = json_decode(file_get_contents($filepath));

        array_push($db,$data);

        $json = json_encode($db,JSON_UNESCAPED_UNICODE);

        file_put_contents($filepath,$json);

        return redirect(route('create'));
    }

    public function lists()
    {
        $filepath = storage_path('app/data.db');

        $db = file_get_contents($filepath);

        # 第二个参数默认为false，
        # 为false 值为对象
        # 为true  值为数组
        $list = json_decode($db);

        return view('lists',['list'=>$list]);
    }

    public function vuelists()
    {
        $filepath = storage_path('app/data.db');

        $db = file_get_contents($filepath);

        # 第二个参数默认为false，
        # 为false 值为对象
        # 为true  值为数组
        $list = json_decode($db);

        return view('listsvue',['list'=>$db]);
    }
}
