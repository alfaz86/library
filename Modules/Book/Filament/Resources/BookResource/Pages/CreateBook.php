<?php

namespace Modules\Book\Filament\Resources\BookResource\Pages;

use Modules\Book\Filament\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;
}
