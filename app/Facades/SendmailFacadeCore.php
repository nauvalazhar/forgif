<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SendmailFacadeCore extends Facade {
	public static function getFacadeAccessor() {
		return 'sendmail';
	}
}