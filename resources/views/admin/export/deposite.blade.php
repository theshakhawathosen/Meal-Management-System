<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimal Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #a3a3a3;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }
        tr
        {

            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #f9fafb;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f5f9;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center">Total Deposite</h2>
    <table>
        <thead>
            <tr>
                <th class="text-left">ID</th>
                <th class="text-left">Member</th>
                <th class="text-center">Amount</th>
                <th class="text-right">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deposits as $deposit)
                <tr>
                    @php
                        $url = $deposit->user->photo;
                        $filename = basename($url);
                    @endphp
                    <td>{{ $loop->iteration }}</td>
                    <td style="display:flex;align-items:center"><img src="{{ public_path("upload/user/$filename") }}"
                            style="height: 35px;width:35px;border-radius:50%;margin-right:10px">
                        {{ $deposit->user->name }}
                        </td>
                    <td class="text-center">{{ $deposit->amount }}</td>
                    <td class="text-right">
                        {{ $deposit->date }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
