<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'posts_tags';

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public static function tagsCloud()
    {
        return (new static)->has('posts')->get();
    }
}
