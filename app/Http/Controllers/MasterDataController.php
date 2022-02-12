<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterLoginItem;
use App\MasterQuest;

class MasterDataController extends Controller
{
	public function Get(Request $request)
	{
		//クライアント側に送信したいマスターデータだけを選択
        $master_login_item = MasterLoginItem::GetMasterLoginItem();
		$master_quest = MasterQuest::GetMasterQuest();

		$response = array(
			'master_data_version' => config('constants.MASTER_DATA_VERSION'),
			'master_login_item' => $master_login_item,
			'master_quest' => $master_quest,
		);

		return json_encode($response);
	}
}
