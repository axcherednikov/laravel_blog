<?php

namespace App\Models\Task;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Task\TaskHistory
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property array|null $before
 * @property array|null $after
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Task\Task $tasks
 * @property-read User $users
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory whereAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory whereBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHistory whereUserId($value)
 * @mixin \Eloquent
 */
class TaskHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'after' => 'array',
        'before' => 'array',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }
}
