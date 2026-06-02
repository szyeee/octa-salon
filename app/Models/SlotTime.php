<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotTime extends Model
{
    use HasFactory;
    protected $table = 'slot_times';
    protected $primaryKey = 'id_slot';

    protected $fillable = [
        'date',
        'start_time',
        'done_time',
        'status',
    ];

    public function reservations()
    {

        return $this->belongsToMany(
            Reservation::class,
            'reservation_slots',
            'id_slot',
            'id_reservation'
        );
    }
}
