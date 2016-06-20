<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = array('name', 'email', 'message');

	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
