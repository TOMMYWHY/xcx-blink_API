<?php

namespace App\Http\Controllers\api\v1;

use App\AllUser;
use App\IsLike;
use App\Repositories\ClassicRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classic;
use GuzzleHttp\Client;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;

//require 'vendor/autoload.php';

class ClassicController extends Controller
{
	protected $repo;
	public function __construct(ClassicRepository $repo) {
		// protected repo = repository repo
		$this->repo = $repo;
	}

	//列出所以classic
	public function index() {
		return $this->repo->allClassic();
	}

	//最新一期
	public function latest() {
		return $this->repo->findClassic();
	}

	//下一期
	public function previous($index, Request $request) {
		return $this->repo->nextOrPrevious( $index,1,$request);
	}

	//上一期
	public function next($index, Request $request) {
		return $this->repo->nextOrPrevious( $index, 0,$request);
	}

	//获取该期刊所有点赞数 与 当前用户 like_status
	public function favor($type, $id, Request $request) {
		return  $this->repo->getLikeAndFavor($type, $id,$request);
	}

	public function allFavor() {
		$data = AllUser::find(1)->classics()->get();
//		$data = Classic::allUsers(1)->get();
		return $data;
	}


	//=================

	/*
	 * 获取 music url 并存入数据库
	 */
	public function music_url(Request $request) {
		//music api from 虾米 and 豆瓣
		$music_data =[
			'http://mr3.doubanio.com/3d2ac0d0026ec860a2c000710f1aa601/2/fm/song/p1670235_128k.mp4',
			'https://m128.xiami.net/523/78523/1369631477/1772360515_1506674958538.mp3?auth_key=1542164400-0-0-f50213922fd5e87df9d1fa606a36853a'

		];
		/*
		 *

		$client = new Client([
			'base_uri' => $url,
			'timeout'  => 12.0,
		]);
				$response = $client->request('GET');

*/
		$music_classic = Classic::where('type',200)->get();

		foreach ($music_classic as $index =>$item ){
			$item->url = $music_data[$index];
			$item->save();
		}
//		dd( $music_classic->toArray());
		return $music_classic;
	}


	/*
	 *查询所有数据，
	 *为 index 字段赋值
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
