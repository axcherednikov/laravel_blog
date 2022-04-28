<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait HasFlushTagCache
{
    public static function bootHasFlushTagCache(): void
    {
        static::creating(fn () => Cache::tags(self::$tagsCache)->flush());
        static::updating(fn () => Cache::tags(self::$tagsCache)->flush());
        static::deleting(fn () => Cache::tags(self::$tagsCache)->flush());
    }
}
