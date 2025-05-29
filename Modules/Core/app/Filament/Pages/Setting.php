<?php

namespace Modules\Core\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Modules\Core\Models\Setting as ModelsSetting;

class Setting extends Page
{
    protected static string $view = 'core::filament.pages.setting';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $slug = 'settings';

    protected static ?int $navigationSort = 1;

    public $app_name;
    public $app_logo;
    public $use_logo_upload;
    public $app_logo_upload;
    public $preview_logo;

    public function mount(): void
    {
        $logo = ModelsSetting::query()
            ->where('key', 'app::logo')
            ->first();

        $use_logo_upload = false;

        if ($logo && $logo->value) {
            // Check if the logo is a URL or a file path
            if (filter_var($logo->value, FILTER_VALIDATE_URL)) {
                $use_logo_upload = false; // It's a URL
            } elseif (Storage::disk('public')->exists($logo->value)) {
                $use_logo_upload = true; // It's a file path
            }
        }

        $this->form->fill([
            'app_name' => ModelsSetting::get('app::name', 'My Application'),
            'app_logo' => filter_var($logo->value, FILTER_VALIDATE_URL) ? $logo->getLogoUrl() : null,
            'use_logo_upload' => $use_logo_upload,
            'app_logo_upload' => null,
            'preview_logo' => $logo ? $logo->getLogoUrl() : asset('images/book.png'),
        ]);
    }

    public function getTitle(): string
    {
        return __('setting.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('setting.navigation_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('setting.navigation_group');
    }

    public function getBreadcrumbs(): array
    {
        return [
            __('setting.breadcrumbs.title'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('')
                ->schema([
                    TextInput::make('app_name')
                        ->label(__('setting.fields.app_name'))
                        ->required()
                        ->maxLength(255),

                    Group::make()
                        ->schema([
                            Toggle::make('use_logo_upload')
                                ->label('Upload Logo')
                                ->inline(false)
                                ->live(),

                            Placeholder::make('')
                                ->content(function () {
                                    return new HtmlString(
                                        view('core::filament.pages.setting-logo-preview', [
                                            'logo' => $this->preview_logo,
                                        ])->render()
                                    );
                                })
                                ->visible(fn($get) => $get('use_logo_upload') && $this->app_logo == null),

                            FileUpload::make('app_logo_upload')
                                ->label('')
                                ->image()
                                ->disk('public')
                                ->directory('images')
                                ->visible(fn($get) => $get('use_logo_upload')),

                            TextInput::make('app_logo')
                                ->label('Logo URL')
                                ->url()
                                ->visible(fn($get) => !$get('use_logo_upload')),
                        ]),
                ]),
        ];
    }

    public function save()
    {
        $data = $this->form->getState();

        ModelsSetting::set('app::name', $data['app_name']);

        // Simpan logo berdasarkan toggle
        if (!empty($data['use_logo_upload']) && !empty($data['app_logo_upload'])) {
            ModelsSetting::set('app::logo', $data['app_logo_upload']);
        } else {
            ModelsSetting::set('app::logo', $data['app_logo']);
        }

        Notification::make()
            ->title(__('fines::module.notifications.save_success'))
            ->success()
            ->send();

        return redirect()->route('filament.admin.pages.settings');
    }
}
