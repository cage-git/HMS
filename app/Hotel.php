<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
     protected $table = 'hotel';
    protected $fillable = [
        'id',
        'business_id',
        'name',
        'location_id',
        'landmark',
        'zipcode',
        'address',
        'status'
    ];
}
