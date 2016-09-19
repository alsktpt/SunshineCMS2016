<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 后台首页
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndexPage()
    {
        return view('backend.index');
    }

    /**
     * 创建子站页面
     *
     * @return \Illuminate\Http\Response
     */
    public function createCollectionPage()
    {
        return view('backend.createCollection');
    }
    /**
     * 子站列表
     * 
     * @return [type] [description]
     */
    public function collectionListPage()
    {
        return view('backend.collectionList');
    }
    /**
     * 显示子站细节
     * @param  [type] $uri [description]
     * @return [type]      [description]
     */
    public function showCollection($uri)
    {
        return view('backend.showCollection', ['uri' => $uri]);
    }


}
