@extends('layouts.__master')

@section('title')
Tambah TPU
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="font-weight-bold">
            Pengisian Data TPU
        </h3>
    </div>
    <form method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="card-body row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Nama TPU</label>
                    <input value="{{ old('name') }}" name="name" class="form-control" type="text" placeholder="Nama TPU" required>
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
                        <option {{ old('area') === $area['value'] ? 'selected' : null }} value="{{ $area['value'] }}">
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
                    <input value="{{ old('whatsapp') }}" name="whatsapp" class="form-control" type="number" placeholder="62812345678" required>
                    @error('whatsapp')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Alamat</label>
                    <textarea name="address" class="form-control" type="text" placeholder="Alamat Lengkap" required>{{ old('address') }}</textarea>
                    @error('address')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">URL Google Maps</label>
                    <input value="{{ old('maps') }}" name="maps" class="form-control" type="text" placeholder="https://goo.gl/maps" required>
                    @error('maps')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Foto</label>
                    <input value="{{ old('image') }}" name="image" class="form-control" type="file" required accept="image/*">
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
                    <input value="{{ old('price_a') }}" name="price_a" class="form-control" type="number" placeholder="1200000" required>
                    @error('price_a')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Harga Kelas B</label>
                    <input value="{{ old('price_b') }}" name="price_b" class="form-control" type="number" placeholder="1200000" required>
                    @error('price_b')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Harga Kelas C</label>
                    <input value="{{ old('price_c') }}" name="price_c" class="form-control" type="number" placeholder="1200000" required>
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
                    @for ($i = 0; $i < $data['class_a']; $i++)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card border">
                            <div class="card-header text-center">
                                <h5 class="mb-0">A-{{ $i+1 }}</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="form-group">
                                    <label class="form-control-label">Jenis Lahan</label>
                                    <select name="area_class_a[A-{{ $i+1 }}]" class="form-control" required>
                                        <option value="">Pilih</option>
                                        @foreach (config('constants.type_tpu') as $type_tpu)
                                        <option value="{{ $type_tpu['value'] }}">
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
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
                <hr/>
                <h4>Lahan Kelas B</h4>
                <div class="row">
                    @for ($i = 0; $i < $data['class_b']; $i++)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card border">
                            <div class="card-header text-center">
                                <h5 class="mb-0">B-{{ $i+1 }}</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="form-group">
                                    <label class="form-control-label">Jenis Lahan</label>
                                    <select name="area_class_b[B-{{ $i+1 }}]" class="form-control" required>
                                        <option value="">Pilih</option>
                                        @foreach (config('constants.type_tpu') as $type_tpu)
                                        <option value="{{ $type_tpu['value'] }}">
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
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
                <hr/>
                <h4>Lahan Kelas C</h4>
                <div class="row">
                    @for ($i = 0; $i < $data['class_c']; $i++)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card border">
                            <div class="card-header text-center">
                                <h5 class="mb-0">C-{{ $i+1 }}</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="form-group">
                                    <label class="form-control-label">Jenis Lahan</label>
                                    <select name="area_class_c[C-{{ $i+1 }}]" class="form-control" required>
                                        <option value="">Pilih</option>
                                        @foreach (config('constants.type_tpu') as $type_tpu)
                                        <option value="{{ $type_tpu['value'] }}">
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
                            </div>
                        </div>
                    </div>
                    @endfor
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
