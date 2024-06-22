@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3>Utilizatori</h3>
                        </div>
                        <div class="col-3" style="padding-left:40px;">
                            <a href="{{ route('admin.userCreate') }}"><button class='btn btn-primary'>Creare utilizator</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="min-height: 50vh">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nume</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Tip utilizator</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td><a href = "{{route('admin.userShow', ['id' => $user->id])}}">{{ $user->name }}</a></td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->userType->type }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


