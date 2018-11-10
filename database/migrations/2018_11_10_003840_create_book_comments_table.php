<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'book_id');
	        $table->integer( 'allUser_id');
            $table->text('content');
	        $table->integer('nums');//喜欢该评论数量
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
        Schema::dropIfExists('book_comments');
    }
}
