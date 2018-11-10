<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classic extends Model
{
    //
	protected $table = 'classic';
	protected $fillable = [ 'index','fav_nums'];//开启白名单字段

	public function AllUsers(  ) {
		return $this->belongsToMany( 'App\AllUser','is_likes','classic_id','allUser_id')->withPivot( 'isLike');
	}
}
