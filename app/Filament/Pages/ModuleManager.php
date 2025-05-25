<?php

namespace App\Filament\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Log;
use Nwidart\Modules\Facades\Module;

class ModuleManager extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static string $view = 'filament.pages.module-manager';

    public ?string $processingModule = null;

    public function getTitle(): string
    {
        return __('module_manager.title');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('module_manager.navigation_group');
    }

    public static function getNavigationLabel(): string
    {
        return __('module_manager.navigation_label');
    }

    public function getBreadcrumbs(): array
    {
        return [
            __('setting.breadcrumbs.title'),
            __('module_manager.breadcrumbs.module_manager'),
        ];
    }

    public function getModules()
    {
        $coreModules = [
            'Core',
            'Book',
            'Member',
            'Loan',
            'LoanReturn',
        ];
        $modules = Module::all();
        $optionalModules = array_filter($modules, function ($module) use ($coreModules) {
            return !in_array($module->getName(), $coreModules);
        });
        return $optionalModules;
    }

    public function toggleModule(string $name)
    {
        $this->processingModule = $name;

        try {
            $module = Module::find($name);

            if ($module->isEnabled()) {
                $module->disable();
            } else {
                $module->enable();

                // Seeder
                $seederClass = 'Modules\\' . $module->getName() . '\\Database\\Seeders\\' . $module->getName() . 'DatabaseSeeder';
                if (class_exists($seederClass)) {
                    $seeder = new $seederClass();
                    $seeder->run();
                }
            }

            Notification::make()
                ->title(__('module_manager.module_' . ($module->isEnabled() ? 'enabled' : 'disabled'), ['module' => __('module_manager.modules.' . $module->getLowerName() . '.title')]))
                ->success()
                ->send();

        } catch (\Throwable $th) {
            Notification::make()
                ->title(__('module_manager.modules.fines.actions.error'))
                ->danger()
                ->send();

            Log::error('Error enabling module: ' . $th->getMessage());
        }

        $this->processingModule = null;

        return redirect()->route('filament.admin.pages.module-manager');
    }
}
