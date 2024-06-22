<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected static $USER_TYPES = ['ADMIN', 'DOCTOR', 'CUSTOMER'];

    public static function getAvailableValues(){
        return self::$USER_TYPES;
    }

    protected $fillable = [
        'type'
    ];

    public static function getValues() {
        return self::all()->toArray();
    }

    public static function getNonAdminValues() {
        $allValues = self::getValues();
        return array_filter($allValues, function ($el) {
            return $el["type"] !== 'ADMIN';
        });
    }

    public static function getAdminValue() {
        $allValues = self::getValues();
        $filteredArr = array_filter($allValues, function ($el) {
            return $el["type"] === 'ADMIN';
        });

        return (object)$filteredArr[0];
    }
}
