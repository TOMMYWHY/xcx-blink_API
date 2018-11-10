<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Book::class,3)->create();
	    factory(\App\BookIsLike::class,1)->create();
	    factory(\App\BookComment::class,6)->create();

    }
}
