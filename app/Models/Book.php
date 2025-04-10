<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    const AVAILABLE = 'available';
    const NOT_AVAILABLE = 'not available';
    const INFORMATIONs = [
        self::AVAILABLE => 'Tersedia',
        self::NOT_AVAILABLE => 'Tidak Tersedia',
    ];

    protected $fillable = [
        'code',
        'title',
        'author',
        'publication_year',
        'information',
    ];

    protected $attributes = [
        'information' => self::AVAILABLE,
    ];
}
