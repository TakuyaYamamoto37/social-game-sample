<?php

namespace App\Libs;

use App\MasterLoginItem;
use App\MasterQuest;
use App\MasterCharacter;
use App\MasterGacha;
use App\MasterGachaCharacter;
use App\MasterShop;
use App\MasterText;

class MasterDataService
{
    public static function GenerateMasterData($version)
    {
        touch(__DIR__ . '/' . $version);
        chmod(__DIR__ . '/' . $version, 0666);

        $master_data_list = array();
        //マスターデータの種類を以下に随時追加
        $master_data_list['master_login_item'] = MasterLoginItem::all();
        $master_data_list['master_quest'] = MasterQuest::all();
        $master_data_list['master_character'] = MasterCharacter::all();
        $master_data_list['master_gacha'] = MasterGacha::all();
        $master_data_list['master_gacha_character'] = MasterGachaCharacter::all();
        $master_data_list['master_shop'] = MasterShop::all();
        $master_data_list['master_text'] = MasterText::all();

        $json = json_encode($master_data_list, JSON_UNESCAPED_UNICODE);
        file_put_contents(__DIR__ . '/' . $version, $json);
    }

    public static function GetMasterData($data_name)
    {
        $file = fopen(__DIR__ . '/' . config('constants.MASTER_DATA_VERSION'), "r");
        if (!$file)
        {
            return false;
        };

        $json = array();
        while ($line = fgets($file))
        {
            $json = json_decode($line, true);
        };

        if (!array_key_exists($data_name, $json))
        {
            return false;
        };

        return $json[$data_name];
    }

    public static function CheckMasterDataVersion($client_master_version)
    {
        return config('constants.MASTER_DATA_VERSION') <= $client_master_version;
    }

    
    public function GetMasterDataSize()
    {
        $size = filesize(__DIR__ . '/' . config('constants.MASTER_DATA_VERSION'));
        $size_bytes = floatval($size);
        return $size_bytes;
    }
}
