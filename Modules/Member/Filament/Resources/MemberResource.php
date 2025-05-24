<?php

namespace Modules\Member\Filament\Resources;

use Modules\Member\Filament\Resources\MemberResource\Pages;
use Modules\Member\Filament\Resources\MemberResource\Pages\CreateMember;
use Modules\Member\Filament\Resources\MemberResource\Pages\EditMember;
use Modules\Member\Filament\Resources\MemberResource\Pages\ListMembers;
use Modules\Member\Filament\Resources\MemberResource\RelationManagers;
use Modules\Member\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('member.resources.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('member.resources.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('member.fields.name'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('member_code')
                    ->label(__('member.fields.member_code'))
                    ->required()
                    ->maxLength(255)
                    ->rules(function (\Filament\Forms\Get $get, ?Member $record) {
                        return [
                            Rule::unique('members', 'member_code')->ignore($record?->id),
                        ];
                    })
                    ->validationMessages([
                        'unique' => __('member.validation.member_code_unique'),
                    ]),

                Forms\Components\TextInput::make('email')
                    ->label(__('member.fields.email'))
                    ->email()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label(__('member.fields.phone'))
                    ->rules([
                        'nullable',
                        'regex:/^[0-9+\s().-]+$/',
                    ])
                    ->maxLength(20),

                Forms\Components\Textarea::make('address')
                    ->label(__('member.fields.address'))
                    ->rows(3)
                    ->maxLength(65535),

                Forms\Components\Toggle::make('is_active')
                    ->label(__('member.fields.is_active'))
                    ->default(true)
                    ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('member.fields.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('member_code')
                    ->label(__('member.fields.member_code'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('member.fields.email'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label(__('member.fields.phone'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('address')
                    ->label(__('member.fields.address'))
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BooleanColumn::make('is_active')
                    ->label(__('member.fields.is_active'))
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
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
            'index' => ListMembers::route('/'),
            'create' => CreateMember::route('/create'),
            'edit' => EditMember::route('/{record}/edit'),
        ];
    }
}
