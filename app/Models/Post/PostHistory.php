<?php

declare(strict_types=1);

namespace App\Models\Post;

use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Post\PostHistory.
 *
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property mixed|null $before
 * @property mixed|null $after
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Post $posts
 * @property-read User $users
 * @method static Builder|PostHistory newModelQuery()
 * @method static Builder|PostHistory newQuery()
 * @method static Builder|PostHistory query()
 * @method static Builder|PostHistory whereAfter($value)
 * @method static Builder|PostHistory whereBefore($value)
 * @method static Builder|PostHistory whereCreatedAt($value)
 * @method static Builder|PostHistory whereId($value)
 * @method static Builder|PostHistory wherePostId($value)
 * @method static Builder|PostHistory whereUpdatedAt($value)
 * @method static Builder|PostHistory whereUserId($value)
 * @mixin Eloquent
 */
class PostHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $touches = ['users', 'posts'];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
