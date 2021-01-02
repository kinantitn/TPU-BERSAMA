@extends('layouts.__master')

@section('title')
Pemilihan TPU
@endsection

@section('content')
<div id="accordion">
    <div class="card mb-2">
        <div class="card-header" id="dataKlasifikasi" data-toggle="collapse" data-target="#collapseDataKlasifikasi" aria-expanded="true" aria-controls="collapseDataKlasifikasi" style="cursor: pointer;">
            <div class="float-right">
                <i class="ni ni-bold-down text-primary"></i>
            </div>
            <h3 class="m-0">Klasifikasi kelas</h3>
        </div>
        <div id="collapseDataKlasifikasi" class="collapse" aria-labelledby="dataKlasifikasi" data-parent="#dataKlasifikasi">
            <div class="card-body row">
                @foreach (config('constants.class_tpu') as $key_tpu => $class_tpu)
                <div class="col-12 col-lg-4">
                    <div class="card m-0" style="box-shadow:none;border:1px solid rgba(0, 0, 0, .05);;">
                        <div class="card-header p-3">
                            <h3 class="font-weight-bold mb-0">
                                {{ $class_tpu['name'] }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="font-weight-bold">
                                Fasilitas
                            </p>
                            @foreach ($class_tpu['description'] as $description)
                            <div class="d-flex mb-2">
                                <div class="pr-2">
                                    <i class="fas fa-check-circle text-primary pr-2"></i>
                                </div>
                                <div class="p-0">
                                    {{ $description }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="card">
    <form method="get">
        <div class="card-body row">
            <div class="col-8 col-xl-10">
                <select class="form-control" name="area">
                    @foreach (config('constants.area') as $area)
                    <option value="{{ $area['value'] }}">
                        {{ $area['name'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-4 col-xl-2 text-right">
                <button class="btn btn-primary btn-block" type="submit">
                    Filter
                </button>
            </div>
        </div>
    </form>
</div>

<div class="row">
    @forelse ($funerals as $funeral)
    <div class="col-md-4">
        <div class="card">
            <img class="card-img-top" src="{{ asset('storage/funeral/'.$funeral['id'].'/'.$funeral['image']) }}" style="height: 300px;object-fit: cover !important;">
            <div class="card-body">
                <div class="text-center">
                    <h2 class="font-weight-bold">{{ $funeral['name'] }}</h2>
                    @php
                        $rating = (int) round($funeral->ratings->avg('rating'))
                    @endphp

                    @if ($rating)
                        @if ($rating === 1)
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                        @elseif ($rating === 2)
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                        @elseif ($rating === 3)
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                        @elseif ($rating === 4)
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                        @elseif ($rating === 5)
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        @endif
                    @else
                        Belum ada rating
                    @endif
                </div>
                <hr>
                <div class="text-center">
                    <ul class="list-unstyled my-4">
                        @foreach (config('constants.class_tpu') as $key_class => $class_tpu)
                        <li>
                            <div class="d-flex align-items-center justify-content-center my-4">
                                <div>
                                    <div class="icon icon-xs icon-shape bg-{{ $class_tpu['class'] }} text-white shadow rounded-circle">
                                        {{ $class_tpu['param'] }}
                                    </div>
                                </div>
                                <div>
                                    <span class="pl-2 font-weight-bold">
                                        {{ $class_tpu['name'] }} - {{ \App\Utilities\Helpers::formatCurrency($funeral[$class_tpu['price_table']], 'Rp') }} /
                                    </span>
                                    <span class="text-muted">
                                        Unit
                                    </span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#ajukan-permohonan" onclick="ajukanPermohonan('{{ $funeral['id'] }}')">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="pl-2">Pesan</span>
                    </button>
                </div>
                <hr>
                <div class="bg-secondary p-4 text-center rounded mt-2"">
                    <h4 class="font-weight-bold">Lokasi TPU</h4>
                    <p>{{ $funeral['address'] }}</p>
                    <a class="btn btn-outline-primary btn-block mt-2" href="{{ $funeral['maps'] }}" target="_blank">
                        <i class="fas fa-map-marked"></i>
                        <span class="pl-2">Link</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col">
        <div class="card">
            <div class="card-body text-center">
                <h3>Tidak ada data</h3>
                <a class="btn btn-default" href="{{ route('order') }}">
                    Reset
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>

<div class="modal fade" id="ajukan-permohonan" tabindex="-1" role="dialog" aria-labelledby="ajukan-permohonan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Ajukan permohonan
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('order.pick-tpu') }}" method="get">
                <div class="modal-body">
                    <input type="hidden" name="id" id="idFuneral">
                    <div class="form-group">
                        <label class="form-control-label">Jenis Jenazah</label>
                        <select class="form-control" name="customer_type">
                            @foreach (config('constants.customer_type') as $customer_type)
                            <option value="{{ $customer_type['value'] }}">
                                {{ $customer_type['name'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Kelas</label>
                        <select class="form-control" name="class_tpu">
                            @foreach (config('constants.class_tpu') as $key_class => $class_tpu)
                            <option value="{{ $key_class }}">
                                {{ $class_tpu['name'] }}
                            </option>
                            @endforeach
                        </select>
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
<script>
    function ajukanPermohonan(id) {
        $('#idFuneral').val(id)
    }
</script>
@endsection
