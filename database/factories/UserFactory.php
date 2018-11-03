<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

//tinker
//namespace App;
//factory(Calssic::class,3)->create();
/*
 *

$factory->define(App\Classic::class, function (Faker $faker) {
	return [
		"content"=> $faker->paragraph(),
        "fav_nums"=> $faker->numberBetween(0,100),
//        "id"=> 1,
        "image"=> $faker->imageUrl(),
        "index"=> $faker->unique()->numerify(),
//        "like_status"=>$faker->boolean(),
//        "pubdate"=> $faker->dateTime(),
        "title"=>$faker->sentence(),
        "type"=>100,

	];
});
*/