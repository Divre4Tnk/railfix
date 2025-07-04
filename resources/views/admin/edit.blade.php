@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Data Admin</a></li>
                            <li class="breadcrumb-item"><span>Edit Admin</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3 align-items-center pt-2">
            <div class="col-md-4">
                <h4 class="mb-3 mb-md-0">Edit Admin</h4>
            </div>
            <div class="col-md-8">
                <div class="float-start float-md-end">
                    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
                    <button type="submit" form="form-edit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.update', $user->id) }}" method="POST" id="form-edit">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name', $user->name) }}" placeholder="Ex: John Doe">
                        @error('name')
                            <small class="text-danger mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                            value="{{ old('username', $user->username) }}" placeholder="Ex: johndoe123">
                        @error('username')
                            <small class="text-danger mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak ingin
                                mengubah)</small></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="********">
                        @error('password')
                            <small class="text-danger mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
