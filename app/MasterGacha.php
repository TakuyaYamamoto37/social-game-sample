<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libs\MasterDataService;

class MasterGacha extends Model
{
    protected $table = 'master_gacha';
    protected $primaryKey = 'gacha_id';

    public static function GetMasterGacha()
    {
        $master_data_list = MasterDataService::GetMasterData('master_gacha');
        return $master_data_list;
    }
}
