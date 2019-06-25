<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatetuansettingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuansettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tuan_num')->nullable()->default(1)->comment('团的最大数量');
            $table->string('man_num')->nullable()->default(1)->comment('单个团的最大人数');
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
        Schema::drop('tuansettings');
    }
}
