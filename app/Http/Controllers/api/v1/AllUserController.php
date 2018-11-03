<?php

namespace App\Http\Controllers\api\v1;

use App\AllUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllUserController extends Controller
{
    //
	public function userLogined() {
//		return 'userlogin111';
		/*
     $user = AllUser::find(1);
	 foreach ($user->classics as $item){
		dd( $item);
	}
	 */
		$user = AllUser::with( 'classics')->find( 1);
		dd($user->toArray());

	}
}
