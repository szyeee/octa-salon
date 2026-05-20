<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'id_service';

    protected $fillable = [

        'name',
        'description',
        'price',
        'duration'

    ];

    public $timestamps = true;
}