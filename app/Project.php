<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = array('name', 'description', 'open', 'email');

	public function user() 
	{
		return $this->belongsTo(User::class);
	}
}
