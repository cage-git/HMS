<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessSettings extends Model
{
    protected $table = 'business_settings';
     protected $fillable = [
    'id',
    'business_id',
    'name',
    'value'
    ];
}
