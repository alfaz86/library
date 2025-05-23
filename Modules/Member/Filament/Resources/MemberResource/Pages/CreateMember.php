<?php

namespace Modules\Member\Filament\Resources\MemberResource\Pages;

use Modules\Member\Filament\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;
}
