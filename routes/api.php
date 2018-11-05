<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// api/v1/classic
//http://weichat.test/api/v1/
Route::prefix('v1')->namespace('api\v1')-> group( function (){
	Route::get('classic/latest','ClassicController@latest');
	Route::get('classic/{index}/previous','ClassicController@previous');
	Route::get('classic/{index}/next','ClassicController@next');
	Route::get('classic/{type}/{id}/favor','ClassicController@favor');


	Route::get('/like','IsLikeController@like');
	Route::get('/like/cancel','IsLikeController@like_cancel');


	//classic 表中添加 index
	Route::get('classic/add_index','ClassicController@addindex');
	//当前登录 user 信息
	Route::get('userlogined','AllUserController@userLogined');

});


