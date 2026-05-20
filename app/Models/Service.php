<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'id_service';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration'
    ];
}