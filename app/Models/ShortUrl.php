<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShortUrl extends Model
{
    protected $casts = [
        'expire_at' => 'datetime',
        'click_count' => 'integer'
    ];

    protected $fillable = [
        'user_id',
        'original_url',
        'short_code',
        'expires_at'
    ];

    public function clicks(): HasMany
    {
        return $this->hasMany(ShortUrlClick::class);
    }

    public static function findByCode(string $code): ?self
    {
        return self::withCount('clicks')->where('short_code', '=', $code)->first();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
