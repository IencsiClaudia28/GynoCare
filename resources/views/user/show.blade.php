@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3>{{ $user->name }}</h3>
                        </div>
                        <div class="col-3" style="padding-left:40px;">
                            <a href="{{ route(Auth::user()->isAdmin() ? 'admin.userEdit' : 'userEdit', ['id' => $user]) }}"><button class='btn btn-primary'>Editare profil</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="text-align:center;min-height: 50vh">
                    @if($user->isDoctor())
                        @if(!empty($user->getProfilePath()))
                        <img src="{{ asset('storage/profilePictures/' . $user->id . '/profile.png') }} " alt="Profile photo" style="width: 400px;height: 300px;">
                        @else
                        <img src="{{ url(asset('images/base-profile-img.png')) }}" alt="Profile photo" style="width: 400px;height: 300px;">
                        @endif
                    @endif
                    <p>Nume: {{ $user->name }}</p>
                    @if($user->isDoctor())
                    <p>Angajator: {{ $user->employer->name }}</p>
                    <p>Bio: {{ $user->bio }}</p>
                    @endif
                    <p>Telefon: {{ $user->phone }}</p>
                    <p>E-mail: {{ $user->email }}</p>
                    <p>Adresă: {{ $user->address }}</p>
                    @if($user->userType->type != 'ADMIN')
                    <p>Programări: {{ count($user->appointments()) }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection