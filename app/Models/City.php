<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clinic;

class City extends Model
{
    use HasFactory;

    protected static $CITIES = ['Oradea', 'Timișoara', 'Cluj', 'Constanța', 'Iași', 'Craiova', 'București'];

    public static function getAvailableValues(){
        return self::$CITIES;
    }

    protected $fillable = [
        'city'
    ];

    public static function getValues() {
        return self::all();
    }

    public function clinics() {
        return $this->hasMany(Clinic::class);
    }
}
