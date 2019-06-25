<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->nullable()->comment('单号');
            $table->integer('user_id')->nullable()->comment('用户id');
            $table->string('type')->nullable()->comment('交易方式(充值|提现|交易)');
            $table->float('price')->nullable()->comment('交易价格');
            $table->string('status')->nullable()->comment('交易状态(发起|处理中|已完成)');
            $table->string('arrive_time')->nullable()->comment('预计到账时间');
            $table->integer('bankinfo_id')->nullable()->comment('到账银行id');
            $table->float('account_tem')->nullable()->comment('临时余额');
            //新增bankinfo中的字段
            $table->string('card_name')->nullable()->comment('银行卡名称');
            $table->string('starthu')->nullable()->comment('开户行');
            $table->string('user_name')->nullable()->comment('姓名');
            $table->string('user_mobile')->nullable()->comment('预留手机号');
            $table->string('card_no')->nullable()->comment('银行卡号');
            $table->timestamps();
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
        Schema::drop('account_users');
    }
}
