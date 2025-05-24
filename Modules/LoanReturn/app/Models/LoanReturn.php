<?php

namespace Modules\LoanReturn\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Loan\Models\Loan;

class LoanReturn extends Model
{
    protected $fillable = [
        'loan_id',
        'returned_date',
        'fine_amount',
    ];

    public static function booted(): void
    {
        static::created(function (LoanReturn $loanReturn) {
            $loanBooks = $loanReturn->loan?->loan_books ?? [];

            foreach ($loanBooks as $lb) {
                $book = $lb->book;
                $stockRemaining = $book->stock_remaining;

                if ($stockRemaining > 0 && !$book->available) {
                    $book->available = true;
                    $book->save();
                }
            }
        });

        static::deleting(function (LoanReturn $loanReturn) {
            $loanReturn->loan?->update(['status' => 'borrow']);

            $loanBooks = $loanReturn->loan?->loan_books ?? [];

            foreach ($loanBooks as $lb) {
                $book = $lb->book;
                $stockRemaining = $book->stock_remaining;

                if ($stockRemaining <= 0 && $book->available) {
                    $book->available = false;
                    $book->save();
                }
            }
        });
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
