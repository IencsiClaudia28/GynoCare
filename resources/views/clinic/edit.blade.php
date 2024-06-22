@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Editare Clinică</h3></div>

                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <form action="{{ route('admin.clinicUpdate', ['id' => $clinic->id]) }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">{{ __('Nume') }}</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $clinic->name }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="services" class="col-md-3 col-form-label">{{ __('Servicii') }}</label>
                            <div class="col-md-9">
                                <div style="max-height: 150px; overflow-y: auto; border: 1px solid #ccc; padding: 5px; width: 100%;">
                                    <div id="serviceInputs">
                                        @foreach($clinic->services as $index => $service)
                                        <div class="service-input mb-2" style="position: relative; border: 2px solid #ccc; border-radius: 10px;">
                                            <div>
                                                <button type="button" class="btn btn-danger btn-sm close-btn mt-2" onclick="removeServiceInput(this)">X</button>
                                            </div>
                                            <div>
                                                <input type="text" class="form-control mb-1" name="services[]" value="{{ $service->name }}" placeholder="Nume serviciu" required>
                                                <input type="number" class="form-control" name="prices[]" value="{{ $service->price }}" placeholder="Preț" min="0" required>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary mt-3" onclick="addServiceInput()">Adaugă serviciu</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="city" class="col-md-3 col-form-label">{{ __('Oraș') }}</label>
                            <div class="col-md-9">
                                <select class="form-control" id="city" name="city" required>
                                    @foreach(\App\Models\City::all() as $city)
                                    <option value="{{ $city->id }}" {{ $clinic->city_id == $city->id ? 'selected' : '' }}>{{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-3 col-form-label">{{ __('Adresă') }}</label>
                            <div class="col-md-9">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $clinic->address }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="link" class="col-md-3 col-form-label">{{ __('Link Maps') }}</label>
                            <div class="col-md-9">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ $clinic->link }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="homepage" class="col-md-3 col-form-label">{{ __('Homepage') }}</label>
                            <div class="col-md-9">
                                <input id="homepage" type="text" class="form-control @error('homepage') is-invalid @enderror" name="homepage" value="{{ $clinic->homepage }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">{{ __('Descriere') }}</label>
                            <div class="col-md-9">
                                <textarea id="description" maxlength="1000" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ $clinic->description }}</textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Modificare clinică</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .close-btn {
        position: absolute;
        left: 96%;
        width: 25px;
        transform: translate(-50%, -50%);
        font-size: 0.65rem;
        padding: 0.4rem;
        border-radius: 100%;
        background-color: #dc3545;
        color: #fff;
        border: none;
    }
</style>

<script>
    function addServiceInput() {
        const serviceInputs = document.getElementById('serviceInputs');
        const serviceInput = document.createElement('div');
        serviceInput.className = 'service-input mb-2';
        serviceInput.style.position = 'relative';
        serviceInput.style.border = '2px solid #ccc';
        serviceInput.style.borderRadius = '10px';
        serviceInput.innerHTML = `
            <div>
                <button type="button" class="btn btn-danger btn-sm close-btn mt-2" onclick="removeServiceInput(this)">X</button>
            </div>
            <div>
                <input type="text" class="form-control mb-1" name="services[]" placeholder="Service Name" required>
                <input type="number" class="form-control" name="prices[]" placeholder="Price" min="0" required>
            </div>
        `;
        serviceInputs.appendChild(serviceInput);
    }

    function removeServiceInput(button) {

        const serviceContainerNumberOfChildrens = document.getElementById('serviceInputs').children.length;
        console.log(serviceContainerNumberOfChildrens);

        if(serviceContainerNumberOfChildrens > 1){
            const serviceInput = button.parentNode.parentNode;
            serviceInput.parentNode.removeChild(serviceInput);
        };

    }
</script>
@endsection
