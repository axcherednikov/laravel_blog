<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function complete($complete = true)
    {
        $this->update(['completed' => $complete]);
    }

    public function incomplete()
    {
        $this->complete(false);
    }
}
