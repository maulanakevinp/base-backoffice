<div class="card mb-3">
    <div class="card-body d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Data Pribadi</h5>
        <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".data-pribadi-edit" aria-expanded="false" aria-controls="data-pribadi-edit-1 data-pribadi-edit-2">
            <i class="feather icon-edit"></i>
        </button>
    </div>
    <div class="card-body border-top data-pribadi-edit collapse show" id="data-pribadi-edit-1">
        <form>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Nama Lengkap</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->nama }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Tanggal Lahir</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->tanggal_lahir ? tgl($data_pribadi->tanggal_lahir) : '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Status Pernikahan</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->status_pernikahan->nama ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Jenis Kelamin</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->jenis_kelamin->nama ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">NIK</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->nik ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Nama Panggilan</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->nama_panggilan ?? '-' }}
                </div>
            </div>
        </form>
    </div>
    <div class="card-body border-top data-pribadi-edit collapse " id="data-pribadi-edit-2">
        <form class="form" action="{{ route('data-pribadi.update', $data_pribadi) }}" method="POST">
            @csrf @method('put')
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lengkap" value="{{ $data_pribadi->nama }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ $data_pribadi->tanggal_lahir }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Status Pernikahan</label>
                <div class="col-sm-9">
                    <select class="form-control form-select" id="status_pernikahan_id" name="status_pernikahan_id">
                        <option value="">Pilih</option>
                        @foreach (App\Models\StatusPernikahan::all() as $key => $item)
                            <option value="{{ $item->id }}" {{ $data_pribadi->status_pernikahan_id == $item->id ? 'selected="true"' : '' }}>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Jenis Kelamin</label>
                <div class="col-sm-9">
                    <div>
                        @foreach (App\Models\JenisKelamin::all() as $key => $item)
                            <div class="radio radio-primary d-inline">
                                <input type="radio" name="jenis_kelamin_id" id="jenis_kelamin_id{{ $key }}" {{ $data_pribadi->jenis_kelamin_id == $item->id ? 'checked="true"' : '' }} value="{{ $item->id }}">
                                <label for="jenis_kelamin_id{{ $key }}" class="cr">{{ $item->nama }}</label>
                            </div>
                        @endforeach
                    </div>
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">NIK</label>
                <div class="col-sm-9">
                    <input type="text" onkeypress="return hanyaAngka(event)"  class="form-control" name="nik" placeholder="Masukkan NIK" value="{{ $data_pribadi->nik }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Nama Panggilan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama_panggilan" placeholder="Masukkan Nama Panggilan" value="{{ $data_pribadi->nama_panggilan }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
