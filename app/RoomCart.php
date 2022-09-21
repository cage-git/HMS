<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class RoomCart extends Model
{
	protected $guarded=['id'];
	protected $with=['room'];
	function room(){
	 	return $this->hasOne('App\Room','id','room_id');
	}
}
