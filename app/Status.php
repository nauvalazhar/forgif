<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
	use SoftDeletes;

	protected $table = "status";
	protected $fillable = ["user_id", "content", "attachment", "privacy", "status", "meta"];

	protected $dates = ['deleted_at'];

	public function users() {
		return $this->belongsTo('App\User', 'user_id');
	}
}
