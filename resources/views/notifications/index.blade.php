@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><span>Notifikasi</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-12">
                <h4 class="mb-3">Notifikasi</h4>
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Judul</th>
                                        <th>Masuk</th>
                                        <th>Status barang</th>
                                        <th>Dibaca</th>
                                        <th>Dibuat pada</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($notifications as $notification)
                                        <tr>
                                            <td class="text-center">{{ ($notifications->currentPage() - 1) * $notifications->perPage() + $loop->iteration }}</td>
                                            <td>
                                                <h5 class="mb-1">{{ $notification->title }}</h5>
                                                <p class="mb-0">{{ $notification->inventory->name }} | {{ $notification->inventory->location->name }}</p>
                                            </td>
                                            <td>{{ $notification->inventory->date_in->format('d-m-Y') }}</td>
                                            <td>
                                                @php
                                                    $status = [
                                                        'received' => ['text' => 'Masuk', 'color' => 'secondary'],
                                                        'on_progress' => ['text' => 'Dalam Progres', 'color' => 'warning'],
                                                        'done' => ['text' => 'Selesai', 'color' => 'success'],
                                                        'returned' => ['text' => 'Dikembalikan', 'color' => 'info'],
                                                        'broken' => ['text' => 'Rusak', 'color' => 'danger']
                                                    ][$notification->type];
                                                @endphp
                                                <span class="badge bg-{{ $status['color'] }}">{{ $status['text'] }}</span>
                                            </td>
                                            <td>
                                                @if ($notification->is_read)
                                                    <span class="badge bg-success">Dibaca</span>
                                                @else
                                                    <span class="badge bg-danger">Belum dibaca</span>
                                                @endif
                                            </td>
                                            <td>{{ $notification->created_at->format('d M Y, H:i') }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('notifications.update', $notification->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                </form>
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
                        <div class="mt-3">{{ $notifications->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
