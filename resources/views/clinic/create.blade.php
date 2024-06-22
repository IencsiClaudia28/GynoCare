@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Creare clinică</h3></div>

                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <form action="{{ route('admin.clinicStore') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">{{ __('Nume') }}</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="services" class="col-md-3 col-form-label">{{ __('Servicii') }}</label>
                            <div class="col-md-9">
                                <div style="max-height: 150px; overflow-y: auto; border: 1px solid #ccc; padding: 5px; width: 100%;">
                                    <div id="serviceInputs">
                                        <div class="service-input" style="margin-bottom: 5px;">
                                            <input type="text" class="form-control mb-2" name="services[]" placeholder="Nume serviciu" required>
                                            <input type="number" class="form-control" name="prices[]" placeholder="Preț" min="0" required>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary mt-3" onclick="addServiceInput()">Adauga Serviciu</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="city" class="col-md-3 col-form-label">{{ __('Oraș') }}</label>
                            <div class="col-md-9">
                                <select class="form-control" id="city" name="city" required>
                                    @foreach(\App\Models\City::all() as $city)
                                    <option value={{ $city->id }}>{{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-3 col-form-label">{{ __('Adresă') }}</label>
                            <div class="col-md-9">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="link" class="col-md-3 col-form-label">{{ __('Link Maps ') }}</label>
                            <div class="col-md-9">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="homepage" class="col-md-3 col-form-label">{{ __('Homepage ') }}</label>
                            <div class="col-md-9">
                                <input id="homepage" type="text" class="form-control @error('homepage') is-invalid @enderror" name="homepage" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">{{ __('Descriere') }}</label>
                            <div class="col-md-9">
                                <textarea id="description" maxlength="1000" class="form-control @error('description') is-invalid @enderror" name="description" required></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Creează clinică</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    function addServiceInput() {
        const serviceInputs = document.getElementById('serviceInputs');
        const serviceInput = document.createElement('div');
        serviceInput.className = 'service-input';
        serviceInput.style.marginBottom = '5px'; // Adjusted margin
        serviceInput.innerHTML = `
            <input type="text" class="form-control mb-2" name="services[]" placeholder="Nume Serviciu" required>
            <input type="number" class="form-control" name="prices[]" placeholder="Preț" min="0" required>
        `;
        serviceInputs.appendChild(serviceInput);
    }
</script>
@endsection
