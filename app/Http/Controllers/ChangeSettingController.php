<?php

namespace App\Http\Controllers;
use Auth,DB,Hash;
use App\Setting;
use Session;

class ChangeSettingController extends Controller
{
    private $paginate=10;
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);

    }

    public function changeSetting($val) {
        $userRoleId = Auth::user()->role_id; 
        if(in_array($userRoleId,config("business_roles.business_roles"))){
            if($val == "ar" || $val == "en" ){
            Setting::updateOrCreate(['name'=>"site_language",'business_id'=>Auth::user()->business_id], ['value'=>$val, 'updated_at'=>date('Y-m-d h:i:s')]);
            }
        }else{
            if($val == "ar" || $val == "en" ){
            Setting::updateOrCreate(['name'=>"site_language"], ['value'=>$val, 'updated_at'=>date('Y-m-d h:i:s')]);
            }
        }
        
        if(in_array($userRoleId,config("business_roles.business_roles"))){
            if($val == "dark" || $val == "light" ){
                Setting::updateOrCreate(['name'=>"site_theme",'business_id'=>Auth::user()->business_id], ['value'=>$val, 'updated_at'=>date('Y-m-d h:i:s')]);
            }
        }else{
            if($val == "dark" || $val == "light" ){
                Setting::updateOrCreate(['name'=>"site_theme"], ['value'=>$val, 'updated_at'=>date('Y-m-d h:i:s')]);
            }
        }


        return redirect()->back();
    }

}
