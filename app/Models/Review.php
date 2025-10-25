<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Review extends Model
{
    protected $fillable = [
        'title',
        'body',
        'rating',
        'user_id',
        'product_id',
        'approved'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getCreatedAtAttribute($value) : string
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
