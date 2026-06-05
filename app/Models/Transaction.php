<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaction';

    protected $fillable = [
        'id_reservation',
        'customer_name',
        'total_price',
        'status',
        'amount_paid', 
    ];

    public function transactionDetails() 
    {
        return $this->hasMany(TransactionDetail::class, 'id_transaction', 'id_transaction');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'id_reservation');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'id_transaction');
    }
}
