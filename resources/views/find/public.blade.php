<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status</title>

    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/style-status.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg bg-white py-1 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="img-fluid"
                    style="max-height: 60px;">
            </a>
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary rounded-pill">
                            <i class="ti ti-layout-dashboard me-1"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill">
                            <i class="ti ti-login me-1"></i> Login
                        </a>
                    @endauth
                </div>
            @endif

        </div>
    </nav>

    <section id="heroCarousel" class="hero carousel slide position-relative" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/1.png') }}" width="100%" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block text-center">
                    <h1 class="fw-bold mb-1 text-white">
                        Lacak Status <span class="text-primary-light">Perbaikan</span>
                    </h1>
                    <p class="lead fs-6">
                        Pantau perbaikan Perangkat Anda dengan <span class="fw-semibold">mudah</span> dan
                        <span class="fw-semibold">cepat</span>
                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/2.png') }}" width="100%" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block text-center">
                    <h1 class="fw-bold mb-1 text-white">Setiap <span class="text-primary-light">Permasalahan</span>
                        Pasti Ada <span class="text-primary-light">Solusi</span></h1>
                    <p class="lead fs-6">IT hadir untuk memberikan solusi terbaik bagi perangkat Anda.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="search-box">
                    <h4 class="text-primary fw-bold text-center mb-2">
                        <i class="ti ti-search me-2"></i> Lacak Sekarang
                    </h4>
                    <p class="text-muted text-center mb-4">Masukkan kode unik barang untuk melihat status</p>

                    <form id="searchForm" method="GET" action="">
                        <div class="input-group mb-5">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="ti ti-list text-primary"></i>
                            </span>
                            <select name="tipe" class="form-select" style="max-width: 230px">
                                <option value="kode" {{ request('tipe') == 'kode' ? 'selected' : '' }}>Kode Unik</option>
                                <option value="sn" {{ request('tipe') == 'sn' ? 'selected' : '' }}>Serial Number (SN)</option>
                                <option value="inventaris" {{ request('tipe') == 'inventaris' ? 'selected' : '' }}>Nomor Inventaris</option>
                            </select>
                            <input type="text" name="q" value="{{ request('q') }}"
                                class="form-control border-start-0" placeholder="Ex: WS12345">
                            <button id="searchBtn" class="btn btn-primary" type="submit">
                                <i class="ti ti-search me-1"></i> Cari
                            </button>
                            @if (request('q'))
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-refresh me-1"></i> Reset
                                </a>
                            @endif
                        </div>
                    </form>

                    <div id="loadingSpinner" class="text-center my-4 d-none">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Sedang memproses...</p>
                    </div>

                    <div id="resultBox">
                        @if (!empty($result))
                            <div class="progress-tracker-wrapper">
                                <div class="progress-tracker">
                                    <div class="progress-bar"
                                        style="width: 
                                      @if ($result->status == 'received') 12%
                                      @elseif($result->status == 'on_progress') 38%
                                      @elseif($result->status == 'done') 63%
                                      @elseif($result->status == 'returned') 100%
                                      @elseif($result->status == 'broken') 100% @endif">
                                    </div>

                                    <div
                                        class="progress-step @if (in_array($result->status, ['received', 'on_progress', 'done', 'returned', 'broken'])) completed @endif @if ($result->status == 'received') active @endif">
                                        <div class="step-icon">
                                            <i class="ti ti-download fs-6"></i>
                                        </div>
                                        <div class="step-label">Diterima</div>
                                        @if ($result->date_in)
                                            <span class="step-date">{{ $result->date_in->format('d M Y') }}</span>
                                        @endif
                                    </div>

                                    <div
                                        class="progress-step @if (in_array($result->status, ['on_progress', 'done', 'returned', 'broken'])) completed @endif @if ($result->status == 'on_progress') active @endif">
                                        <div class="step-icon">
                                            <i class="ti ti-refresh fs-6"></i>
                                        </div>
                                        <div class="step-label">Proses</div>
                                    </div>

                                    <div
                                        class="progress-step @if (in_array($result->status, ['done', 'returned', 'broken'])) completed @endif @if ($result->status == 'done') active @endif">
                                        <div class="step-icon">
                                            <i class="ti ti-check fs-6"></i>
                                        </div>
                                        <div class="step-label">Selesai</div>
                                        {{-- @if ($result->date_out)
                                        <span class="step-date">{{ $result->date_out->format('d M Y') }}</span>
                                    @endif --}}
                                    </div>

                                    <div
                                        class="progress-step 
                                        @if ($result->status == 'returned') active returned @endif 
                                        @if ($result->status == 'broken') active broken @endif">
                                        <div class="step-icon">
                                            @if ($result->status == 'returned')
                                                <i class="ti ti-arrow-back-up fs-6"></i>
                                            @elseif($result->status == 'broken')
                                                <i class="ti ti-alert-triangle fs-6"></i>
                                            @else
                                                <i class="ti ti-package fs-6"></i>
                                            @endif
                                        </div>

                                        <div class="step-label">
                                            @if ($result->status == 'returned')
                                                Dikembalikan
                                            @elseif($result->status == 'broken')
                                                Rusak
                                            @else
                                                Status Akhir
                                            @endif
                                        </div>
                                        @if (($result->status == 'returned' || $result->status == 'broken') && $result->date_out)
                                            <span class="step-date">{{ $result->date_out->format('d M Y') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="status-info">
                                    @if ($result->status == 'received')
                                        <span class="current-status status-received fw-bold">
                                            <i class="ti ti-clock me-1"></i> Barang sudah diterima oleh tim IT dan
                                            sedang
                                            menunggu giliran untuk diperiksa dan diperbaiki.
                                        </span>
                                    @elseif($result->status == 'on_progress')
                                        <span class="current-status status-progress fw-bold">
                                            <i class="ti ti-settings me-1"></i> Barang sedang dikerjakan oleh tim
                                            teknis.
                                            Proses perbaikan dan pengecekan kondisi sedang berlangsung.
                                        </span>
                                    @elseif($result->status == 'done')
                                        <span class="current-status status-done fw-bold">
                                            <i class="ti ti-check me-1"></i> Selesai pengecekan, menunggu konfirmasi status akhir.
                                        </span>
                                    @elseif($result->status == 'returned')
                                        <span class="current-status status-returned fw-bold">
                                            <i class="ti ti-arrow-back-up me-1"></i> Barang telah selesai diperbaiki dan sudah dikembalikan kepada pemilik.
                                        </span>
                                    @elseif($result->status == 'broken')
                                        <span class="current-status status-broken fw-bold">
                                            <i class="ti ti-alert-triangle me-1"></i> Barang tidak dapat diperbaiki. Hubungi tim IT untuk tindak lanjut terkait penggantian
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="row rounded overflow-hidden ">
                                <div class="col-md-6 detail-item">
                                    <div class="detail-label">Nama Barang</div>
                                    <div class="detail-value">{{ $result->name }}</div>
                                </div>
                                <div class="col-md-6 detail-item">
                                    <div class="detail-label">Serial Number (SN)</div>
                                    <div class="detail-value">{{ $result->serial_number }}</div>
                                </div>
                                <div class="col-md-6 detail-item">
                                    <div class="detail-label">Inventori Number</div>
                                    <div class="detail-value">{{ $result->inventory_number }}</div>
                                </div>
                                <div class="col-md-6 detail-item">
                                    <div class="detail-label">Lokasi</div>
                                    <div class="detail-value">{{ $result->location?->name ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 detail-item">
                                    <div class="detail-label">PIC</div>
                                    <div class="detail-value">{{ $result->pic ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 detail-item">
                                    <div class="detail-label">Tanggal Masuk</div>
                                    <div class="detail-value">{{ $result->date_in?->format('d-m-Y') ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 detail-item">
                                    <div class="detail-label">Tanggal Keluar</div>
                                    <div class="detail-value">{{ $result->date_out?->format('d-m-Y') ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 detail-item">
                                    <div class="detail-label">Telepon</div>
                                    <div class="detail-value">{{ $result->phone ?? '-' }}</div>
                                </div>
                                <div class="col-12 detail-item">
                                    <div class="detail-label">Keterangan</div>
                                    <div class="detail-value">{{ $result->description ?? 'Tidak ada keterangan' }}
                                    </div>
                                </div>
                            </div>
                        @elseif(request('q'))
                            <div class="not-found mt-4">
                                <i class="ti ti-mood-sad"></i>
                                <h5 class="fw-bold text-dark">Pencarian tidak ditemukan</h5>
                                <p class="text-muted">Pastikan kode yang dimasukkan sudah benar</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-4 mt-auto">
        <div class="container">
            <p class="m-0 d-inline-flex align-items-center">
                <img src="{{ asset('assets/images/logo-kai.png') }}" width="35" alt="Logo">
                <span class="ms-2">| IT Divre IV Tanjungkarang.</span>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/status.js') }}"></script>

</body>

</html>
