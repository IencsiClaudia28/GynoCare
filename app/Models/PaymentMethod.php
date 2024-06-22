<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected static $PAYMENT_METHODS = ['CASH', 'CARD', 'TRANSFER BANCAR'];

    public static function getAvailableValues(){
        return self::$PAYMENT_METHODS;
    }

    protected $fillable = [
        'method'
    ];

    public static function getValues() {
        return self::all();
    }
}
