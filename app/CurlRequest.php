<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class CurlRequest extends Model
{
	protected $guarded = ['id'];
	protected $with = ['reservation'];
	function reservation(){
	 	return $this->belongsTo('App\Reservation','reservation_id');
	}
}
