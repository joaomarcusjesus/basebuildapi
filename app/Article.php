<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Scopes\ArticleScope;

class Article extends Model
{
	use HasSlug;

    protected $fillable = ['slug', 'title', 'subtitle', 'body', 'user_id', 'status'];

     /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /** Boots **/
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ArticleScope());

        static::created(function($model)
        {
            $model->isVerifiedRole(['editor', 'jornalista', 'administrador']) ? $model->status = 'approved' : $model->status = 'waiting';
            $model->save();
        });
    }

    /** Relationships **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Scopes **/
    public function scopeStatus($query, $status)
    {
        return $query->where('is_status', $status);
    }

    /** Methods Helpers **/
    protected function isVerifiedRole($roles)
    {   
        if($roles != null)
        {
            foreach($roles as $role)
            {
                if ($this->user->is($role))
                {
                    return true;
                }
            }

            return false;
        } 
    }
}
