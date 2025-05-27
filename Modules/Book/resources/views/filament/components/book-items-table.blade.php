<pre>@json($items)</pre>

<table class="w-full text-sm border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-2 py-1 border">#</th>
            <th class="px-2 py-1 border">Nomor Akses</th>
            <th class="px-2 py-1 border">Lokasi</th>
            <th class="px-2 py-1 border">Status</th>
            <th class="px-2 py-1 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $i => $item)
            <tr>
                <td class="px-2 py-1 border">{{ $i + 1 }}</td>
                <td class="px-2 py-1 border">{{ $item['accession_number'] }}</td>
                <td class="px-2 py-1 border">{{ $item['location'] ?? '-' }}</td>
                <td class="px-2 py-1 border">{{ ucfirst($item['status']) }}</td>
                <td class="px-2 py-1 border text-red-600">
                    <button wire:click="removeBookItemFromList({{ $i }})" type="button">Hapus</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-2 py-1 border text-center text-gray-500">Tidak ada item buku yang ditambahkan.
                </td>
            </tr>
        @endforelse
    </tbody>

    <tfoot>
        <tr>
            <td colspan="5" class="text-center py-2">
                @if ($this->totalPages > 1)
                    <div class="flex justify-center space-x-1">
                        <button wire:click="goToPage({{ $this->currentPage - 1 }})"
                            type="button"
                            class="px-2 py-1 border bg-white text-sm" @disabled($this->currentPage === 1)>
                            &laquo;
                        </button>

                        @for ($page = 1; $page <= $this->totalPages; $page++)
                            <button wire:click="goToPage({{ $page }})"
                                class="px-2 py-1 border text-sm {{ $page === $this->currentPage ? 'bg-blue-500 text-white' : 'bg-white' }}">
                                {{ $page }}
                            </button>
                        @endfor

                        <button wire:click="goToPage({{ $this->currentPage + 1 }})"
                            class="px-2 py-1 border bg-white text-sm"
                            type="button"
                            @disabled($this->currentPage === $this->totalPages)>
                            &raquo;
                        </button>
                    </div>
                @endif
            </td>
        </tr>
    </tfoot>
</table>