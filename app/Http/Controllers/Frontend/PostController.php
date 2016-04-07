<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use SAuth, Input, Redirect, Gate;

class PostController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = SAuth::user();
        return view('write.post', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreArticleRequest $request)
    {

		if(Input::get('define_published_at') === null)
		{
			$new['published_at'] = Carbon::now();
		}
		else
		{
			$new['published_at'] = Carbon::createFromTimestamp(strtotime(Input::get('published_date').''.Input::get('published_time')));
		}
		$new['title'] = clean(Input::get('title'));
		$new['content'] = clean(Input::get('content'));
		$new['user_id'] = SAuth::user()->id;

		if (Article::create($new)) {
			return Redirect::to('/');
		} else {
			return Redirect::back()->withInput()->withErrors('数据库维护中，保存失败！');
		}

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return $this->editCheck($article)
        ? view('write.edit', compact('article'))
        : abort(403);
    }


    public function editCheck($article)
    {
        if (! Gate::allows('edit-post')) {
            if (Gate::denies('is-post-owner', $article)) {
                return FALSE;
            }
        }
        return TRUE;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
