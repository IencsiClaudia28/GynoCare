<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    use HasFactory;

    protected static $APPOINTMENT_STATUSES = ['REQUESTED', 'ACCEPTED', 'COMPLETED', 'CANCELED'];

    public static function getAvailableValues(){
        return self::$APPOINTMENT_STATUSES;
    }

    protected $fillable = [
        'status'
    ];

    public static function getValues() {
        return self::all()->toArray();
    }

    public static function getRequestedValue() {
        return self::where([
            'status' => 'REQUESTED'
        ])->first();
    }

    public static function getAcceptedValue() {
        return self::where([
            'status' => 'ACCEPTED'
        ])->first();
    }

    public static function getCompletedValue() {
        return self::where([
            'status' => 'COMPLETED'
        ])->first();
    }
}
