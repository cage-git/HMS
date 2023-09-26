<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Business extends Model
{
   protected $table = 'business';
    protected $fillable = [
        'id',
        'business_name',
        'start_date',
        'mobile','country',
        'business_logo',
        'address',
        'user_name',
        'password',
        'package',
        'name'
    ];
    
}
