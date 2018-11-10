<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $table = 'books';

	protected $fillable = [ 'fav_nums'];//开启白名单字段

	//多对多
	public function allUsers() {
		return $this->belongsToMany( 'App\AllUser','book_is_likes','book_id','allUser_id')->withPivot( 'isLike');
	}

	//一对多
	public function comments() {
		return $this->hasMany( 'App\BookComment');
	}
}
