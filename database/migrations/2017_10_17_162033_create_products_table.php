<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateproductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品名称');
            $table->string('banner')->nullable()->comment('banner图');
            $table->float('price')->comment('拼团价格');
            $table->float('o_price')->comment('商品原价');
            $table->longText('img_content')->comment('图文详情');
            $table->string('start_time')->nullable()->default('2017-01-01 00:00:00')->comment('拼团开始时间');
            $table->string('end_time')->nullable()->default('2017-01-01 00:00:00')->comment('拼团结束时间');
            $table->tinyInteger('status')->comment('状态(0->上架 1->下架)');
            $table->string('tuan_num')->nullable()->default(1)->comment('团的最大数量');
            $table->string('man_num')->nullable()->default(1)->comment('单个团的最大人数');
            $table->string('deleted')->nullable()->default('否')->comment('是否删除');
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
        Schema::drop('products');
    }
}
