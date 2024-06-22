<div class="card">
    <div class="card-header"><h3>Tichete deschise</h3></div>
    @if(count(Auth::user()->getEvents()))
    <div class="card-body" style="min-height: 50vh">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titlu</th>
                    <th scope="col">Raportor</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach(Auth::user()->getEvents() as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td><a href = "{{ route('admin.ticketShow', ['id' => $ticket->id]) }}">{{ $ticket->title }}</a></td>
                    <td>{{ $ticket->reporter->name }}</td>
                    <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="card-body align-items-center d-flex justify-content-center" style="min-height: 50vh">
        <h1>Nu există tichete deschise momentan.</h1>
    </div>
    @endif
</div>