<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    //
    protected $fillable=['title', 'content', 'published_at', 'user_id', 'last_editor_id'];
    protected $dates = ['published_at'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    public function anthologies()
    {
        return $this->belongsToMany(Anthology::class);
    }
    public function scopeVerified($query)
    {
        $query->where('verified', '1');
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
