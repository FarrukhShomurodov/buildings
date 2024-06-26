<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'photo_url'
    ];

    public function floor(): HasMany
    {
        return $this->hasMany(Floor::class);
    }

    public function apartments(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
