<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    public function works(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Work::class,
            table: 'author_work'
        )->withTimestamps();
    }
}
