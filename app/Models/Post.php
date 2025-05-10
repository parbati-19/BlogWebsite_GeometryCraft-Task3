<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'published_date', 'category', 'image'];
    protected $casts = [
        'published_date' => 'datetime',
    ];
    

}
