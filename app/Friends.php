<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
	protected $table = "friends";
	protected $fillable = ["user_to", "user_from", "status"];

	public function users() {
		return $this->belongsTo('App\User', 'user_from');
	}

	public function users_from() {
		return $this->belongsTo('App\User', 'user_to');
	}
}
