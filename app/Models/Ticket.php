<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TicketStatus;
use App\Models\User;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'resolution',
        'reporter_id',
        'status_id',
        'solver_id'
    ];

    public function reporter(){
        return $this->hasOne(User::class, 'id', 'reporter_id');
    }

    public function solver(){
        return $this->hasOne(User::class, 'id', 'solver_id');
    }

    public function status(){
        return $this->hasOne(TicketStatus::class, 'id', 'status_id');
    }

    public function isSolved(){
        return $this->status->status == 'SOLVED';
    }

    public static function getOpen(){
        return self::where([
            'status_id' => TicketStatus::getOpenValue()->id
        ])->get();
    }
}
