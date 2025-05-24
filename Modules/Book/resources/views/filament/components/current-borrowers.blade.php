<table class="filament-tables-table w-full text-sm">
    <thead>
        <tr>
            <th class="text-left p-2">Nama Peminjam</th>
            <th class="text-left p-2">Tanggal Pinjam</th>
            <th class="text-left p-2">Jatuh Tempo</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($borrowers as $item)
            <tr>
                <td class="p-2">{{ $item->member->name }}</td>
                <td class="p-2">{{ \Illuminate\Support\Carbon::parse($item->loan_date)->translatedFormat('d M Y') }}</td>
                <td class="p-2">{{ \Illuminate\Support\Carbon::parse($item->due_date)->translatedFormat('d M Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="p-2 italic text-gray-500">Tidak ada peminjam aktif.</td>
            </tr>
        @endforelse
    </tbody>
</table>
