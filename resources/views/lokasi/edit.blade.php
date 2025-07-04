@extends('layouts.app')

@section('title', 'Edit Data')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('location.index') }}">Data Lokasi</a></li>
                            <li class="breadcrumb-item"><span>Edit Data</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 align-items-center pt-2">
            <div class="col-md-4">
                <h4 class="mb-3 mb-md-0">Edit Data</h4>
            </div>
            <div class="col-md-8">
                <div class="float-start float-md-end">
                    <a href="{{ route('location.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
                    <button type="submit" form="form-tambah" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('location.update', $location->id) }}" method="post" id="form-tambah">
                    @csrf
                    @method('put')
                    <div>
                        <label class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Ex: Stasiun Rejosari" aria-label="Nama" aria-describedby="button-addon2"
                            name="name" value="{{ $location->name }}">
                        @error('name')
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
