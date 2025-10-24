<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Coupon extends Model
{
    protected $fillable = [
        'name',
        'discount',
        'expires_at'
    ];

    /**
     * Convert the coupon name to uppercase
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::upper($value);
    }

    /**
     * Check if the coupon is valid
     */
    public function checkIfExpired() : bool
    {
        if($this->expires_at > date("Y-m-d")) {
            return false;
        }else {
            return true;
        }
    }
}
