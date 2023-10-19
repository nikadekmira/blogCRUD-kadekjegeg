<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = ('posts');

    protected $fillable1 = [
        'title',
        'category_id',
        'slug',
        'image',
        'description',
    ];
}
