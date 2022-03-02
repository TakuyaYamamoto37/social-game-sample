<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\MasterDataService;
use App\UserProfile;
use App\UserPresent;

class PresentController extends Controller
{
    public function GetPresentList(Request $request)
    {
        $client_master_version = $request->client_master_version;
        $user_id = $request->user_id;

        //マスターデータチェック
        if (!MasterDataService::CheckMasterDataVersion($client_master_version))
        {
            return config('error.ERROR_MASTER_DATA_UPDATE');
        }

        //user_profileテーブルのレコードを取得
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        if (!$user_profile)
        {
            return config('error.ERROR_INVALID_DATA');
        }

        //user_presentテーブルからレコードを取得
        $user_present_list = UserPresent::where('user_id', $user_id)->get();
        if (!$user_present_list)
        {
            return config('error.ERROR_INVALID_DATA');
        }
        
        //クライアントへのレスポンス
        $response = array
        (
            'user_present' => $user_present_list,
        );
        return json_encode($response);
    }

    public function GetItem(Request $request)
    {
        $user_id = $request->user_id;
        $present_id = $request->present_id;

        //user_profileテーブルのレコードを取得
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        if (!$user_profile)
        {
            return config('error.ERROR_INVALID_DATA');
        }

        //present_idからuser_presentテーブルのレコードを取得
        $user_present = UserPresent::where('present_id', $present_id)->first();
        if (!$user_present)
        {
            return config('error.ERROR_INVALID_DATA');
        }

        //user_profileにアイテム加算
        if ($user_present->item_type == config('constants.ITEM_TYPE_CRYSTAL'))
        {
            $user_profile->crystal += $user_present->item_count;
        }
        else if ($user_present->item_type == config('constants.ITEM_TYPE_CRYSTAL_FREE'))
        {
            $user_profile->crystal_free += $user_present->item_count;
        }
        else if ($user_present->item_type == config('constants.ITEM_TYPE_FRIEND_COIN'))
        {
            $user_profile->friend_coin += $user_present->item_count;
        }

        //データの書き込み
        try
        {
            $user_profile->save();
            $user_present->delete();
        }
        catch (\PDOException $e)
        {
            return config('error.ERROR_DB_UPDATE');
        }

        //クライアントへのレスポンス
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $user_present_list = UserPresent::where('user_id', $user_id)->get();
        $response = array(
            'user_profile' => $user_profile,
            'user_present' => $user_present_list,
        );

        return json_encode($response);
    }
}
