<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    protected $primaryKey = 'id_service';
    public $incrementing = true;

    protected $fillable = [

        'name',
        'description',
        'price',
        'duration',
        'image',
    ];

    public $timestamps = true;
}
