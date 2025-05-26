<?php

namespace Modules\Book\Filament\Resources\BookResource\Pages;

use Modules\Book\Filament\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('book.resources.list');
    }
}
