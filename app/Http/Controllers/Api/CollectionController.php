<?php

namespace App\Http\Controllers\Api;

use App\Collection;

use App\Http\Requests;

use App\Services\CollectionEdit;

use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    /**
     * CollectionEdit Services
     * @var [type]
     */
    protected $collectionOpt;

    function __construct(CollectionEdit $cole)
    {
        $this->collectionOpt = $cole;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Collection::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CollectionRequest $request)
    {
        $newCollection = $request->all();

        $this->collectionOpt->createCollection($newCollection);

        return response()->json([], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uri
     * @return \Illuminate\Http\Response
     */
    public function show($uri)
    {
        return Collection::findOrFail($uri);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CollectionRequest $request, $uri)
    {
        $updateCollection = $request->all();
        if ($this->collectionOpt->updateCollection($updateCollection, $uri))return response()->json([], 205);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests\CollectionRequest $request, $uri)
    {
        $this->collectionOpt->deleteCollection($uri);
        return response()->json([], 205);
    }
}
