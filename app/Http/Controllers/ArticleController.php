<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Article;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Services\Pagination;

class ArticleController extends Controller
{
    protected $article;
    protected $pagination;

    public function __construct(Article $article, Pagination $pagination)
    {
        // Dependency Injection
        $this->article = $article;
        $this->pagination = $pagination;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // If has request limit
        $request->has('limit') ? $limit = $request->get('limit') : $limit = 10;

        // If has request page
        $request->has('page') ? $page = $request->get('page') : $page = 1;

        // Return collection
        return new ArticleCollection(
            $this->pagination->make(
                $this->article->all(), $page, $limit, $request
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $this->article->create($request->all());

        return response()->json(['message' => 'created article success', 'status_code' => 201]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['data' => new ArticleResource($this->article->findOrFail($id)), 'status_code' => 200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        return response()->json(['message' => 'updated article success', 'status_code' => 201]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleRequest $request, Article $article)
    {
        $article->delete();

        return response()->json(['message' => 'deleted article success', 'status_code' => 201]);
    }
}
