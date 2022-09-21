<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class RoomType extends Model
{
	protected $guarded = ['id'];
	protected $with = ['attachments'];
	function rooms(){
	 	return $this->hasMany('App\Room','room_type_id','id')->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC');
	}
	function attachments(){
	 	return $this->hasMany('App\MediaFile','tbl_id','id')->where('type','room_type_image');
	}
}
