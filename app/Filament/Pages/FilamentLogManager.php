<?php

namespace App\Filament\Pages;

use FilipFonal\FilamentLogManager\Pages\Logs;

class FilamentLogManager extends Logs
{
    protected static ?string $slug = 'logs';

    public static function getNavigationSort(): int
    {
        return 199;
    }

    public static function getNavigationLabel(): string
    {
        return 'Log';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('setting.navigation_group');
    }

    public static function canAccess(): bool
    {
        if (!isPluginActive('logger')) {
            abort(404);
        }

        return true;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return isPluginActive('logger');
    }

}
