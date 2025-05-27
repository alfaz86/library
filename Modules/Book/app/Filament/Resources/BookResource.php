<?php

namespace Modules\Book\Filament\Resources;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\HtmlString;
use Modules\Book\Filament\Resources\BookResource\Pages;
use Modules\Book\Filament\Resources\BookResource\Pages\CreateBook;
use Modules\Book\Filament\Resources\BookResource\Pages\EditBook;
use Modules\Book\Filament\Resources\BookResource\Pages\ListBooks;
use Modules\Book\Filament\Resources\BookResource\RelationManagers;
use Modules\Book\Models\Book;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;
use Modules\Loan\Models\Loan;


class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('book.resources.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('book.resources.plural_label');
    }

    public function getTitle(): string
    {
        return __('book.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('book.navigation_label');
    }

    public static function form(Form $form): Form
    {
        return $form->schema(static::getFormSchema());
    }

    public static function getFormSchema(): array
    {
        return [
            Section::make('')
                ->columns(3)
                ->schema([

                    Forms\Components\TextInput::make('title')
                        ->label(__('book.fields.title'))
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('author')
                        ->label(__('book.fields.author'))
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('isbn')
                        ->label(__('book.fields.isbn'))
                        ->required()
                        ->maxLength(13)
                        ->numeric()
                        ->rules(function (\Filament\Forms\Get $get, ?Book $record) {
                            return [
                                Rule::unique('books', 'isbn')->ignore($record?->id),
                            ];
                        })
                        ->validationMessages([
                            'unique' => __('book.validation.isbn_unique'),
                        ]),

                    Forms\Components\TextInput::make('publisher')
                        ->label(__('book.fields.publisher'))
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('published_year')
                        ->label(__('book.fields.published_year'))
                        ->required()
                        ->maxLength(4),

                    Forms\Components\TextInput::make('category')
                        ->label(__('book.fields.category'))
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('language')
                        ->label(__('book.fields.language'))
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('pages')
                        ->label(__('book.fields.pages'))
                        ->required()
                        ->numeric(),

                    Forms\Components\TextInput::make('shelf_location')
                        ->label(__('book.fields.shelf_location'))
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('stock')
                        ->label(__('book.fields.stock'))
                        ->required()
                        ->numeric(),

                    Forms\Components\Toggle::make('available')
                        ->label(__('book.fields.available'))
                        ->default(true)
                        ->inline(false)
                        ->hidden(),

                    Forms\Components\FileUpload::make('cover_image')
                        ->label(__('book.fields.cover_image'))
                        ->image()
                        ->directory('covers')
                        ->hidden(),
                ]),

            Forms\Components\Section::make('Peminjam Saat Ini')
                ->hidden(fn(?Book $record) => $record === null)
                ->schema([
                    Placeholder::make('')
                        ->content(function ($state, $get) {
                            $borrowers = Loan::whereHas('loan_books', function (Builder $query) use ($get) {
                                $query->where('book_id', $get('id'));
                            })->where('status', 'borrow')->with('member')->get();

                            return new HtmlString(
                                view('book::filament.components.current-borrowers', [
                                    'borrowers' => $borrowers,
                                ])->render()
                            );
                        }),
                ]),
        ];
    }


    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Book::query()
                // ->withCount([
                //     'loans as loans_borrowed_count' => function ($query) {
                //         $query->where('status', 'borrow');
                //     }
                // ])
                // ->select('*')
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('book.fields.title'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('author')
                    ->label(__('book.fields.author'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('isbn')
                    ->label(__('book.fields.isbn'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('publisher')
                    ->label(__('book.fields.publisher'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('published_year')
                    ->label(__('book.fields.published_year'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category')
                    ->label(__('book.fields.category'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('language')
                    ->label(__('book.fields.language'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('pages')
                    ->label(__('book.fields.pages'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('shelf_location')
                    ->label(__('book.fields.shelf_location'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label(__('book.fields.stock'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('stock_remaining')
                    ->badge()
                    ->color(fn($state): string => match (true) {
                        $state <= 0 => 'danger',
                        default => 'success',
                    })
                    ->label(__('book.table.columns.stock_remaining'))
                    ->sortable()
                    ->searchable(),
                // ->getStateUsing(function ($record) {
                //     return $record->stock - $record->loans()
                //         ->where('status', 'borrow')
                //         ->count();
                // }),

                Tables\Columns\TextColumn::make('available')
                    ->color(fn($state): string => match (true) {
                        $state === true => 'success',
                        $state === false => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn($state): string => __('book.table.columns.available.' . (is_bool($state) ? ($state ? 'true' : 'false') : 'unknown')))
                    ->label(__('book.fields.available')),

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
            'index' => ListBooks::route('/'),
            'create' => CreateBook::route('/create'),
            'edit' => EditBook::route('/{record}/edit'),
        ];
    }
}
