@extends('layouts.auth')

@section('content')
<div class = "row justify-content-center" style="padding-bottom:40px">
    <h1>Înregistrare</h1>
</div>
<div class="container">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nume') }}</label>

            <div class="col-md-8">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Adresă') }}</label>

            <div class="col-md-8">
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Telefon') }}</label>

            <div class="col-md-8">
                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

            <div class="col-md-8">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmare parolă') }}</label>

            <div class="col-md-8">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-4"></div>
            <a href="{{ route('login'); }}" class="btn btn-warning">Utilizator existent</a>
                <div class="col-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Înregistrare') }}
                </button>
                </div>
            <div class="col-1"></div>
        </div>
    </form>
</div>
@endsection
