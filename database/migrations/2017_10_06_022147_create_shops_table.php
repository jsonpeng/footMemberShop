<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default('')->comment('店铺名称');
            $table->string('shop_id')->nullable()->default('')->comment('店铺ID');
            $table->string('intro')->nullable()->default('')->comment('店铺说明');
            $table->float('card_price')->nullable()->default(1000)->comment('会员卡价格');
            $table->string('card_intro')->nullable()->default('')->comment('会员卡说明');
            $table->string('card_pic')->nullable()->default('')->comment('会员卡图片');
            $table->integer('card_limit')->nullable()->default(1)->comment('会员卡消费次数限制');
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
        Schema::dropIfExists('shops');
    }
}
