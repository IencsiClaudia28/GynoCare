<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.userShow', ['id' => Auth::user()->id]) }}">Profil</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.userIndex') }}">Utilizatori</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.clinicIndex') }}">Clinici</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.appointmentIndex') }}">Programări</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.paymentIndex') }}">Plăți</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.ticketIndex') }}">Tichete</a>
</li>