<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Interfaces\PaymentServiceInterface;
use Auth;

class PaymentController extends Controller
{
    protected PaymentServiceInterface $paymentService;

    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->middleware('auth');

        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $this->authorize('viewAny', Payment::class);

        if(Auth::user()->isAdmin())
            $payments = Payment::all();
        else
            $payments = Auth::user()->customerPayments();

        return view('payment.index', ['payments' => $payments]);
    }

    public function show(Payment $id)
    {
        $this->authorize('view', $id, Payment::class);

        return view('payment.show', ['payment' => $id]);
    }

    public function complete(Payment $id, Request $req)
    {
        $this->authorize('complete', $id, Payment::class);

        if($req->input('method') == '2') {
            $isvalid = $this->paymentService->validateCard([
                'card_number' => $req->cardNumber,
                'exp_month' => $req->expMonth,
                'exp_year' => $req->expYear,
                'cvc' => $req->cvv
            ]);

            if(empty($isvalid))
                return redirect()
                ->route('paymentShow', ['id' => $id->id])
                ->with('error', 'Datele cardului sunt eronate');
        }

        if($req->input('method') == '3') {
            $isvalid = $this->paymentService->validateBankAccount([
                'country' => $req->country,
                'currency' => $req->currency,
                'account_holder_name' => $req->name,
                'account_holder_type' => 'individual',
                'routing_number' => $req->routingNr,
                'account_number' => $req->accountNr
            ]);

            if(empty($isvalid))
                return redirect()
                ->route('paymentShow', ['id' => $id->id])
                ->with('error', 'Datele contului bancar sunt eronate');
        }

        Payment::where([
            'id' => $id->id
        ])->update([
            'payment_method_id' => $req->input('method'),
            'payment_status_id' => PaymentStatus::getDoneValue()->id
        ]);

        return redirect()->route('paymentShow', ['id' => $id->id]);
    }

    public function refund(Payment $id)
    {
        $this->authorize('refund', $id, Payment::class);

        Payment::where([
            'id' => $id->id
        ])->update([
            'payment_status_id' => PaymentStatus::getRefundedValue()->id
        ]);

        return redirect()->route('admin.paymentShow', ['id' => $id->id]);
    }
}
