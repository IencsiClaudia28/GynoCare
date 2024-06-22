<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\Appointment;
use App\Models\ClinicReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ClinicService;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
        'address',
        'description',
        'link',
        'homepage'
    ];

    public function doctors(){
        return $this->hasMany(User::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function reviews(){ 
        return $this->hasMany(ClinicReview::class, 'clinic_id');
    }

    public function services(){ 
        return $this->hasMany(ClinicService::class, 'clinic_id');
    }
    
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function hasUserSubscribed(User $u){
        $users = $this->users;
        foreach($users as $user){
            if($user->id == $u->id)
                return true;
        }

        return false;
    }
}
