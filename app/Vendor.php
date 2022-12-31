<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Vendor extends Model
{
	protected $guarded = ['id'];
	function category(){
	 	return $this->hasOne('App\VendorCategory','id','category_id')->where('is_deleted', 0);
	}
	function country(){
	 	return $this->hasOne('App\Country','id','vendor_country');
	}
}
