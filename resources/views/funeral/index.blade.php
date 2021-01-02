@extends('layouts.__master')

@section('title')
Data TPU
@endsection

@section('css-ekstra')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Data TPU Jakarta</h3>
            </div>
            <div class="col text-right">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#buat-tpu">
                    Tambah TPU
                    <i class="fas fa-plus pl-2"></i>
                </button>
            </div>
        </div>
    </div>
    <hr class="my-2"/>
    <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-basic">
            <thead class="thead-light">
                <tr>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kapasitas</th>
                    <th>Tersedia</th>
                    <th>Harga</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kapasitas</th>
                    <th>Tersedia</th>
                    <th>Harga</th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($funerals as $funeral)
                <tr>
                    <td>
                        {{ $funeral['name'] }}
                    </td>
                    <td>
                        {{ config('constants.area')[$funeral['area']]['name'] }}
                    </td>
                    <td>{{ $funeral['capacity'] }} Lahan</td>
                    <td>{{ $funeral['available'] }} Lahan</td>
                    <td class="text-primary font-weight-bold">
                        {{ \App\Utilities\Helpers::formatCurrency($funeral['price_c'], 'Rp') }} - {{  \App\Utilities\Helpers::formatCurrency($funeral['price_a'], 'Rp') }}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" href="{{ route('funeral.detail', ['id' => $funeral['id']]) }}">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="buat-tpu" tabindex="-1" role="dialog" aria-labelledby="buat-tpu" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Tambah TPU
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('funeral.create-form') }}" method="get">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label">Kapasitas Kelas A</label>
                        <input type="number" class="form-control" name="class_a" value="{{ old('class_a') }}" required>
                        @error('class_a')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Kapasitas Kelas B</label>
                        <input type="number" class="form-control" name="class_b" value="{{ old('class_b') }}" required>
                        @error('class_b')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Kapasitas Kelas C</label>
                        <input type="number" class="form-control" name="class_c" value="{{ old('class_c') }}" required>
                        @error('class_c')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ml-auto">
                        Lanjutkan
                        <i class="pl-2 fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('js-ekstra')
<script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/components/vendor/datatable.js') }}"></script>
@endsection
