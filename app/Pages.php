<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
	protected $table = "pages";
	protected $fillable = ["user_id", "title", "slug", "content", "keywords", "status"];

	public function users() {
		return $this->belongsTo('App\User', 'user_id');
	}
}
