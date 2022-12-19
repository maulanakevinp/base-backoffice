<div class="card">
    <div class="card-body d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Detail Kontak</h5>
        <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".data-detail-kontak-edit" aria-expanded="false" aria-controls="data-detail-kontak-edit-1 data-detail-kontak-edit-2">
            <i class="feather icon-edit"></i>
        </button>
    </div>
    <div class="card-body border-top data-detail-kontak-edit collapse show" id="data-detail-kontak-edit-1">
        <form>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Alamat</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->detail_kontak->alamat ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Kota</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->detail_kontak->kota ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Provinsi</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->detail_kontak->provinsi ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Kode Pos</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->detail_kontak->kode_pos ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Telepon Rumah</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->detail_kontak->telepon_rumah ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Telepon Seluler</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->detail_kontak->telepon_seluler ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Telepon Kerja</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->detail_kontak->telepon_kerja ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Email Kerja</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->detail_kontak->email_kerja ?? '-' }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 font-weight-bolder">Email Lain</label>
                <div class="col-sm-9">
                    {{ $data_pribadi->detail_kontak->email_lain ?? '-' }}
                </div>
            </div>
        </form>
    </div>
    <div class="card-body border-top data-detail-kontak-edit collapse " id="data-detail-kontak-edit-2">
        <form class="form" action="{{ route('detail-kontak.update', $data_pribadi->detail_kontak) }}" method="POST">
            @csrf @method('put')
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Alamat</label>
                <div class="col-sm-9">
                    <textarea type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat">{{ $data_pribadi->detail_kontak->alamat }}</textarea>
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Kota</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="kota" id="kota" placeholder="Masukkan Kota" value="{{ $data_pribadi->detail_kontak->kota }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Provinsi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="provinsi" id="provinsi" placeholder="Masukkan Provinsi" value="{{ $data_pribadi->detail_kontak->provinsi }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Kode Pos</label>
                <div class="col-sm-9">
                    <input type="text" onkeypress="return hanyaAngka(event);" class="form-control" name="kode_pos" id="kode_pos" placeholder="Masukkan Kode Pos" value="{{ $data_pribadi->detail_kontak->kode_pos }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Telepon Rumah</label>
                <div class="col-sm-9">
                    <input type="tel" class="form-control" name="telepon_rumah" id="telepon_rumah" placeholder="Masukkan Telepon Rumah" value="{{ $data_pribadi->detail_kontak->telepon_rumah }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Telepon Seluler</label>
                <div class="col-sm-9">
                    <input type="tel" class="form-control" name="telepon_seluler" id="telepon_seluler" placeholder="Masukkan Telepon Seluler" value="{{ $data_pribadi->detail_kontak->telepon_seluler }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Telepon Kerja</label>
                <div class="col-sm-9">
                    <input type="tel" class="form-control" name="telepon_kerja" id="telepon_kerja" placeholder="Masukkan Telepon Kerja" value="{{ $data_pribadi->detail_kontak->telepon_kerja }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Email Kerja</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email_kerja" id="email_kerja" placeholder="Masukkan Email Kerja" value="{{ $data_pribadi->detail_kontak->email_kerja }}">
                    <span class="invalid-feedback"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Email Lain</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email_lain" id="email_lain" placeholder="Masukkan Email Lain" value="{{ $data_pribadi->detail_kontak->email_lain }}">
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
