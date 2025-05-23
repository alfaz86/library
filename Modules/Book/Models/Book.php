<?php

namespace Modules\Book\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'publisher',
        'published_year',
        'category',
        'language',
        'pages',
        'shelf_location',
        'stock',
        'available',
        'description',
        'cover_image',
    ];
}
