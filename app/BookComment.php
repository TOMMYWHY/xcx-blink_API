<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{

	protected $fillable = ['book_id','content','allUser_id','nums'];
    //多对一
	public function book() {
		return $this->belongsTo( 'App\Book');
	}
}
