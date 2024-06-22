<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Clinic;
use App\Models\AppointmentStatus;
use App\Models\ClinicService;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_date',
        'appointment_status_id',
        'service_id',
        'customer_id',
        'clinic_id',
        'doctor_id',
        'notes'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    public function customer() {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function clinic() {
        return $this->hasOne(Clinic::class, 'id', 'clinic_id');
    }

    public function doctor() {
        return $this->hasOne(User::class, 'id', 'doctor_id');
    }

    public function status() {
        return $this->hasOne(AppointmentStatus::class, 'id', 'appointment_status_id');
    }

    public function service() {
        return $this->hasOne(ClinicService::class, 'id', 'service_id');
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
