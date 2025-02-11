<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuildItem extends Model
{
    use HasFactory;

    protected $fillable = ['build_id', 'type', 'image'];

    public function build(): BelongsTo
    {
        return $this->belongsTo(Build::class);
    }
}
