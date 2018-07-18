<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->comment('发起评论用户');
            $table->text('body')->comment('评论内容');

            //一个评论属于一个question 也属于一个answer这种应用场景是多态关联

            $table->unsignedInteger('commentable_id');//定义方法名
            $table->string('commentable_type');//定义类型 

            //注意这两字段必须前缀一致 都是comment_

            $table->unsignedInteger('parent_id')->nullable()->comment('嵌套评论的父级id');
            $table->integer('leval')->default(1)->comment('第几层评论');
            $table->string('is_hidden')->default('F')->comment('是否屏蔽');
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
        Schema::dropIfExists('comments');
    }
}
