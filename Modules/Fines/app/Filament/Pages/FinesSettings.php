<?php

namespace Modules\Fines\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Models\Setting;

class FinesSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static string $view = 'fines::filament.pages.fines-settings';

    protected static ?int $navigationSort = 99;

    public $fine_amount;
    public $fine_interval;
    public $fine_type;
    public $max_days;

    public function mount(): void
    {
        $this->form->fill([
            'fine_amount' => Setting::get('fines::fine_amount', 1000),
            'fine_interval' => Setting::get('fines::fine_interval', 'day'),
            'fine_type' => Setting::get('fines::fine_type', 'per_item'),
            'max_days' => Setting::get('fines::max_days', 7),
        ]);
    }

    public function getTitle(): string
    {
        return __('fines::module.title');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('fines::module.navigation_group');
    }

    public static function getNavigationLabel(): string
    {
        return __('fines::module.navigation_label');
    }

    public function getBreadcrumbs(): array
    {
        return [
            __('setting.breadcrumbs.title'),
            __('fines::module.breadcrumbs.fines'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('fine_amount')
                        ->label(__('fines::module.form.fine_amount'))
                        ->numeric()
                        ->required()
                        ->prefix('IDR'),

                    Forms\Components\Select::make('fine_interval')
                        ->label(__('fines::module.form.fine_interval'))
                        ->options([
                            'day' => __('fines::module.form.fine_intervals.day'),
                            'week' => __('fines::module.form.fine_intervals.week'),
                            'month' => __('fines::module.form.fine_intervals.month'),
                            'year' => __('fines::module.form.fine_intervals.year'),
                        ])
                        ->required()
                        ->native(false),

                    Forms\Components\Select::make('fine_type')
                        ->label(__('fines::module.form.fine_type'))
                        ->options([
                            'per_item' => __('fines::module.form.fine_types.per_item'),
                            'per_loan' => __('fines::module.form.fine_types.per_loan'),
                        ])
                        ->required()
                        ->native(false),

                    Forms\Components\TextInput::make('max_days')
                        ->label(__('fines::module.form.max_days'))
                        ->numeric()
                        ->required(),
                ]),
        ];
    }

    public function save()
    {
        $data = $this->form->getState();

        Setting::set('fines::fine_amount', $data['fine_amount']);
        Setting::set('fines::fine_interval', $data['fine_interval']);
        Setting::set('fines::fine_type', $data['fine_type']);
        Setting::set('fines::max_days', $data['max_days']);

        Notification::make()
            ->title(__('fines::module.notifications.save_success'))
            ->success()
            ->send();

        return redirect()->route('filament.admin.pages.fines-settings');
    }
}
