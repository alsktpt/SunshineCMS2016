<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anthology extends Model
{
    public function articles()
    {
    	return $this->belongsToMany(Article::class);
    }


    public function user()
    {
    	return $this->belongsToMany(User::class);
    }
}
