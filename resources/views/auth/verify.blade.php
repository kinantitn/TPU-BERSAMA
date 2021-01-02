@extends('layouts.__master')

@section('title')
    Verifikasi Email
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('Verifikasi alamat email anda') }}</div>

            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                    </div>
                @endif

                {{ __('Sebelum melanjutkan, periksa email anda untuk tautan verifikasi.') }}
                {{ __('Jika anda tidak menerima email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk meminta yang lain') }}</button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
