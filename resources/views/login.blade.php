<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - Railfix</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Aplikasi Website Pencatatan Inventory Perbaikan IT PT. KAI Divre 4 Tanjungkarang">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <!-- Plugin CSS -->
    <link href="{{ asset('assets/css/plugins/animate.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
</head>

<body class="landing-page">

    <!-- Loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Login Form Section -->
    <section class="d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/images/logo.svg') }}" width="200" alt="logo">
                                {{-- <h2 class="fw-bold text-primary mb-2" style="font-size: 1.75rem;">Railsfix</h2> --}}
                                <p class="text-muted" style="font-size: 0.95rem;">Please sign in to continue</p>

                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login_store') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Enter your username" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter your password" required>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>


                            {{-- <div class="mt-3 text-center">
                                <a href="#">Forgot password?</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Required JS -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

    <script>
        layout_change('light');
        change_box_container('false');
        layout_rtl_change('false');
        preset_change("preset-1");
        font_change("Public-Sans");
    </script>
</body>

</html>
