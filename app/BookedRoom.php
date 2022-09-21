<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class BookedRoom extends Model
{
	protected $guarded = ['id'];
	protected $with = ['room','room_type'];
	function room(){
	 	return $this->hasOne('App\Room','id','room_id');
	}
	function room_type(){
	 	return $this->hasOne('App\RoomType','id','room_type_id');
	}
}
