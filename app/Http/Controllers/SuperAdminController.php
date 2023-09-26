<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use Auth,DB,Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;

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
    public function allBusiness(Request $request){    
            $this->data['datalist'] = Business::orderBy('name', 'ASC')->get();
            return view('backend/super_admin/all_business', $this->data);
    }
    public function allBusinessData(Request $request){  
         $query = DB::table('business')
            ->orderBy('name', 'ASC');
            $data = $query->get();
            $jsonData = [
            'data' => $data,
            ];
        return response()->json($jsonData);      
    }
     public function deleteBusinessData(Request $request, $id)
        {            
            $business = Business::find($id);

            if (!$business) {
                return response()->json(['message' => 'Business not found'], 404);
            }
            try {
                $business->delete();
                return response()->json(['message' => 'Business deleted successfully']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error deleting business'], 500);
            }
    }
    public function editBusinessData(Request $request){

        $this->data['data_row']=Business::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/super_admin/edit_business',$this->data);
    }
public function updateBusinessData(Request $request, $id)
{
    // Find the business record by ID
    $business = Business::find($id);

    if (!$business) {
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
    }

    // Update the business record with the data from the form
    $business->update($request->all());

    return redirect()->route('all-business')->with(['success' => 'Business record updated successfully']);
}

     public function saveBusiness(Request $request){
            $data = $request->all();
           Business::create([
          'business_name' => $data['business_name'],
          'start_date' => $data['start_date'],
          'end_date' => $data['end_date'],
          'mobile' => $data['mobile_num'],
          'country' => $data['country'],
          'address' => $data['address'],
          'business_logo' => $data['business_logo'],
          'user_name' => $data['business_username'],
          'password' => bcrypt($data['business_password']),
          'package' => $data['package_name'],
          'name' => $data['name'],
        ]);
        return redirect()->route('all-business')->with('success', 'Business saved successfully');    
    }
    public function savePackage(Request $request){
          $data = $request->all();
          $arraytostring = implode(',',$request->input('services'));
          $data['services'] = $arraytostring;
             Package::create([
            'name' => $data['package_name'],
            'num_user' => $data['number_of_users'],
            'num_hotels' => $data['number_of_hotels'],
            'num_invoices' => $data['number_of_invoices'],
            'services' => $data['services']
            ]);
        return redirect()->route('add-package')->with('success', 'Package saved successfully');

  
  }
}
