<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardBuysTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_buys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_num')->nullable()->default('')->comment('订单编号');
            $table->float('price')->nullable()->default(10000)->comment('支付价格');
            $table->string('status')->nullable()->default('')->comment('未支付');
            $table->integer('shop_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('card_buys');
    }
}
