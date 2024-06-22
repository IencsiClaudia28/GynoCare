@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Creare tichet</h3></div>

                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <form action = "{{ route('ticketStore') }}" method = "POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label">{{ __('Titlu') }}</label>
                            <div class="col">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">{{ __('Descriere') }}</label>
                            <div class="col">
                                <textarea rows="8" id="description" maxlength="5000"class="form-control @error('address') is-invalid @enderror" name="description" required> </textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Creare tichet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection