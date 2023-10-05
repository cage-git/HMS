<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Business;
use Session;
class LoginController extends Controller {
    private $core;
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
    }
    public function adminLogin() {
        //set settings in session
        setSettings();
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('backend/login');
    }
    public function doLogin(Request $request) {
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password, 'status' => 1])) {
            if(Auth::user()->role_id == 8){
                 $busienssData = Business::where('id',Auth::user()->business_id)->first();
                 $SubscriotionStartDate = $busienssData['start_date'];
                 $SubscriotionEndDate   = $busienssData['end_date'];
                 $today= date('Y-m-d');
                 
                 if($SubscriotionStartDate <= $today && $SubscriotionEndDate >=$today){
                    $this->core->syncUserAndCustomer();
                    return redirect()->route('dashboard')->with(['success' => config('constants.FLASH_SUCCESS_LOGIN')]);
                 }else{
                     Auth::logout();
                    if($SubscriotionStartDate > $today){
                        return redirect()->back()->with(['error' => config('constants.FLASH_START_DATE')]);

                    }
                    if($SubscriotionEndDate < $today){
                   
                        return redirect()->back()->with(['error' => config('constants.FLASH_END_DATE')]);
                    }
                     
                    
                 }
                 
            }
            //sync user and customer
            $this->core->syncUserAndCustomer();
            return redirect()->route('dashboard')->with(['success' => config('constants.FLASH_SUCCESS_LOGIN')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_INVALID_CREDENTIAL')]);
    }
    public function logout(Request $request) {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
