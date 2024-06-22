@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3>{{ $ticket->title }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <p>Titlu: {{ $ticket->title }}</p>
                    <p>Descriere: {{ $ticket->description }}</p>
                    <p>Reporter: {{ $ticket->reporter->name }}</p>
                    <p>Status: {{ $ticket->status->status }}</p>
                    @if($ticket->isSolved())
                    <p>Concluzie: {{ $ticket->resolution }}</p>
                    <p>Solutionat de catre: {{ $ticket->solver->name }}</p>
                    @endif
                    @if(Auth::user()->isAdmin() && !$ticket->isSolved())
                    <form action = "{{ route('admin.ticketUpdate', ['id' => $ticket->id]) }}" method = "POST">
                        @method('patch')
                        @csrf
                        <div class="row mb-3">
                            <label for="resolution" class="col-md-3 col-form-label">{{ __('Resolution') }}</label>
                            <div class="col">
                                <textarea rows="3" id="resolution" maxlength="5000" class="form-control @error('resolution') is-invalid @enderror" name="resolution" required> </textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Mark as solved</button>
                    </form>
                    @endif  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection