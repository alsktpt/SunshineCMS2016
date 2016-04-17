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

    /**
     * [getCollectionPage description]
     * @param  [type] $uri [description]
     * @return [type]      [description]
     */
    public function getCollectionPage($uri)
    {
        $collection = Collection::whereUri($uri)->firstOrFail();

        $anthologies = Anthology::whereCollectionId($collection['id'])->get();

        foreach ($anthologies as $anthology) 
        {
            foreach ($anthology->articles as $article) 
            {
                $posts[$article->id] = $article;
            }
        }
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
        return view('frontend.article')->withArticle(Article::decodeFind($id));
    }

    public function showCollectionAnthologies($uri)
    {
        $anthologies = Anthology::whereCollectionId(Collection::whereUri($uri)->firstOrFail()->id)->get();
        dd($anthologies);
    }

    public function showUserProfile($id)
    {

    }


}
