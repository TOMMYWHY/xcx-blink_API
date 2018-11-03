<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllUser extends Model
{
    //与 classic 多对多关系
	public function classics(  ) {
		return $this->belongsToMany( 'App\Classic','is_likes','allUser_id','classic_id')->withPivot( 'isLike');
	}
}
