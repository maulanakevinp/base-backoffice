@extends('layouts.master')
@section('title', 'Informasi Umum')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}">
@endsection

@section('content')
    @include('layouts.components.alert')
    @include('layouts.components.breadcrumb', [
        'title' => 'Informasi Umum',
        'breadcrumb' => '
            <li class="breadcrumb-item"><a href="#!">Admin</a></li>
            <li class="breadcrumb-item"><a href="#!">Organisasi</a></li>
        '
    ])

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('informasi-umum.update',$informasi_umum) }}" class="form" method="post">
                        @csrf @method('put')
                        <h6>Informasi Umum</h6>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nama_organisasi">Nama Organisasi</label>
                                <input type="text" class="form-control" name="nama_organisasi" value="{{ $informasi_umum->nama_organisasi }}" placeholder="Masukkan Nama Organisasi">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tax_id">Tax ID</label>
                                <input type="text" class="form-control" name="tax_id" value="{{ $informasi_umum->tax_id }}" placeholder="Masukkan Tax ID">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nomor_registrasi">Nomor Registrasi</label>
                                <input type="text" class="form-control" name="nomor_registrasi" value="{{ $informasi_umum->nomor_registrasi }}" placeholder="Masukkan Nomor Registrasi">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <h6 class="mt-5">Detail Kontak</h6>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control" name="telepon" value="{{ $informasi_umum->telepon }}" placeholder="Masukkan Telepon">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="whatsapp">WhatsApp</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+62</span>
                                    </div>
                                    <input type="text" class="form-control" name="whatsapp" value="{{ $informasi_umum->whatsapp }}" placeholder="Masukkan Nomor WhatsApp">
                                </div>
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" name="fax" value="{{ $informasi_umum->fax }}" placeholder="Masukkan Fax">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $informasi_umum->email }}" placeholder="Masukkan Email">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="{{ $informasi_umum->alamat }}" placeholder="Masukkan Alamat">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" name="kota" value="{{ $informasi_umum->kota }}" placeholder="Masukkan Kota">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="provinsi">Provinsi</label>
                                <input type="text" class="form-control" name="provinsi" value="{{ $informasi_umum->provinsi }}" placeholder="Masukkan Provinsi">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" class="form-control" name="kode_pos" value="{{ $informasi_umum->kode_pos }}" placeholder="Masukkan Kode Pos">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-12">
                                <label for="catatan">Tentang Kami</label>
                                <textarea rows="5" class="form-control" name="tentang_kami" placeholder="Masukkan Tentang Kami">{{ $informasi_umum->tentang_kami }}</textarea>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <h6 class="mt-5">Sosial Media</h6>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="link_facebook">Link Facebook</label>
                                <input type="text" class="form-control" name="link_facebook" value="{{ $informasi_umum->link_facebook }}" placeholder="Masukkan Link Facebook">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="link_instagram">Link Instagram</label>
                                <input type="text" class="form-control" name="link_instagram" value="{{ $informasi_umum->link_instagram }}" placeholder="Masukkan Link Instagram">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="link_youtube">Link Youtube</label>
                                <input type="text" class="form-control" name="link_youtube" value="{{ $informasi_umum->link_youtube }}" placeholder="Masukkan Link Youtube">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="link_twitter">Link Twitter</label>
                                <input type="text" class="form-control" name="link_twitter" value="{{ $informasi_umum->link_twitter }}" placeholder="Masukkan Link Twitter">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="link_maps">Link Maps</label>
                                <textarea rows="5" class="form-control" name="link_maps" placeholder="Masukkan Link Maps">{{ $informasi_umum->link_maps }}</textarea>
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/form.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.form-select').select2({
            placeholder: 'Pilih',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
