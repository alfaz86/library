<?php

namespace Modules\Loan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Book\Models\Book;
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
}
