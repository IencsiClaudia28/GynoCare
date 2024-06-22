@extends('layouts.auth')

@section('content')
<div class = "row justify-content-center" style="padding-bottom:40px">
    <h1>Autentificare</h1>
</div>
<div class="container">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

            <div class="col-md-8">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Parolă') }}</label>

            <div class="col-md-8">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-4"></div>
            <a href="{{ route('register'); }}" class="btn btn-warning">Utilizator nou</a>
                <div class="col-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Conectare') }}
                </button>
                </div>
            <div class="col-2"></div>
        </div>
    </form>
</div>
@endsection
