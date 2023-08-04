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

        if($val == "ar" || $val == "en" ){
            Setting::updateOrCreate(['name'=>"site_language"], ['value'=>$val, 'updated_at'=>date('Y-m-d h:i:s')]);
        }


        if($val == "dark" || $val == "light" ){
            Setting::updateOrCreate(['name'=>"site_theme"], ['value'=>$val, 'updated_at'=>date('Y-m-d h:i:s')]);
        }


        return redirect()->back();
    }

}
