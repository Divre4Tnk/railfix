@extends('layouts.app')

@section('title', 'Find it')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><span>Find it</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col-md-12">
                <h4 class="mb-3">Find it</h4>
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <form action="" method="GET">
                            <div class="input-group" style="max-width: 400px;">
                                <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="Kode Unik Barang">
                                <button class="btn btn-outline-primary" type="submit"><i class="ti ti-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        @if (!empty($result))
                            <h3 class="mb-4 text-center">#{{ $result->code }}</h3>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="mb-3 card-title">Detail Barang</h5>
                                            <table class="text-nowrap w-100">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-start py-1">Nama Barang</td>
                                                        <td class="text-end py-1">{{ $result->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start py-1">Serial Number</td>
                                                        <td class="text-end py-1">{{ $result->serial_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start py-1">Barang dari</td>
                                                        <td class="text-end py-1">{{ $result->location->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start py-1">Tanggal Masuk</td>
                                                        <td class="text-end py-1">{{ $result->date_in->format('d-m-Y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start py-1">Tanggal Keluar</td>
                                                        <td class="text-end py-1">{{ $result->date_out ? $result->date_out->format('d-m-Y') : '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start py-1">Penanggung Jawab</td>
                                                        <td class="text-end py-1">{{ $result->pic ? $result->pic : '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start py-1">Nomor Telepon</td>
                                                        <td class="text-end py-1">{{ $result->phone ? $result->phone : '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start pt-1">Status</td>
                                                        <td class="text-end pt-1">
                                                            @php
                                                                $status = [
                                                                    'received' => ['text' => 'Masuk', 'color' => 'secondary'],
                                                                    'on_progress' => ['text' => 'Dalam Progres', 'color' => 'warning'],
                                                                    'done' => ['text' => 'Selesai', 'color' => 'success'],
                                                                    'returned' => ['text' => 'Dikembalikan', 'color' => 'info'],
                                                                    'broken' => ['text' => 'Rusak', 'color' => 'danger']
                                                                ][$result->status];
                                                            @endphp
                                                            <span class="badge bg-{{ $status['color'] }}">{{ $status['text'] }}</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <a href="{{ route('inventories.edit', $result->id) }}" class="btn w-100 btn-primary">Edit</a>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mb-3 card-title">Keterangan</h5>
                                            <p class="mb-0">{{ $result->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-center mb-0">Barang tidak ditemukan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
