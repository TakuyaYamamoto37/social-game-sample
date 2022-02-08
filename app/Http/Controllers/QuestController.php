<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;

class QuestController extends Controller
{
	public function Tutorial(Request $request)
	{
		$user_id = $request->user_id;

		//user_profileテーブルからレコードを取得
		$user_profile = UserProfile::Where('user_id', $user_id)->first();

		//レコード存在チェック
		if (!$user_profile)
		{
			return config('error.ERROR_INVALID_DATA');
		}

		//チュートリアル進捗の確認
		if (config('constants.TUTORIAL_QUEST') <= $user_profile->tutorial_progress)
		{
			return config('error.ERROR_INVALID_DATA');
		}

		//チュートリアル進捗の更新
		$user_profile->tutorial_progress = config('constants.TUTORIAL_QUEST');

		//データの書き込み
		try
		{
			$user_profile->save();
		}
		catch (\PDOException $e)
		{
			return config('error.ERROR_DB_UPDATE');
		}

		//クライアントへのレスポンス
		$user_profile = UserProfile::Where('user_id', $user_id)->first();
		$response = array(
			'user_profile' => $user_profile,
		);

		return json_encode($response);
	}
}
