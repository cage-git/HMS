<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Room extends Model
{
	protected $guarded = ['id'];
	protected $with = ['room_type', 'attachments'];
	function room_type(){
	 	return $this->hasOne('App\RoomType','id','room_type_id');
	}
	function attachments(){
	 	return $this->hasMany('App\MediaFile','tbl_id','id')->where('type','room_image');
	}
}
