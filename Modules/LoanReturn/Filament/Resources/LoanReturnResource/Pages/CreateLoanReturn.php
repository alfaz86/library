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
        Loan::where('id', $data['loan_id'])->update([
            'status' => 'returned',
        ]);

        return $data;
    }
}
