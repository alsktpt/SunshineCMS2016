<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    //
    protected $fillable=['title', 'content', 'published_at', 'user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    

    public function scopePublished($query)
	{
	    $query->where('published_at','<=',Carbon::now())->orderBy('published_at', 'desc');
	}

    public static function decodefind($id)
    {
        $id = base64_decode($id);
        return self::findOrFail($id);
    }
}
