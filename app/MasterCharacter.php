<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libs\MasterDataService;

class MasterCharacter extends Model
{
    protected $table = 'master_character';
    protected $primaryKey = 'character_id';

    public static function GetMasterCharacter()
    {
        $master_data_list = MasterDataService::GetMasterData('master_character');
        return $master_data_list;
    }
}
