@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <h3>Detalii plată</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="text-align:center;min-height: 50vh">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <p>Pacient: {{ $payment->appointment->customer->name }}</p>
                    <p>Medic: {{ $payment->appointment->doctor->name }}</p>
                    <p>Clinică: {{ $payment->appointment->clinic->name }}</p>
                    <p>Serviciu: {{ $payment->appointment->service->name }}</p>
                    <p>Dată programare: {{ $payment->appointment->updated_at->format('Y-m-d') }}</p>
                    <p>Preț programare: {{ $payment->value }} RON</p>
                    <p>Status plata: {{ $payment->status->status }}</p>
                    @if($payment->status->status == 'DONE')
                    <p>Metoda plata: {{ $payment->method->method }}</p>
                    @endif
                    @can('complete', $payment)
                    <form action = "{{ route('paymentComplete', ['id' => $payment->id]) }}" method = "POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="method" class="col-md-3 col-form-label">{{ __('Metoda') }}</label>
                            <div class="col">
                                <select name="method" id="method" class="form-control" onchange="updatePaymentDetails(this)" required>
                                    <option value="" disabled selected>Alegeti metoda plata</option>
                                    @foreach(App\Models\PaymentMethod::getValues() as $method)
                                        <option value="{{ $method->id }}">{{ $method->method }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="cardDetails" style="padding-top:20px;display:none">
                            <div class="row mb-3">
                                <label for="cardNumber" class="col-md-3 col-form-label">{{ __('Nr. Card') }}</label>
                                <div class="col">
                                    <input id="cardNumber" type="text" class="form-control @error('cardNumber') is-invalid @enderror" name="cardNumber">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="expMonth" class="col-md-3 col-form-label">{{ __('Lună Exp.') }}</label>
                                <div class="col">
                                    <select id="expMonth" class="form-control @error('expMonth') is-invalid @enderror" name="expMonth">
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <label for="expYear" class="col-md-3 col-form-label">{{ __('An Exp.') }}</label>
                                <div class="col">
                                    @php
                                        $currentYear = date('Y');
                                        $endYear = $currentYear + 30;
                                    @endphp
                                    <select id="expYear" class="form-control @error('expYear') is-invalid @enderror" name="expYear">
                                        @for ($year = $currentYear; $year <= $endYear; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                            <label for="cvv" class="col-md-3 col-form-label">{{ __('CVV') }}</label>
                                <div class="col">
                                    <input id="cvv" type="text" class="form-control @error('cvv') is-invalid @enderror" name="cvv">
                                </div>
                            </div>
                        </div>
                        <div id="wireDetails" style="padding-top:20px;display:none">
                            <div class="row mb-3">
                                <label for="country" class="col-md-3 col-form-label">{{ __('Țară') }}</label>
                                <div class="col">
                                    <select id="country" class="form-control @error('country') is-invalid @enderror" name="country">
                                        <option value="RO">Romania</option>
                                        <option value="US">Statele Unite</option>
                                        <option value="GB">Marea Britanie</option>
                                        <option value="DE">Germania</option>
                                    </select>
                                </div>
                                <label for="currency" class="col-md-3 col-form-label">{{ __('Monedă') }}</label>
                                <div class="col">
                                    <select id="currency" class="form-control @error('currency') is-invalid @enderror" name="currency">
                                        <option value="RON">RON</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-3 col-form-label">{{ __('Nume titular') }}</label>
                                <div class="col">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="routingNr" class="col-md-3 col-form-label">{{ __('Număr rutare') }}</label>
                                <div class="col">
                                    <input id="routingNr" type="text" class="form-control @error('routingNr') is-invalid @enderror" name="routingNr">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="accountNr" class="col-md-3 col-form-label">{{ __('Număr cont') }}</label>
                                <div class="col">
                                    <input id="accountNr" type="text" class="form-control @error('accountNr') is-invalid @enderror" name="accountNr">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Completare plată</button>
                    </form>
                    @endcan
                    @can('refund', $payment)
                    <form action = "{{ route('admin.paymentRefund', ['id' => $payment->id]) }}" method = "POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">Restituire plată</button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    const paymentDetails = {
        '1': 'cashDetails',
        '2': 'cardDetails',
        '3': 'wireDetails'
    };

    const paymentDetailsFields = {
        '1': [],
        '2': ['cardNumber', 'expMonth', 'expYear', 'cvv'],
        '3': ['country', 'currency', 'name', 'routingNr', 'accountNr']
    }

    function updatePaymentDetails(select){
        unrequireAllInputs();
        hideAllInputs();
        requireInput(select.value);
        showInput(select.value);
    }

    function unrequireAllInputs(){
        for(const fieldsArr of Object.values(paymentDetailsFields))
            for(const fieldId of fieldsArr)
                document.getElementById(fieldId).required = false;       
    }

    function hideAllInputs(){
        for(const detailsId of Object.values(paymentDetails))
            if(document.getElementById(detailsId))
                document.getElementById(detailsId).style.display = "none";
    }

    function requireInput(methodId){
        for(const fieldId of paymentDetailsFields[methodId])
            document.getElementById(fieldId).required = true;   
    }

    function showInput(methodId){
        if(document.getElementById(paymentDetails[methodId]))
            document.getElementById(paymentDetails[methodId]).style.display = "block";
    }

</script>