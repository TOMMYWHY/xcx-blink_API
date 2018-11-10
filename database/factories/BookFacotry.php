<?php
use Faker\Generator as Faker;

/**
 * Created by PhpStorm.
 * User: Tommy
 * Date: 2018/11/9
 * Time: 上午11:25
 */

$factory->define(App\Book::class, function (Faker $faker){
	return [
		'title'=> $faker->word,
		'author'=> $faker->name,
		'binding' =>$faker->randomElement($array=array('Paperback','电子书','精装')),
		'category' =>$faker->randomElement($array=array('算法','编程','艺术史')),
		'image' =>$faker->imageUrl(70, 90,'technics'),
		'images' =>$faker->imageUrl(140, 180,'technics'),
		'isbn' =>$faker->ean8,
		"fav_nums"=> $faker->numberBetween(0,100),
		'pages' =>$faker->numberBetween(100,9000),
		'price'=> $faker->randomNumber(2),
		'pubdate' => $faker->date($format = 'Ymd', $max = 'now'),
		'publisher'=>$faker->randomElement($array=array('人民邮电出版社','中央编译出版社','人民教育出版社')),
		'subtitle'=>$faker->sentence(7),
		'summary'=>$faker->paragraph(2),
		'translator'=>$faker->name,
	];
});
$factory->define(App\BookIsLike::class, function (Faker $faker) {
	return [
		"allUser_id"=> 1,
		"book_id"=> 1,
		"isLike"=> true,
	];
});
$factory->define(App\BookComment::class, function (Faker $faker) {
	return [
		"allUser_id"=> 1,
		"book_id"=> $faker->numberBetween(1,5),
		"content"=> $faker->sentence(4),
		"nums"=> $faker->numberBetween(1,100),
	];
});