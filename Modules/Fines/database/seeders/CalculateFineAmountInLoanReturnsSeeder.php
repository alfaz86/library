<?php

namespace Modules\Fines\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Fines\Services\FinesService;
use Modules\LoanReturn\Models\LoanReturn;

class CalculateFineAmountInLoanReturnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $finesService = new FinesService();
        $loanReturns = LoanReturn::with('loan')
            ->where('fine_amount', 0)
            ->whereHas('loan', function ($query) {
                $query->where('status', 'late');
            })
            ->get();

        foreach ($loanReturns as $loanReturn) {
            $loanReturn->fine_amount = $finesService->calculateFine($loanReturn->loan_id, $loanReturn->returned_date);
            $loanReturn->saveQuietly();
        }
    }
}
