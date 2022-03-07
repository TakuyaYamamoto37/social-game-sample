<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libs\MasterDataService;

class MasterText extends Model
{
    protected $table = 'master_text';
    public $incrementing = false;
    protected $primaryKey = 'text_id';
    public $timestamps = false;

    public static function GetMasterText()
    {
        $master_data_list = MasterDataService::GetMasterData('master_text');
        return $master_data_list;
    }
}
