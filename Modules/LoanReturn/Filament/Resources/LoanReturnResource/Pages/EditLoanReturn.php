<?php

namespace Modules\LoanReturn\Filament\Resources\LoanReturnResource\Pages;

use Modules\LoanReturn\Filament\Resources\LoanReturnResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLoanReturn extends EditRecord
{
    protected static string $resource = LoanReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
