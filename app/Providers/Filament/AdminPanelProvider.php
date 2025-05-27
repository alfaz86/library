<?php

namespace App\Providers\Filament;

use App\Filament\Pages\FilamentLogManager;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Report\Filament\Pages\Report;
use Modules\Book\Filament\Resources\BookResource;
use Modules\Core\Filament\Resources\SettingResource;
use Modules\Core\Models\Setting;
use Modules\Fines\Filament\Pages\FinesSettings;
use Modules\Loan\Filament\Resources\LoanResource;
use Modules\LoanReturn\Filament\Resources\LoanReturnResource;
use Modules\Member\Filament\Resources\MemberResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
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
            ->pages(array_filter([
                Pages\Dashboard::class,
                isModuleActive('Fines') ? FinesSettings::class : null,
                isModuleActive('Report') ? Report::class : null,
                isPluginActive('logger') ? FilamentLogManager::class : null,
            ]))
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
            ->resources(array_filter([
                SettingResource::class,
                BookResource::class,
                MemberResource::class,
                LoanResource::class,
                LoanReturnResource::class,
            ]))
            ->userMenuItems([
                MenuItem::make()
                    ->label(fn() => __('setting.menu_item'))
                    ->url(fn(): string => SettingResource::getUrl())
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->brandName($this->getBrand('app::name'))
            ->brandLogo(fn() => view(
                'core::filament.sidebar.logo',
                [
                    'logo' => $this->getBrand('app::logo'),
                    'name' => $this->getBrand('app::name'),
                ]
            ))
            ->renderHook(
                PanelsRenderHook::SIDEBAR_NAV_START,
                function () {
                    return view('core::filament.sidebar.customize');
                }
            );
    }

    private function getBrand(string $key): mixed
    {
        if (!Schema::hasTable('settings')) {
            return null;
        }

        $settings = Setting::query()
            ->where('key', $key)
            ->first();

        if ($settings) {
            $value = $settings->value;

            if ($key === 'app::logo') {
                return $settings->getLogoUrl();
            }

            return $value;
        }

        if ($key === 'app::name') {
            return config('app.name');
        }

        return null;
    }
}
