<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FriendsFacadeCore extends Facade {
	public static function getFacadeAccessor() {
		return 'friends';
	}
}