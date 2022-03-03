<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Work extends Model
{
    use HasFactory;

    public function editions(): HasMany
    {
        return $this->hasMany(
            related: Edition::class,
        );
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Author::class,
            table: 'author_work'
        )->withTimestamps();
    }
}
