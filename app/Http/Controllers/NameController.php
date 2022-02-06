<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;

class NameController extends Controller
{
	public function ChangeName(Request $request)
	{
        $client_master_version = $request->client_master_version;
        $user_id = $request->user_id;
        $user_name = $request->user_name;

        if ($client_master_version < config('constants.MASTER_DATA_VERSION'))
        {
            //マスターデータの更新の必要をクライアント側に伝える
            return config('error.ERROR_MASTER_DATA_UPDATE');
        }

        //ユーザー名の長さチェック
        if (10 < strlen($user_name))
        {
            
        }
        //user_prifileテーブルからレコードを取得
        $user_profile = UserProfile::where('user_id', $user_id)->first();

        //レコード存在チェック
        if (!$user_profile)
        {
            //エラー返す
        }

        $user_profile->user_name = $user_name;

        //データベースへ書き込み
        try 
        {
            $user_profile->save();
        } catch (\PDOException $e) 
        {
            
        }

        $response = array(
            'user_profile' => $user_profile,
        );

        return json_encode($response);
	}
}
