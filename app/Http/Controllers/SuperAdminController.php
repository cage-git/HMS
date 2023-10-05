<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\BusinessPermission;
use App\BusinessSettings;
use App\Package,App\Role;
use App\User;
use Auth,DB,Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;

class SuperAdminController extends Controller
{
   private $core;
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
    }
    public function addBusiness(){
         $this->data['roles']=$this->getRoleList();
           return view('backend/super_admin/add_business',$this->data);
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
        $this->data['user_data']=User::where('business_id',$request->id)->first();
        return view('backend/super_admin/edit_business',$this->data);
    }
    public function updateBusinessData(Request $request, $id)
    {
        $business = Business::find($id);

        if (!$business) {
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        $business->update($request->all());

        return redirect()->route('all-business')->with(['success' => 'Business record updated successfully']);
    }

     public function saveBusiness(Request $request){       
            $data = $request->all();
         $filename="";
          if ($request->hasFile('business_logo')) {
           $filename = $this->core->fileUpload($request->business_logo,'uploads/business_images');            
          }
         $newBusiness =  Business::create([
          'business_name' => $data['business_name'],
          'start_date' => $data['start_date'],
          'end_date' => $data['end_date'],
          'mobile' => $data['mobile_num'],
          'country' => $data['country'],
          'address' => $data['address'],
          'business_logo' => $filename,
          'package' => $data['package_name'],
          'name' => $data['name'],
        ]);
           $newBusinessId = $newBusiness->id;
           $roleId = 8;
           $role = Role::where('id', $roleId)->first();
           User::create([
          'role_id' => $role->id,
          'business_id'=> $newBusinessId,
          'name' => $data['business_username'],
          'email' => $data['business_email'],
          'password' => bcrypt($data['business_password']),
           ]);
        $permissionData = DB::table('permissions')
            ->select('parent_id','description','slug','category','admin', 'receptionist','store_manager','financial_manager','customer','housekeeper')
            ->get();
         foreach ($permissionData as $permission) {
            $businessPermission = BusinessPermission::create([
                'parent_id' => $permission->parent_id,
                'business_id' => $newBusinessId, 
                'description' => $permission->description,
                'slug' => $permission->slug,
                'category' => $permission->category,
                'admin' => $permission->admin,
                'receptionist' => $permission->receptionist,
                'store_manager' => $permission->store_manager,
                'financial_manager' => $permission->financial_manager,
                'customer' => $permission->customer,
                'housekeeper' => $permission->housekeeper,
            ]);
        }
        $settingsData = DB::table('settings')
            ->select('name','value')
            ->get();
            
            foreach($settingsData as $settings){
                if($settings->name=="site_logo"){
                    $settings->value=$filename;
                }elseif($settings->name=="hotel_email"){
                    $settings->value=$data['business_email'];
                }elseif($settings->name=="default_nationality"){
                    $settings->value=$data['country'];
                }

                $businessSetting=BusinessSettings::create([
                    'business_id'=>$newBusinessId,
                    'name'=>$settings->name,
                    'value'=>$settings->value,
                ]);

            }
       
        return redirect()->route('all-business')->with('success', 'Business saved successfully');    
    }
    //// Packages    
    public function addPackage(){
        return view('backend/super_admin/add_package');
    }
    public function allPackages(){
        return view('backend/super_admin/all_package');
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
        return redirect()->route('all-packages')->with('success', 'Package saved successfully');
     }
     public function allPackageData(Request $request){  
         $query = DB::table('package')
            ->orderBy('name', 'ASC');
            $data = $query->get();
            $jsonData = [
            'data' => $data,
            ];
        return response()->json($jsonData);      
    }
    public function deletePackageData(Request $request, $id)
        {            
            $business = Package::find($id);

            if (!$business) {
                return response()->json(['message' => 'Packages not found'], 404);
            }
            try {
                $business->delete();
                return response()->json(['message' => 'Packages deleted successfully']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error deleting Packages'], 500);
            }
    }
    // public function updatePackageData(Request $request, $id)
    // {
    //     $business = Package::find($id);

    //     if (!$business) {
    //         return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
    //     }
    //     $business->update($request->all());

    //     return redirect()->route('all-packages')->with(['success' => 'Business record updated successfully']);
    // }
    public function editPackageData(Request $request){

        $this->data['data_row']=Package::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/super_admin/edit_package',$this->data);
    }
    function getRoleList(){
        return Role::orderBy('role','ASC')->pluck('role','id');
    }
}
