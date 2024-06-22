@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Planificare programare</h3></div>

                <div class="card-body" style="text-align:center;min-height: 50vh">
                    <form action = "{{ route('appointmentStore') }}" method = "POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="clinic" class="col-md-3 col-form-label">{{ __('Clinică') }}</label>
                            <div class="col">
                                <select class="form-control" id="clinic" name="clinic" onchange="updateOptions(this, {{ json_encode($clinicsData) }})" required>
                                    @foreach($clinicsData as $clinicName => $data)
                                        <option value ="{{ $data['clinic']->id }}">{{ $data['clinic']->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="doctor" class="col-md-3 col-form-label">{{ __('Medic') }}</label>
                            <div class="col">
                                <select class="form-control" id="doctor" name="doctor">
                                    <option value ="">Fără preferință de medic</option>
                                    @foreach(reset($clinicsData)['doctors'] as $doctor)
                                        <option value ="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type" class="col-md-3 col-form-label">{{ __('Serviciu') }}</label>
                            <div class="col">
                                <select class="form-control" id="service" name="service" required>
                                    @foreach(reset($clinicsData)['services'] as $service)
                                        <option value ="{{ $service->id }}">{{ $service->name }} - {{$service->price}}RON</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date" class="col-md-3 col-form-label">{{ __('Data programare') }}</label>
                            <div class="col">
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" required>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Planifică programare</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">

    function updateOptions(selectBox, clinics){
        
        let doctorSelectBox = document.getElementById('doctor');
        let servicesSelectBox = document.getElementById('service');

        let selectedClinicName = selectBox.options[selectBox.selectedIndex].text;

        resetOptions(doctorSelectBox);
        resetOptions(servicesSelectBox);

        populateDoctorSelect(doctorSelectBox, clinics[selectedClinicName].doctors);
        populateServiceSelect(servicesSelectBox, clinics[selectedClinicName].services);

    }

    function resetOptions(selectBox){
        while(selectBox.options.length)
            selectBox.remove(0);
    }

    function populateDoctorSelect(selectBox, doctors){
        let noDoctorOption = new Option('Fara preferinta de medic', 0);
        selectBox.add(noDoctorOption);

        for(let doctor of doctors){
            let newOption = new Option(doctor.name, doctor.id);
            selectBox.add(newOption);
        }
    }

    function populateServiceSelect(selectBox, services){
        for(let service of services){
            let newOption = new Option(`${service.name} - ${service.price}RON`, service.id);
            selectBox.add(newOption);
        }
    }

</script>