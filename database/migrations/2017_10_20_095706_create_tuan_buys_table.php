<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTuanBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuan_buys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_num')->nullable()->default('')->comment('订单编号');
            $table->float('price')->nullable()->default(10000)->comment('支付价格');
            $table->string('status')->nullable()->comment('状态(已支付|未支付)');
            $table->integer('user_id')->nullable()->comment('用户id');
            $table->integer('product_id')->nullable()->comment('商品id');
            $table->string('name')->nullable()->comment('开团名称');
            $table->string('product_name')->nullable()->comment('商品名称');
            $table->string('type')->nullable()->comment('支付方式');
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
        Schema::dropIfExists('tuan_buys');
    }
}
