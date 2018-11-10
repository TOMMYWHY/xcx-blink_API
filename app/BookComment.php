<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{
    //多对一
	public function book() {
		return $this->belongsTo( 'App\Book');
	}
}
