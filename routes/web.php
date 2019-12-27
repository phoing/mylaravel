<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

# 用户路由
Route::group(['prefix'=>'user'],function(){
    # 添加页面路由
    Route::get('xs','UserController@create')->name('create');
    # 添加功能路由
    Route::post('tj','UserController@add')->name('add');
    # 列表展示路由
    Route::get('lb','UserController@lists')->name('lists');
    # 列表展示Vue路由
    Route::get('vue','UserController@vuelists')->name('vuelists');
});

# myuser路由
Route::group(['prefix'=>'home','namespace'=>'Home'],function (){
    # 列表
    Route::get('index','MyuserController@index')->name('myuser.index');
    # 添加页面
    Route::get('create','MyuserController@create')->name('myuser.create');
    # 添加功能
    Route::post('store','MyuserController@store')->name('myuser.store');
    # 修改页面
    Route::get('edit/{id}','MyuserController@edit')->name('myuser.edit');
    # 修改功能
    Route::put('update/{id}','MyuserController@update')->name('myuser.update');
    # 查看详情
    Route::get('detail/{id}','MyuserController@detail')->name('myuser.detail');
    # 删除数据
    Route::delete('delete/{id}','MyuserController@delete')->name('myuser.delete');
    # 联想搜索
    Route::get('think','MyuserController@think')->name('myuser.think');
});

# 后台管理路由
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function (){
    # Login路由
    Route::group(['prefix' => 'login','namespace' => 'Login'],function(){
        # 登录页面
        Route::get('login','LoginController@index')->name('admin.login.index');
        # 提交验证
        Route::post('login','LoginController@login')->name('admin.login.login');
    });

    # User路由
    Route::group(['prefix' => 'user','namespace' => 'User'],function (){
        # 列表页面
        Route::get('index','UserController@index')->name('admin.user.index');
        # 添加页面
        Route::get('create','UserController@create')->name('admin.user.create');
        # 添加数据
        Route::post('store','UserController@store')->name('admin.user.store');
        # 修改页面
        Route::get('edit/{id}','UserController@edit')->name('admin.user.edit');
        # 修改数据
        Route::post('update/{id}','UserController@update')->name('admin.user.update');
        # 软删除数据
        Route::get('delete/{id}','UserController@delete')->name('admin.user.delete');
        # 回收站
        Route::get('trash','UserController@trash')->name('admin.user.trash');
        # 恢复软删除
        Route::get('recover/{id}','UserController@recover')->name('admin.user.recover');
        # 真实删除
        Route::get('destroy/{id}','UserController@destroy')->name('admin.user.destroy');
    });
});