<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Clinic;
use App\Models\ClinicReview;
use App\Models\Payment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\PaymentStatus;
use App\Models\AppointmentStatus;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('viewAny', Appointment::class);

        $appointments = Auth::user()->appointments();
        $appointmentRequests = Auth::user()->isDoctor() ? Auth::user()->appointmentRequests() : [];

        return view('appointment.index', ['appointments' => $appointments, 'appointmentRequests' => $appointmentRequests]);
    }

    public function show(Appointment $id)
    {
        $this->authorize('view', $id, Appointment::class);

        $user = Auth::user();
        $canReviewClinic = false;

        if($user->isCustomer()){

            $appointmentClinic = $id->clinic;

            $customerHasClinicReview = count(ClinicReview::where([
                'clinic_id' => $appointmentClinic->id,
                'reviewer_id' => $user->id
            ])->get()) >= 1;

            if($customerHasClinicReview === false)
                $canReviewClinic = true;
        };

        return view('appointment.show', [
            'appointment' => $id,
            'canReviewClinic' => $canReviewClinic
        ]); 
    }

    public function create()
    {
        $this->authorize('create', Appointment::class);



        $clinics = Clinic::all();
        $clinicsData = [];

        foreach($clinics as $clinic) {
            $clinicsData[$clinic->name] = [
                'clinic' => $clinic,
                'doctors' => $clinic->doctors,
                'services' => $clinic->services
            ];
        };
        
        return view('appointment.create', [ 'clinicsData' => $clinicsData ]);
    }

    public function store(Request $req)
    {

        $this->authorize('store', Appointment::class);

        $validator = Validator::make($req->all(), [
            'date' => 'required|date|after:today'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAppointment = Appointment::create([
            'appointment_date' => $req->date,
            'service_id' => $req->service,
            'appointment_status_id' => AppointmentStatus::getRequestedValue()->id,
            'clinic_id' => $req->clinic,
            'customer_id' => auth()->user()->id,
            'doctor_id' => !empty($req->doctor) ? $req->doctor : null,
            'notes' => null
        ]);

        return redirect()->route('appointmentShow', ['id' => $newAppointment->id]);
    }

    public function accept(Appointment $id)
    {
        $this->authorize('accept', $id, Appointment::class);

        Appointment::where([
            'id' => $id->id
        ])->update([
            'appointment_status_id' => AppointmentStatus::getAcceptedValue()->id,
            'doctor_id' => Auth::user()->id
        ]);

        return redirect()->route('appointmentIndex');
    }

    public function decline(Appointment $id)
    {
        $this->authorize('decline', $id, Appointment::class);

        Appointment::where([
            'id' => $id->id
        ])->update([
            'doctor_id' => null
        ]);

        return redirect()->route('appointmentIndex');
    }

    public function complete(Request $req, Appointment $id)
    {
        $this->authorize('complete', $id, Appointment::class);

        Appointment::where([
            'id' => $id->id
        ])->update([
            'appointment_status_id' => AppointmentStatus::getCompletedValue()->id,
            'notes' => $req->notes
        ]);

        Payment::create([
            'appointment_id' => $id->id,
            'value' => $id->service->price,
            'payment_status_id' => PaymentStatus::getPendingValue()->id
        ]);

        return redirect()->route('appointmentShow', ['id' => $id->id]);
    }
}
