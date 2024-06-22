@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ $user->name }}</h3></div>

                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <form action = "{{ route(Auth::user()->isAdmin() ? 'admin.userUpdate' : 'userUpdate', ['id' => $user]) }}" method = "POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        @if($user->isDoctor())
                        <div class="row mb-3 justify-content-center">
                            @if(!empty($user->getProfilePath()))
                            <img src="{{ asset('storage/profilePictures/' . $user->id . '/profile.png') }} " alt="Profile photo" style="width: 400px;height: 300px;">
                            @else
                            <img src="{{ url(asset('images/base-profile-img.png')) }}" alt="Profile photo" style="width: 400px;height: 300px;">
                            @endif
                            <div class="col">
                                <input type="file" name="photo" id="photo">
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">{{ __('Nume') }}</label>
                            <div class="col">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value={{ $user->name }} required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label">{{ __('E-mail') }}</label>
                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value={{ $user->email }} required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-3 col-form-label">{{ __('Adresă') }}</label>
                            <div class="col">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value={{ $user->address }} required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-md-3 col-form-label">{{ __('Telefon') }}</label>
                            <div class="col">
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value={{ $user->phone }} required>
                            </div>
                        </div>
                        @if($user->isDoctor())
                        <div class="row mb-3">
                            <label for="bio" class="col-md-3 col-form-label">{{ __('Bio') }}</label>
                            <div class="col">
                                <textarea id="bio" maxlength="1000"class="form-control @error('bio') is-invalid @enderror" name="bio">{{ $user->bio }}</textarea>
                            </div>
                        </div>
                        @endif
                        <button class="btn btn-primary" type="submit">Salvare</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection