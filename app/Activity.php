<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    
    protected $fillable = ['name', 'address', 'start_at', 'user_id'];

}
