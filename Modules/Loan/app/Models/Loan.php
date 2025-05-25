<?php

namespace Modules\Loan\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Book\Models\Book;
use Modules\LoanReturn\Models\LoanReturn;
use Modules\Member\Models\Member;

class Loan extends Model
{
    protected $fillable = [
        'member_id',
        'loan_date',
        'due_date',
        'status',
    ];

    public const STATUS_BORROW = 'borrow';
    public const STATUS_RETURNED = 'returned';
    public const STATUS_LATE = 'late';

    public const STATUSES = [
        self::STATUS_BORROW,
        self::STATUS_RETURNED,
        self::STATUS_LATE,
    ];
    
    public static function booted(): void
    {
        static::deleting(function (loan $loan) {
            $loanBooks = $loan->loan_books ?? [];

            foreach ($loanBooks as $lb) {
                $book = $lb->book;
                $stockRemaining = $book->stock_remaining;

                if ($stockRemaining <= 0 && !$book->available) {
                    $book->available = true;
                    $book->save();
                }
            }
        });
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, LoanBook::class)
            ->withTimestamps();
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function loan_books(): HasMany
    {
        return $this->hasMany(LoanBook::class);
    }

    public function loan_returns(): HasMany
    {
        return $this->hasMany(LoanReturn::class);
    }

    public function isLate($due_date, $returned_date): bool
    {
        $dueDate = Carbon::parse($due_date)->startOfDay();
        $returnedDate = Carbon::parse($returned_date)->startOfDay();

        if ($returnedDate->greaterThan($dueDate)) {
            return true;
        }

        return false;
    }
}
