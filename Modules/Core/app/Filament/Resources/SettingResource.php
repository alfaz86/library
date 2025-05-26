<?php

namespace Modules\Core\Filament\Resources;

use Modules\Core\Filament\Resources\SettingResource\Pages;
use Modules\Core\Filament\Resources\SettingResource\Pages\CreateSetting;
use Modules\Core\Filament\Resources\SettingResource\Pages\EditSetting;
use Modules\Core\Filament\Resources\SettingResource\Pages\ListSettings;
use Modules\Core\Filament\Resources\SettingResource\RelationManagers;
use Modules\Core\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 1;

    public function getTitle(): string
    {
        return __('setting.title');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('setting.navigation_group');
    }

    public static function getNavigationLabel(): string
    {
        return __('setting.navigation_label');
    }

    public function getBreadcrumbs(): array
    {
        return [
            __('setting.breadcrumbs.title'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->unique(ignorable: fn($record) => $record)
                    ->maxLength(255),
                Forms\Components\TextInput::make('value')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->sortable()
                    ->searchable(),
            ])->filters([
                    //
                ])->actions([
                    Tables\Actions\EditAction::make(),
                ])->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ]),
                ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}
