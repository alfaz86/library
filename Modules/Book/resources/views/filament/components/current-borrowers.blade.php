<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">{{ __('book.table.current_borrowers.borrower') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('book.table.current_borrowers.borrowed_at') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('book.table.current_borrowers.due_date') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrowers as $item)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('filament.admin.resources.loans.edit', $item->id) }}" style="text-decoration: none;"
                            onmouseover="this.style.textDecoration='underline';"
                            onmouseout="this.style.textDecoration='none';">{{ $item->member->name }}</a>
                    </td>
                    <td class="px-6 py-4">
                        {{ \Illuminate\Support\Carbon::parse($item->loan_date)->translatedFormat('d M Y') }}</td>
                    <td class="px-6 py-4">
                        {{ \Illuminate\Support\Carbon::parse($item->due_date)->translatedFormat('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-2 italic text-gray-500 text-center">{{ __('book.table.current_borrowers.empty') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>