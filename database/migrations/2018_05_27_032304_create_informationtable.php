<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationtable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('用户id');
            $table->string('sex')->comment('性别');
            $table->text('school')->comment('学校');
            $table->string('height')->comment('身高');
            $table->integer('weight')->comment('体重');
            $table->text('phone')->comment('电话');
            $table->string('Do you have a girlfriend')->comment('有没有女朋友');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information');
    }
}
