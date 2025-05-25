<?php

namespace Modules\LoanReturn\Filament\Resources\LoanReturnResource\Pages;

use Modules\Loan\Models\Loan;
use Modules\LoanReturn\Filament\Resources\LoanReturnResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLoanReturn extends CreateRecord
{
    protected static string $resource = LoanReturnResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $status = 'returned';

        if (isset($data['fine_amount'])) {
            $data['fine_amount'] = parsetoNumber($data['fine_amount']);
        }

        $loan = Loan::where('id', $data['loan_id']);

        if ($loan) {
            $loan = $loan->first();
            if ($loan->isLate($loan->due_date, $data['returned_date'])) {
                $status = 'late';
            }
        }
        
        $loan->update([
            'status' => $status,
        ]);

        return $data;
    }
}
