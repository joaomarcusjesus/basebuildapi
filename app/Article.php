<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
	use HasSlug;

    protected $fillable = ['slug', 'title', 'subtitle', 'body', 'user_id'];

     /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /** Relationships **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('name');
    }
}
