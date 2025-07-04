<table>
    <tr><th colspan="11">LAPORAN INVENTORY</th></tr>
    <tr><th colspan="11">WORKSHOP IT SUPPORT</th></tr>
    <tr><th colspan="11">PT. Kereta Api Indonesia (Persero) Divre IV Tanjungkarang, Lampung</th></tr>
</table>
@if ($start && $end)
    <table>
        <tr>
            <td>Dari tanggal</td>
            <td>: {{ $start->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Sampai tanggal</td>
            <td>: {{ $end->format('d-m-Y') }}</td>
        </tr>
    </table>
@endif
<table>
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $inventory->code }}</td>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->serial_number }}</td>
                <td>{{ $inventory->location->name }}</td>
                <td>{{ $inventory->pic }}</td>
                <td>{{ $inventory->phone }}</td>
                <td>{{ $inventory->date_in->format('d-m-Y') }}</td>
                <td>{{ $inventory->date_out ? $inventory->date_out->format('d-m-Y') : '-' }}</td>
                <td>{{ $inventory->description }}</td>
                <td>
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