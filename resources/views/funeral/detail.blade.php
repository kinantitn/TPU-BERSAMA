@extends('layouts.__master')

@section('title')
Detail TPU
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="font-weight-bold">
            Detail TPU
        </h3>
    </div>
    <form method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="card-body row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Nama TPU</label>
                    <input value="{{ $data['funeral']['name'] }}" name="name" class="form-control" type="text" placeholder="Nama TPU" required>
                    @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Wilayah</label>
                    <select name="area" class="form-control" required>
                        <option value="">Pilih Wilayah</option>
                        @foreach (config('constants.area') as $area)
                        <option {{ $data['funeral']['area'] === $area['value'] ? 'selected' : null }} value="{{ $area['value'] }}">
                            {{ $area['name'] }}
                        </option>
                        @endforeach
                    </select>
                    @error('area')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Kontak Whatsapp</label>
                    <input value="{{ $data['funeral']['whatsapp'] }}" name="whatsapp" class="form-control" type="number" placeholder="62812345678" required>
                    @error('whatsapp')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Alamat</label>
                    <textarea name="address" class="form-control" type="text" placeholder="Alamat Lengkap" required>{{ $data['funeral']['address'] }}</textarea>
                    @error('address')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">URL Google Maps</label>
                    <input value="{{ $data['funeral']['maps'] }}" name="maps" class="form-control" type="text" placeholder="https://goo.gl/maps" required>
                    @error('maps')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Foto</label>
                    <small class="text-danger">
                       * abaikan jika tidak ingin dirubah
                    </small>
                    <br>
                    <img src="{{ asset('storage/funeral/'.$data['funeral']['id'].'/'.$data['funeral']['image']) }}" class="rounded my-2" style="width: 30%;">
                    <input name="image" class="form-control" type="file" accept="image/*">
                    @error('image')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Harga Kelas A</label>
                    <input value="{{ (int) $data['funeral']['price_a'] }}" name="price_a" class="form-control" type="number" placeholder="1200000" required>
                    @error('price_a')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Harga Kelas B</label>
                    <input value="{{ (int) $data['funeral']['price_b'] }}" name="price_b" class="form-control" type="number" placeholder="1200000" required>
                    @error('price_b')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Harga Kelas C</label>
                    <input value="{{ (int) $data['funeral']['price_c'] }}" name="price_c" class="form-control" type="number" placeholder="1200000" required>
                    @error('price_c')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <hr/>
                <h4>Lahan Kelas A</h4>
                <div class="row">
                    @foreach ($data['area_class_a'] as $key => $area_class_a)
                    <div class="col-6 col-md-4 col-lg-2 mb-4">
                        <div class="card border {{ $area_class_a['available'] ? null : 'bg-danger' }}" style="height: 100%">
                            <div class="card-header text-center">
                                <h5 class="mb-0">{{ $key }}</h5>
                            </div>
                            <div class="card-body text-center">
                                @if ($area_class_a['available'])
                                <div class="form-group">
                                    <label class="form-control-label">Jenis Lahan</label>
                                    <select name="area_class_a[{{ $key }}]" class="form-control" required>
                                        <option value="">Pilih</option>
                                        @foreach (config('constants.type_tpu') as $type_tpu)
                                        <option {{ $area_class_a['type'] === $type_tpu['value'] ? 'selected' : null }} value="{{ $type_tpu['value'] }}">
                                            {{ $type_tpu['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('area_class_a')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                @else
                                <div class="d-flex align-items-center justify-content-center" style="height: 100%">
                                    <div class="font-weight-bold text-white">
                                        Sudah Terisi
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr/>
                <h4>Lahan Kelas B</h4>
                <div class="row">
                    @foreach ($data['area_class_b'] as $key => $area_class_b)
                    <div class="col-6 col-md-4 col-lg-2 mb-4">
                        <div class="card border {{ $area_class_b['available'] ? null : 'bg-danger' }}" style="height: 100%">
                            <div class="card-header text-center">
                                <h5 class="mb-0">{{ $key }}</h5>
                            </div>
                            <div class="card-body text-center">
                                @if ($area_class_b['available'])
                                <div class="form-group">
                                    <label class="form-control-label">Jenis Lahan</label>
                                    <select name="area_class_b[{{ $key }}]" class="form-control" required>
                                        <option value="">Pilih</option>
                                        @foreach (config('constants.type_tpu') as $type_tpu)
                                        <option {{ $area_class_b['type'] === $type_tpu['value'] ? 'selected' : null }} value="{{ $type_tpu['value'] }}">
                                            {{ $type_tpu['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('area_class_b')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                @else
                                <div class="d-flex align-items-center justify-content-center" style="height: 100%">
                                    <div class="font-weight-bold text-white">
                                        Sudah Terisi
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr/>
                <h4>Lahan Kelas C</h4>
                <div class="row">
                    @foreach ($data['area_class_c'] as $key => $area_class_c)
                    <div class="col-6 col-md-4 col-lg-2 mb-4">
                        <div class="card border {{ $area_class_c['available'] ? null : 'bg-danger' }}" style="height: 100%">
                            <div class="card-header text-center">
                                <h5 class="mb-0">{{ $key }}</h5>
                            </div>
                            <div class="card-body text-center">
                                @if ($area_class_c['available'])
                                <div class="form-group">
                                    <label class="form-control-label">Jenis Lahan</label>
                                    <select name="area_class_c[{{ $key }}]" class="form-control" required>
                                        <option value="">Pilih</option>
                                        @foreach (config('constants.type_tpu') as $type_tpu)
                                        <option {{ $area_class_c['type'] === $type_tpu['value'] ? 'selected' : null }} value="{{ $type_tpu['value'] }}">
                                            {{ $type_tpu['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('area_class_c')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                @else
                                <div class="d-flex align-items-center justify-content-center" style="height: 100%">
                                    <div class="font-weight-bold text-white">
                                        Sudah Terisi
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">
                Simpan
                <i class="pl-2 fas fa-save"></i>
            </button>
        </div>
    </form>
</div>
@endsection
