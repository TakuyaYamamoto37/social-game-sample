<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\MasterDataService;
use App\UserProfile;
use App\UserCharacter;

class CharacterController extends Controller
{
    public function GetCharacterList(Request $request)
    {
        $client_master_version = $request->client_master_version;
        $user_id = $request->user_id;
        
        //マスターデータチェック
        if (!MasterDataService::CheckMasterDataVersion($client_master_version))
        {
            return config('error.ERROR_MASTER_DATA_UPDATE');
        }

        //user_profileテーブルのレコードを取得
        $user_prifile = UserProfile::where('user_id', $user_id)->first();

        //レコードの存在チェック
        if (!$user_prifile)
        {
            return config('error.ERROR_INVALID_DATA');
        }

        //user_characterテーブルからレコードを取得
        $user_character_list = UserCharacter::where('user_id', $user_id)->get();

        //クライアントへのレスポンス
        $response = array(
            'user_character' => $user_character_list,
        );

        return json_encode($response);
    }
    
}
