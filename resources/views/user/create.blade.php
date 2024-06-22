@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Creare utilizator</h3></div>

                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <form action = "{{ route('admin.userStore') }}" method = "POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">{{ __('Nume') }}</label>
                            <div class="col">
                                <input id="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label">{{ __('E-mail') }}</label>
                            <div class="col">
                                <input id="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-3 col-form-label">{{ __('Adresă') }}</label>
                            <div class="col">
                                <input id="address" type="text" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" name="address" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">{{ __('Telefon') }}</label>
                            <div class="col">
                                <input id="phone" type="tel" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" name="phone" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">{{ __('Parolă') }}</label>
                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">{{ __('Tip utilizator') }}</label>
                            <div class="col">
                                <select class="form-control" id="userType" name="userType" onchange="showDoctorDivs(this)" required>
                                    @foreach(\App\Models\UserType::getValues() as $userType)
                                        @if($userType['type'] != 'CUSTOMER')
                                        <option value ={{ $userType['id'] }}>{{ $userType['type'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="employerDiv" class="row mb-3" style="visibility:hidden">
                            <label for="employer" class="col-md-3 col-form-label">{{ __('Angajator') }}</label>
                            <div class="col">
                                <select class="form-control" id="employer" name="employer">
                                    @foreach(\App\Models\Clinic::all() as $clinic)
                                        <option value ={{ $clinic['id'] }}>{{ $clinic['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="bioDiv" class="row mb-3" style="visibility:hidden">
                            <label for="bio" class="col-md-3 col-form-label">{{ __('Bio') }}</label>
                            <div class="col">
                                <textarea id="bio" maxlength="1000"class="form-control @error('bio') is-invalid @enderror" name="bio"> </textarea>
                            </div>
                        </div>
                        <div id="photoDiv" class="row mb-3" style="visibility:hidden">
                            <label for="photo" class="col-md-3 col-form-label">{{ __('Photo') }}</label>
                            <div class="col">
                                <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Creare utilizator</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    function showDoctorDivs(select){
        if(select.value == 2){
            document.getElementById('employerDiv').style.visibility = "visible";
            document.getElementById('bioDiv').style.visibility = "visible";
            document.getElementById('photoDiv').style.visibility = "visible";
        }
        else{
            document.getElementById('employerDiv').style.visibility = "hidden";
            document.getElementById('bioDiv').style.visibility = "hidden";
            document.getElementById('photoDiv').style.visibility = "hidden";
        }
    } 
</script>