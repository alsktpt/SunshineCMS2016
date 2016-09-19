<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
     protected $fillable=['uri', 'name', 'title', 'status', 'theme'];
	/**
	* 主键为uri
	*
	* @var string
	*/
	protected $primaryKey = 'uri';
	
     public function anthology()
     {
     	return $this->hasMany(Anthology::class);
     }

}
