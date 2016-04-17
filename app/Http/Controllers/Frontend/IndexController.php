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
     * 进入子站点首页
     * @param  [type] $uri [description]
     * @return [type]      [description]
     */
    public function getCollectionPage($uri)
    {
        $collection = Collection::whereUri($uri)->firstOrFail();

        $anthologies = Anthology::whereCollectionId($collection['id'])->get()->toArray();
        
        if ($anthologies === []) {
            $posts = [];
        }
        else
        {
            foreach ($anthologies as $anthology) 
            {
                foreach ($anthology->articles as $article) 
                {
                    $posts[$article->id] = $article;
                }
            }
        }

        return view($this->getThemeHome($collection), compact('posts','anthologies', 'collection'));
    }
    
    private function show($id, $collecionUri = '')
    {
        if ($collecionUri === '')
        {
            // $this->
        }        
    }
    /**
     * 显示文章
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showArticle($id)
    {
        $this->show($id);
        return view('frontend.article')->withArticle(Article::decodeFind($id));
    }
    /**
     * 显示子站点的文章分类
     * @param  [type] $uri [description]
     * @return [type]      [description]
     */
    public function showCollectionAnthologies($uri)
    {
        $anthologies = Anthology::whereCollectionId(Collection::whereUri($uri)->firstOrFail()->id)->get();
        dd($anthologies);
    }

    /**
     * 显示子站点的文章列表
     * @param  [type] $uri [description]
     * @param  [type] $id  [description]
     * @return [type]      [description]
     */
    public function showCollecionAntholgy($uri, $id)
    {
        
    }

    public function showCollecionAritcle($uri, $id)
    {
        # code...
    }

    public function showUserProfile($id)
    {

    }


    private function getThemeHome($collection)
    {
        return isset($collection['theme'])
        ? 'theme.'.$collection['theme'].'.home'
        : 'frontend.home';
    }


}
