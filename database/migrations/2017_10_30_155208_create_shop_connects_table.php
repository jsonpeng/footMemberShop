<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopConnectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_connects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shop_id');
            $table->string('name');

            $table->integer('shop_connet_id')->unsigned();
            $table->foreign('shop_connet_id')->references('id')->on('shops');

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
        Schema::drop('shop_connects');
    }
}
