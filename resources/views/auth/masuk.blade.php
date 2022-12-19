@extends('layouts.master')
@section('title', 'Login')

@section('content')
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="card-body">
                        <div class="text-center">
                            <a href="{{ url('/') }}"><img src="{{ asset('assets/images/72x72.png') }}" alt=""></a>
                        </div>
                        <form action="{{ route('masuk') }}" method="post">
                            @csrf
                            {{-- <img src="assets/images/logo-dark.png" alt="" class="img-fluid mb-4"> --}}
                            <a href="{{ url('/') }}"><h4 class="mb-3 f-w-900 text-center">{{ config('app.name') }}</h4></a>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                </div>
                                <input autofocus type="text" name="username" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username/Email" value="{{ old('username') }}">
                                @if ($errors->has('username') || $errors->has('email'))
                                    <span class="error small form-text invalid-feedback">{{ $errors->first('username') ?: $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}">
                                @error('password') <span class="error small form-text invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="checkbox checkbox-fill">
                                <input name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label for="customCheckLogin" class="cr">{{ __('Ingat Saya') }}</label>
                            </div>
                            <button class="btn btn-block btn-primary mb-4">Masuk</button>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
