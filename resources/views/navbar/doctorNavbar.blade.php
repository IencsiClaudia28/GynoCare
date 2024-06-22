<li class="nav-item">
    <a class="nav-link" href="{{ route('userShow', ['id' => Auth::user()->id]) }}">Profil</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('appointmentIndex') }}">Programări</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('ticketIndex') }}">Tichete</a>
</li>