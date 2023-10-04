<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth,DB,Hash;
use App\Customer;
class CompanyController extends Controller
{
    private $paginate=10;
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function addCompany() {
        return view('backend/companys/add_edit',$this->data);
    }
    public function editCompany(Request $request){
        $this->data['data_row']=Customer::where('cat','=','company')->whereId($request->id)->where('is_deleted',0)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/companys/add_edit',$this->data);
    }
    public function saveCompany(Request $request)
    {
        if (Auth::check()) {
        $BusinessUserId = Auth::user()->business_id;
        }
        if ($request->id > 0) {
            if ($this->core->checkWebPortal() == 0) {
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            }
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }

        if (!$request->id) {
            $customerData = [
                "surname" => $request->name,
                "company_gst_num" => $request->company_gst_num,
                "cat"=>'company',
                "name" => $request->name,
                "middle_name" => '',
                "father_name" => '',
                "email" => ($request->email != '') ? $request->email : '', //str_replace(' ', rand(1111,9999), $request->name.$request->mobile).'@fake_email.com',
                "mobile" => $request->mobile,
                "address" => $request->address,
                "country" => $request->country,
                "state" => $request->state,
                "city" => $request->city,
                "gender" => 'Other',
                // "age" => '50',
                'business_id'=>$BusinessUserId,
                "password" => Hash::make($request->mobile),
            ];
            $res = Customer::insert($customerData);
        } else {
            $request->merge(['password' => Hash::make($request->mobile)]);
            $res = Customer::where('cat', '=', 'company')->updateOrCreate(['id' => $request->id,'business_id'=>$BusinessUserId], $request->except(['_token']));
        }

        if($res){

            //sync user and customer
            $this->core->syncUserAndCustomer();

            return redirect()->route('list-company')->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listCompany() {
        if(Auth::user()->role_id == 8){
         $this->data['datalist']=Customer::where('cat','=','company')->where('is_deleted',0)->orderBy('name','ASC')->where('business_id',Auth::user()->business_id)->get();
        }else{
            $this->data['datalist']=Customer::where('cat','=','company')->where('is_deleted',0)->orderBy('name','ASC')->get();
        }
        $this->data['customer_list']=getCustomerList('get','company');
         $this->data['search_data'] = ['customer_id'=>'','mobile_num'=>'','city'=>'','state'=>'','country'=>''];
        return view('backend/companys/list',$this->data);
    }
    public function deleteCompany(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(Customer::where('cat','=','company')->whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
}
