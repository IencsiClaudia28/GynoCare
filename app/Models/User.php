<?php

namespace App\Models;

use App\Exceptions\InternalException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Clinic;
use App\Models\Appointment;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Illuminate\Support\Collection;
use Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'user_type_id',
        'clinic_id',
        'bio'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
    ];

    public function customerHasAppointments() { 
        return $this->hasMany(Appointment::class, 'customer_id');
    }

    public function userType() {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }

    public function isAdmin() {
        if($this->userType->type == 'ADMIN')
            return true;

        return false;
    }

    public function isCustomer() {
        if($this->userType->type == 'CUSTOMER')
            return true;

        return false;
    }

    public function isDoctor() {
        if($this->userType->type == 'DOCTOR')
            return true;

        return false;
    }

    public function employer() {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    public function appointments() {


        switch($this->userType->type){
            case 'DOCTOR':
                return $this->doctorAppointments();
            case 'CUSTOMER':
                return $this->customerAppointments();
            case 'ADMIN':
                return Appointment::all();
            default:
                throw new InternalException('Invalid user type', 400);
        }
    }

    public function tickets() {
        switch($this->userType->type){
            case 'ADMIN':
                return $this->adminTickets;
            case 'DOCTOR':
            case 'CUSTOMER':
                return $this->userTickets;
            default:
                throw new InternalException('Invalid user type', 400);
        }
    }

    public function customerPayments() {
        if(!$this->isCustomer())
            throw new InternalException('Invalid user type', 400);

        $payments = [];
        $appointments = $this->appointments();
        foreach($appointments as $appointment)
            if(!empty($appointment->payment))
                $payments[] = $appointment->payment;

        return $payments;
    }

    public function doctorAppointments() {
        return Appointment::where([
            'doctor_id' => $this->id
        ])
        ->where('appointment_status_id', '!=', AppointmentStatus::getRequestedValue()->id)
        ->get();
    }

    public function customerAppointments() {
        $appointments = $this->customerHasAppointments;
        
        return $appointments;
        $appointments = $this->customerHasAppointments;
        
        return $appointments;
    }

    public function appointmentRequests() {
        if($this->userType->type != 'DOCTOR')
            throw new InternalException('Invalid user type', 400);

        return Appointment::where([
            'doctor_id' => null,
            'clinic_id' => $this->clinic_id
        ])->orWhere([
            'doctor_id' => $this->id
        ])->where([
            'appointment_status_id' => AppointmentStatus::getRequestedValue()->id
        ])->get();
    }

    public function adminTickets() {
        return $this->hasMany(Ticket::class, 'solver_id', 'id');
    }

    public function userTickets() {
        return $this->hasMany(Ticket::class, 'reporter_id', 'id');
    }

    public function getEvents() {
        switch($this->userType->type){
            case 'ADMIN':
                return Ticket::where('status_id', '=', TicketStatus::getOpenValue()->id)->take(5)->get();
            case 'CUSTOMER':
            case 'DOCTOR':
                return $this->getIncomingAppointments();
            default:
                return [];
        }
    }

    public function getIncomingAppointments() {
        if($this->userType->type == 'ADMIN')
            throw new InternalException('Invalid user type', 400);

        if($this->userType->type == 'DOCTOR'){
            return $this->doctorAppointments()
            ->where('appointment_status_id', '==', AppointmentStatus::getAcceptedValue()->id);
        }
        else if($this->userType->type == 'CUSTOMER'){
            return $this->customerAppointments()
            ->where('appointment_status_id', '==', AppointmentStatus::getAcceptedValue()->id);
        }

        return [];
    }

    public function getProfilePath() {
        $profilePath = 'public/profilePictures/' . $this->id . '/profile.png';
        if(Storage::disk('local')->exists($profilePath))
            return $profilePath;

        return null;
    }

    public function clinics(){
        return $this->belongsToMany(Clinic::class);
    }
}
