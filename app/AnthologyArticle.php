<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnthologyArticle extends Model
{
    /**
     * 表名
     * @var string
     */
    protected $table = 'anthology_article';

    protected $fillable =['verified', 'verified_user'];
}
