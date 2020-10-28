<?php

namespace App;

class Task extends Model
{
    protected $fillable = ['title', 'body'];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function scopeIncomplete($query)
    {
        return $query->where('completed', 0)->get();
    }
}
