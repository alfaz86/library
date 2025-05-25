<?php

namespace Modules\LoanReturn\Filament\Resources;

use Dom\Text;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Modules\Book\Models\Book;
use Modules\Fines\Services\FinesService;
use Modules\Loan\Models\Loan;
use Modules\LoanReturn\Filament\Resources\LoanReturnResource\Pages\CreateLoanReturn;
use Modules\LoanReturn\Filament\Resources\LoanReturnResource\Pages\EditLoanReturn;
use Modules\LoanReturn\Filament\Resources\LoanReturnResource\Pages\ListLoanReturns;
use Modules\LoanReturn\Filament\Resources\LoanReturnResource\Pages;
use Modules\LoanReturn\Filament\Resources\LoanReturnResource\RelationManagers;
use Modules\LoanReturn\Models\LoanReturn;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Modules\Member\Models\Member;

class LoanReturnResource extends Resource
{
    protected static ?string $model = LoanReturn::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $translationKey = 'loan_return.resources';

    public static function getModelLabel(): string
    {
        return __('loan_return.resources.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('loan_return.resources.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('loan_id')
                ->label(__('loan_return.fields.borrower'))
                ->searchable()
                ->required()
                ->getSearchResultsUsing(function (string $search) {
                    $driver = DB::getDriverName();
                    $operator = $driver === 'pgsql' ? 'ilike' : 'like';

                    return Loan::query()
                        ->where('status', '!=', 'returned')
                        ->whereHas('member', function ($query) use ($search, $operator) {
                            $query->where('name', $operator, "%{$search}%")
                                ->orWhere('member_code', $operator, "%{$search}%");
                        })
                        ->with('member', 'loan_books')
                        ->get()
                        ->mapWithKeys(function ($loan) {
                            return [
                                $loan->id => self::getLabelSelect($loan->id, null),
                            ];
                        })
                        ->toArray();
                })
                ->allowHtml()
                ->required()
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state, $get) {
                    $loanId = $get('loan_id');
                    $returnedDate = $get('returned_date');

                    if ($state && $returnedDate && isModuleActive('Fines')) {
                        $fine = FinesService::calculateFine($loanId, $returnedDate);
                        $set('fine_amount', formatCurrency($fine, 'IDR', 'id_ID'));
                    }
                })

                ->getOptionLabelUsing(fn($value, $livewire) => self::getLabelSelect($value, $livewire))
                ->disabled(fn($livewire) => $livewire instanceof ListRecords),

            Forms\Components\DatePicker::make('returned_date')
                ->label(__('loan_return.fields.returned_date'))
                ->default(now())
                ->required()
                ->native(false)
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state, $get) {
                    $loanId = $get('loan_id');
                    $returnedDate = $get('returned_date');

                    if ($loanId && $returnedDate && isModuleActive('Fines')) {
                        $fine = FinesService::calculateFine($loanId, $returnedDate);
                        $set('fine_amount', formatCurrency($fine, 'IDR', 'id_ID'));
                    }
                })
                ->disabled(fn($livewire) => $livewire instanceof ListRecords),

            Fieldset::make(__('loan.fields.loan_books'))
                ->schema(function (callable $get) {
                    $loanId = $get('loan_id');

                    if (!$loanId) {
                        return [
                            Placeholder::make('')
                                ->content(__('loan_return.messages.empty')),
                        ];
                    }

                    $loan = Loan::with('loan_books.book')->find($loanId);
                    if (!$loan || $loan->loan_books->isEmpty()) {
                        return [
                            Placeholder::make('empty')->content(__('loan_return.messages.no_books'))
                        ];
                    }

                    return $loan->loan_books->map(function ($loanBook, $index) {
                        return Placeholder::make("book_{$index}")
                            ->label(__('loan.fields.book_id') . ' #' . ($index + 1))
                            ->content($loanBook->book->title ?? '-');
                    })->toArray();
                })
                ->extraAttributes([
                    'class' => 'bg-white dark:bg-gray-900 rounded-lg',
                ]),

            TextInput::make('fine_amount')
                ->label(__('loan_return.fields.fine_amount'))
                ->default(0)
                ->readOnly()
                ->formatStateUsing(fn($state) => formatCurrency($state, 'IDR', 'id_ID'))
                ->visible(fn() => isModuleActive('Fines')),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(array_filter([
                Tables\Columns\TextColumn::make('loan.member.name')
                    ->label(__('loan_return.fields.borrower'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('returned_date')
                    ->label(__('loan_return.fields.returned_date'))
                    ->date()
                    ->sortable(),

                isModuleActive('Fines') ?
                Tables\Columns\TextColumn::make('fine_amount')
                    ->label(__('loan_return.fields.fine_amount'))
                    ->money('IDR')
                    ->sortable()
                    ->formatStateUsing(fn($state) => formatCurrency($state, 'IDR', 'id_ID'))
                : null,
            ]))
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => ListLoanReturns::route('/'),
            'create' => CreateLoanReturn::route('/create'),
        ];
    }

    public static function getLabelSelect($value, $livewire = null): string
    {
        $loan = Loan::with('member', 'loan_books.book')->find($value);
        $count = $loan->loan_books->count();

        if ($livewire instanceof ListRecords) {
            return $loan->member->name;
        }

        $badge = <<<HTML
                <span style="--c-50:var(--success-50);--c-400:var(--success-400);--c-600:var(--success-600);"
                    class="fi-badge inline-flex items-center rounded-md text-xs font-medium ring-1 ring-inset px-2 py-0.5 fi-color-custom bg-custom-50 text-custom-600 ring-custom-600/10 dark:bg-custom-400/10 dark:text-custom-400 dark:ring-custom-400/30 fi-color-success">
                    <span>$count Buku</span>
                </span>
            HTML;

        $label = <<<HTML
                <span class="flex items-center justify-between gap-2 w-full">
                    <div class="flex flex-col">
                        <span class="font-medium">{$loan->member->name}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{$loan->member->member_code}</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="text-right mb-1">
                            {$badge}
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400" style="zoom: 80%;">{$loan->loan_date}</span>
                    </div>
                </span>
            HTML;

        return $label;
    }
}
