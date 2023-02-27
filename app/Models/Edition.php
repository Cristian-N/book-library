<?php

namespace App\Models;

use GpsLab\Component\Base64UID\Base64UID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

//        Edition::creating(function($model) {
//            $model->e_id = Base64UID::generate();
//        });
    }
}
