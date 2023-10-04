<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessPermission extends Model
{
    protected $table = 'business_permissions';
    protected $fillable = [
        'id',
        'parent_id',
        'business_id',
        'description',
        'slug',
        'category',
        'admin',
        'receptionist',
        'store_manager',
        'financial_manager',
        'customer',
        'housekeeper'
    ];
}
