@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3>Clinici</h3>
                        </div>
                        <div class="col-3" style="padding-left:40px;">
                            @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.clinicCreate') }}"><button class='btn btn-primary'>Creare clinică</button></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body" style="min-height: 50vh">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                @if(Auth::user()->isAdmin())
                                <th scope="col">ID</th>
                                @endif
                                <th scope="col">Nume</th>
                                <th scope="col">Oraș</th>
                                <th scope="col">Adresă</th>
                                @if(Auth::user()->isAdmin())
                                <th scope="col">Angajați</th>
                                @endif
                                <th scope="col">Review-uri</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clinics as $clinic)
                            <tr>
                                @if(Auth::user()->isAdmin())
                                <td>{{ $clinic->id }}</td>
                                <td><a href = "{{route('admin.clinicShow', ['id' => $clinic->id])}}">{{ $clinic->name }}</a></td>
                                @endif
                                @if(Auth::user()->isCustomer())
                                <th scope="row"><a href = "{{route('clinicShow', ['id' => $clinic->id])}}">{{ $clinic->name }}</a></th>
                                @endif
                                <td>{{ $clinic->city->city }}</td>
                                <td>{{ $clinic->address }}</td>
                                @if(Auth::user()->isAdmin())
                                <td>{{ count($clinic->doctors) }}</td>
                                @endif
                                <td><a href="{{route('clinicReviewsIndex', ['id' => $clinic->id])}}">{{ count($clinic->reviews) }}</a></td>
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


