@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Auth::user()->isAdmin())
            <div class="card" style="margin-bottom:2cm">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3>Tichete deschise</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="min-height: 25vh">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Titlu</th>
                                <th scope="col">Raportor</th>
                                <th scope="col">Dată</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unresolvedTickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td><a href = "{{ route('admin.ticketShow', ['id' => $ticket->id]) }}">{{ $ticket->title }}</a></td>
                                <td>{{ $ticket->reporter->name }}</td>
                                <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
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
                            <h3>Tichetele mele</h3>
                        </div>
                        <div class="col-3" style="padding-left:40px;">
                            @if(!Auth::user()->isAdmin())
                            <a href="{{ route('ticketCreate') }}"><button class='btn btn-primary'>Tichet nou</button></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body" style="min-height: 25vh">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                @if(Auth::user()->isAdmin())
                                <th scope="col">ID</th>
                                @endif
                                <th scope="col">Titlu</th>
                                <th scope="col">Raportor</th>
                                <th scope="col">Status</th>
                                <th scope="col">Dată</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($belongingTickets as $ticket)
                            <tr>
                                @if(Auth::user()->isAdmin())
                                <td>{{ $ticket->id }}</td>
                                @endif
                                <td><a href = "{{route(Auth::user()->isAdmin()? 'admin.ticketShow' : 'ticketShow', ['id' => $ticket->id])}}">{{ $ticket->title }}</a></td>
                                <td>{{ $ticket->reporter->name }}</td>
                                <td>{{ $ticket->status->status }}</td>
                                <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
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


