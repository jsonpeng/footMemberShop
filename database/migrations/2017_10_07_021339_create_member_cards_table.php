<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberCardsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('start')->nullable()->default('2017-01-01 00:00:00')->comment('会员开始时间');
            $table->timestamp('end')->nullable()->default('2017-01-01 00:00:00')->comment('会员结束时间');
            $table->string('card_no')->nullable()->default('')->comment('会员卡号');
            $table->string('price')->nullable()->default(0)->comment('购买价格');
            $table->timestamps();
            $table->softDeletes();

            $table->integer('shop_id')->unsigned();
            $table->foreign('shop_id')->references('id')->on('shops');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_cards');
    }
}
