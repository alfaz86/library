<?php

namespace Modules\Book\Filament\Resources\BookResource\Pages;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Illuminate\Support\HtmlString;
use Modules\Book\Filament\Resources\BookResource;
use Filament\Actions;
use Filament\Forms\Components\Actions as ComponentsActions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;

    public int $currentPage = 1;
    public int $perPage = 3;

    public $newItem = [
        'accession_number' => '',
        'location' => '',
        'status' => 'available',
    ];

    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'newItem' => [
                'accession_number' => '',
                'location' => '',
                'status' => 'available',
            ],
            'book_items' => [],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Ambil schema dari resource dulu
                ...BookResource::getFormSchema(),

                Section::make('Tambah Eksemplar Buku')
                    ->columns(3)
                    ->schema([
                        TextInput::make('newItem.accession_number')
                            ->label('Nomor Akses')
                            ->required(),

                        TextInput::make('newItem.location')
                            ->label('Lokasi Rak'),

                        Select::make('newItem.status')
                            ->label('Status')
                            ->options([
                                'available' => 'Tersedia',
                                'borrowed' => 'Dipinjam',
                                'damaged' => 'Rusak',
                                'lost' => 'Hilang',
                            ])
                            ->default('available'),

                        ComponentsActions::make([
                            ComponentsActions\Action::make('addBookItem')
                                ->label('Tambahkan')
                                ->action('addBookItemToList')
                                ->color('primary'),
                        ])->columnSpanFull(),
                    ]),

                Section::make('Daftar Eksemplar Buku')
                    ->columns(1)
                    ->schema([
                        Placeholder::make('book_items_table')
                            ->content(function ($get, $livewire) {
                                $items = $get('book_items') ?? [];

                                return new HtmlString(
                                    view('book::filament.components.book-items-table', [
                                        'items' => $livewire->paginatedBookItems,
                                    ])->render()
                                );
                            }),
                    ]),
            ]);
    }

    public function addBookItemToList()
    {
        $this->validate([
            'data.newItem.accession_number' => 'required|string',
        ]);

        $bookItems = $this->data['book_items'] ?? [];
        $bookItems[] = $this->data['newItem'];

        $this->form->fill([
            'book_items' => $bookItems,
            'newItem' => [
                'accession_number' => '',
                'location' => '',
                'status' => 'available',
            ],
        ]);
    }

    public function removeBookItemFromList($index)
    {
        $bookItems = $this->data['book_items'] ?? [];

        // Hitung total item sebelum dihapus
        $totalBefore = count($bookItems);

        // Hapus item berdasarkan index
        unset($bookItems[$index]);
        $bookItems = array_values($bookItems); // Reindex

        // Update data
        $this->form->fill([
            'book_items' => $bookItems,
        ]);

        // Hitung total item setelah penghapusan
        $totalAfter = count($bookItems);
        $totalPages = (int) ceil($totalAfter / $this->perPage);

        // Jika halaman sekarang lebih besar dari total halaman, mundur 1 halaman
        if ($this->currentPage > $totalPages && $this->currentPage > 1) {
            $this->currentPage--;
        }
    }


    public function getPaginatedBookItemsProperty()
    {
        $items = $this->data['book_items'] ?? [];

        $offset = ($this->currentPage - 1) * $this->perPage;

        return array_slice($items, $offset, $this->perPage);
    }

    public function getTotalPagesProperty()
    {
        $total = count($this->data['book_items'] ?? []);
        return (int) ceil($total / $this->perPage);
    }

    public function goToPage($page)
    {
        $this->currentPage = max(1, min($page, $this->totalPages));
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['stock'] > 0) {
            $data['available'] = true;
        }

        return $data;
    }
}
