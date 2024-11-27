<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LaundryItem extends Model
{
	protected $guarded = ['id'];
	function vendor_info(){
        return $this->hasOne('App\Vendor','id','vendor_id');
    }
}
