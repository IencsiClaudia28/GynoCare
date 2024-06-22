@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3>Plăți</h3>
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
                                <th scope="col">Serviciu</th>
                                <th scope="col">Valoare(RON)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Dată</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                @if(Auth::user()->isAdmin())
                                <td>{{ $payment->id }}</td>
                                @endif
                                <td><a href = "{{route(Auth::user()->isAdmin() ? 'admin.paymentShow' : 'paymentShow', ['id' => $payment->id])}}">{{ $payment->appointment->service->name }}</a></td>
                                <td>{{ $payment->value }}</td>
                                <td>{{ $payment->status->status }}</td>
                                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
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