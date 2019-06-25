<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersRechargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_recharge', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->nullable()->default('')->comment('充值编号');
            $table->integer('user_id')->comment('用户id');
            $table->float('price')->nullable()->default(0)->comment('充值金额');
            $table->string('status')->nullable()->default('未支付')->comment('充值状态');
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
        Schema::dropIfExists('orders_recharge');
    }
}
