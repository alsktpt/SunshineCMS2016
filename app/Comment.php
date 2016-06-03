<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['body', 'user_id', 'article_id', 'parent_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function article()
    {
    	return $this->belongsTo(Article::class);
    }    

    public function scopeVerified($query)
    {
        $query->where('verified', '1');
    }

    public function scopeNoparent($query)
    {
        $query->where('parent_id', '0');
    }
}
