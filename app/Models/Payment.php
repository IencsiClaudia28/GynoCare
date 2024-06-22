<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;
use App\Models\PaymentStatus;
use App\Models\PaymentMethod;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_status_id',
        'payment_method_id',
        'value',
        'appointment_id'
    ];

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

    public function status() {
        return $this->hasOne(PaymentStatus::class, 'id', 'payment_status_id');
    }

    public function method() {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }
}
