<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = array('name', 'description', 'open');

	public function user() 
	{
		return $this->belongsTo(User::class);
	}
}
