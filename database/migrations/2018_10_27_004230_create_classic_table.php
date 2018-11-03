<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classic', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'title');
            $table->text('content');
            $table->integer( 'index')->default(0);//index: 期号
	        $table->text('image');
	        $table->integer( 'type');//type: 期刊类型,这里的类型分为:100 电影 200 音乐 300 句子
	        $table->integer( 'fav_nums');//fav_nums: 点赞次数
//	        $table->dateTime('pubdate');
	        $table->timestamps();
        });

//	    DB::statement('ALTER Table classic add orderid INTEGER NOT NULL UNIQUE AUTO_INCREMENT;');
//	    DB::statement("ALTER Table classic add orderid INTEGER NOT NULL UNIQUE AUTO_INCREMENT");

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classic');
    }
}
