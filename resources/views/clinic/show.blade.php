@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3>{{ $clinic->name }}</h3>
                        </div>
                        @if(Auth::user()->isAdmin())
                        <div class="col-3" style="padding-left:40px;">
                            <a href="{{ route('admin.clinicEdit', ['id' => $clinic->id]) }}"><button class='btn btn-primary'>Editare clinică</button></a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <p>Nume: {{ $clinic->name }}</p>
                    <p>Oraș: {{ $clinic->city->city }}</p>
                    <p>Adresă: {{ $clinic->address }}</p>
                    <p>Link: <a href = "{{ $clinic->link }}" target="_blank">Google maps</a></p>
                    @if(Auth::user()->isAdmin())
                    <p>Homepage: <a href = "{{ $clinic->homepage }}" target="_blank">{{ $clinic->name }}</a></p>
                    <p>Angajați: {{ count($clinic->doctors) }}</p>
                    <p>Programări: {{ count($clinic->appointments) }}</p>
                    @endif
                    <p>Descriere: {{ $clinic->description }}</p>
                    <p>Review-uri: <a href="{{route('clinicReviewsIndex', ['id' => $clinic->id])}}">{{ count($clinic->reviews) }}</a></p></td>
                    @if(Auth::user()->isCustomer())
                        @if($clinic->hasUserSubscribed(Auth::user()))
                        <p>Homepage: <a href = "{{ $clinic->homepage }}" target="_blank">{{ $clinic->name }}</a></p>
                        <form action="{{ route('clinicUnsubscribe', ['id' => $clinic->id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger" type="submit">Dezabonare de la clinică</button>
                        </form>
                        @else
                        <form action="{{ route('clinicSubscribe', ['id' => $clinic->id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary" type="submit">Abonare la clinică</button>
                        </form>
                        @endif
                    @endif
                    <table class="table table-bordered" style="margin-top:20px">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align:center;">Servicii</th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Denumire serviciu</th>
                                <th scope="col">Preț(RON)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serviceCnt = 1;
                            @endphp
                            @foreach($clinic->services as $service)
                                <tr>
                                    <th scope="row">{{ $serviceCnt }}</th>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->price }}</td>
                                </tr>
                                @php
                                    $serviceCnt++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection