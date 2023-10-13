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
        <span class="col-form-label text-bold">Mutasi Karyawan</span>
    </div>
    <br>
    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Staff <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <select name="staff_id" class="form-control select2 @error('staff_id') is-invalid @enderror">
                <option value=""></option>
                @foreach ($staff as $item)
                    <option value="{{ $item->id }}"
                        {{ $item->id == old('staff_id', $mutasi->staff_id ?? '') ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
            @error('staff_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('staff_id') }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Posisi <span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <select name="position_id" class="form-control select2 @error('position_id') is-invalid @enderror">
                <option value=""></option>
                @foreach ($posisi as $item)
                    <option value="{{ $item->id }}"
                        {{ $item->id == old('position_id', $mutasi->position_id ?? '') ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
            @error('position_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('position_id') }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Keterangan <span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                placeholder="Masukan keterangan..">{{ old('keterangan', $mutasi->keterangan ?? '') }}</textarea>
            @error('keterangan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('keterangan') }}</strong>
                </span>
            @enderror
        </div>
    </div>

   <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Dari Kantor <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" name="dari" class="form-control @error('dari') is-invalid @enderror" value="{{ old('dari', $mutasi->dari ?? '') }}" placeholder="Dari Kantor.." autocomplete="off">
            @error('dari')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dari') }}</strong>
                </span>
            @enderror
        </div>
    </div>

   <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Ke Kantor <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" name="ke" class="form-control @error('ke') is-invalid @enderror" value="{{ old('ke', $mutasi->ke ?? '') }}" placeholder="Tujuan Kantor.." autocomplete="off">
            @error('ke')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ke') }}</strong>
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
