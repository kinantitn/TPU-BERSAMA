@extends('layouts.__master')

@section('title')
Permohonan TPU
@endsection

@section('css-ekstra')
<style>
    .w-40 {
        width: 40% !important;
    }
    .image-payment-method {
        position: absolute;
        width: 80%;
    }
</style>
@endsection

@section('content')

@php
    $customer_type = app('request')->input('customer_type')
@endphp
@switch($customer_type)
    @case('WNA')
        @include('order.form_wna')
        @break
    @case('WARGA_JAKARTA')
        @include('order.form_warga_jakarta')
        @break
    @case('WARGA_LUAR_JAKARTA')
        @include('order.form_warga_luar_jakarta')
        @break
    @case('KELUARGA_MISKIN')
        @include('order.form_keluarga_miskin')
        @break
    @case('ORANG_TERLANTAR')
        {{-- @include('order.form_wna') --}}
        @include('order.form_wrong')
        @break
    @default
        @include('order.form_wrong')
@endswitch

@endsection

@section('js-ekstra')
<script src="{{ asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
@endsection
