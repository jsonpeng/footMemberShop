<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatebankinfosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->comment('用户id');
            $table->string('card_name')->nullable()->comment('银行卡名称');
            $table->string('starthu')->nullable()->comment('开户行');
            $table->string('user_name')->nullable()->comment('姓名');
            $table->string('user_mobile')->nullable()->comment('预留手机号');
            $table->string('card_no')->nullable()->comment('银行卡号');
            $table->string('type')->nullable()->comment('银行卡类型');
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
        Schema::drop('bankinfos');
    }
}
