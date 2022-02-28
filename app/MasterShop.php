<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libs\MasterDataService;

class MasterShop extends Model
{
    protected $table = 'master_shop';
    protected $primaryKey = 'shop_id';
    public $incrementing = false;

    public static function GetMasterShop()
    {
        $master_data_list = MasterDataService::GetMasterData('master_shop');
        return $master_data_list;
    }
}
