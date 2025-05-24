<?php

namespace Modules\Loan\Filament\Resources\LoanResource\Pages;

use Modules\Loan\Filament\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLoan extends CreateRecord
{
    protected static string $resource = LoanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->loanBooksData = $data['loan_books'] ?? [];
        unset($data['loan_books']);

        return $data;
    }

    protected function afterCreate(): void
    {
        foreach ($this->loanBooksData as $item) {
            $this->record->books()->attach($item['book_id']);
        }
    }
}
