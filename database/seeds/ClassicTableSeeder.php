<?php

use Illuminate\Database\Seeder;

class ClassicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Classic::class,8)->create();
	    factory(\App\AllUser::class,1)->create();
	    factory(\App\IsLike::class,1)->create();
    }
}
