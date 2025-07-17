<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShortUrlClick extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'short_url_id',
        'clicked_at'
    ];

    protected $casts = [
        'clicked_at' => 'datetime'
    ];

    public function shortUrl(): BelongsTo
    {
        return $this->belongsTo(BelongsTo::class);
    }
}
