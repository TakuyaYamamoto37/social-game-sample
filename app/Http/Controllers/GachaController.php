<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\MasterDataService;
use App\UserProfile;
use App\MasterGacha;

class GachaController extends Controller
{
    public function DrawGacha(Request $request)
    {
        $client_master_version = $request->client_master_version;
        $user_id = $request->user_id;
        $gacha_id = $request->gacha_id;
        
        //マスターデータチェック
        if (!MasterDataService::CheckMasterDataVersion($client_master_version))
        {
            return config('error.ERROR_MASTERDATA_UPDATE');
        }

        //user_profileテーブルからレコードを取得
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        if (!$user_profile)
        {
            return config('error.ERROR_INVALID_DATA');
        }

        //ガチャマスターデータ取得
        $master_gacha = MasterGacha::GetMasterGachaByGachaId($gacha_id);
        if (is_null($master_gacha))
        {
            return config('error.ERROR_INVALID_DATA');
        }

        //値の妥当性の検証
        $validation = $this->validation($user_profile, $master_gacha);
        if (!is_null($validation))
        {
            return $validation;
        }
    }

    private function validation($user_profile, $master_gacha)
    {
        //スケジュールチェック
        if (time() < strtotime($master_gacha->open_at))
        {
            return config('error.ERROR_INVALID_SCHEDULE');
        }
        if (strtotime($master_gacha->close_at) < time())
        {
            return config('error.ERROR_INVALID_SCHEDULE');
        }

        //所持通貨チェック
        if ($master_gacha->cost_type == config('constants.GACHA_COST_TYPE_CRYSTAL'))
        {
            if ($user_profile->crystal < $master_gacha->cost_amount)
            {
                return config('error.ERROR_COST_SHORTAGE');
            }
        }
        else if ($master_gacha->cost_type == config('constants.GACHA_COST_TYPE_CRYSTAL_FREE'))
        {
            if ($user_profile->crystal + $user_profile->crystal_free < $master_gacha->cost_amount)
            {
                return config('error.ERROR_COST_SHORTAGE');
            }
        }
        else if ($master_gacha->cost_type == config('constants.GACHA_COST_TYPE_FRIEND_COIN'))
        {
            if ($user_profile->friend_coin < $master_gacha->cost_amount)
            {
                return config('error.ERROR_COST_SHORTAGE');
            }
        }
    }
}
