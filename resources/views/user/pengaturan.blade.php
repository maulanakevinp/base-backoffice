@extends('layouts.master')
@section('title', 'Pengaturan')

@section('content')
    @include('layouts.components.alert')
    @include('layouts.components.breadcrumb', [
        'title' => 'Pengaturan Akun',
        'breadcrumb' => ''
    ])

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pengaturan Akun</h5>
                </div>
                <div class="card-body">
                    <form class="form" action="{{ route('update-pengaturan',auth()->user()) }}" method="post">
                        @csrf @method('patch')
                        <h6 class="heading-small text-muted mb-4">Ubah Email</h6>
                        <div class="pl-lg-4">
                            <p class="mb-3">Biarkan kosong jika tidak ingin mengubah email.</p>
                            <div class="form-group">
                                <label class="form-control-label" for="email_lama">Email Lama</label>
                                <input readonly class="form-control" type="email" placeholder="Email saat ini" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="email_baru">Email Baru</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Masukkan alamat email baru ..." value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <h6 class="heading-small text-muted mb-4">Ubah Username</h6>
                        <div class="pl-lg-4">
                            <p class="mb-3">Biarkan kosong jika tidak ingin mengubah username.</p>
                            <div class="form-group">
                                <label class="form-control-label" for="username_lama">Username Lama</label>
                                <input readonly class="form-control" type="username" placeholder="Username saat ini" value="{{ Auth::user()->username }}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="username_baru">Username Baru</label>
                                <input class="form-control @error('username') is-invalid @enderror" type="username" name="username" id="username" placeholder="Masukkan username baru ..." value="{{ old('username') }}">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <h6 class="heading-small text-muted mb-4">Ubah Password</h6>
                        <div class="pl-lg-4">
                            <p class="mb-3">Biarkan kosong jika tidak ingin mengubah Password.</p>
                            <div class="form-group">
                                <label class="form-control-label" for="password">Password Baru</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Masukkan password baru" value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="password_confirmation">Konfirmasi Password Baru</label>
                                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="Masukkan password baru" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <label class="form-control-label" for="password_lama">Password <span class="text-danger">*</span></label>
                            <input required class="form-control @error('password_lama') is-invalid @enderror" type="password" name="password_lama" id="password_lama" placeholder="Masukkan password">
                            @error('password_lama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
