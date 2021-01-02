@extends('layouts.__master')

@section('title')
    Beranda
@endsection

@section('content')
<div class="row">
    <div class="col-xl-6 order-xl-2">
        <div class="card card-profile">
            <img src="{{ asset('assets/img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top" style="height: 130px;">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()['name'] }}&size=240" class="rounded-circle">
                    </div>
                </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                    &nbsp;
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="text-center">
                    <h5 class="h3">
                        {{ Auth::user()['name'] }}
                    </h5>
                    <div class="h5 font-weight-300">
                        <i class="ni ni-email-83 mr-2"></i>{{ Auth::user()['email'] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="h3 mb-0">
                    Riwayat Permohonan
                </h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush list my--3">
                    @forelse ($data['history_transaction'] as $history_transaction)
                    <li class="list-group-item px-0">
                        <div class="row">
                            <div class="col-auto">
                                <h3 class="mb-0">
                                    {{ $history_transaction['funerals']['name'] }}
                                </h3>
                                <h5 class="text-danger font-weight-bold mb-0">
                                    <h5 class="text-muted">
                                        {{ App\Utilities\Helpers::formatDate($history_transaction['created_at']) }}
                                    </h5>
                                </h5>
                            </div>
                            <div class="col text-right align-items-end">
                                <span class="badge badge-{{ config('constants.status')[$history_transaction['status']]['class'] }}">
                                    {{ config('constants.status')[$history_transaction['status']]['name'] }}
                                </span>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item px-0 text-center">
                        Tidak ada riwayat
                    </li>
                    @endforelse

                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-6 order-xl-1">
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-gradient-warning border-0">
                    <div class="card-body">
                        <div class="row py-3">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                                    Total Transaksi
                                </h5>
                                <span class="h2 font-weight-bold mb-0 text-white">
                                    {{ App\Utilities\Helpers::formatCurrency($data['total_transaction']) }}
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                    <i class="ni ni-archive-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card bg-gradient-danger border-0">
                    <div class="card-body">
                        <div class="row py-3">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Menunggu Pembayaran</h5>
                                <span class="h2 font-weight-bold mb-0 text-white">
                                    {{ App\Utilities\Helpers::formatCurrency($data['pending_payment']) }}
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                    <i class="ni ni-credit-card"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3 class="mb-0">
                            Edit profil
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">
                    Informasi Pengguna
                </h6>
                <div class="pl-lg-4">
                    <form method="POST" action="{{ route('home.update-profile') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">
                                        Nama
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama" value="{{ Auth::user()['name'] }}" required>
                                    @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">
                                        Alamat Email
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ Auth::user()['email'] }}" readonly>
                                </div>
                            </div>
                            @if(App\Utilities\Helpers::checkRoleWithoutAction(['admin']))
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">
                                        Hak Akses
                                    </label>
                                    <input type="text" class="form-control" value="{{ Auth::user()['role'] }}" readonly>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="my-4" />

                <h6 class="heading-small text-muted mb-4">
                    Ubah Password
                </h6>
                <div class="pl-lg-4">
                    <form method="POST" action="{{ route('home.update-password') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="old_password">
                                        Password Lama
                                    </label>
                                    <input type="password" name="old_password" id="old_password" class="form-control" placeholder="*********" required>
                                    @error('old_password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="new_password">
                                        Password Baru
                                    </label>
                                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="*********" required>
                                    @error('new_password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="new_password_confirmation">
                                        Konfirmasi Password
                                    </label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="*********" required>
                                    @error('new_password_confirmation')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    Ubah Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
