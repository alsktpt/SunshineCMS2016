<?php

namespace App\Http\Controllers\Frontend;

use SAuth;
use Carbon\Carbon;

use App\Article;
use App\Activity;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class IndexController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLandingPage(Request $request)
    {
        // 获取文章数据
        $posts = Article::latest()->verified()->published()
        ->paginate(config('site.posts_per_page'));

        // 获取活动信息
        $activities = Activity::where('start_at', '>=', Carbon::yesterday())
        ->orderBy('start_at', 'desc')->get();
        
        // 渲染视图 
        return view('landing', compact('posts','activities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showArticle($id)
    {
        return view('index.article')->withArticle(Article::decodefind($id));
    }

    public function getUserProfile($id)
    {

    }


}
