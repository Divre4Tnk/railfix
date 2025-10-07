@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="pc-content">
        {{-- <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card rounded-3" style="height: 100px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h6 class="mb-1 f-w-400 text-muted">Total Barang Masuk</h6>
                        <h4 class="mb-0 text-dark">
                            {{ !empty($totalBarangMasuk) ? number_format($totalBarangMasuk, 0, ',', '.') . ' Unit' : '-' }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card rounded-3" style="height: 100px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h6 class="mb-1 f-w-400 text-muted">Total Barang Keluar</h6>
                        <h4 class="mb-0 text-dark">
                            {{ !empty($totalBarangKeluar) ? number_format($totalBarangKeluar, 0, ',', '.') . ' Unit' : '-' }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card rounded-3" style="height: 100px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h6 class="mb-1 f-w-400 text-muted">Barang Masuk Hari Ini</h6>
                        <h4 class="mb-0 text-dark">
                            {{ !empty($barangMasukHariIni) ? number_format($barangMasukHariIni, 0, ',', '.') . ' Unit' : '-' }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card rounded-3" style="height: 100px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h6 class="mb-1 f-w-400 text-muted">Barang Keluar Hari Ini</h6>
                        <h4 class="mb-0 text-dark">
                            {{ !empty($barangKeluarHariIni) ? number_format($barangKeluarHariIni, 0, ',', '.') . ' Unit' : '-' }}
                        </h4>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="col-12 row-md-8 row-lg-4 order-3 order-md-2">
            <div class="row">
                <!-- Total Barang Masuk -->
                <div class="col-12 col-sm-6 col-lg-3 mb-1">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center bg-primary text-white me-3"
                                style="width: 60px; height: 60px; border-radius: 15%">
                                <i class="ti ti-download" style="font-size: 32px;"></i>
                            </div>
                            <div>
                                <small class="text-muted">Total Barang Masuk</small>
                                <h3 class="fw-bold mb-0">
                                    {{ !empty($totalBarangMasuk) ? number_format($totalBarangMasuk, 0, ',', '.') . ' Unit' : '-' }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Barang Keluar -->
                <div class="col-12 col-sm-6 col-lg-3 mb-1">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center bg-danger text-white me-3"
                                style="width: 60px; height: 60px; border-radius: 15%">
                                <i class="ti ti-upload" style="font-size: 32px;"></i>
                            </div>
                            <div>
                                <small class="text-muted">Total Barang Keluar</small>
                                <h3 class="fw-bold mb-0">
                                    {{ !empty($totalBarangKeluar) ? number_format($totalBarangKeluar, 0, ',', '.') . ' Unit' : '-' }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barang Masuk Hari Ini -->
                <div class="col-12 col-sm-6 col-lg-3 mb-1">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center bg-success text-white me-3"
                                style="width: 60px; height: 60px; border-radius: 15%">
                                <i class="ti ti-calendar-plus" style="font-size: 32px;"></i>
                            </div>
                            <div>
                                <small class="text-muted">Barang Masuk Hari Ini</small>
                                <h3 class="fw-bold mb-0">
                                    {{ !empty($barangMasukHariIni) ? number_format($barangMasukHariIni, 0, ',', '.') . ' Unit' : '-' }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barang Keluar Hari Ini -->
                <div class="col-12 col-sm-6 col-lg-3 mb-1">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center bg-warning text-white me-3"
                                style="width: 60px; height: 60px; border-radius: 15%">
                                <i class="ti ti-calendar-minus" style="font-size: 32px;"></i>
                            </div>
                            <div>
                                <small class="text-muted">Barang Keluar Hari Ini</small>
                                <h3 class="fw-bold mb-0">
                                    {{ !empty($barangKeluarHariIni) ? number_format($barangKeluarHariIni, 0, ',', '.') . ' Unit' : '-' }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0">Laporan Grafik Bulan Ini</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="chart-tab-tabContent">
                        <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                            aria-labelledby="chart-tab-profile-tab" tabindex="0">
                            <div id="visitor-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-12">
                <h4 class="mb-3">Barang Masuk Hari ini</h4>
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Kode Unik</th>
                                        <th>Nama Barang</th>
                                        <th>Barang dari</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($detailBarangMasukHariIni as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->location->name }}</td>
                                            <td>{{ $item->date_in->format('d-m-Y') }}</td>
                                            <td>{{ $item->date_out ? $item->date_out->format('d-m-Y') : '-' }}</td>
                                            <td>
                                                @php
                                                    $status = [
                                                        'received' => ['text' => 'Received', 'color' => 'secondary'],
                                                        'on_progress' => [
                                                            'text' => 'On Progress',
                                                            'color' => 'warning',
                                                        ],
                                                        'done' => ['text' => 'Done', 'color' => 'success'],
                                                        'returned' => ['text' => 'Returned', 'color' => 'info'],
                                                        'broken' => ['text' => 'Broken', 'color' => 'danger'],
                                                    ][$item->status];
                                                @endphp
                                                <span class="badge bg-{{ $status['color'] }}">{{ $status['text'] }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const labels = {!! json_encode(array_keys($dataPerTanggal)) !!};
        var options = {
            chart: {
                height: 450,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#1890ff', '#13c2c2'],
            series: [{
                name: 'Barang Masuk',
                data: {!! json_encode(array_column($dataPerTanggal, 'masuk')) !!}
            }, {
                name: 'Barang Keluar',
                data: {!! json_encode(array_column($dataPerTanggal, 'keluar')) !!}
            }],
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                categories: labels,
            }
        };
        var chart = new ApexCharts(document.querySelector('#visitor-chart'), options);
        chart.render();
    </script>
@endpush
