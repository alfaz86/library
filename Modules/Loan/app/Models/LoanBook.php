<?php

namespace Modules\Loan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Modules\Book\Models\Book;

class LoanBook extends Model
{
    protected $fillable = [
        'loan_id',
        'book_id',
    ];

    public static function booted(): void
    {
        static::saving(function (LoanBook $loanBook) {
            $book = Book::find($loanBook->book_id);
            if ($book) {
                $remainingStock = $book->stock_remaining - 1; // Adding 1 because we are about to loan this book
                if ($remainingStock <= 0) {
                    $book->available = false;
                    $book->saveQuietly();
                    Log::info("Book ID {$book->id} is now unavailable due to no remaining stock.");
                }
            }
        });
    }

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
