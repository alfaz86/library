<?php

namespace Modules\Book\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Book\Database\Factories\BookItemFactory;

class BookItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'barcode',
        'is_available',
        'notes',
    ];
    
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
