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
            $table->increments('id');
            $table->string('name')->nullable()->default('')->comment('登录名');
            $table->string('email')->nullable()->default('')->comment('邮箱');
            $table->string('password')->nullable()->default('')->comment('密码');
            $table->string('nickname')->nullable()->default('会员')->comment('用户昵称');
            $table->string('header')->nullable()->default('')->comment('头像');
            $table->string('mobile')->nullable()->default('')->comment('手机号');
            $table->string('shenfenzheng')->nullable()->default('')->comment('身份证');
            $table->string('address')->nullable()->default('')->comment('地址');
            $table->string('type')->nullable()->default('会员')->comment('用户类型 管理员和会员');
            $table->string('weixin')->nullable()->default('')->comment('openid');
            $table->string('status')->nullable()->default('开启')->comment('用户状态'); // 禁止， 开启
            $table->date('birthday')->nullable()->comment('用户生日');
			$table->float('account_price')->nullable()->default(0)->comment('账户余额');
            $table->rememberToken();
            $table->timestamps();
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
