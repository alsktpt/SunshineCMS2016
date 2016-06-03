<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Input,Auth;
use App\Comment;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comment::verified()->noparent()->orderBy('created_at', 'desc')->limit(10)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CommentRequest $request)
    {
        $comment['body'] = clean(Input::get('body'));
        $comment['user_id'] = Auth::user()->id;
        $comment['article_id'] = Input::get('article_id');
        if (Input::get('parent_id') != '') {
            $comment['parent_id'] = $request->input('parent_id');
        }
        $comment['verified'] = config('site.comment_default_verified');

        if (Comment::create($comment)) {
            return response()->json(['status' => '201', 'message' => 'Submited!'], 201);
        } else {
            return response()->json(['status' => '500', 'message' => 'Database Died!'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Article::findOrFail($id)->comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CommentRequest $request, $id)
    {
        $comment =Comment::findOrFail($id);
        $data['body'] = clean(Input::get('body'));
        $data['verified'] = config('site.comment_default_verified');

        if ($comment->update($data)) {
            return response()->json(['status' => '201', 'message' => 'Submited!'], 201);
        } else {
            return response()->json(['status' => '500', 'message' => 'Database Died!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Comment::delete($id)) {
            return response()->json(['status' => '201', 'message' => 'success!'], 201);
        }else
        {
            return response()->json(['status' => '500', 'message' => 'Database Died'], 500);
        }
    }
}
