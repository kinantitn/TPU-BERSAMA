
<div class="modal fade" id="pembayaran" tabindex="-1" role="dialog" aria-labelledby="pembayaran" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Pembayaran
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bold">Informasi TPU</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex mb-2">
                                <div class="p-0 w-40">
                                    Nama
                                </div>
                                <div class="ml-auto text-right" style="width: 60%;">
                                    {{ $data['funeral']['name'] }}
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="p-0 w-40">
                                    Alamat
                                </div>
                                <div class="ml-auto text-right" style="width: 60%;">
                                    {{ $data['funeral']['address'] }}asd asdasdasda asdsadsadas asdasdasd asdas dasd asd
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="p-0 w-40">
                                    Nomor Lahan
                                </div>
                                <div class="ml-auto text-right" style="width: 60%;">
                                    {{ $data['funeral']['funeral_number'] }}
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="p-0 w-40">
                                    Kebutuhan
                                </div>
                                <div class="ml-auto text-right" style="width: 60%;">
                                    {{ $data['funeral']['funeral_type'] }}
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="p-0 w-40">
                                    Kelas
                                </div>
                                <div class="ml-auto text-right" style="width: 60%;">
                                    {{ $data['funeral']['funeral_class'] }}
                                </div>
                            </div>
                            Foto
                            <img src="{{ asset('storage/funeral/'.$data['funeral']['id'].'/'.$data['funeral']['image']) }}" class="rounded mt-2" style="width: 100%;">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bold">Metode Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            @foreach (config('constants.payment_method') as $payment_method)
                            <div class="custom-control custom-radio mb-3 border rounded pl-5 p-3">
                                <input name="payment_method" class="custom-control-input" id="paymentMethod{{ $payment_method['name'] }}" type="radio" value="{{ $payment_method['value'] }}" required {{ old('payment_method') === $payment_method['value'] ? 'checked' : null }}>
                                <div class="image-payment-method">
                                    <img src="{{ asset($payment_method['image']) }}" style="width: 5rem; float: right">
                                </div>
                                <label class="custom-control-label" for="paymentMethod{{ $payment_method['name'] }}">{{ $payment_method['name'] }}</label>
                            </div>
                            @endforeach
                            @error('payment_method')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bold">Ringkasan Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="p-0">
                                    Total Tagihan
                                </div>
                                <div class="p-0 ml-auto items-align-end">
                                    {{ \App\Utilities\Helpers::formatCurrency($data['funeral']['funeral_price'], 'Rp') }}
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="p-0">
                                    Biaya Layanan (10%)
                                </div>
                                <div class="p-0 ml-auto items-align-end">
                                    {{ \App\Utilities\Helpers::formatCurrency($data['funeral']['funeral_tax'], 'Rp') }}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <div>
                                <h3 class="font-weight-bold mb-0">
                                    Total Bayar
                                </h3>
                            </div>
                            <div class="ml-auto align-items-end">
                                <h3 class="font-weight-bold text-danger mb-0">
                                    {{ \App\Utilities\Helpers::formatCurrency($data['funeral']['funeral_total_price'], 'Rp') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">
                    Tutup
                </button>
                <button type="submit" class="btn btn-primary ml-auto">
                    Selesaikan Permohonan
                    <i class="pl-2 fas fa-arrow-right"></i>
                </button>
            </div>

        </div>
    </div>
</div>
