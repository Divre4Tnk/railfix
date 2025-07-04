<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mantis - Print Inventory</title>
    <style>
        .text-center {
            text-align: center;
        }
        .table {
            width: 100%
        }
        h2, h4, p {
            margin-bottom: .5rem !important;
            margin-top: 0 !important;
        }
    </style>
</head>
<body>
    <center style="margin-bottom: 2rem">
        <h2>LAPORAN INVENTORY</h2>
        <h2>WORKSHOP IT SUPPORT</h2>
        <p>PT. Kereta Api Indonesia (Persero) Divre IV Tanjungkarang, Lampung</p>
        <hr style="margin-top: 1rem; border-width: 1px; border-style: solid">
    </center>
    @if ($start && $end)
        <table style="margin-bottom: 1rem">
            <tr>
                <td>Dari tanggal</td>
                <td>: {{ $start }}</td>
            </tr>
            <tr>
                <td>Sampai tanggal</td>
                <td>: {{ $end }}</td>
            </tr>
        </table>
    @endif
    <table class="table" border="1" cellspacing="0">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Unik</th>
                <th>Nama Barang</th>
                <th class="text-center">Serial Number</th>
                <th>Barang dari</th>
                <th class="text-center">PIC</th>
                <th class="text-center">Nomor Telepon</th>
                <th class="text-center">Masuk</th>
                <th class="text-center">Keluar</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $inventory->code }}</td>
                    <td>{{ $inventory->name }}</td>
                    <td class="text-center">{{ $inventory->serial_number }}</td>
                    <td>{{ $inventory->location->name }}</td>
                    <td class="text-center">{{ $inventory->pic }}</td>
                    <td class="text-center">{{ $inventory->phone }}</td>
                    <td class="text-center">{{ $inventory->date_in->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $inventory->date_out ? $inventory->date_out->format('d-m-Y') : '-' }}</td>
                    <td>{{ $inventory->description }}</td>
                    <td class="text-center">
                        @php
                            $status = [
                                'received' => ['text' => 'Masuk'],
                                'on_progress' => ['text' => 'Dalam Progres'],
                                'done' => ['text' => 'Selesai',],
                                'returned' => ['text' => 'Dikembalikan'],
                                'broken' => ['text' => 'Rusak']
                            ][$inventory->status];
                        @endphp
                        {{ $status['text'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.print();
        window.onafterprint = function(event) {
            window.history.back();
        };
    </script>
</body>
</html>