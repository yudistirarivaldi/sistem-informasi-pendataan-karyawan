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
        <span class="col-form-label text-bold">Overtime</span>
    </div>
    <br>
    {{-- <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Staff <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <select name="staff_id" class="form-control select2 @error('staff_id') is-invalid @enderror">
                <option value=""></option>
                @foreach ($staff as $item)
                    <option value="{{ $item->id }}" {{ $item->id == old('staff_id', $overtime->staff_id ?? '') ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            @error('staff_id')
                <span class="text-danger" role="alert">
                    {{ $errors->first('staff_id') }}
                </span>
            @enderror
        </div>
    </div> --}}

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Staff <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            @if (Auth::user()->hasRole('admin'))
                <select name="staff_id" class="form-control select2 @error('staff_id') is-invalid @enderror">
                    <option value=""></option>
                    @foreach ($staff as $item)
                        <option value="{{ $item->id }}"
                            {{ $item->id == old('staff_id', $overtime->staff_id ?? '') ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            @else
                <select name="staff_id" class="form-control select2 @error('staff_id') is-invalid @enderror">
                    @foreach ($staff->where('id', Auth::user()->staff->id) as $item)
                        <option value="{{ $item->id }}"
                            {{ $item->id == old('staff_id', $overtime->staff_id ?? '') ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            @endif

            @error('staff_id')
                <span class="text-danger" role="alert">
                    {{ $errors->first('staff_id') }}
                </span>
            @enderror
        </div>
    </div>

    {{-- <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Departement<span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <select name="departement_id" class="form-control select3 @error('departement_id') is-invalid @enderror">
                <option value=""></option>
                @foreach ($departement as $item)
                    <option value="{{ $item->id }}" {{ $item->id == old('departement_id', $overtime->departement_id ?? '') ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            @error('departement_id')
                <span class="text-danger" role="alert">
                    {{ $errors->first('departement_id') }}
                </span>
            @enderror
        </div>
    </div> --}}

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Departement <span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            @if (Auth::user()->hasRole('admin'))
                <select name="departement_id"
                    class="form-control select2 @error('departement_id') is-invalid @enderror">
                    <option value=""></option>
                    @foreach ($departement as $item)
                        <option value="{{ $item->id }}"
                            {{ $item->id == old('departement_id', $overtime->departement_id ?? '') ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            @else
                <select name="departement_id"
                    class="form-control select2 @error('departement_id') is-invalid @enderror">
                    @foreach ($departement->where('id', Auth::user()->staff->departement_id) as $item)
                        <option value="{{ $item->id }}"
                            {{ $item->id == old('departement_id', $overtime->departement_id ?? '') ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            @endif
            @error('departement_id')
                <span class="text-danger" role="alert">
                    {{ $errors->first('departement_id') }}
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Tgl. Lembur <span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="date" name="tgl_overtime" class="form-control @error('tgl_overtime') is-invalid @enderror"
                value="{{ old('tgl_overtime', $overtime->tgl_overtime ?? '') }}" autocomplete="off">
            @error('tgl_overtime')
                <span class="text-danger" role="alert">
                    {{ $errors->first('tgl_overtime') }}
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Waktu Mulai<span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <div class="input-group">
                <input type="time" name="waktu_mulai" class="form-control @error('waktu_mulai') is-invalid @enderror"
                    value="{{ old('waktu_mulai', $overtime->waktu_mulai ?? '') }}" min="0" autocomplete="off"
                    placeholder="0">
                <div class="input-group-append">
                </div>
            </div>
            @error('waktu_mulai')
                <span class="text-danger" role="alert">
                    {{ $errors->first('waktu_mulai') }}
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Waktu Selesai<span
                class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <div class="input-group">
                <input type="time" name="waktu_selesai"
                    class="form-control @error('waktu_selesai') is-invalid @enderror"
                    value="{{ old('waktu_selesai', $overtime->waktu_selesai ?? '') }}" min="0"
                    autocomplete="off" placeholder="0">
                <div class="input-group-append">
                </div>
            </div>
            @error('waktu_selesai')
                <span class="text-danger" role="alert">
                    {{ $errors->first('waktu_selesai') }}
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end"></label>
        <div class="col-12 col-md-5 col-lg-5">
            {{-- <button type="button" class="btn btn-primary" id="updateLocationBtn">Update Lokasi Saat Ini</button> --}}
        </div>
    </div>

    <div class="form-group row">
        {{-- <label class="col-md-4 col-xs-4 col-form-label">Latitude</label> --}}
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" class="form-control" name="latitude" style="display: none;">
            {{-- <input type="text" class="form-control" name="latitude"> --}}
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

<script>
    function updateLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Isi input field latitude dan longitude dalam formulir
                document.querySelector('input[name="latitude"]').value = latitude;
            });
        } else {
            alert("Geolocation tidak didukung di perangkat ini.");
        }
    }

    document.getElementById('updateLocationBtn').addEventListener('click', updateLocation);
</script>
