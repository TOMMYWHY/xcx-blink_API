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


$factory->define(App\Classic::class, function (Faker $faker) {
	return [
		"content"=> $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        "fav_nums"=> $faker->numberBetween(0,100),
//        "id"=> 1,
        "image"=> $faker->imageUrl(),
//        "index"=> function(){
//
//        },
//        "like_status"=>$faker->boolean(),
//        "pubdate"=> $faker->dateTime(),
        "title"=>$faker->sentence($nbWords=5,$variableNbWords = true),
        "type"=>$faker->randomElement($array=array(100,200,300,400)),

	];
});

$factory->define(App\AllUser::class, function (Faker $faker) {
	return [
		"nickName"=> 'tommy_test',
		"openid"=> $faker->uuid(),

		"gender"=> 'male',
		'avatarUrl'=> $faker->imageUrl($width = 140, $height = 180),
	];
});
$factory->define(App\IsLike::class, function (Faker $faker) {
	return [
		"allUser_id"=> 1,
		"classic_id"=> 3,
		"isLike"=> true,
	];
});
