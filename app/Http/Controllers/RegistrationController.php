<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;

class RegistrationController extends Controller
{
	public function Registration(Request $request)
	{
		$user_id = uniqid();

		//初期データの設定
		$user_profile = new UserProfile;
		$user_profile->user_id = $user_id;
		$user_profile->user_name = 'test';
		//$user_profile->user_name = $user_name;
		$user_profile->crystal = config('constants.CRYSTAL_DEFAULT');
		$user_profile->crystal_free = config('constants.CRYSTAL_FREE_DEFAULT');
		$user_profile->friend_coin = config('constants.FRIEND_COIN_DEFAULT');
		$user_profile->tutorial_progress = config('constants.TUTORIAL_START');

		//データの書き込み
		try
		{
			$user_profile->save();
		}catch (\PDOException $e)
		{
			return config('error.ERROR_DB_UPDATE');
		}

		//クライアントへのレスポンス
		$user_profile = Userprofile::where('user_id', $user_id)->first();
        $response = array(
			"user_profile" => $user_profile,
		);
		return json_encode($response);
	}
}
