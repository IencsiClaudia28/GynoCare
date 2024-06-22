@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3>Review-uri</h3>
                        </div>
                        <div class="col-3" style="padding-left:40px;">
                        </div>
                    </div>
                </div>
                <div class="card-body" style="min-height: 50vh">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                @if(Auth::user()->isAdmin())
                                <th scope="col">Id</th>
                                @endif
                                <th scope="col">Client</th>
                                <th scope="col">Evaluare</th>
                                <th scope="col">Comentariu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clinicReviews as $clinicReview)
                                <tr>
                                    @if(Auth::user()->isAdmin())
                                        <td>{{ $clinicReview->id }}</td>
                                    @endif
                                    @if(Auth::user()->isAdmin())
                                        <td><a href="{{route('admin.userShow', ['id' => $clinicReview->reviewer->id])}}">{{ $clinicReview->reviewer->name}}</a></td>
                                    @else 
                                        <td>{{ $clinicReview->reviewer->name}}</td>
                                    @endif

                                    <td>{{ $clinicReview->rate }}</td>
                                    <td>{{ $clinicReview->comment }}</td>
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


