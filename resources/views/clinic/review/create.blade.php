@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Postare review</h3></div>

                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <form action = "{{ route('clinicReviewsStore') }}" method = "POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="rate" class="ml-5 pl-1 col-form-label">{{ __('Evaluare') }}</label>
                            <div class="form-group ml-4 pl-5">
                                <select id="rate" name="rate" class="form-control ml-3">
                                    <option value="1">1 Stea</option>
                                    <option value="2">2 Stele</option>
                                    <option value="3">3 Stele</option>
                                    <option value="4">4 Stele</option>
                                    <option value="5">5 Stele</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="comment" class="col-md-3 col-form-label">{{ __('Comentariu') }}</label>
                            <div class="col">
                                <textarea rows="8" id="comment" maxlength="5000"class="form-control @error('comment') is-invalid @enderror" name="comment" required> </textarea>
                            </div>
                        </div>
                        <input id="clinicId" name="clinicId" type="hidden" value="{{$clinicId}}">
                        <button class="btn btn-primary" type="submit">Postează</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection