@extends('layouts.__master')

@section('title')
Pilih Lahan
@endsection

@section('content')
<div class="card">
    <form method="get" action="{{ route('order.form', ['id' => $data['id']]) }}">
        <input type="hidden" name="customer_type" value="{{ $data['customer_type'] }}">
        <input type="hidden" name="class_tpu" value="{{ $data['class_tpu'] }}">
        <div class="card-body row">

            @foreach ($data['slot_funeral'] as $key_slot => $slot_funeral)
            @php
                $class = null;
                if ($slot_funeral['available']) {
                    if($slot_funeral['type'] === 'umum') {
                        $class = 'bg-light';
                    }
                } else {
                    $class = 'bg-danger';
                }
            @endphp
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card {{ $class }} border" style="height: 100%">
                    <div class="card-header text-center">
                        <h5 class="mb-0">{{ $key_slot }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($slot_funeral['available'])
                            @if ($slot_funeral['type'] === 'covid')
                            <div class="d-flex align-items-center justify-content-center flex-column" style="height: 100%">
                                <div class="p-0">
                                    <input name="pick_tpu" id="{{ $key_slot }}" type="radio" value="{{ $key_slot }}">
                                </div>
                                <div>
                                    <label for="{{ $key_slot }}">
                                        <i class="fas fa-plus text-danger" style="font-size: 24px"></i>
                                    </label>
                                </div>
                            </div>
                            @elseif ($slot_funeral['type'] === 'umum')
                            <div class="d-flex align-items-center justify-content-center flex-column p-2" style="height: 100%">
                                <div class="p-0">
                                    <input name="pick_tpu" id="{{ $key_slot }}" type="radio" value="{{ $key_slot }}">
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-12">
                <div class="d-flex justify-content-around flex-wrap">
                    <div class="d-flex">
                        <div class="rounded bg-danger" style="height: 25px; width:25px"></div>
                        <div class="pl-2">
                            Lahan terisi
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="bg-light rounded" style="height: 25px; width:25px"></div>
                        <div class="pl-2">
                            Lahan Tersedia
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="rounded" style="height: 25px; width:25px">
                            <i class="fas fa-plus text-danger"></i>
                        </div>
                        <div class="pl-2">
                            Khusus Covid
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">
                Lanjutkan
                <i class="pl-2 fas fa-arrow-right"></i>
            </button>
        </div>
    </form>
</div>
@endsection

@section('js-ekstra')

@endsection
