<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class StatusFacadeCore extends Facade {
	public static function getFacadeAccessor() {
		return 'status';
	}
}