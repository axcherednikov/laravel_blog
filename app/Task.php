<?php

namespace App;

use App\Mail\TaskCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Task extends Model
{
    protected $fillable = ['owner_id', 'title', 'body'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            Mail::to($task->owner->email)->send(
                new TaskCreated($task)
            );
        });
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function scopeIncomplete($query)
    {
        return $query->where('completed', 0)->get();
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function addStep(array $attributes)
    {
        return $this->steps()->create($attributes);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
