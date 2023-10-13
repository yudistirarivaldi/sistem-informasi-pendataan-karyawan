<div class="card-body">
    <div class="card card-solid">
        <div class="card-body pb-0 pt-3">
            <blockquote>
                <b>Keterangan!!</b><br>
                <small><cite title="Source Title">Inputan Yang Ditanda Bintang Merah (<span class="text-danger">*</span>)
                        Harus Di Isi !!</cite></small>
            </blockquote>
        </div>
    </div>
    <div class="card-header with-border pl-0 pb-1">
        <span class="col-form-label text-bold">Pasien</span>
    </div>
    <br>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Kode Pasien <span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" name="kode_pasien" class="form-control @error('kode_pasien') is-invalid @enderror"
                value="{{ old('kode_pasien', $pasien->kode_pasien ?? '') }}" placeholder="Koode Pasien.."
                autocomplete="off">
            @error('kode_pasien')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('kode_pasien') }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Nama Pasien <span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" name="nama_pasien" class="form-control @error('nama_pasien') is-invalid @enderror"
                value="{{ old('nama_pasien', $pasien->nama_pasien ?? '') }}" placeholder="Nama Pasien.."
                autocomplete="off">
            @error('nama_pasien')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nama_pasien') }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Alamat <span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                value="{{ old('alamat', $pasien->alamat ?? '') }}" placeholder="Alamat Pasien.." autocomplete="off">
            @error('alamat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('alamat') }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">No HP <span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                value="{{ old('no_hp', $pasien->no_hp ?? '') }}" placeholder="Koode Pasien.." autocomplete="off">
            @error('no_hp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('no_hp') }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="offset-md-4">
        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-check-double mr-1"></i> Simpan</button>
            <button type="reset" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i> Reset</button>
        </div>
    </div>
</div>
