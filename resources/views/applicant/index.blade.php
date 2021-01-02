@extends('layouts.__master')

@section('title')
Data Permohonan
@endsection

@section('css-ekstra')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-header border-0">
        <h3 class="mb-0">Permohonan TPU</h3>
    </div>
    <hr class="my-2"/>
    <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-basic">
            <thead class="thead-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pemohon</th>
                    <th>Lokasi TPU</th>
                    <th>Kebutuhan</th>
                    <th>Kelas</th>
                    <th>Nomor Lahan</th>
                    <th>Status Pembayaran</th>
                    <th>Status Permohonan</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pemohon</th>
                    <th>Lokasi TPU</th>
                    <th>Kebutuhan</th>
                    <th>Kelas</th>
                    <th>Nomor Lahan</th>
                    <th>Status Pembayaran</th>
                    <th>Status Permohonan</th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>
                        {{ App\Utilities\Helpers::formatDate($order['created_at']) }}
                    </td>
                    <td>
                        {{ $order['name_applicant'] }}
                    </td>
                    <td>
                        {{ $order['funerals']['name'] }} - {{ config('constants.area')[$order['funerals']['area']]['name'] }}
                    </td>
                    <td>
                        {{ config('constants.type_tpu')[$order['funeral_type']]['name'] }}
                    </td>
                    <td>
                        <span class="badge badge-{{ config('constants.class_tpu')[$order['funeral_class']]['class'] }}">
                            {{ config('constants.class_tpu')[$order['funeral_class']]['param'] }}
                        </span>
                    </td>
                    <td>
                        {{ $order['funeral_number'] }}
                    </td>
                    <td class="text-primary font-weight-bold">
                        <span class="badge badge-{{ config('constants.payment_status')[$order['payment_status']]['class'] }}">
                            {{ config('constants.payment_status')[$order['payment_status']]['name'] }}
                        </span>
                    </td>
                    <td class="text-primary font-weight-bold">
                        <span class="badge badge-{{ config('constants.status')[$order['status']]['class'] }}">
                            {{ config('constants.status')[$order['status']]['name'] }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" href="{{ route('applicant.detail', ['id' => $order['id']]) }}">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


@section('js-ekstra')
<script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/components/vendor/datatable.js') }}"></script>
@endsection
