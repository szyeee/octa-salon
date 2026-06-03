<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id_reservation';

    protected $fillable = [
        'date',
        'time',
        'status',
        'id_service',
        'id_user'
    ];

    public function service()
    {
        return $this->belongsTo(
            Service::class,
            'id_service',
            'id_service'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }
    public function slots()
    {
        return $this->belongsToMany(
            SlotTime::class,
            'reservation_slots',
            'id_reservation',
            'id_slot',
            'id_reservation',
            'id_slot'
        );
    }

    public function transaction() {
        return $this->hasOne(Transaction::class, 'id_reservation');
    }
}
