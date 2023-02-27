<?php

namespace App\Models;

use GpsLab\Component\Base64UID\Base64UID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        Author::creating(function ($model) {
            $model->a_id = Base64UID::generate();
        });
    }

    public function works(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Work::class,
            table: 'author_work'
        )->withTimestamps();
    }
}
