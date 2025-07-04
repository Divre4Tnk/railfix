@extends('layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="pc-content">
        <div class="page-header m-0">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><span>Data Admin</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-12">
                <h4 class="mb-3">Data Admin</h4>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {!! session('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header ">
                        <form action="{{ route('admin.index') }}" method="get">
                            <div class="row align-items-center">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Cari" aria-label="Nama"
                                            aria-describedby="button-addon2" name="search" autocomplete="off"
                                            value="{{ request('search') }}">
                                        <button class="btn btn-outline-primary" type="submit"
                                            id="button-addon2">Search</button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <a href="{{ route('admin.create') }}"
                                        class="btn btn-primary float-start float-md-end">Tambah</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Tanggal Diperbarui</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $index => $user)
                                        <tr>
                                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                                            <td>{{ $user->updated_at->format('d M Y, H:i') }}</td>

                                            <td class="text-end">
                                                <a href="{{ route('admin.edit', $user->id) }}"
                                                    class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST"
                                                    style="display:inline-block;" title="Hapus">
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
                                            <td colspan="8" class="text-center">Tidak ada data admin.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $users->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
