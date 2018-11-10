<?php

namespace App\Http\Controllers\api\v1;

use App\Repositories\IsLikeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AllUser;
use App\IsLike;



class IsLikeController extends Controller
{
	protected $repo;

	public function __construct( IsLikeRepository $repository ) {
		$this->repo = $repository;
	}


	//点赞操作
	public function like(Request $request ) {

		$allUser_id = AllUser::find(1)->id;
		return $this->repo->likeOrNot($request, $allUser_id,1);
	}
	//取消点赞操作
	public function like_cancel( Request $request ) {
		$allUser_id = AllUser::find(1)->id;
		return $this->repo->likeOrNot( $request, $allUser_id, 0);
	}

}
