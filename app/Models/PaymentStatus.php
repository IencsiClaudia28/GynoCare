<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    protected static $PAYMENT_STATUSES = ['PENDING', 'DONE', 'REFUNDED'];

    public static function getAvailableValues(){
        return self::$PAYMENT_STATUSES;
    }

    protected $fillable = [
        'status'
    ];

    public static function getValues() {
        return self::all();
    }

    public static function getPendingValue() {
        return self::where([
            'status' => 'PENDING'
        ])->first();
    }

    public static function getDoneValue() {
        return self::where([
            'status' => 'DONE'
        ])->first();
    }

    public static function getRefundedValue() {
        return self::where([
            'status' => 'REFUNDED'
        ])->first();
    }
}
