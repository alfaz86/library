<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Book\Filament\Resources\BookResource;
use Modules\Core\Filament\Resources\SettingResource;
use Modules\Core\Models\Setting;
use FilipFonal\FilamentLogManager\FilamentLogManager;
use Modules\Member\Filament\Resources\MemberResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $plugins = $this->getPlugins();

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::hex('#086E7D'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->resources([
                SettingResource::class,
                BookResource::class,
                MemberResource::class,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Settings')
                    ->url(fn(): string => SettingResource::getUrl())
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->brandName($this->getBrand('library_name'))
            ->brandLogo(fn() => view(
                'core::filament.sidebar.logo',
                [
                    'logo' => $this->getBrand('library_logo'),
                    'name' => $this->getBrand('library_name'),
                ]
            ))
            ->plugins($plugins);
    }

    private function getBrand(string $key): mixed
    {
        $settings = Setting::query()
            ->where('key', $key)
            ->first();

        if ($settings) {
            $value = $settings->value;

            if ($key === 'library_logo') {
                return $settings->getLogoUrl();
            }

            return $value;
        }

        if ($key === 'library_name') {
            return config('app.name');
        }

        return null;
    }

    private function getPlugins(): array
    {
        $settings = Setting::query()
            ->where('key', 'logger')
            ->first();

        $plugins = [];

        if ($settings && $settings->value == 1) {
            $plugins[] = FilamentLogManager::make();
        }

        return $plugins;
    }
}
