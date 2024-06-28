<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'apartment_count',
        'house_id',
    ];

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function apartments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Apartment::class);
    }
}
