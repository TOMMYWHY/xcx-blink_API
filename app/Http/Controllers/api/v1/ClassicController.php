<?php

namespace App\Http\Controllers\api\v1;

use App\Repositories\ClassicRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classic;
use Illuminate\Support\Facades\DB;


class ClassicController extends Controller
{
	protected $repo;
	public function __construct(ClassicRepository $repo) {
		// protected repo = repository repo
		$this->repo = $repo;
	}

	public function index() {
		return $this->repo->allClassic();
	}


	public function latest() {
		return $this->repo->findClassic();
		//allUsers id 写死 1
//		$latest = Classic::with( ['allUsers' =>function($query){
//			$query->find(1);
//		}])->orderBy('index','desc')->first();
//		$latest->like_status = $latest->allUsers[0]->pivot->isLike || null;
//		return $latest->toJson();
	}

	//下一个
	public function previous($index, Request $request) {
		return $this->repo->nextOrPrevious( $index,1,$request);
		$error = [
			'error_code' => 3000,
			'msg' => 'This episode does not exit~!',
			'request' => $request->path(),
			'method' => $request->method()
		];
		$data = Classic::orderBy('index','desc')->find($index-1);
		/*
		 * 教程实现*/
		if(!$data){
			return $error;
		}else{
			return $data->toArray();
		}

//		dd( $data);

		/*
		 * tommy 实现
		 *
		if (!$data){
			$data = Classic::orderBy('id','desc')->find(1);
			$data->error = $error;
			return $data;
		}
		else{
			return $data->toArray();
		}
		*/
	}
	//下一个
	public function next($index, Request $request) {
		$error = [
			'error_code' => 3000,
			'msg' => 'This episode does not exit~!',
			'request' => $request->path(),
			'method' => $request->method()
		];
		$data=Classic::orderBy('index','desc')->find($index + 1);
		if(!$data){
			return $error;
		}else{
			return $data->toArray();
		}
	}


	/*
	 *查询所有数据，
	 *将index 字段赋值
	 * 可将多个集合 merge
	 * */
	public function addindex() {
//		$data= Classic::get()->push()->orderBy('created_at')->each(function ($item,$key){});
		//transform() 与 each() 都可以，但是each需要save；transform 直接对原 collection 进行修改，直接return即可。此处不可使用 map，map 创建新的 collection
		$data= Classic::get()->transform(function ($item,$key){
			$item->index = $key+1;    //此处用key，以便后期 多表数据合并 push
//			$item->save();
			return $item;
		});

//		dd( $data->toArray());
		return $data->toArray();
	}



}
