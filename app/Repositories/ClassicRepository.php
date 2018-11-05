<?php
/**
 * Created by PhpStorm.
 * User: Tommy
 * Date: 2018/11/3
 * Time: 下午3:47
 */

namespace App\Repositories;

use App\Classic;

class ClassicRepository{

	protected $nextOrPrevious = null;


	//返回所有 classic with 点赞 AllUsers
	public function allClassic() {
		$classics = Classic::with( 'allUsers')->orderBy( 'index','desc')->get();
		dd( $classics);
		return $classics;
	}

	public function findClassic( ) {
		$latest = Classic::with( ['allUsers' =>function($query){
			$query->find(1);
		}])->orderBy('index','desc')->first();
		//判断当前 user 是否进行 【喜欢】 操作
		$latest->like_status = !$latest->allUsers->isEmpty() ?$latest->allUsers[0]->pivot->isLike : 0;
		return $latest->toJson();
	}


	//根据参数 $action 进行上一个与下一个操作
	public function nextOrPrevious( $index, $action, $request) {
		//action = 1 时 ：previous； action = 0 时 ：next。
		$this->nextOrPrevious = $action ? $index - 1 : $index + 1;
		$data = Classic::with( ['allUsers' =>function($query){
			$query->find(1);
			}])->orderBy('index','desc')->find($this->nextOrPrevious);
		//判断 data 是否被找到
		if(!$data) {
			return $this->error_msg( $request, 'This episode does not exit~!' );
		}
		//判断 $data->allUsers 是否为空， 及当前用户是否点击 【喜欢】
		$data->like_status = !$data->allUsers->isEmpty() ? $data->allUsers[0]->pivot->isLike : 0;
		return $data->toArray();

	}

	//返回错误信息
	public function error_msg( $request, $msg ) {
		return $error = [
			'error_code' => 3000,
			'msg' => $msg,
			'request' => $request->path(),
			'method' => $request->method()
		];
	}
}