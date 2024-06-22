@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @switch(Auth::user()->userType->type)
                @case('ADMIN')
                    @include('events.open-tickets')
                    @break;
                @case('DOCTOR')
                @case('CUSTOMER')
                    @include('events.upcoming-appointments')
                    @break;
            @endswitch
        </div>
    </div>
</div>
@endsection