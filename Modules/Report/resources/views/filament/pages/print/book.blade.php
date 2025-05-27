<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ __('book.report_print.title') }}</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #333;
            text-align: left;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 4px;
                font-size: 12px;
            }
        }
    </style>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</head>
<body>
    <h1>{{ __('book.report_print.header') }}</h1>
    <p>{{ __('book.report_print.print_at', ['date' => now()->translatedFormat('d F Y')]) }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>{{ __('book.report_print.columns.book') }}</th>
                <th>{{ __('book.report_print.columns.detail') }}</th>
                <th>{{ __('book.report_print.columns.shelf_location') }}</th>
                <th>{{ __('book.report_print.columns.stock') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $i => $book)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        {{ $book->title }}<br>
                        <strong>{{ __('book.report_print.columns.author') }}:</strong> {{ $book->author }}
                    </td>
                    <td>
                        <strong>{{ __('book.report_print.columns.isbn') }}:</strong> {{ $book->isbn }}<br>
                        <strong>{{ __('book.report_print.columns.publisher') }}:</strong> {{ $book->publisher }}<br>
                        <strong>{{ __('book.report_print.columns.published_year') }}:</strong> {{ $book->published_year }}<br>
                        <strong>{{ __('book.report_print.columns.category') }}:</strong> {{ $book->category }}<br>
                        <strong>{{ __('book.report_print.columns.language') }}:</strong> {{ $book->language }}<br>
                        <strong>{{ __('book.report_print.columns.pages') }}:</strong> {{ $book->pages }}
                    </td>
                    <td>{{ $book->shelf_location }}</td>
                    <td>{{ $book->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
