<?php

namespace Modules\Fines\Services;

use Carbon\Carbon;
use Modules\Core\Models\Setting;
use Modules\Loan\Models\Loan;

class FinesService
{
    public static function calculateFine(int $loanId, string $returnDate): int
    {
        $loan = Loan::find($loanId);
        if (!$loan || !$loan->due_date) {
            return 0;
        }

        $dueDate = Carbon::parse($loan->due_date)->startOfDay();
        $returnedDate = Carbon::parse($returnDate)->startOfDay();

        if ($returnedDate->lessThanOrEqualTo($dueDate)) {
            return 0; // Tidak telat
        }

        $daysLate = $dueDate->diffInDays($returnedDate);

        // Ambil setting denda
        $amount = (int) Setting::get('fines::fine_amount', 1000);
        $interval = Setting::get('fines::fine_interval', 'day'); // day/week/month/year
        $type = Setting::get('fines::fine_type', 'per_item'); // per_item / per_loan

        // Hitung total interval telat
        $intervalCount = match ($interval) {
            'day' => $dueDate->diffInDays($returnedDate),
            'week' => $dueDate->diffInWeeks($returnedDate),
            'month' => $dueDate->diffInMonths($returnedDate),
            'year' => $dueDate->diffInYears($returnedDate),
            default => 0,
        };

        if ($intervalCount < 1) {
            $intervalCount = 1; // minimal 1x denda jika lewat
        }

        // Hitung jumlah buku yg dipinjam jika per_item
        $quantity = ($type === 'per_item') ? $loan->loan_books()->count() : 1;

        return $intervalCount * $amount * $quantity;
    }
}
