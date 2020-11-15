<?php

namespace App;

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
}
