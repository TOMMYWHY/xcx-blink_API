<?php

namespace App\Http\Controllers\api\v1;

use App\AllUser;
use App\Book;
use App\BookComment;
use App\BookIsLike;
use App\Hotkeyword;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
	/*
	 * 所有图书
	 */
	public function index() {
		//所有 books 集合
		$books = Book::with( 'allUsers')->get(['id','title','image','fav_nums','author']);
		foreach ($books as $book){
			$book->like_status = !$book->allUsers->isEmpty() ?  $book->allUsers[0]->pivot->isLike : 0;
		}
		return $books;
    }

    /*
     * 获取 【当前用户】 所有【喜欢】书籍 【总数】
     */
	public function getFavorCount() {
		$allUser_id = AllUser::find(1)->id;
		$FavorCount = BookIsLike::where([
			['allUser_id', '=',$allUser_id],
			['isLike','=',1]
		])->count();
		return ['count' => $FavorCount];
	}  

	/*
	 * 获取书籍点赞
	 * book/1/favor
	 */
	public function getFavor($book_id, $allUser_id=1) {
		$book= Book::find($book_id);
		$allUser_id = AllUser::find($allUser_id)->id;
		$book_like_status = BookIsLike::where('book_id',$book_id)
		                              ->where('allUser_id',$allUser_id)->first();
		$fav_nums = $book->fav_nums;

//		dd( $allUser_id);
		if (!$book_like_status){
			return $data =[
				'fav_nums' =>$fav_nums,
				'id' =>$book_id,
				'like_status' =>0,
				'msg' => 'you have not like or unlike it.'
			];
		}
		else{
			//当前用户操作过，无论是 【喜欢】 或者是 【不喜欢】
			return $data =[
				'fav_nums' =>$fav_nums,
				'id' =>$book_id,
				'like_status' =>$book_like_status->isLike,
			];
		}
		return $book_like_status;
	}

	/*
	 * 获取书籍详细信息
	 */
	public function getDetail($id) {
//		return 'detail';
//		return $id;
		$allUsers_id = AllUser::find(1)->id;
		$book = Book::with(['allUsers' =>function($query){
			$query->find(1);
		}])->find($id);
		if (! $book){
			return 'This book does not exit~!';
		}
		$book->like_status = !$book->allUsers->isEmpty() ? $book->allUsers[0]->pivot->isLike : 0;
		return $book->toArray();
	}

	/*
	 *获取书籍短评
	 * */
	public function getComments($id) {
		$AllUser_id = AllUser::find(1)->id;
//		$comments = Book::find($id)->comments;
//		return ( $comments);
		$comments = Book::find($id)->comments()
		                       ->where('allUser_id',$AllUser_id)
		                       ->get();
		return $data = [
				'book_id'=>$id,
				'comments'=>$comments,
			];
	}

	/**
	 * @param Request $request
	 *
	 * @return array
	 */
	public function addComments(Request $request) {
		$allUser_id = AllUser::find(1)->id;
		$book_id = $request->book_id;
//		$book_id = 1;
//		if ( ! empty( $request->content ) ) {
			$content = $request->content;
//		}
//		$content ='test11111';
		$has_content = BookComment::where('content', '=',$content)->first();

//		dd( $has_content);
		if ($has_content){
			$has_content->update([
				'nums'=> $has_content->nums+1,
			]);
		}else{
//			dd( 1);
			$comment = new BookComment();
			$comment->book_id = $book_id;
			$comment->content = $content;
			$comment->allUser_id = $allUser_id;
			$comment->nums = 1;
			$comment->save();

//			dd( $comment);
		}
		return $data =[
			"error_code"=> 0,
	        "msg"=>"ok",
	        "request"=>"POST  /book/add_short_comment"
			];
	}

	public function getHotKeywords() {
//		return 'getHotKeywords';
		$keywords = Hotkeyword::orderBy('nums','desc')-> get();
		return $keywords;
	}

	public function search(Request $request  ) {
//		dd( $q);
//		$start = $request->start? $request->start : 0; 赋值成功
//		$start = $request->start || 0; 仅判断; js 中赋值成功
		$start = $request->start or 0;  //赋值成功
//		dd( $start);

		$count = $request->count? $request->count : 6;
		$summary = $request->summary? $request->summary : 0;
//		dd( $start);
		$keywords =  $request->q;
		$books = Book::where('title','like','%'.$keywords.'%')->
		             orWhere('subtitle','like','%'.$keywords.'%')->
					 orWhere('summary','like','%'.$keywords.'%')->
					 get();
		$return_count = $books->count();
//		dd( $return_count);
		$return_books =$books->slice($start,$count);
//		return $books;

		return $data =[
			'books'=>$return_books,
			'count'=>$count,
			'start'=>$start,
			'total'=>$return_count
		];

	}



}
