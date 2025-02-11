<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Build extends Model
{
    use HasFactory;

    protected $fillable = ['hero_id', 'image'];

    public function hero(): BelongsTo
    {
        return $this->belongsTo(Hero::class);
    }

    public function buildItems(): HasMany
    {
        return $this->hasMany(BuildItem::class);
    }
}
