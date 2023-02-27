<?php

namespace App\Models;

use App\Models\Scopes\VisitorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new VisitorScope);

         static::saving(function ($user) {
             $user->type = 'visitor';
         });
    }
}
