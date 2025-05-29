<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ __('loan.report_print.title') }}</title>
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
    <h1>{{ __('loan.report_print.header') }}</h1>
    <p>{{ __('loan.report_print.print_at', ['date' => now()->translatedFormat('d F Y')]) }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>{{ __('loan.report_print.columns.member') }}</th>
                <th>{{ __('loan.report_print.columns.loan_date') }}</th>
                <th>{{ __('loan.report_print.columns.due_date') }}</th>
                <th>{{ __('loan.report_print.columns.status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $i => $loan)
                <tr>
                    <td rowspan="2">{{ $i + 1 }}</td>
                    <td>
                        {{ $loan->member->name }}<br>
                        <small>{{ $loan->member->member_code }}</small>
                    </td>
                    <td>{{ $loan->loan_date }}</td>
                    <td>{{ $loan->due_date }}</td>
                    <td>{{ __('loan.status.' . $loan->status) }}</td>
                </tr>
                @forelse ($loan->loan_returns as $item)
                    <tr>
                        <td colspan="4">
                            <strong>{{ __('loan.report_print.columns.loan_return.return_date') }}:</strong> {{ $item->returned_date }}<br>
                            <strong>{{ __('loan.report_print.columns.loan_return.fine') }}:</strong> {{ formatCurrency($item->fine_amount, 'IDR', 'id_ID') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">{{ __('loan.report_print.columns.loan_return.no_return') }}</td>
                    </tr>
                @endforelse
            @endforeach
        </tbody>
    </table>
</body>
</html>
