<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeUnpublished($query)
    {
        return $query->where('publish', 0)->get();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
