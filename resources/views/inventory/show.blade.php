@extends('layouts.app')

@section('title', 'Detail Inventory')

@section('content')
    <div class="pc-content">
        <!-- Header -->
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('inventories.index') }}">Data Inventory</a></li>
                            <li class="breadcrumb-item"><span>Detail</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card mb-4 pt-2">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0">CODE # <b>{{ $inventory->code }}</b></h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted">Status: </span>
                    @php
                        $statusConfig = [
                            'received' => ['text' => 'Masuk', 'color' => 'secondary'],
                            'on_progress' => ['text' => 'Dalam Progres', 'color' => 'warning'],
                            'done' => ['text' => 'Selesai', 'color' => 'success'],
                            'returned' => ['text' => 'Dikembalikan', 'color' => 'info'],
                            'broken' => ['text' => 'Rusak', 'color' => 'danger'],
                        ][$inventory->status];
                    @endphp
                    <span class="badge rounded-pill bg-{{ $statusConfig['color'] }} px-3 py-2">
                        {{ $statusConfig['text'] }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Left Column - Inventory Details -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h6 class="d-flex align-items-center mb-3">
                            <i class="bx bx-info-circle text-primary me-2"></i>
                            Detail Barang :
                        </h6>
                        <div class="border rounded p-3">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Nama Barang</small>
                                    <h6 class="mb-0">{{ $inventory->name }}</h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Nomor Inventaris</small>
                                    <h6 class="mb-0">{{ $inventory->inventory_number }}</h6>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Serial Number</small>
                                    <h6 class="mb-0">{{ $inventory->serial_number }}</h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Lokasi</small>
                                    <h6 class="mb-0">{{ $inventory->location->name }}</h6>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Tanggal Masuk</small>
                                    <h6 class="mb-0">{{ \Carbon\Carbon::parse($inventory->date_in)->format('d M Y') }}
                                    </h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Tanggal Keluar</small>
                                    <h6 class="mb-0">
                                        @if ($inventory->date_out)
                                            {{ \Carbon\Carbon::parse($inventory->date_out)->format('d M Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </h6>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Penanggung Jawab (PIC)</small>
                                    <h6 class="mb-0">{{ $inventory->pic ?? '-' }}</h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Nomor Telepon</small>
                                    <h6 class="mb-0">{{ $inventory->phone ?? '-' }}</h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted d-block">Dibuat</small>
                                    <h6 class="mb-0">
                                        {{ $inventory->created_at->timezone('Asia/Jakarta')->format('d/m/Y, H:i') }} WIB
                                    </h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Diperbarui</small>
                                    <h6 class="mb-0">
                                        {{ $inventory->updated_at->timezone('Asia/Jakarta')->format('d/m/Y, H:i') }} WIB
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Status & Description -->
                    <div class="col-md-6">
                        <h6 class="d-flex align-items-center mb-3">
                            <i class="bx bx-info-circle text-primary me-2"></i>
                            Keterangan :
                        </h6>

                        <div class="border rounded p-3 bg-light">
                            @if ($inventory->description)
                                {{ $inventory->description }}
                            @else
                                <span class="text-muted">Tidak ada keterangan</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('inventories.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-chevron-left me-1"></i> Kembali
            </a>
            <a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-primary">
                <i class="bx bx-edit me-1"></i> Edit
            </a>
        </div>
    </div>
@endsection
