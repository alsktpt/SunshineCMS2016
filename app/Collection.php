<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
     protected $fillable=['uri', 'name', 'template'];

     public function anthology()
     {
     	return $this->hasMany(Anthology::class);
     }

}
