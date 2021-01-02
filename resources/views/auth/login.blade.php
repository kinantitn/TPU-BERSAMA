@extends('layouts.__auth')

@section('title')
    Masuk
@endsection

@section('content')
<div class="header bg-gradient-primary py-5 py-lg-6 pt-lg-7">

    <div class="container">
        <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                    <h1 class="text-white">
                        {{ env('APP_NAME') }}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>

</div>

<div class="container mt--7 pb-5">

    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
                <div class="card-header bg-transparent">
                    <div class="text-muted text-center my-2">
                        {{ __('Selamat Datang') }}
                    </div>
                </div>
                <div class="card-body px-lg-5 py-lg-5">
                    <form role="form"  method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="ni ni-email-83"></i>
                                    </span>
                                </div>
                                <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="ni ni-lock-circle-open"></i>
                                    </span>
                                </div>
                                <input type="password" placeholder="Password" class="form-control" name="password" required autocomplete="current-password">
                            </div>
                            @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary my-4">
                                {{ __('Masuk') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <a href="{{ route('password.request') }}" class="text-light">
                        <small>{{ __('Lupa Password ?') }}</small>
                    </a>
                </div>
                <div class="col-6 text-right text-light">
                    <small>
                        {{ __('Belum punya akun ?') }}
                        <a href="{{ route('register') }}" class="text-white font-weight-bold">
                            {{ __('Daftar') }}
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
