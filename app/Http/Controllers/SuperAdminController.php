<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use Auth,DB,Hash;

class SuperAdminController extends Controller
{

    
    public function addBusiness(){
           return view('backend/super_admin/add_business');
    }
    public function addPackage(){
        return view('backend/super_admin/add_package');
    }
    public function allPackages(){
        return view('backend/super_admin/all_package');
    }
    public function allBusiness(){
        return view('backend/super_admin/all_business');
    }
     public function saveBusiness(Request $request){
        $data = $request->all();
        return Business::create([
      'business_name' => $data['business_name'],
      'start_date' => $data['start_date'],
      'mobile' => $data['mobile_num'],
      'country' => $data['country'],
      'address' => $data['address'],
      'business_logo' => $data['business_logo'],
      'user_name' => $data['business_username'],
      'password' => $data['business_password'],
      'package' => $data['package_name'],
      'name' => $data['name'],
    ]);
      return redirect()->route('add-business')->with('success', 'Business saved successfully');

    
    }
}
