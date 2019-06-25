<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            /*
            $table->string('card_intro')->nullable()->default('')->comment('会员卡说明');
            $table->float('card_num')->nullable()->default(10000)->comment('会员卡销售金额');
            $table->string('card_pic')->nullable()->default('')->comment('会员卡图片');
            $table->integer('card_limit')->nullable()->default(1)->comment('会员卡消费次数限制');
            */

            $table->integer('tongji_limit')->nullable()->default(2)->comment('试图消费多少次，会被统计');
            $table->integer('serias_limit')->nullable()->default(2)->comment('连续消费多少天，会被统计');
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
        Schema::dropIfExists('settings');
    }
}
