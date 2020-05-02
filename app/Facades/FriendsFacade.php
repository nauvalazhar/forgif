<?php
namespace App\Facades;
use App\Status;
use App\Friends;
use App\User;
use Auth;
use DB;

class FriendsFacade {
	public function mayKnow() {
		$users = User::where('id', '!=', @Auth::user()->id)
		->whereNotIn('id', function($query) {
			$query->select('user_to')->from(with(new Friends())->getTable())->where('user_from', @Auth::user()->id);
		})
		->inRandomOrder()
		->limit(3)
		->get();
		$_users = [];
		foreach($users as $user) {
			$_users[$user->id] = $user;
			$_users[$user->id]['has_follow'] = Friends::where('user_to', @Auth::user()->id)->where('user_from', $user->id)->where('status', 'confirmed')->count();
			$_users[$user->id]['has_follow_waiting'] = Friends::where('user_to', @Auth::user()->id)->where('user_from', $user->id)->where('status', 'waiting')->count();
			$_users[$user->id]['has_follow_request'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $user->id)->where('status', 'waiting')->count();
			$_users[$user->id]['has_follow_confirmed'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $user->id)->where('status', 'confirmed')->count();
		}
		return $users;
	}

	public function request() {
		$request = Friends::with('users')->where('friends.user_to', Auth::user()->id)->where('status', 'waiting')->get();
		$_request = [];
		foreach($request as $req) {
			$_request[$req->id] = $req;
			$_request[$req->id][$req->users->id] = $req->users;
			$_request[$req->id][$req->users->id]['has_follow'] = Friends::where('user_to', Auth::user()->id)->where('user_from', $req->users->id)->where('status', 'confirmed')->count();
			$_request[$req->id][$req->users->id]['has_follow_waiting'] = Friends::where('user_to', Auth::user()->id)->where('user_from', $req->users->id)->where('status', 'waiting')->count();				
			$_request[$req->id][$req->users->id]['has_follow_request'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $req->users->id)->where('status', 'waiting')->count();
			$_request[$req->id][$req->users->id]['has_follow_confirmed'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $req->users->id)->where('status', 'confirmed')->count();
		}
		return $request;
	}
}