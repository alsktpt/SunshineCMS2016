<?php

namespace App\Http\Controllers\Frontend;

use SAuth;
use Carbon\Carbon;

use App\Article;
use App\Anthology;
use App\Collection;
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
        $posts = Article::latest('published_at')->verified()->published()
        ->paginate(config('site.posts_per_page'));

        // 获取文集
        $anthologies = Anthology::all();
        
        // 渲染视图 
        return view('landing', compact('posts','anthologies'));
    }


    public function getCollectionPage($uri)
    {
        $collection = Collection::whereUri($uri)->firstOrFail();

        $posts = Article::latest('published_at')->verified()->published()
        ->paginate(config('site.posts_per_page'));
        $anthologies = Anthology::whereCollectionId($collection['id'])->get();
        foreach ($anthologies as $anthology) {
            dump($anthology->articles);
        }
        dd();
        return view('theme.'.$collection['theme'].'.home', compact('posts','anthologies'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showArticle($id)
    {
        $anthologies = Article::decodeFind($id)->anthologies;
        foreach ($anthologies as $anthology) {
            dump($anthology->name);
        }
        dd();
        return view('index.article')->withArticle(Article::decodeFind($id));
    }

    public function showUserProfile($id)
    {

    }


}
