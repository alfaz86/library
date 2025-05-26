<?php

namespace Modules\Loan\Filament\Resources;

use Filament\Tables\Actions\DeleteAction;
use Modules\Loan\Filament\Resources\LoanResource\Pages;
use Modules\Loan\Filament\Resources\LoanResource\Pages\CreateLoan;
use Modules\Loan\Filament\Resources\LoanResource\Pages\EditLoan;
use Modules\Loan\Filament\Resources\LoanResource\Pages\ListLoans;
use Modules\Loan\Filament\Resources\LoanResource\RelationManagers;
use Modules\Loan\Models\Loan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use Modules\Book\Models\Book;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return __('loan.resources.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('loan.resources.plural_label');
    }

    public function getTitle(): string
    {
        return __('loan.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('loan.navigation_label');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('')
                ->columns(2)
                ->schema([
                    Select::make('member_id')
                        ->label(__('loan.fields.member_id'))
                        ->relationship('member', 'name')
                        ->searchable()
                        ->required(),
        
                    DatePicker::make('loan_date')
                        ->label(__('loan.fields.loan_date'))
                        ->default(now())
                        ->required(),
        
                    DatePicker::make('due_date')
                        ->label(__('loan.fields.due_date'))
                        ->default(now()->addWeek())
                        ->required(),
        
                    Repeater::make('loan_books')
                        ->label(__('loan.fields.loan_books'))
                        ->relationship('loan_books')
                        ->schema([
                            Select::make('book_id')
                                ->label(__('loan.fields.book_id'))
                                ->options(Book::pluck('title', 'id'))
                                ->searchable()
                                ->required(),
                        ])
                        ->columnSpanFull()
                        ->minItems(1)
                        ->reorderable(false)
                        ->addActionLabel(__('loan.fields.add_book')),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('member.name')
                    ->label(__('loan.fields.member_id'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('loan_date')
                    ->label(__('loan.fields.loan_date'))
                    ->date()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('due_date')
                    ->label(__('loan.fields.due_date'))
                    ->date()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('loan.fields.status'))
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        Loan::STATUS_BORROW => 'warning',
                        Loan::STATUS_RETURNED => 'success',
                        Loan::STATUS_LATE => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => __('loan.status.' . $state) ?? $state)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('loan_books_count')
                    ->label(__('loan.table.columns.book_count'))
                    ->counts('loan_books')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('loan.fields.status'))
                    ->options([
                        Loan::STATUS_BORROW => __('loan.status.borrow'),
                        Loan::STATUS_RETURNED => __('loan.status.returned'),
                        Loan::STATUS_LATE => __('loan.status.late'),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function ($records, $action) {
                            $blocked = [];
                            $deleted = 0;

                            foreach ($records as $record) {
                                if ($record->loan_returns()->count() > 0) {
                                    $blocked[] = $record->id;
                                } else {
                                    $record->delete();
                                    $deleted++;
                                }
                            }

                            Log::info('Bulk delete loans action executed', [
                                'deleted' => count($records) - count($blocked),
                                'blocked' => $blocked,
                            ]);

                            if (count($blocked)) {
                                Notification::make()
                                    ->title(__('loan.notifications.loan_can\'t_be_deleted_title'))
                                    ->body(__('loan.notifications.loan_can\'t_be_deleted_body'))
                                    ->danger()
                                    ->send();
                            }

                            if ($deleted > 0) {
                                Notification::make()
                                    ->title(__('loan.notifications.loan_deleted'))
                                    ->body(__('loan.notifications.loan_deleted_detail', ['deleted' => $deleted]))
                                    ->success()
                                    ->send();
                            }
                        }),
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
            'index' => ListLoans::route('/'),
            'create' => CreateLoan::route('/create'),
            'edit' => EditLoan::route('/{record}/edit'),
        ];
    }
}
