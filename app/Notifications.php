<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
	protected $table = 'notifications';
	protected $fillable = ['notif_to', 'notif_from', 'text', 'icon', 'link'];
}
