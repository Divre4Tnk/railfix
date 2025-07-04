@extends('layouts.app')

@section('title', 'Data Inventory')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><span>Data Inventory</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-12">
                <h4 class="mb-3">Data Inventory</h4>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {!! session('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header ">
                        <form action="" method="get">
                            <div class="row align-items-center">
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Cari" name="search" value="{{ $search }}">
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <div class="input-group">
                                        <select name="location_id" class="form-control">
                                            <option value="">Semua Lokasi</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}" {{ $location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="input-group">
                                        <input type="text" placeholder="Dari" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" name="start_date" value="{{ $start }}">
                                        <input type="text" placeholder="Sampai" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" name="end_date" value="{{ $end }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="btn-group float-start float-md-end" role="group" aria-label="Basic example">
                                        <button class="btn btn-outline-primary" type="submit" data-bs-toggle="tooltip" data-bs-title="Cari Data">
                                            <i class="ti ti-search"></i>
                                        </button>
                                        <div class="btn-group" role="group" data-bs-toggle="tooltip" data-bs-title="Export Data">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-outline-primary">
                                                <i class="ti ti-table-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item text-danger" href="{{ route('inventories.print', ['start_date' => $start, 'end_date' => $end]) }}">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" /><path d="M17 18h2" /><path d="M20 15h-3v6" /><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" /></svg>
                                                    Print PDF
                                                </a></li>
                                                <li><a class="dropdown-item text-success" href="{{ route('inventories.export', ['start_date' => $start, 'end_date' => $end]) }}">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-xls"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M4 15l4 6" /><path d="M4 21l4 -6" /><path d="M17 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" /><path d="M11 15v6h3" /></svg>
                                                    Export Excel
                                                </a></li>
                                            </ul>
                                        </div>
                                        <a href="{{ route('inventories.create') }}" class="btn btn-primary">Tambah</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($inventories as $inventory)
                                        <tr>
                                            <td class="text-center">{{ ($inventories->currentPage() - 1) * $inventories->perPage() + $loop->iteration }}</td>
                                            <td>{{ $inventory->code }}</td>
                                            <td>{{ $inventory->name }}</td>
                                            <td>{{ $inventory->location->name }}</td>
                                            <td>{{ $inventory->date_in->format('d-m-Y') }}</td>
                                            <td>{{ $inventory->date_out ? $inventory->date_out->format('d-m-Y') : '-' }}</td>
                                            <td>
                                                @php
                                                    $status = [
                                                        'received' => ['text' => 'Masuk', 'color' => 'secondary'],
                                                        'on_progress' => ['text' => 'Dalam Progres', 'color' => 'warning'],
                                                        'done' => ['text' => 'Selesai', 'color' => 'success'],
                                                        'returned' => ['text' => 'Dikembalikan', 'color' => 'info'],
                                                        'broken' => ['text' => 'Rusak', 'color' => 'danger']
                                                    ][$inventory->status];
                                                @endphp
                                                <span class="badge bg-{{ $status['color'] }}">{{ $status['text'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">{{ $inventories->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
