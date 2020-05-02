<?php
namespace App\Facades;

use Mail;
use App\Mail\RegisterNotification;

class SendmailFacade {

	public function register($data) {
		return Mail::to($data['email'])->send(new RegisterNotification($data));
	}

}