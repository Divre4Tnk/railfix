@extends('layouts.app')

@section('title', 'Tambah Data')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('inventories.index') }}">Data Inventory</a></li>
                            <li class="breadcrumb-item"><span>Tambah Data</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 align-items-center pt-2">
            <div class="col-md-4">
                <h4 class="mb-3 mb-md-0">Tambah Data</h4>
            </div>
            <div class="col-md-8">
                <div class="float-start float-md-end">
                    <a href="{{ route('inventories.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
                    <button type="submit" form="form-tambah" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('inventories.store') }}" method="post" id="form-tambah">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Nama Barang<span class="text-danger">*</span></label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                placeholder="Ex: Printer Epson L3210" name="name" value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger mt-1" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Serial Number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control  @error('serial_number') is-invalid @enderror"
                                placeholder="Ex: 12345678" name="serial_number" value="{{ old('serial_number') }}">
                            @error('serial_number')
                                <small class="text-danger mt-1" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Nomor Inventaris<span class="text-danger"></span></label>
                            <input type="text" class="form-control  @error('inventory_number') is-invalid @enderror"
                                placeholder="Ex: 12345678" name="inventory_number" value="{{ old('inventory_number') }}">
                            @error('inventory_number')
                                <small class="text-danger mt-1" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Barang dari<span class="text-danger">*</span></label>
                            <select name="location_id" 
                                    class="form-select select2 @error('location_id') is-invalid @enderror">
                                <option value="" selected disabled>Pilih Lokasi</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" @selected(old('location_id') == $location->id)>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <small class="text-danger mt-1" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Tanggal Masuk<span class="text-danger">*</span></label>
                            <input type="date" class="form-control  @error('date_in') is-invalid @enderror"
                                name="date_in" value="{{ old('date_in') }}">
                            @error('date_in')
                                <small class="text-danger mt-1" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Tanggal Keluar</label>
                            <input type="date" class="form-control  @error('date_out') is-invalid @enderror"
                                name="date_out" value="{{ old('date_out') }}">
                            @error('date_out')
                                <small class="text-danger mt-1" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Penanggung Jawab (PIC)</label>
                            <input type="text" class="form-control  @error('pic') is-invalid @enderror"
                                placeholder="Ex: Mas Bowo" name="pic" value="{{ old('pic') }}">
                            @error('pic')
                                <small class="text-danger mt-1" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control  @error('phone') is-invalid @enderror"
                                placeholder="Ex: 08123456789" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <small class="text-danger mt-1" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="status" class="form-control  @error('status') is-invalid @enderror">
                                <option value="" selected="" disabled>Pilih Status</option>
                                @php
                                    $status = [
                                        ['value' => 'received', 'text' => 'Masuk'],
                                        ['value' => 'on_progress', 'text' => 'Dalam Progres'],
                                        ['value' => 'done', 'text' => 'Selesai'],
                                        ['value' => 'returned', 'text' => 'Dikembalikan'],
                                        ['value' => 'broken', 'text' => 'Rusak'],
                                    ];
                                @endphp
                                @foreach ($status as $item)
                                    <option value="{{ $item['value'] }}" @selected(old('status') == $item['value'])>
                                        {{ $item['text'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <small class="text-danger mt-1" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control  @error('description') is-invalid @enderror" placeholder="Masukkan Keterangan"
                            name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger mt-1" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                placeholder: "Pilih Lokasi",
                allowClear: true,
                width: '100%'
            });
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-container--open .select2-search__field').focus();
        });
    </script>
@endpush

