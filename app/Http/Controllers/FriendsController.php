<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friends;
use Auth;

class FriendsController extends Controller
{
	public function forgif(Request $request) {
		$forgif = Friends::create([
			'user_from' => Auth::user()->id,
			'user_to' => $request->user_to,
			'status' => 'waiting'
		]);
		if(!$forgif) {
			return response(['data' => 'Requrest failed'], 500);
		}
		return response(['data' => 'OK', 'success' => true]);
	}

	public function confirm(Request $request) {
		$confirm = Friends::whereUserFrom($request->id)->whereUserTo(Auth::user()->id)->update(['status' => 'confirmed']);
		return response(['data' => 'OK', 'success' => true]);
	}

	public function destroy(Request $request) {
		$confirm = Friends::whereUserTo($request->id)->whereUserFrom(Auth::user()->id)->delete();
		return response(['data' => 'OK', 'success' => true]);
	}
}
