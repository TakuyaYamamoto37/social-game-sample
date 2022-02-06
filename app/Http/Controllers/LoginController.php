<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function Start(Request $request)
	{
        $user_id = $request->user_id;
        $response = $user_id;
		return $response;
	}
}
