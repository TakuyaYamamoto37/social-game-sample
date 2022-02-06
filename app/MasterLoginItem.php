<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libs\MasterDataService;

class MasterLoginItem extends Model
{
    protected $table = 'master_login_item';
    protected $primaryKey = 'login_day';

    public static function GetMasterLoginItem()
    {
        $master_data_list = MasterDataService::GetMasterData('master_login_item');
        return $master_data_list;
    }
}
