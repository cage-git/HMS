<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class PaymentHistory extends Model
{
	protected $table = 'payment_history';
	protected $guarded = ['id'];
	protected $with = ['user','customer'];
	function addedByInfo(){
	 	return $this->hasOne('App\User','id','added_by');
	}
	function user(){
	 	return $this->hasOne('App\User','id','user_id');
	}
	function customer(){
	 	return $this->hasOne('App\Customer','id','customer_id');
	}
    function reservation(){
        return $this->hasOne('App\Reservation','id','tbl_id');
    }
}
