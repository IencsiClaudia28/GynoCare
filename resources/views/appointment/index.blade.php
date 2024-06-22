@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Auth::user()->isDoctor())
            <div class="card" style="margin-bottom:2cm">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-5">
                            <h3>Cereri programare</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body" min-height: 25vh>
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Serviciu</th>
                                <th scope="col">Preț</th>
                                <th scope="col">Status</th>
                                <th scope="col">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointmentRequests as $appointment)
                            <tr>
                                <td><a href = "{{ route('appointmentShow', ['id' => $appointment->id]) }}">{{ $appointment->service->name }}</a></td>
                                <td>{{ $appointment->service->price }}RON</td>
                                <td>{{ $appointment->status->status }}</td>
                                <td>{{ $appointment->appointment_date->format('Y-m-d H:m') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3>Programări</h3>
                        </div>
                        <div class="col-4" style="padding-left:40px;">
                            @if(Auth::user()->isCustomer())
                            <a href="{{ route('appointmentCreate') }}"><button class='btn btn-primary'>Planificare programare</button></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body" min-height: 25vh>
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                @if(Auth::user()->isAdmin())
                                <th scope="col">ID</th>
                                @endif
                                <th scope="col">Clinică</th>
                                <th scope="col">Serviciu</th>
                                <th scope="col">Preț</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                @if(Auth::user()->isAdmin())
                                <td>{{ $appointment->id }}</td>
                                @endif
                                <td>{{ $appointment->clinic->name }}</td>
                                <td><a href = "{{ route(Auth::user()->isAdmin() ? 'admin.appointmentShow' : 'appointmentShow', ['id' => $appointment->id]) }}">{{ $appointment->service->name }}</a></td>
                                <td>{{ $appointment->service->price }}RON</td>
                                <td>{{ $appointment->status->status }}</td>
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


