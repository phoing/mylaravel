<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            # 自增主键id
            $table->increments('id');
            # 用户名
            $table->string('username',50)->default('')->comment('用户名');
            # 邮箱
            $table->string('email',100)->unique()->default('')->comment('邮箱');
            # 性别
            $table->enum('sex',['1','2'])->default('1')->comment('性别1：男，2：女');
            # remember_token字段
            $table->rememberToken();
            # 生成2个字段，created_at 和 updated_at  此字段只有模型才生效
            $table->timestamps();
            # 软删除标识字段 生成 deleted_at 字段 用于 软删除
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
