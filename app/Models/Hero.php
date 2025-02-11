<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'tier_list_hero');
    }

    public function builds(): HasMany
    {
        return $this->hasMany(Build::class);
    }
}
