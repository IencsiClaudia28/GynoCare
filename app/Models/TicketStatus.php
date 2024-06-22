<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    use HasFactory;

    protected static $TICKET_STATUSES = ['OPEN', 'SOLVED'];

    public static function getAvailableValues(){
        return self::$TICKET_STATUSES;
    }

    protected $fillable = [
        'status'
    ];

    public static function getValues() {
        return self::all()->toArray();
    }

    public static function getOpenValue() {
        $allValues = self::getValues();
        $filteredArr = array_filter($allValues, function ($el) {
            return $el["status"] === 'OPEN';
        });

        return (object)$filteredArr[0];
    }

    public static function getSolvedValue() {
        return self::where(['status' => 'SOLVED'])->first();
        $allValues = self::getValues();
        $filteredArr = array_filter($allValues, function ($el) {
            return $el["status"] === 'SOLVED';
        });

        return (object)$filteredArr[0];
    }
}
