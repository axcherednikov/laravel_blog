<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $touches = ['users', 'posts'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
