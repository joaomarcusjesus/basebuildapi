<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ArticleScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if($this->isVerifiedRole(['jornalista', 'reporter', 'estagiario', 'colunista', 'escritor']) && Auth::check()) 
        {
            $u = Auth::user();
            
            $query->whereHas('user', function ($q) use ($u) {
                $q->where('id', $u->id);
            });
        }
    }
}