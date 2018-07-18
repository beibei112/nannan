<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('问题标题');
            $table->text('body')->comment('问题主题内容');
            $table->integer('comments_count')->default(0)->comment('评论次数');
            $table->integer('followers_count')->default(1)->comment('关注次数');
            $table->integer('answers_count')->default(0)->comment('回答次数');
            $table->string('close_comment',8)->default('C')->comment('');
            $table->string('is_hidden',8)->default('H')->comment('');
            $table->integer('user_id')->unsigned()->comment('用户id');
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
        Schema::dropIfExists('questions');
    }
}
