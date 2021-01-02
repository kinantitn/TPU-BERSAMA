@extends('layouts.__master')

@section('title')
    Status Permohanan
@endsection

@section('content')

@forelse ($orders as $order)
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
                @if ($order['payment_status'] !== 'PAID' && $order['status'] !== 'CANCEL')
                    @if ($order['status'] !== 'COMPLETE')
                    <div class="d-flex align-items-center mb-2">
                        <div class="p-0 text-muted">
                            Upload Pembayaran
                        </div>
                        <div class="ml-auto">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#upload-pembayaran"
                            onclick="setPayment('{{ $order['token'] }}','{!! base64_encode(json_encode(config('constants.payment_method')[$order['payment_method']])) !!}')">
                                <i class="ni ni-cloud-upload-96"></i>
                                Upload disini
                            </button>
                        </div>
                    </div>
                    @endif
                @endif

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
                <div class="d-flex align-items-center mb-2">
                    <div class="p-0 text-muted">
                        Kontak
                    </div>
                    <div class="ml-auto">
                        <a class="btn btn-success btn-sm" href="https://api.whatsapp.com/send?phone={{ $order['funerals']['whatsapp'] }}" target="_blank">
                            <i class="ni ni-chat-round"></i>
                            Whatsapp
                        </a>
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
        </div>
    </div>
    <div class="card-footer d-flex align-items-center">
        <div class="text-muted">
            Perubahan terakhir : {{ App\Utilities\Helpers::formatDate($order['updated_at'], true) }}
        </div>
        <div class="ml-auto">
            @if ($order['payment_status'] === 'PENDING' && $order['status'] === 'PENDING')
            <buton class="btn btn-danger btn-sm ml-auto" data-toggle="modal" data-target="#batalkan-permohonan" style="cursor: pointer" onclick="setCancel('{{ $order['token'] }}')">
                Batalkan Permohonan
            </buton>
            @endif
            @if ($order['status'] === 'CONFIRM')
            <buton class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#tiba-di-TPU" style="cursor: pointer" onclick="setArrival('{{ $order['token'] }}')">
                Tiba di TPU
            </buton>
            @endif
            @if ($order['status'] === 'ARRIVE')
            <buton class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#selesaikan-permohonan" style="cursor: pointer" onclick="setComplete('{{ $order['token'] }}')">
                Selesikan Permohonan
            </buton>
            @endif
        </div>
    </div>
</div>
@empty
<div class="card">
    <div class="card-body text-center">
        <h3>Tidak ada data</h3>
    </div>
</div>
@endforelse

<div class="modal fade" id="upload-pembayaran" tabindex="-1" role="dialog" aria-labelledby="upload-pembayaran" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Upload bukti pembayaran
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('status.payment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="token" id="tokenPayment">
                <div class="modal-body">
                    <div class="d-flex align-items-center rounded p-2 mb-2">
                        <div class="pr-2">
                            Silahkan transfer ke rekening <span id="bankName"></span> a/n <span id="bankOwner"></span>
                        </div>
                        <div class="ml-auto" style="width: 40%;">
                            <img id="bankImage" width="100%">
                        </div>
                    </div>
                    <input type="file" name="payment" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ml-auto">
                        Upload
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

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
            <form action="{{ route('status.cancel') }}" method="post">
                @csrf
                <input type="hidden" name="token" id="tokenCancel">
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

<div class="modal fade" id="tiba-di-TPU" tabindex="-1" role="dialog" aria-labelledby="tiba-di-TPU" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Tiba di lokasi TPU
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('status.arrive') }}" method="post">
                @csrf
                <input type="hidden" name="token" id="tokenArrive">
                <div class="modal-body">

                    <p>
                        Yakin sudah tiba di lokasi TPU ?
                    </p>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">
                        Tidak
                    </button>
                    <button type="submit" class="btn btn-primary ml-auto">
                        Yakin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="selesaikan-permohonan" tabindex="-1" role="dialog" aria-labelledby="selesaikan-permohonan" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Selesaikan Permohonan
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('status.complete') }}" method="post">
                @csrf
                <input type="hidden" name="token" id="tokenComplete">
                <input type="hidden" name="rating" id="starRating" value="1">
                <div class="modal-body text-center">

                    <p>Berikan rating</p>

                    <i class="fas fa-star text-warning" id="starRate1" onclick="starRating1()"></i>
                    <i class="far fa-star text-warning" id="starRate2" onclick="starRating2()"></i>
                    <i class="far fa-star text-warning" id="starRate3" onclick="starRating3()"></i>
                    <i class="far fa-star text-warning" id="starRate4" onclick="starRating4()"></i>
                    <i class="far fa-star text-warning" id="starRate5" onclick="starRating5()"></i>

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
@endsection


@section('js-ekstra')
<script>
    function setCancel(token) {
        $('#tokenCancel').val(token)
    }
    function setPayment(token, data) {
        const payment_data = JSON.parse(atob(data))
        $('#tokenPayment').val(token)
        $('#bankName').text(payment_data.value)
        $('#bankOwner').text(payment_data.name_reference)
        $('#bankImage').attr('src', payment_data.image)
    }
    function setArrival(token) {
        $('#tokenArrive').val(token)
    }
    function setComplete(token) {
        $('#tokenComplete').val(token)
    }
    function starRating1() {
        removeClassStar()
        $('#starRate1').addClass("fas fa-star text-warning")
        $('#starRate2').addClass("far fa-star text-warning")
        $('#starRate3').addClass("far fa-star text-warning")
        $('#starRate4').addClass("far fa-star text-warning")
        $('#starRate5').addClass("far fa-star text-warning")
        $('#starRating').val(1)
    }
    function starRating2() {
        removeClassStar()
        $('#starRate1').addClass("fas fa-star text-warning")
        $('#starRate2').addClass("fas fa-star text-warning")
        $('#starRate3').addClass("far fa-star text-warning")
        $('#starRate4').addClass("far fa-star text-warning")
        $('#starRate5').addClass("far fa-star text-warning")
        $('#starRating').val(2)
    }
    function starRating3() {
        removeClassStar()
        $('#starRate1').addClass("fas fa-star text-warning")
        $('#starRate2').addClass("fas fa-star text-warning")
        $('#starRate3').addClass("fas fa-star text-warning")
        $('#starRate4').addClass("far fa-star text-warning")
        $('#starRate5').addClass("far fa-star text-warning")
        $('#starRating').val(3)
    }
    function starRating4() {
        removeClassStar()
        $('#starRate1').addClass("fas fa-star text-warning")
        $('#starRate2').addClass("fas fa-star text-warning")
        $('#starRate3').addClass("fas fa-star text-warning")
        $('#starRate4').addClass("fas fa-star text-warning")
        $('#starRate5').addClass("far fa-star text-warning")
        $('#starRating').val(4)
    }
    function starRating5() {
        removeClassStar()
        $('#starRate1').addClass("fas fa-star text-warning")
        $('#starRate2').addClass("fas fa-star text-warning")
        $('#starRate3').addClass("fas fa-star text-warning")
        $('#starRate4').addClass("fas fa-star text-warning")
        $('#starRate5').addClass("fas fa-star text-warning")
        $('#starRating').val(5)
    }
    function removeClassStar() {
        $('#starRate1').removeClass()
        $('#starRate2').removeClass()
        $('#starRate3').removeClass()
        $('#starRate4').removeClass()
        $('#starRate5').removeClass()
    }
</script>
@endsection
