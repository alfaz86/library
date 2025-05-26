<?php

namespace Modules\LoanReturn\Filament\Resources\LoanReturnResource\Pages;

use Modules\LoanReturn\Filament\Resources\LoanReturnResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLoanReturns extends ListRecords
{
    protected static string $resource = LoanReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('loan_return.resources.list');
    }
}
