<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Auth, Input, Redirect, Gate;

class PostController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('write.post');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreArticleRequest $request)
    {
		$new['title'] = clean(Input::get('title'));
		$new['content'] = clean(Input::get('content'));
		$new['user_id'] = Auth::user()->id;
        $new['last_editor_id'] = Auth::user()->id;
        $new['published_at'] = $this->createCarbon();
        $new['verified'] = config('article_default_verified');

		if (Article::create($new)) {
			return Redirect::to('/');
		} else {
			return Redirect::back()->withInput()->withErrors('数据库维护中，保存失败！');
		}

    }

    protected function createCarbon()
    {
        return Input::get('define_published_at') === null
        ? Carbon::now()
        : $this->createCarbonByUserDefine();
    }

    protected function createCarbonByUserDefine()
    {
        return Carbon::createFromTimestamp(strtotime(Input::get('published_date').''.Input::get('published_time')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::decodeFind($id);
        $this->authorize('canEdit', $article);
        return view('write.edit', compact('article'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\StoreArticleRequest $request)
    {

        $article = Article::decodeFind(Input::get('id'));
        $this->authorize('canEdit', $article);

        $update = $request->except(['id', 'define_published_at' , 'published_date', 'published_time']);
        $update['last_editor_id'] = Auth::user()->id;

        if(Input::get('define_published_at') !== null)
        {
            $update['published_at'] = $this->createCarbonByUserDefine();
        }

        $article->update($update);

        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::decodeDelete($id);
    }
}
