<div class="card">
    <div class="card-header"><h3>Programări viitoare</h3></div>
    @if(count(Auth::user()->getEvents()))
    <div class="card-body" style="min-height: 50vh">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">Serviciu</th>
                    <th scope="col">Client</th>
                    <th scope="col">Dată programare</th>
                </tr>
            </thead>
            <tbody>
                @foreach(Auth::user()->getEvents() as $appointment)
                <tr>
                    <td><a href = "{{ route('appointmentShow', ['id' => $appointment->id]) }}">{{ $appointment->service->name }}</a></td>
                    <td>{{ $appointment->customer->name }}</td>
                    <td>{{ $appointment->appointment_date->format('Y-m-d H:m') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="card-body align-items-center d-flex justify-content-center" style="min-height: 50vh">
        <h1>Nu aveți programări planificate momentan.</h1>
    </div>
    @endif
</div>