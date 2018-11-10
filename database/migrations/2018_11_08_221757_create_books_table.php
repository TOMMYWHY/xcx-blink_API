<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
	        $table->string( 'title')->default('');
            $table->string( 'author')->default('');
	        $table->string( 'binding')->default('');
	        $table->string( 'category')->default('');
	        $table->integer( 'fav_nums');
	        $table->text('image');
	        $table->text('images');
	        $table->string( 'isbn')->default('');
	        $table->integer( 'pages')->default(0);
	        $table->string( 'price')->default('');
	        $table->integer( 'pubdate')->default(0);
	        $table->string( 'publisher')->default('');
	        $table->text( 'subtitle');
	        $table->text( 'summary');
	        $table->text( 'translator');
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
        Schema::dropIfExists('books');
    }
}
