@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <h3>Detalii programare</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <p>Clinică: {{ $appointment->clinic->name }}</p>
                    <p>Medic: {{ !empty($appointment->doctor) ? $appointment->doctor->name : 'Fără preferință' }}</p>
                    <p>Pacient: {{ $appointment->customer->name }}</p>
                    <p>Serviciu: {{ $appointment->service->name }}</p>
                    <p>Cost programare: {{ $appointment->service->price }} RON</p>
                    <p>Data: {{ $appointment->appointment_date->format('Y-m-d H:m') }}</p>
                    <p>Status programare: {{ $appointment->status->status }}</p>
                    @switch($appointment->status->status)
                        @case('COMPLETED')
                            @if(!Auth::user()->isDoctor())
                            <p>Status plata: {{ $appointment->payment->status->status }}</p>
                            @endif
                            <p>Mentiuni: <textarea class="form-control" rows="6" readonly>{{ !empty($appointment->notes) ? $appointment->notes : 'Fără mențiuni' }}</textarea></p>
                            @if($canReviewClinic)
                            <a class="btn btn-primary" href="{{route('clinicReviewsCreate', ['id' => $appointment->clinic->id])}}">Review Clinică</a>
                            @endif
                        @break
                        @case('ACCEPTED')
                            @if(Auth::user()->isDoctor())
                            <form action = "{{ route('appointmentComplete', ['id' => $appointment->id]) }}" method = "POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="notes" class="col-md-3 col-form-label">{{ __('Mențiuni') }}</label>
                                    <div class="col">
                                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="7" required></textarea>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Încheiere programare</button>
                            </form>
                            @endif
                        @break
                        @case('REQUESTED')
                            @if(Auth::user()->isDoctor())
                            <div class="row justify-content-around">
                            <div class="col-2"></div>
                                <div class="col-2">
                                    <form action = "{{ route('appointmentAccept', ['id' => $appointment->id]) }}" method = "POST">
                                        @csrf
                                        <button class="btn btn-primary" type="submit">Acceptă</button>
                                    </form>
                                </div>
                                @can('decline', $appointment)
                                <div class="col-2">
                                    <form action = "{{ route('appointmentDecline', ['id' => $appointment->id]) }}" method = "POST">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Refuză</button>
                                    </form>
                                </div>
                                @endcan
                            <div class="col-2"></div>
                            </div>
                            @endif
                        @break
                    @endswitch
                </div>
            </div>
        </div>
    </div>
</div>
@endsection