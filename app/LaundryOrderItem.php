<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LaundryOrderItem extends Model
{
	protected $guarded = ['id'];
	protected $with = ['item_info'];
    function item_info(){
	 	return $this->hasOne('App\LaundryItem','id','item_id');
	}
}
