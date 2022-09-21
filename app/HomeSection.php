<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $guarded=['id'];
    function banners(){
	 	return $this->hasMany('App\MediaFile','tbl_id','id')->where('type','home_banner')->inRandomOrder();
	}
}
