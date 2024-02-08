<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id', 
        'province_id',
        'province',
        'type',
        'city_name',
        'postal_code'
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
