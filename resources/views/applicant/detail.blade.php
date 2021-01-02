@extends('layouts.__master')

@section('title')
Detail Permohonan
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <button class="btn btn-{{ config('constants.status')[$order['status']]['class'] }} btn-sm">
            {{ config('constants.status')[$order['status']]['name'] }}
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h2 class="h2 mb-3">Data Pemohon</h2>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Tanggal
                    </div>
                    <div class="ml-auto">
                        {{ App\Utilities\Helpers::formatDate($order['created_at']) }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Nama
                    </div>
                    <div class="ml-auto">
                        {{ $order['name_applicant'] }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Kontak
                    </div>
                    <div class="ml-auto">
                        <a class="btn btn-success btn-sm" href="https://api.whatsapp.com/send?phone={{ $order['phone_applicant'] }}" target="_blank">
                            <i class="ni ni-chat-round"></i>
                            Whatsapp
                        </a>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Status Pembayaran
                    </div>
                    <div class="ml-auto">
                        <span class="badge badge-{{ config('constants.payment_status')[$order['payment_status']]['class'] }}">
                            {{ config('constants.payment_status')[$order['payment_status']]['name'] }}
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Metode Pembayaran
                    </div>
                    <div class="ml-auto">
                        {{ config('constants.payment_method')[$order['payment_method']]['name'] }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Jumlah Pembayaran
                    </div>
                    <div class="ml-auto text-danger font-weight-bold">
                        {{ App\Utilities\Helpers::formatCurrency($order['total_price'], 'Rp') }}
                    </div>
                </div>

                <hr class="my-4" />

                <h2 class="h2 mb-3">Data TPU</h2>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Lokasi TPU
                    </div>
                    <div class="ml-auto">
                        {{ $order['funerals']['name'] }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        No Lahan
                    </div>
                    <div class="ml-auto">
                        {{ $order['funeral_number'] }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Kebutuhan
                    </div>
                    <div class="ml-auto">
                        {{ config('constants.type_tpu')[$order['funeral_type']]['name'] }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Kelas
                    </div>
                    <div class="ml-auto">
                        <span class="badge badge-{{ config('constants.class_tpu')[$order['funeral_class']]['class'] }}">
                            {{ config('constants.class_tpu')[$order['funeral_class']]['param'] }}
                        </span>
                    </div>
                </div>

            </div>

            <div class="col-12 col-lg-6">

                <div class="d-block d-lg-none d-sm-block d-md-block" style="width: 100%">
                    <hr class="my-4" />
                </div>

                <h2 class="h2 mb-3">Data Jenazah</h2>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Nama
                    </div>
                    <div class="ml-auto">
                        {{ $order['name_funeral'] }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Kategori
                    </div>
                    <div class="ml-auto">
                        {{ config('constants.customer_type')[$order['customer_type']]['name'] }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Jenis Kelamin
                    </div>
                    <div class="ml-auto">
                        {{ config('constants.gender')[$order['gender_funeral']]['name'] }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Agama
                    </div>
                    <div class="ml-auto">
                        {{ config('constants.religion')[$order['religion_funeral']]['name'] }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Tanggal Wafat
                    </div>
                    <div class="ml-auto">
                        {{ App\Utilities\Helpers::formatDate($order['date_funeral']) }}
                    </div>
                </div>
            </div>


            <div class="col-12">
                <hr class="my-4" />
                <h2 class="h2 mb-3">Dokumen</h2>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <tbody>
                            @if ($order['payment_file'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        Bukti Pembayaran
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['payment_file']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if ($order['identity_applicant'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        KTP/Paspor Pemohon
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['identity_applicant']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if ($order['family_applicant'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        KK Pemohon
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['family_applicant']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if ($order['identity_funeral'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        KTP/Paspor Jenazah
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['identity_funeral']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if ($order['certificate_funeral'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        Surat Kematian
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['certificate_funeral']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if ($order['permit_life_funeral'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        Surat Izin Tinggal Jenazah
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['permit_life_funeral']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if ($order['family_funeral'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        KK Jenazah
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['family_funeral']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if ($order['identity_heir'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        KTP/Paspor Ahli Waris
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['identity_heir']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if ($order['family_heir'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        KK Ahli Waris
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['family_heir']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if ($order['not_capable_funeral'])
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        Surat Keterangan Tidak Mampu
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <a href="{{ asset('storage/order/'.$order['token'].'/'.$order['not_capable_funeral']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        Download
                                        <i class="pl-2 fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex align-items-center">
        <div class="text-muted">
            Perubahan terakhir : {{ App\Utilities\Helpers::formatDate($order['updated_at'], true) }}
        </div>
        <div class="ml-auto">
            @if ($order['payment_status'] !== 'PAID' && $order['status'] !== 'CANCEL')
                @if ($order['status'] !== 'COMPLETE')
                <buton class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#batalkan-permohonan" style="cursor: pointer">
                    Batalkan Permohonan
                </buton>
                @endif
            @endif
            @if ($order['status'] === 'PENDING')
            <buton class="btn btn-primary btn-sm" data-toggle="modal" data-target="#konfirmasi-permohonan" style="cursor: pointer">
                Konfirmasi Permohonan
            </buton>
            @endif
            @if ($order['status'] === 'ARRIVE')
            <buton class="btn btn-primary btn-sm" data-toggle="modal" data-target="#selesaikan-permohonan" style="cursor: pointer">
                Selesaikan Permohonan
            </buton>
            @endif
        </div>
    </div>
</div>
@if ($order['payment_status'] !== 'PAID' && $order['status'] !== 'CANCEL')
    @if ($order['status'] !== 'COMPLETE')
    <div class="modal fade" id="batalkan-permohonan" tabindex="-1" role="dialog" aria-labelledby="batalkan-permohonan" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">
                        Batalkan permohonan
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('applicant.cancel', ['id' => $order['id']]) }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $order['token'] }}">
                    <div class="modal-body">

                        <p>
                            Yakin ingin membatalkan permohonan ?
                        </p>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">
                            Tidak
                        </button>
                        <button type="submit" class="btn btn-danger ml-auto">
                            Batalkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endif
@if ($order['status'] === 'PENDING')
<div class="modal fade" id="konfirmasi-permohonan" tabindex="-1" role="dialog" aria-labelledby="konfirmasi-permohonan" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Konfirmasi permohonan
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('applicant.confirm', ['id' => $order['id']]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <p>
                        Yakin ingin mengkonfirmasi permohonan ?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">
                        Tidak
                    </button>
                    <button type="submit" class="btn btn-primary ml-auto">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@if ($order['status'] === 'ARRIVE')
<div class="modal fade" id="selesaikan-permohonan" tabindex="-1" role="dialog" aria-labelledby="selesaikan-permohonan" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Selesaikan permohonan
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('applicant.complete', ['id' => $order['id']]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <p>
                        Yakin ingin menyelesaikan permohonan ?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">
                        Tidak
                    </button>
                    <button type="submit" class="btn btn-primary ml-auto">
                        Selesaikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
