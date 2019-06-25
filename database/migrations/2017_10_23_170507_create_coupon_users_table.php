<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->date('time_begin')->comment('有效期开始时间');
            $table->date('time_end')->comment('有效期结束时间');
            $table->string('type')->default('满减券')->comment('生日券、打折券、满减券、代金券');
            $table->float('base')->default(0)->comment('满足最小金额');
            $table->float('given')->default(0)->comment('优惠金额');
            $table->float('discount')->default(100)->comment('折扣，九折就输入90，不打折就输入100');
            $table->string('together')->default('否')->comment('叠加使用,备用');
            $table->string('status')->default('未使用')->comment('优惠券状态');
            $table->string('limit')->default('无')->comment('消费限制 节假日 周末 工作日 无');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('order_no')->nullable()->comment('订单编号');

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
        Schema::drop('coupon_users');
    }
}
