<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaction_detail';

    protected $fillable = [
        'id_transaction',
        'id_service',
        'quantity',
        'price_at_purchase',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
}
