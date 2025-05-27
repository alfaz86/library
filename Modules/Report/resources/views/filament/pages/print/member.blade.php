<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ __('member.report_print.title') }}</title>
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
    <h1>{{ __('member.report_print.header') }}</h1>
    <p>{{ __('member.report_print.print_at', ['date' => now()->translatedFormat('d F Y')]) }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>{{ __('member.report_print.columns.name') }}</th>
                <th>{{ __('member.report_print.columns.member_code') }}</th>
                <th>{{ __('member.report_print.columns.phone') }}</th>
                <th>{{ __('member.report_print.columns.email') }}</th>
                <th>{{ __('member.report_print.columns.address') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $i => $member)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->member_code }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
