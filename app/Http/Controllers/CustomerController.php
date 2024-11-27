<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth,DB,Hash;
use App\Customer;
class CustomerController extends Controller
{
    private $paginate=10;
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function addCustomer() {
        return view('backend/customers/add_edit',$this->data);
    }
    public function editCustomer(Request $request){
        $this->data['data_row']=Customer::where('cat','=','user')->whereId($request->id)->where('is_deleted',0)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/customers/add_edit',$this->data);
    }
    public function saveCustomer(Request $request) {
        if (Auth::check()) {
        $BusinessUserId = Auth::user()->business_id;
        }
        $userRoleId = Auth::user()->role_id; 
        if(in_array($userRoleId,config("business_roles.business_roles"))){
         $existingPhone = Customer::where('mobile', $request->mobile)->where('id', '!=', $request->id)->where('business_id',Auth::user()->business_id)->first();
        }else{
            $existingPhone = Customer::where('mobile', $request->mobile)->where('id', '!=', $request->id)->first();
        }

        if ($existingPhone) {
            return redirect()->back()->with(['error' => 'Contact Number already exists']);
        }
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            }
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        $request->merge(['password'=>Hash::make($request->mobile)]);
        $res = Customer::where('cat','=','user')->updateOrCreate(['id'=>$request->id,'hotel_id'=>$request->hotel,'business_id'=>$BusinessUserId],$request->except(['_token']));
        if($res){
            // sync user and customer
            $this->core->syncUserAndCustomer();

            return redirect()->route('list-customer')->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }

    public function listCustomer() {
    $userRoleId = Auth::user()->role_id; if(in_array($userRoleId,config("business_roles.business_roles"))){
         $this->data['datalist']=Customer::where('cat','=','user')->where('is_deleted',0)->orderBy('name','ASC')->where('business_id',Auth::user()->business_id)->get();
        }else{
             $this->data['datalist']=Customer::where('cat','=','user')->where('is_deleted',0)->orderBy('name','ASC')->get();
        }
         $this->data['customer_list']=getCustomerList('get');
         $this->data['search_data'] = ['customer_id'=>'','mobile_num'=>'','city'=>'','state'=>'','country'=>''];
        // dd($this->data);

        return view('backend/customers/list',$this->data);
    }
    public function deleteCustomer(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(Customer::where('cat','=','user')->whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    public function searchFromCustomer(Request $request) {
        $userRoleId = Auth::user()->role_id; 
        if(in_array($userRoleId,config("business_roles.business_roles"))){
            $data=Customer::where('cat','=',$request->category)
                ->where('is_deleted',0)
                ->where('mobile',$request->search_from_phone_idcard)->where('business_id',Auth::user()->business_id)
                ->orWhere('id_card_no', 'like', '%' . $request->search_from_phone_idcard . '%')->where('business_id',Auth::user()->business_id)
                ->orWhere('mobile', 'like', '%' . $request->search_from_phone_idcard . '%')->where('business_id',Auth::user()->business_id)
                ->orWhere('name', 'like', '%' . $request->search_from_phone_idcard . '%')
                ->orderBy('name','ASC')->where('business_id',Auth::user()->business_id)->get();
    }else{
        $data=Customer::where('cat','=',$request->category)
                ->where('is_deleted',0)
                ->where('mobile',$request->search_from_phone_idcard)
                ->orWhere('id_card_no', 'like', '%' . $request->search_from_phone_idcard . '%')
                ->orWhere('mobile', 'like', '%' . $request->search_from_phone_idcard . '%')
                ->orWhere('name', 'like', '%' . $request->search_from_phone_idcard . '%')
                ->orderBy('name','ASC')->get();
    }   

        return response()->json(['customers'=> $data], 200);

   }
   public function searchFromCompany(Request $request) {
     $userRoleId = Auth::user()->role_id; if(in_array($userRoleId,config("business_roles.business_roles"))){
    $data=Customer::where('cat','=',$request->category)
            ->where('is_deleted',0)
            ->where('mobile',$request->search_from_phone_idcard)
            ->orWhere('id_card_no', 'like', '%' . $request->search_from_phone_idcard . '%')
            ->orWhere('mobile', 'like', '%' . $request->search_from_phone_idcard . '%')
            ->orWhere('name', 'like', '%' . $request->search_from_phone_idcard . '%')
            ->orderBy('name','ASC')->where('business_id',Auth::user()->business_id)->get();
    }else{
        $data=Customer::where('cat','=',$request->category)
            ->where('is_deleted',0)
            ->where('mobile',$request->search_from_phone_idcard)
            ->orWhere('id_card_no', 'like', '%' . $request->search_from_phone_idcard . '%')
            ->orWhere('mobile', 'like', '%' . $request->search_from_phone_idcard . '%')
            ->orWhere('name', 'like', '%' . $request->search_from_phone_idcard . '%')
            ->orderBy('name','ASC')->get();
    }

    return response()->json(['customers'=> $data], 200);
}
}
