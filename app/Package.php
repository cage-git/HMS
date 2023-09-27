<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
   protected $table = 'package';
    protected $fillable = [
        'id',
        'name',
        'num_user',
        'num_hotels',
        'num_invoices',
        'services',
    ];
}
