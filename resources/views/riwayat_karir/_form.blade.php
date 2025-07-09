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
        <span class="col-form-label text-bold">Sanksi Karyawan</span>
    </div>
    <br>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Dari Posisi<span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <select name="position_id" class="form-control select2 @error('position_id') is-invalid @enderror">
                <option value=""></option>
                @foreach ($posisi as $item)
                    <option value="{{ $item->id }}"
                        {{ $item->id == old('position_id', $riwayat_karir->position_id ?? '') ? 'selected' : '' }}>
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
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Ke Posisi<span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <select name="position_new_id" class="form-control select2 @error('position_new_id') is-invalid @enderror">
                <option value=""></option>
                @foreach ($posisi as $item)
                    <option value="{{ $item->id }}"
                        {{ $item->id == old('position_new_id', $riwayat_karir->position_new_id ?? '') ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
            @error('position_new_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('position_new_id') }}</strong>
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
