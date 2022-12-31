<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class HousekeepingOrder extends Model
{
	protected $guarded = ['id'];
	protected $with = ['housekeeper','room_info', 'housekeeping_status'];
	function housekeeper(){
        return $this->hasOne('App\User','id','housekeeper_id');
    }
    function room_info(){
        return $this->hasOne('App\Room','id','room_id');
    }
    function housekeeping_status(){
        return $this->hasOne('App\DynamicDropdown','id','housekeeping_status_id');
    }
}
