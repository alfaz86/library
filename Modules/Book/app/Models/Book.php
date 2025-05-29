<?php

namespace Modules\Book\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Loan\Models\Loan;
use Modules\Loan\Models\LoanBook;

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

    protected $casts = [
        'available' => 'boolean',
    ];

    protected $appends = [
        'stock_remaining',
    ];

    public function getStockRemainingAttribute(): int
    {
        return $this->stock - $this->loans()->where('status', 'borrow')->count();
    }

    public function loans()
    {
        return $this->belongsToMany(Loan::class, LoanBook::class)
            ->withTimestamps();
    }

    public function loanBooks()
    {
        return $this->hasMany(LoanBook::class);
    }

}
