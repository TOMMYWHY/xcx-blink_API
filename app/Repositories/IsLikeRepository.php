<?php
/**
 * Created by PhpStorm.
 * User: Tommy
 * Date: 2018/11/5
 * Time: 下午1:27
 */

namespace App\Repositories;

use App\Classic;
use App\IsLike;
use Hamcrest\Core\Is;

class IsLikeRepository{


	/*
	 * $action == 1 => like; ==0 unlike
	 * */
	public function likeOrNot($request, $allUser_id ,$action) {
		$classic_id = $request->art_id;
		$type = $request->type;//classic_type ???? 为什么需要 type 参数？
		$is_like =IsLike::where('allUser_id',$allUser_id)
		                ->where('classic_id',$classic_id)
		                ->firstOrCreate([
			                'allUser_id' =>$allUser_id,
			                'classic_id' =>$classic_id,
		                ]);
		$classic = Classic::find($classic_id);

		if ($action){
			$classic->update(['fav_nums' => $classic->fav_nums + 1]);
		}
		else{
			$classic->update(['fav_nums' => $classic->fav_nums - 1]);
		}

		$res = $is_like->update(['isLike' => $action]);
		if ($res){
			return $this->error_msg( $request, 'ok~!', '0');
		}else{
			return $this->error_msg( $request, 'fail', '300');
		}
	}

	public function error_msg( $request, $msg, $code ) {
		return $error = [
			'error_code' => $code,
			'msg' => $msg,
			'request' => $request->path(),
			'method' => $request->method()
		];
	}
}