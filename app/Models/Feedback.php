<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasFlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory, HasFlushTagCache;

    protected static array $tagsCache = ['feedbacks'];

    protected $fillable = [
        'email',
        'message',
    ];
}
