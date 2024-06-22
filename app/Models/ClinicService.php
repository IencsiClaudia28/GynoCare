<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClinicService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'clinic_id'
    ];

    public function clinic() {
        $this->belongsTo(Clinic::class, 'id', 'clinic_id');
    }

}
