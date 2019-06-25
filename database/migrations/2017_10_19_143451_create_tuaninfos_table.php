<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTuaninfosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuaninfos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('products_id')->nullable()->comment('商品id');
            $table->integer('no')->nullable()->default(1)->comment('期数');
            $table->string('status')->nullable()->comment('状态(可参团|人满|超过期限)');
            $table->string('name')->nullable()->comment('开团名称');
            $table->integer('num')->nullable()->comment('参团人数');
            $table->string('man_num')->nullable()->comment('团的最大数量');
            $table->string('end_time')->nullable()->comment('拼团结束时间');
            $table->string('winner')->nullable()->default('否')->comment('是否中奖');
            $table->string('whether_fanxian')->nullable()->default('否')->comment('是否返现');
            $table->string('guoqi')->nullable()->default('否')->comment('是否过期');
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
        Schema::drop('tuaninfos');
    }
}
