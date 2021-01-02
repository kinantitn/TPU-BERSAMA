<div class="card">
    <div class="card-header">
        <h3 class="font-weight-bold">
            Pengisian Data Diri
        </h3>
    </div>
    <form method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <input type="hidden" name="funeral_id" value="{{ $data['funeral']['id'] }}">
        <input type="hidden" name="customer_type" value="{{ $data['customer_type'] }}">
        <input type="hidden" name="class_tpu" value="{{ $data['class_tpu'] }}">
        <input type="hidden" name="pick_tpu" value="{{ $data['pick_tpu'] }}">
        <div class="card-body row">
            <div class="col-12 col-md-6 col-lg-6">
                <h4 class="font-weight-bold">
                    Identitas Pemohon
                </h4>
                <div class="form-group">
                    <label class="form-control-label">Nama</label>
                    <input value="{{ old('name_applicant') }}" name="name_applicant" class="form-control" type="text" placeholder="Nama" required>
                    @error('name_applicant')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Email</label>
                    <input class="form-control" type="email" placeholder="Email" value="{{ Auth::user()['email'] }}" disabled>
                    @error('email')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">No.Hp</label>
                    <input value="{{ old('phone_applicant') }}" name="phone_applicant" class="form-control" type="number" placeholder="62812345678" required>
                    @error('phone_applicant')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Hubungan dengan jenazah</label>
                    <input value="{{ old('funeral_relation') }}" name="funeral_relation" class="form-control" type="text" placeholder="Ex: Kakak" required>
                    @error('funeral_relation')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <h4 class="font-weight-bold">
                    Upload Berkas
                </h4>
                <div class="form-group">
                    <label class="form-control-label">KTP Pemohon</label>
                    <input name="identity_applicant" class="form-control" type="file" required>
                    @error('identity_applicant')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">KK Pemohon</label>
                    <input name="family_applicant" class="form-control" type="file" required>
                    @error('family_applicant')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <h4 class="font-weight-bold">
                    Identitas Jenazah
                </h4>
                <div class="form-group">
                    <label class="form-control-label">Nama</label>
                    <input value="{{ old('name_funeral') }}" name="name_funeral" class="form-control" type="text" placeholder="Nama" required>
                    @error('name_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Usia</label>
                    <input value="{{ old('age_funeral') }}" name="age_funeral" class="form-control" type="number" placeholder="Usia" required>
                    @error('age_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Jenis Kelamin</label>
                    <select name="gender_funeral" class="form-control" required>
                        <option value="">Jenis Kelamin</option>
                        @foreach (config('constants.gender') as $gender)
                        <option {{ old('gender_funeral') === $gender['value'] ? 'selected' : null }} value="{{ $gender['value'] }}">
                            {{ $gender['name'] }}
                        </option>
                        @endforeach
                    </select>
                    @error('gender_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Agama</label>
                    <select name="religion_funeral" class="form-control" required>
                        <option value="">Agama</option>
                        @foreach (config('constants.religion') as $religion)
                        <option {{ old('religion_funeral') === $religion['value'] ? 'selected' : null }} value="{{ $religion['value'] }}">
                            {{ $religion['name'] }}
                        </option>
                        @endforeach
                    </select>
                    @error('religion_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Alamat</label>
                    <input value="{{ old('address_funeral') }}" name="address_funeral" class="form-control" type="text" placeholder="Alamat" required>
                    @error('address_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Meninggal Pada</label>
                    <input value="{{ old('date_funeral') }}" name="date_funeral" class="form-control datepicker" placeholder="Pilih tanggal" type="text" required>
                    @error('date_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <h4 class="font-weight-bold">
                    Upload Berkas
                </h4>
                <div class="form-group">
                    <label class="form-control-label">Surat Keterangan Tidak Mampu Jenazah</label>
                    <input name="not_capable_funeral" class="form-control" type="file" required>
                    @error('not_capable_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Kartu Izin Tinggal Terbatas Jenazah</label>
                    <input name="permit_life_funeral" class="form-control" type="file" required>
                    @error('permit_life_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">KTP/Paspor Jenazah</label>
                    <input name="identity_funeral" class="form-control" type="file" required>
                    @error('identity_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">Surat Kematian</label>
                    <br/>
                    <small class="text-danger">
                        * Jika ada
                    </small>
                    <input name="certificate_funeral" class="form-control" type="file">
                    @error('certificate_funeral')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#pembayaran" >
                Ajukan Permohonan
                <i class="pl-2 fas fa-arrow-right"></i>
            </button>
        </div>
        @include('order.payment')
    </form>
</div>
