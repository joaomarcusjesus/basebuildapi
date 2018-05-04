<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
            'data' => $this->getCollection()->transform(function ($article) {
                return [
                    'slug' => $article->slug,
                    'title' => $article->title,
                    'subtitle' => $article->subtitle,
                    'body' => $article->body,
                    'created_at' => $article->created_at->diffForHumans()
                ];
            }),
        ];
    }
}
