<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journalist extends Model
{
    /** Relationships **/
    public function user()
    {
      return $this->morphOne(User::class, 'userable');
    }
}
