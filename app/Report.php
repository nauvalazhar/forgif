<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $table = "report";
	protected $fillable = ["post_id", "reason", "status", "user_id", "to_user", "by_user"];

	public function users() {
		return $this->belongsTo('App\User', 'user_id');
	}
}
