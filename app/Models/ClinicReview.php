<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'comment',
        'reviewer_id',
        'clinic_id'
    ];

    public function reviewer() {
        return $this->hasOne(User::class, 'id', 'reviewer_id');
    }

    public function clinic() {
        return $this->belongsTo(Clinic::class, 'id', 'clinic_id');
    }
    
}
