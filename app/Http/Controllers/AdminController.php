<?php

namespace App\Http\Controllers;
use App\CurlRequest;
use App\CurlHistory;
use Illuminate\Http\Request;
use Auth,DB,Hash;
use App\User,App\Customer,App\Role;
use App\Room,App\RoomType, App\BookedRoom;
use App\Amenities;
use App\FoodCategory,App\FoodItem;
use App\ExpenseCategory,App\Expense;
use App\Product,App\StockHistory;
use App\Reservation;
use App\Order,App\OrderItem,App\OrderHistory;
use App\Setting;
use App\PersonList;
use App\DynamicDropdown;
use App\MediaFile;
use App\Permission;
use Session;
class AdminController extends Controller
{
    private $paginate=10;
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function index() {
        // echo phpinfo();
        // exit;
        $this->data['counts']=DB::select(DB::raw("SELECT
            (((SELECT COUNT(*) FROM (
                SELECT 0  FROM `booked_rooms`
                    WHERE
                        is_checkout = 0  AND
                        (CURDATE() BETWEEN DATE(`check_in`) and DATE(`check_out`))
                    GROUP BY room_id
              ) sq ) / (SELECT COUNT(*) FROM rooms WHERE status = 1)) * 100)  as user_count_two,

            (SELECT COUNT(*) FROM users WHERE status = 1) as user_count,
            (SELECT COUNT(*) FROM orders WHERE DATE(`created_at`) = DATE_ADD(CURDATE(), INTERVAL -1 DAY)) as today_orders,
            (SELECT COUNT(*) FROM reservations WHERE DATE(`check_in`) = CURDATE()) as today_check_ins,
            (SELECT COUNT(*) FROM reservations WHERE DATE(`check_out`) = CURDATE()) as today_check_outs"
            ));
         $this->data['products']=Product::whereStatus(1)->whereIsDeleted(0)->orderBy('stock_qty','ASC')->paginate(50);
         $orderIds = OrderHistory::where('is_book',1)->orderBy('id','DESC')->pluck('order_id');
         $this->data['orders']=Order::with('last_order_history')->whereIn('id',$orderIds)->orderBy('created_at','DESC')->get();

         $dateRange = ['checkin_date'=>date('Y-m-01'), 'checkout_date'=>date('Y-m-t')];
         $this->getRoomList();


         $sDate = date("Y-m-01", strtotime('2023-03-01'));
         $eDate = date("Y-m-t", strtotime('2023-04-01'));
         $params = ['start_date'=>$sDate, 'end_date'=>$eDate];
         $this->data['events'] = json_encode(getCalendarEventsByDate($params));
        //  return response()->json($this->data);
        // dd($this->data);

        return view('backend/dashboard',$this->data);
    }

/* ***** Start User Functions ***** */
    public function editLoggedUserProfile(Request $request){
        $this->data['data_row']=User::whereId(Auth::user()->id)->first();
        return view('backend/users/logged_user_profile',$this->data);
    }
    public function saveProfile(Request $request) {
        if($this->core->checkWebPortal()==0 && in_array(Auth::user()->id, [1,2,3])){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if($request->form_type == 'updatePassword'){
            $request->merge(['password'=>Hash::make($request->new_password)]);
        }
        $res = User::updateOrCreate(['id'=>Auth::user()->id],$request->except(['_token','new_password','conf_password']));
        if($res){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }

    public function addUser() {
        $this->data['roles']=$this->getRoleList();
        return view('backend/users/user_add_edit',$this->data);
    }
    public function editUser(Request $request){
        $this->data['roles']=$this->getRoleList();
        $this->data['data_row']=User::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/users/user_add_edit',$this->data);
    }
    public function saveUser(Request $request) {
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
        if($request->new_password){
            $request->merge(['password'=>Hash::make($request->new_password)]);
        }
        $res = User::updateOrCreate(['id'=>$request->id],$request->except(['_token','new_password','conf_password']));
        if($res){
            return redirect()->route('list-user')->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listUser() {
         $this->data['datalist']=User::orderBy('name','ASC')->where('role_id', '!=', '6')->get();
        return view('backend/users/user_list',$this->data);
    }
    public function deleteUser(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(User::whereId($request->id)->delete()){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
/* ***** End User Functions ***** */

/* ***** Start Room Functions ***** */
    public function addRoom() {
        $this->data['roomtypes_list']=getRoomTypesList();
        return view('backend/rooms/room_add_edit',$this->data);
    }
    public function editRoom(Request $request){
        $this->data['roomtypes_list']=getRoomTypesList();
        $this->data['data_row']=Room::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/rooms/room_add_edit',$this->data);
    }
    public function saveRoom(Request $request) {
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
        $res = Room::updateOrCreate(['id'=>$request->id],$request->except(['_token','amenities_ids']));

        if($res){
            $mediaData = [
                'tbl_id'=>$res->id,
                'media_ids'=>$request->media_ids,
                'files'=>($request->hasFile('room_images')) ? $request->room_images : null,
                'folder_path'=>'uploads/room_images',
                'type'=>'room_image',
            ];
            $this->core->uploadAndUnlinkMediaFile($mediaData);

            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listRoom() {
        //  $this->data['datalist']=Room::whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
         $this->data['datalist']=Room::whereIsDeleted(0)->orderBy('order_num','ASC')->get();
        return view('backend/rooms/room_list',$this->data);
    }
    public function deleteRoom(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(Room::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
/* ***** End Room Functions ***** */

/* ***** Start Room Types Functions ***** */
    public function addRoomType() {
        $this->data['amenities_list']=$this->getAmenitiesList();
        return view('backend/rooms/room_types_add_edit',$this->data);
    }
    public function editRoomType(Request $request){
        $this->data['amenities_list']=$this->getAmenitiesList();
        $this->data['data_row']=RoomType::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/rooms/room_types_add_edit',$this->data);
    }
    public function saveRoomType(Request $request) {
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
        $request->merge(['amenities'=>(join(',',$request->amenities_ids))]);
        $res = RoomType::updateOrCreate(['id'=>$request->id],$request->except(['_token','amenities_ids']));

        if($res){
            $mediaData = [
                'tbl_id'=>$res->id,
                'media_ids'=>$request->media_ids,
                'files'=>($request->hasFile('room_type_images')) ? $request->room_type_images : null,
                'folder_path'=>'uploads/room_type_images',
                'type'=>'room_type_image',
            ];
            $this->core->uploadAndUnlinkMediaFile($mediaData);
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listRoomType() {
        //  $this->data['datalist']=RoomType::whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
         $this->data['datalist']=RoomType::whereIsDeleted(0)->orderBy('order_num','ASC')->get();
        return view('backend/rooms/room_types_list',$this->data);
    }
    public function deleteRoomType(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(RoomType::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
/* ***** End Room Types Functions ***** */

/* ***** Start Amenities Functions ***** */
    public function addAmenities() {
        return view('backend/rooms/amenities_add_edit',$this->data);
    }
    public function editAmenities(Request $request){
        $this->data['data_row']=Amenities::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/rooms/amenities_add_edit',$this->data);
    }
    public function saveAmenities(Request $request) {
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
        $res = Amenities::updateOrCreate(['id'=>$request->id],$request->except(['_token']));

        if($res){
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listAmenities() {
        // $this->data['datalist']=Amenities::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->get();
        $this->data['datalist']=Amenities::whereIsDeleted(0)->orderBy('name','ASC')->get();
        return view('backend/rooms/amenities_list',$this->data);
    }
    public function deleteAmenities(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(Amenities::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
/* ***** End Amenities Functions ***** */

/* ***** Start RoomReservation Functions ***** */
    public function roomReservation() {
        $this->data['roomtypes_list']=getRoomTypesList('custom');
        $this->data['customer_list']=getCustomerList('get');
        $this->data['companies_list']=getCustomerList('get', 'company');
        return view('backend/rooms/room_reservation_add_edit',$this->data);
    }
    public function editReservation(Request $request){
        $this->data['data_row']=Reservation::with('orders_items','orders_info', 'booked_rooms')->whereId($request->id)->whereIsCheckout(0)->first();
        if($this->data['data_row']){
            return view('backend/rooms/check_out',$this->data);
        } else {
            return redirect()->route('list-reservation')->with(['error' => config('constants.FLASH_NOT_ALLOW_URL')]);
        }
    }

    public function saveReservation(Request $request) {
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                if($request->ajax()){
                    return response()->json(['msg' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')], 403);
                }else{
                    return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
                }

            }
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        // if(env('APP_NT_ENABLE') == true){
        if(config('app.nt_enable') == true){
            
            if(
                !$request->mt_nationality
                || !$request->mt_room_rent_type
                || !$request->mt_customer_types
                || !$request->mt_room_type
                || !$request->mt_reason_of_visit
                || !$request->mt_payment_type
            ){
                if($request->ajax()){
                    return response()->json(['msg' => config('constants.FLASH_FILL_REQUIRED_FIELD')], 403);
                }else {
                    return redirect()->back()->with(['error' => config('constants.FLASH_FILL_REQUIRED_FIELD'),'params' => $request->mt_nationality.$request->mt_room_rent_type.$request->mt_customer_types.$request->mt_room_type.$request->mt_reason_of_visit.$request->mt_payment_type ]);
                }
            }
        }
        if(!$request->check_in_date || !$request->check_out_date || !$request->duration_of_stay ||
            (($request->idcard_type == 4 || $request->idcard_type == 21) && $request->idcard_no == '')
        ){ //|| !$request->room_plan ){
            if($request->ajax()){
                return response()->json(['msg' => config('constants.FLASH_FILL_REQUIRED_FIELD')], 403);
            }else {
                return redirect()->back()->with(['error' => config('constants.FLASH_FILL_REQUIRED_FIELD')]);
            }
        }

        $reservationData = [];
        $customerData = [];

        if($request->guest_type_category=='existing'){
            $customerId = $request->selected_customer_id;
            $custData = Customer::whereId($customerId)->where('cat', '=', 'user')->first();
            $custName = $custData->name;
        }
        elseif($request->guest_type_category=='existing_company'){
            $customerId = $request->selected_company_id;
            $custData = Customer::whereId($customerId)->where('cat', '=', 'company')->first();
            $custName = $custData->name;
        }
        elseif($request->guest_type_category=='new_company'){
            $custName = $request->company_name;
            if(
                // !$request->company_gst_num ||
                // !$request->company_email ||
                !$request->company_name ||
                !$request->company_mobile ||
                !$request->company_address
            ){
                return redirect()->back()->with(['error' => config('constants.FLASH_FILL_REQUIRED_FIELD')]);
            }

            $dob = null;
            if($request->dob){
               $dob=  date("Y-m-d", strtotime($request->dob));
            }

            $customerData = [
                "surname" => $request->company_name,
                "company_gst_num" => $request->company_gst_num,
                "cat"=>'company',
                "name" => $request->company_name,
                "middle_name" => '',
                "father_name" => '',
                "email" => $request->company_email ?? '',
                "mobile" => $request->company_mobile,
                "address" => $request->company_address,
                "nationality" => $request->nationality,
                "country" => $request->company_country,
                "state" => $request->company_state,
                "city" => $request->company_city,
                "gender" => $request->gender,
                "dob" => $dob,
                "id_card_no" => $request->idcard_no,
                "idcard_type" => $request->idcard_type,
                "password" => Hash::make($request->mobile),
            ];
            $customerId = Customer::insertGetId($customerData);
            //sync user and customer
            $this->core->syncUserAndCustomer();
        }
        else {
            $custName = $request->name;
            if(!$request->name || !$request->mobile || !$request->gender){
                return redirect()->back()->with(['error' => config('constants.FLASH_FILL_REQUIRED_FIELD')]);
            }
            $dob = null;
            if($request->dob){
               $dob=  date("Y-m-d", strtotime($request->dob));
            }
            $customerData = [
                "surname" => $request->surname,
                "name" => $request->name,
                "middle_name" => $request->middle_name,
                "father_name" => $request->father_name,
                "email" => $request->email ??  '',
                "mobile" => $request->mobile,
                "address" => ($request->address != '') ? $request->address :  '',
                "nationality" => $request->nationality,
                "country" => $request->country,
                "state" => $request->state,
                "city" => $request->city,
                "gender" => $request->gender,
                "dob" => $dob,
                "id_card_no" => $request->idcard_no,
                "idcard_type" => $request->idcard_type,
                "password" => Hash::make($request->mobile),
            ];
            $customerId = Customer::insertGetId($customerData);

            //sync user and customer
            $this->core->syncUserAndCustomer();
        }
        $reservationData = [
            "customer_id" => $customerId,
            "guest_type" => $request->guest_type_category,
            "check_in" => dateConvert($request->check_in_date, 'Y-m-d H:i'),
            "check_out" => dateConvert($request->check_out_date, 'Y-m-d H:i'),
            "duration_of_stay" => $request->duration_of_stay,
            "adult" => $request->adult,
            "kids" => $request->kids,
            "reservation_type" => $request->reservation_type,
            //   "purpose_of_the_visiting" => $request->purpose_of_the_visiting,
            "booked_by" => $request->booked_by,
            "vehicle_number" => $request->vehicle_number,
            "reason_visit_stay" => $request->reason_visit_stay || '',
            "advance_payment" => $request->advance_payment,
            "idcard_type" => $request->idcard_type,
            "idcard_no" => $request->idcard_no,
            "referred_by" => $request->referred_by || '',
            "referred_by_name" => $request->referred_by_name,
            "remark_amount" => $request->remark_amount,
            "remark" => $request->remark,
            "company_name" => $request->company_name || '',
            "company_gst_num"=>$request->company_gst_num || '',
            "room_plan"=>$request->room_plan || '',
        ];
        if(!$request->id){
            $reservationData["created_at_checkin"] = date('Y-m-d H:i:s');
            $reservationData['invoice_num'] = getNextInvoiceNo();
        }
        $res = Reservation::updateOrCreate(['id'=>$request->id],$reservationData);
        if($res){
            //add rooms
            if(!$request->id){
                $this->addReservationRoom($res, $request, 'custom');
            }

            //add ledger
            if($request->advance_payment){
                $where = [
                    'purpose'=>'ROOM_ADVANCE',
                    'tbl_id'=>$res->id,
                    'tbl_name'=>'reservations',
                ];
                $paymentHistoryData = $where;
                $paymentHistoryData['payment_date'] = date('Y-m-d H:i:s');
                $paymentHistoryData['customer_id'] = $res->customer_id;
                $paymentHistoryData['user_id'] = getCustomerInfo($res->customer_id)->user_id;
                $paymentHistoryData['added_by'] = Auth::user()->id;
                $paymentHistoryData['payment_amount'] = $request->advance_payment;
                $paymentHistoryData['payment_type'] = getPaymentModeById($request->payment_mode);
                $paymentHistoryData['credit_debit'] = 'Debit';
                $paymentHistoryData['payment_of'] = 'cr';
                $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                $dataPH = $this->core->updateOrCreatePH($where, $paymentHistoryData);
            }

            $mediaData = [
                'tbl_id'=>$res->id,
                'media_ids'=>$request->media_ids,
                'files'=>($request->hasFile('id_image')) ? $request->id_image : null,
                'folder_path'=>'uploads/id_cards',
                'type'=>'id_cards',
            ];
            $this->core->uploadAndUnlinkMediaFile($mediaData);

            if(isset($request->persons_info['name'])){
                $personsData = [];
                $personReqData = $request->persons_info;
                foreach($personReqData['name'] as $k=>$val){
                    if($val!=''){
                        $personsData[] = [
                            'reservation_id'=>$res->id,
                            'name'=>$val,
                            'gender'=>$personReqData['gender'][$k],
                            'age'=>$personReqData['age'][$k],
                            'address'=>$personReqData['address'][$k],
                            'idcard_type'=>$personReqData['idcard_type'][$k],
                            'idcard_no'=>$personReqData['idcard_no'][$k]
                        ];
                    }
                }
                if(count($personsData)>0){
                    PersonList::insert($personsData);
                }
            }
            //send sms
            if(!$request->id && $request->mobile){
                $this->core->sendSms(1,$request->mobile,["name" => $custName]);
            }


            if(config('app.nt_enable') == true){
                $settings = getSettings();
                if(isset($settings['ntmp_status']) && isset($settings['ntmp_api_key'])){
                    if($settings['ntmp_status'] == 'true' && $settings['ntmp_api_key'] != NULL)
                    {
                        $datas = getNTData($res, $request, $dataPH, false, $customerId);
                        $url = getNtmpUrl($settings['ntmp_type'], 'CreateOrUpdateBooking');
                        $header = [
                            'Content-Type: application/json',
                            'x-Gateway-APIKey: '.$settings['ntmp_api_key'].'',
                            'Authorization: Basic '.base64_encode($settings['ntmp_user_id'].':'.$settings['ntmp_password']).''
                        ];

                         $resp = $this->core->sendCurl(
                             $url,
                             'POST',
                             $header,
                             $datas
                         );
                        CurlRequest::insertGetId(['url' => $url,
                            'reservation_id'=> $res->id,
                            'request_type' => 'POST',
                            'header' => json_encode($header),
                            'post_data' => json_encode($datas),
                            'response_data' => ($resp['status'] == true) ? $resp['response'] : json_encode([]),
                            'what_happen'=> 'Created ' . (($request->reservation_type == 0) ? 'Check-in' : 'Booking')
                        ]);
                        CurlHistory::insert(['url' => $url,
                            'reservation_id'=> $res->id,
                            'request_type' => 'POST',
                            'header' => json_encode($header),
                            'post_data' => json_encode($datas),
                            'response_data' => $resp['response'],
                            'what_happen'=> 'Created ' . (($request->reservation_type == 0) ? 'Check-in' : 'Booking')
                        ]);

                    }
                }

            }

            if($request->ajax()){
                return response()->json(['msg' => $success, 'invoice'=>route('invoice',[$res->id,1,'inv_type'=>'org'])], 200);
            }else {
                return redirect()->back()->with(['success' => $success, 'reservation_id' => $res->id]);
            }
        }
        if($request->ajax()){
            return response()->json(['msg' => $error], 403);
        }else {
            return redirect()->back()->with(['error' => $error]);
        }
    }
    public function cancelReservationSubmit(Request $request){
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            }
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        }
        else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        $res = Reservation::where(['id'=>$request->id])->update(['cancelled'=>1]);
        if($res){
            $data_row = Reservation::with('booked_rooms')->where(['id'=>$request->id])->first();
            // Transactions
            $where = [
                'purpose'=>'REFUND',
                'tbl_id'=>$data_row->id,
                'tbl_name'=>'reservations',
            ];
            $paymentHistoryData = $where;
            $paymentHistoryData['payment_date'] = date('Y-m-d H:i:s');
            $paymentHistoryData['customer_id'] = $data_row->customer_id;
            $paymentHistoryData['user_id'] = getCustomerInfo($data_row->customer_id)->user_id;
            $paymentHistoryData['added_by'] = Auth::user()->id;
            $paymentHistoryData['payment_amount'] = $data_row->advance_payment;
            $paymentHistoryData['payment_type'] = 'Cash';
            $paymentHistoryData['credit_debit'] = 'Credit';
            $paymentHistoryData['payment_of'] = 'dr';
            $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
            $this->core->updateOrCreatePH($where, $paymentHistoryData);
            if(env('APP_NT_ENABLE') == true){
                $settings = getSettings();
                if(isset($settings['ntmp_status']) && isset($settings['ntmp_api_key'])){
                    if($settings['ntmp_status'] == 'true' && $settings['ntmp_api_key'] != NULL)
                    {
                        $curl_record = CurlRequest::where('reservation_id', $request->id)->first();
                        if($curl_record){
                            $post_data = json_decode($curl_record->post_data, true);
                            $post_data['transactionId'] = getNTTransactionId($request->id);
                            $post_data['transactionTypeId'] = '2';
                            $url = getNtmpUrl($settings['ntmp_type'], 'CancelBooking');
                            $header = [
                                'Content-Type: application/json',
                                'x-Gateway-APIKey: '.$settings['ntmp_api_key'].'',
                                'Authorization: Basic '.base64_encode($settings['ntmp_user_id'].':'.$settings['ntmp_password']).''
                            ];
                            $cancel_post_data = [
                                "transactionId"=> $post_data['transactionId'],
                                "cancelReason"=> (string) $request->mt_cancel_reason,
                                "cancelWithCharges"=> (string) $request->mt_cancel_with_charges,
                                "chargeableDays"=> (string) $request->mt_chargeable_days,
                                "roomRentType"=> $post_data['roomRentType'],
                                "dailyRoomRate"=> $post_data['dailyRoomRate'],
                                "totalRoomRate"=> $post_data['totalRoomRate'],
                                "vat"=> $post_data['vat'],
                                "municipalityTax"=> $post_data['municipalityTax'],
                                "discount"=> $post_data['discount'],
                                "grandTotal"=> $post_data['grandTotal'],
                                "userId"=> $post_data['userId'],
                                "paymentType"=> $post_data['paymentType'],
                                "channel"=>  $post_data['channel'],
                                "cuFlag"=> $post_data['cuFlag'],
                            ];
                            $resp = $this->core->sendCurl(
                                $url,
                                'POST',
                                $header,
                                $cancel_post_data
                            );
                            CurlHistory::insert(['url' => $url,
                                'reservation_id'=> $request->id,
                                'request_type' => 'POST',
                                'header' => json_encode($header),
                                'post_data' => json_encode($cancel_post_data),
                                'response_data' => $resp['response'],
                                'what_happen'=> 'Change booking to Cancellation'
                            ]);
                            if($resp['status']){
//                                $post_data['cancel_post_data'] = $cancel_post_data;
                                CurlRequest::updateOrCreate(['reservation_id'=>$request->id], ['url' => $url,
                                    'reservation_id'=> $request->id,
                                    'request_type' => 'POST',
                                    'header' => json_encode($header),
                                    'post_data' => json_encode($cancel_post_data),
                                    'response_data' => ($resp['status'] == true) ? $resp['response'] : json_encode([]),
                                    'what_happen'=> 'Change booking to Cancellation'
                                ]);

                            }
                        }
                    }
                }
            }
            return redirect()->to(route('list-reservation'))->with(['success' => $success]);
        }

        return redirect()->back()->with(['error' => $error]);
    }
    public function cancelReservation(Request $request){
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            }
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        }
        else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        if(env('APP_NT_ENABLE') == true) {
            $res = Reservation::findOrFail($request->id);
            if($res){
                $this->data['data_row']=Reservation::with('orders_items','orders_info', 'booked_rooms')->whereId($request->id)->whereIsCheckout(0)->first();
                return view('backend/rooms/cancellation_booking_form',$this->data);
            }
        }else{
            $res = Reservation::where(['id'=>$request->id])->update(['cancelled'=>1]);
            if($res){
                $data_row = Reservation::with('booked_rooms')->where(['id'=>$request->id])->first();
                // Transactions
                $where = [
                    'purpose'=>'REFUND',
                    'tbl_id'=>$data_row->id,
                    'tbl_name'=>'reservations',
                ];
                $paymentHistoryData = $where;
                $paymentHistoryData['payment_date'] = date('Y-m-d H:i:s');
                $paymentHistoryData['customer_id'] = $data_row->customer_id;
                $paymentHistoryData['user_id'] = getCustomerInfo($data_row->customer_id)->user_id;
                $paymentHistoryData['added_by'] = Auth::user()->id;
                $paymentHistoryData['payment_amount'] = $data_row->advance_payment;
                $paymentHistoryData['payment_type'] = 'Cash';
                $paymentHistoryData['credit_debit'] = 'Credit';
                $paymentHistoryData['payment_of'] = 'dr';
                $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                $this->core->updateOrCreatePH($where, $paymentHistoryData);

                return redirect()->back()->with(['success' => $success]);
            }
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function changetoCheckinReservation(Request $request){
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
        $res = Reservation::where(['id'=>$request->id])->update(['reservation_type'=>0]);
        if($res){
            if(env('APP_NT_ENABLE') == true){
                $settings = getSettings();
                if(isset($settings['ntmp_status']) && isset($settings['ntmp_api_key'])){
                    if($settings['ntmp_status'] == 'true' && $settings['ntmp_api_key'] != NULL)
                    {
                        $curl_record = CurlRequest::where('reservation_id', $request->id)->first();
                        if($curl_record){
                            $post_data = json_decode($curl_record->post_data, true);
                            $post_data['transactionId'] = getNTTransactionId($request->id);
                            $post_data['transactionTypeId'] = '2';
                            $url = getNtmpUrl($settings['ntmp_type'], 'CreateOrUpdateBooking');
                            $header = [
                                'Content-Type: application/json',
                                'x-Gateway-APIKey: '.$settings['ntmp_api_key'].'',
                                'Authorization: Basic '.base64_encode($settings['ntmp_user_id'].':'.$settings['ntmp_password']).''
                            ];
                            $resp = $this->core->sendCurl(
                                $url,
                                'POST',
                                $header,
                                $post_data
                            );
                            CurlHistory::insert(['url' => $url,
                                'reservation_id'=> $request->id,
                                'request_type' => 'POST',
                                'header' => json_encode($header),
                                'post_data' => json_encode($post_data),
                                'response_data' => $resp['response'],
                                'what_happen'=> 'Change booking to Check-in'
                            ]);
                            if($resp['status']){
                                CurlRequest::updateOrCreate(['reservation_id'=>$request->id], ['url' => $url,
                                    'reservation_id'=> $request->id,
                                    'request_type' => 'POST',
                                    'header' => json_encode($header),
                                    'post_data' => json_encode($post_data),
                                    'response_data' => ($resp['status'] == true) ? $resp['response'] : json_encode([]),
                                    'what_happen'=> 'Change booking to Check-in'
                                ]);

                            }
                        }
                    }
                }
            }
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function viewReservation(Request $request) {
        $this->data['data_row']=Reservation::with('orders_items','persons', 'booked_rooms')->whereId($request->id)->first();
        return view('backend/rooms/room_reservation_view',$this->data);
    }
    public function checkOut(Request $request) {












        $this->data['data_row']=Reservation::with('orders_items','orders_info', 'booked_rooms')->whereId($request->id)->whereIsCheckout(0)->first();
        if($this->data['data_row']){
            return view('backend/rooms/check_out',$this->data);
        } else {
            return redirect()->route('list-reservation')->with(['error' => config('constants.FLASH_NOT_ALLOW_URL')]);
        }
    }
    public function saveCheckOutData(Request $request) {

        //NT EXPENSES TESTING
        $settings = getSettings();
        $reservationData = [];
        $orderInfo = [];
        $amountArr =  $request->amount;
        $roomDiscount = $request->discount_amount;
        if($request->room_discount_in == 'perc'){
            // correct the tax calculation for discount percentage
            // $totalAmount = $amountArr['total_room_amount']+$amountArr['total_room_amount_gst']+$amountArr['total_room_amount_cgst'];
            $totalAmount = $amountArr['total_room_amount']+$amountArr['org_room_amount_gst']+$amountArr['org_room_amount_cgst'];
            $roomDiscount = ($roomDiscount/100)*$totalAmount;
        }
        $amountArr['room_amount_discount'] = $roomDiscount;
        $amountArr['additional_amount'] = $request->additional_amount;
        $reservationData = [
            "check_out" => dateConvert($request->check_out_date, 'Y-m-d H:i'),
            "created_at_checkout" => date('Y-m-d H:i:s'),
            "duration_of_stay" => $request->duration_of_stay,
            "amount_json" => json_encode($amountArr),
            "idcard_type" => $request->idcard_type,
            "idcard_no" => $request->idcard_no,
            "company_gst_num"=>$request->company_gst_num,
            "payment_mode"=>$request->payment_mode,
            "payment_status"=>$request->payment_status,
            "is_checkout"=>1,
            "discount"=>$amountArr['room_amount_discount'],
            "sub_total"=>$amountArr['total_room_amount'],
            "gst_perc"=>$settings['gst'],
            "cgst_perc"=>$settings['cgst'],
            "gst_amount"=>$amountArr['total_room_amount_gst'],
            "cgst_amount"=>$amountArr['total_room_amount_cgst'],
            "room_amount_with_cgst"=>$amountArr['total_room_amount_with_cgst'],
            "grand_total"=>$amountArr['total_room_final_amount'],
            "addtional_amount"=>$amountArr['additional_amount'],
            "additional_amount_reason"=>$request->additional_amount_reason,
            "grand_room_total"=>$request->total_grand_room_amount,
        ];
        $mobile = '';
        $name = '';
        $resData = Reservation::with('booked_rooms')->whereId($request->id)->first();
        if($request->id>0){
            if($resData){
                if($resData->customer){
                    $mobile = $resData->customer->mobile;
                    $name = $resData->customer->name;
                }
                if($resData->invoice_num==null && $request->invoice_applicable==1){
                    $reservationData['invoice_num'] = getNextInvoiceNo();
                    $orderInfo['invoice_num'] = getNextInvoiceNo('orders');
                }
            }
        }
        // $mediaData = [
        //     'tbl_id'=>$request->id,
        //     'media_ids'=>$request->media_ids,
        //     'files'=>($request->hasFile('id_image')) ? $request->id_image : null,
        //     'folder_path'=>'uploads/id_cards',
        //     'type'=>'id_cards',
        // ];
        // $this->core->uploadAndUnlinkMediaFile($mediaData);

        $res = Reservation::updateOrCreate(['id'=>$request->id], $reservationData);
        if($res){

            //update booked rooms checkout date
            $this->updateReservationRoom($resData, $request);

            $gstApply = $gstPerc = $gstAmount = $cgstPerc = $cgstAmount = 0;
            if($request->food_gst_apply==1){
                $gstApply = 1;
                $gstPerc = $settings['food_gst'];
                $gstAmount = $request->amount['order_amount_gst'];

                $cgstPerc = $settings['food_cgst'];
                $cgstAmount = $request->amount['order_amount_cgst'];
            }

            $orderInfo['reservation_id'] = $request->id;
            $orderInfo['invoice_date'] = dateConvert($request->check_out_date, 'Y-m-d H:i');
            $orderInfo['gst_apply'] = $gstApply;
            $orderInfo['gst_perc'] = $gstPerc;
            $orderInfo['cgst_perc'] = $cgstPerc;
            $orderInfo['gst_amount'] = $gstAmount;
            $orderInfo['cgst_amount'] = $cgstAmount;
            $orderInfo['order_grand_total'] = $amountArr['total_food_final_amount'];
            $orderInfo['additional_order_amount'] = $amountArr['additional_order_amount'];
            $orderInfo['additional_order_amount_reason'] = $amountArr['additional_order_amount_reason'];

            $orderDiscount = $request->discount_order_amount;
            if($request->order_discount_in == 'perc'){
                // calculate the tax and discount on order items and add grand total for orders
                $orderAmountperc =  ($orderDiscount/100) * $amountArr['order_amount'];
                $order_amount_gst = $amountArr['order_amount_gst'];

                $taxorderAmount =  ($gstPerc/100) * $amountArr['order_amount']; // 10
                $tax_order_amount_gst =  ($orderDiscount/100) * $taxorderAmount; // 5
                

                $orderDiscount = $amountArr['order_amount'] - ($orderAmountperc);
                // $totalAmount = $amountArr['order_amount']+$amountArr['order_amount_gst']+$amountArr['order_amount_cgst'];
                // $orderDiscount = ($orderDiscount/100)*$totalAmount;
            }

            $orderInfo['discount'] = $orderDiscount;

            $orderData = Order::where('reservation_id',$request->id)->first();
            if($orderData){
                $orderInfo["original_date"] = date('Y-m-d H:i:s');
               Order::where('reservation_id',$request->id)->update($orderInfo);
            }

            //add ledger
            $cal = calcFinalAmount($res);
            if($cal){
                $paymentHistoryData = [];
                $where = [
                    'purpose'=>'ROOM_AMOUNT',
                    'tbl_id'=>$resData->id,
                    'tbl_name'=>'reservations',
                ];
                $paymentHistoryData['purpose'] = $where['purpose'];
                $paymentHistoryData['tbl_id'] = $where['tbl_id'];
                $paymentHistoryData['tbl_name'] = $where['tbl_name'];
                $paymentHistoryData['payment_date'] = date('Y-m-d H:i:s');
                $paymentHistoryData['customer_id'] = $res->customer_id;
                $paymentHistoryData['user_id'] = getCustomerInfo($res->customer_id)->user_id;
                $paymentHistoryData['added_by'] = Auth::user()->id;
                $paymentHistoryData['payment_amount'] = $cal['finalRoomAmount'];
                $paymentHistoryData['payment_type'] = getPaymentModeById($resData->payment_mode);
                $paymentHistoryData['credit_debit'] = 'Debit';
                $paymentHistoryData['payment_of'] = 'cr';
                $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                $this->core->updateOrCreatePH($where, $paymentHistoryData);

                if($cal['finalOrderAmount'] > 0){
                    $where = [
                        'purpose'=>'FOOD_ORDER_AMOUNT',
                        'tbl_id'=>$orderData->id,
                        'tbl_name'=>'orders',
                    ];
                    $paymentHistoryData['purpose'] = $where['purpose'];
                    $paymentHistoryData['tbl_id'] = $where['tbl_id'];
                    $paymentHistoryData['tbl_name'] = $where['tbl_name'];
                    $paymentHistoryData['payment_amount'] = $cal['finalOrderAmount'];
                    $this->core->updateOrCreatePH($where, $paymentHistoryData);
                }
            }




//            if(env('APP_NT_ENABLE') == true){
//                $settings = getSettings();
//                if(isset($settings['ntmp_status']) && isset($settings['ntmp_api_key'])){
//                    if($settings['ntmp_status'] == 'true' && $settings['ntmp_api_key'] != NULL)
//                    {
//                        $curl_record = CurlRequest::where('reservation_id', $request->id)->first();
//                        if($curl_record){
//                            $post_data = json_decode($curl_record->post_data, true);
//                            $post_data['transactionId'] = getNTTransactionId($request->id);
//                            $post_data['transactionTypeId'] = '3';
//                            $post_data['cuFlag'] = '1';
//                            $url = getNtmpUrl($settings['ntmp_type'], 'CreateOrUpdateBooking');
//                            $header = [
//                                'Content-Type: application/json',
//                                'x-Gateway-APIKey: '.$settings['ntmp_api_key'].'',
//                                'Authorization: Basic '.base64_encode($settings['ntmp_user_id'].':'.$settings['ntmp_password']).''
//                            ];
//                            if(env('APP_NT_ENABLE_EXPENSE') == true){
//                                $url2 = getNtmpUrl($settings['ntmp_type'], 'BookingExpenseDetails');
//                                $post_data_for_expense = [
//                                    'transactionId'=>$post_data['transactionId'],
//                                    'userId'=>$post_data['userId'],
//                                    'channel'=>$post_data['channel'],
//                                    'expenseItems'=>getNTExpenseItems($request->id),
//                                ];
//
//
//
//                            }
//                            $resp = $this->core->sendCurl(
//                                $url,
//                                'POST',
//                                $header,
//                                $post_data
//                            );
//                            CurlHistory::insert(['url' => $url,
//                                'reservation_id'=> $request->id,
//                                'request_type' => 'POST',
//                                'header' => json_encode($header),
//                                'post_data' => json_encode($post_data),
//                                'response_data' => $resp['response'],
//                                'what_happen'=> 'Checkout'
//                            ]);
//                            if($resp['status']){
//                                CurlRequest::updateOrCreate(['reservation_id'=>$request->id], ['url' => $url,
//                                    'reservation_id'=> $request->id,
//                                    'request_type' => 'POST',
//                                    'header' => json_encode($header),
//                                    'post_data' => json_encode($post_data),
//                                    'response_data' => ($resp['status'] == true) ? $resp['response'] : json_encode([]),
//                                    'what_happen'=> 'Checkout'
//                                ]);
//                            }
//                        }
//
//
//
//                    }
//                }
//            }

            if(env('APP_NT_ENABLE') == true){
                $settings = getSettings();
                if(isset($settings['ntmp_status']) && isset($settings['ntmp_api_key'])){
                    if($settings['ntmp_status'] == 'true' && $settings['ntmp_api_key'] != NULL)
                    {
                        $curl_record = CurlRequest::where('reservation_id', $request->id)->first();
                        if($curl_record){
                            $post_data = json_decode($curl_record->post_data, true);
                            $post_data['transactionId'] = getNTTransactionId($request->id);
                            $post_data['transactionTypeId'] = '3';
                            $post_data['cuFlag'] = '1';
                            $url = getNtmpUrl($settings['ntmp_type'], 'CreateOrUpdateBooking');
                            $header = [
                                'Content-Type: application/json',
                                'x-Gateway-APIKey: '.$settings['ntmp_api_key'].'',
                                'Authorization: Basic '.base64_encode($settings['ntmp_user_id'].':'.$settings['ntmp_password']).''
                            ];
                            if(env('APP_NT_ENABLE_EXPENSE') == true){
                                $url2 = getNtmpUrl($settings['ntmp_type'], 'BookingExpenseDetails');
                                $get_percentage_tax = ($request['amount']['order_amount_gst']/$request['amount']['order_amount']) * 100;
                                $get_percentage_discount = ($request['discount_order_amount']/$request['amount']['order_amount']) * 100;
                                $get_percentage_ctax = ($request['amount']['order_amount_cgst']/$request['amount']['order_amount']) * 100;
                                $post_data_for_expense = [
                                    'transactionId'=>$post_data['transactionId'],
                                    'userId'=>$post_data['userId'],
                                    'channel'=>$post_data['channel'],
                                    'expenseItems'=>getNTExpenseItems($request->id, $request, $get_percentage_tax, $get_percentage_discount, $get_percentage_ctax),
                                ];
                                if($request['additional_amount'] > 0){
                                    $post_data_for_expense['expenseItems'][] = [
                                        "expenseDate"=> (string) dateConvert($request['check_out_date'], 'Ymd'),
                                        "itemNumber"=> (string) $request['additional_amount_reason'],
                                        "expenseTypeId"=> (string) $request['mt_expence_type_id_additional'],
                                        "unitPrice"=> (string) $request['additional_amount'],
                                        "discount"=> (string) 0,
                                        "vat"=> (string) 0,
                                        "municipalityTax"=> (string) 0,
                                        "grandTotal"=> (string) $request['additional_amount'],
                                        "paymentType"=> "1",
                                        "cuFlag"=> "1"
                                    ];
                                }
                                $resp_2 = $this->core->sendCurl(
                                    $url,
                                    'POST',
                                    $header,
                                    $post_data_for_expense
                                );
                                CurlHistory::insert(['url' => $url,
                                    'reservation_id'=> $request->id,
                                    'request_type' => 'POST',
                                    'header' => json_encode($header),
                                    'post_data' => json_encode($post_data_for_expense),
                                    'response_data' => $resp_2['response'],
                                    'what_happen'=> 'Checkout'
                                ]);
                                if($resp_2['status']){
                                    CurlRequest::updateOrCreate(['reservation_id'=>$request->id], ['url' => $url,
                                        'reservation_id'=> $request->id,
                                        'request_type' => 'POST',
                                        'header' => json_encode($header),
                                        'post_data' => json_encode($post_data_for_expense),
                                        'response_data' => ($resp_2['status'] == true) ? $resp_2['response'] : json_encode([]),
                                        'what_happen'=> 'Checkout'
                                    ]);
                                }

                            }
                            $resp = $this->core->sendCurl(
                                $url,
                                'POST',
                                $header,
                                $post_data
                            );
                            CurlHistory::insert(['url' => $url,
                                'reservation_id'=> $request->id,
                                'request_type' => 'POST',
                                'header' => json_encode($header),
                                'post_data' => json_encode($post_data),
                                'response_data' => $resp['response'],
                                'what_happen'=> 'Checkout'
                            ]);
                            if($resp['status']){
                                CurlRequest::updateOrCreate(['reservation_id'=>$request->id], ['url' => $url,
                                    'reservation_id'=> $request->id,
                                    'request_type' => 'POST',
                                    'header' => json_encode($header),
                                    'post_data' => json_encode($post_data),
                                    'response_data' => ($resp['status'] == true) ? $resp['response'] : json_encode([]),
                                    'what_happen'=> 'Checkout'
                                ]);
                            }

                        }



                    }
                }
            }

            //send sms
            if($mobile!=''){
                $this->core->sendSms(2,$mobile,['name'=>$name]);
            }
            return redirect()->route('list-reservation')->with(['success' => config('constants.FLASH_CHECKOUT_1')]);
        }
















        return redirect()->back()->with(['error' => config('constants.FLASH_CHECKOUT_0')]);
    }
    public function invoice(Request $request) {
        $this->data['type'] = $request->type;
        $this->data['data_row']=Reservation::with('orders_items','orders_info', 'booked_rooms')->whereId($request->id)->first();
         return view('backend/rooms/invoice',$this->data);
    }
    public function listReservation() {
        $startDate = getNextPrevDate('prev');
        $this->data['list'] = 'check_ins';
        $this->data['datalist'] = Reservation::with('booked_rooms')->whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(0)->orderBy('created_at','DESC')->get();
        $this->data['roomtypes_list']=getRoomTypesList();
        $this->data['customer_list']=getCustomerList('get', 'all');
        $this->data['search_data'] = ['customer_id'=>'','room_type_id'=>'','date_from'=>$startDate, 'date_to'=>date('Y-m-d')];
        return view('backend/rooms/room_reservation_list',$this->data);
    }
    public function listCheckOuts() {
        $startDate = getNextPrevDate('prev');
        $this->data['list'] = 'check_outs';
        $this->data['datalist']=Reservation::with('booked_rooms')->whereDate('check_out', '>=', $startDate." 00:00:00")->whereDate('check_out', '<=', DB::raw('CURDATE()'))->whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(1)->orderBy('created_at','DESC')->get();
        $this->data['roomtypes_list']=getRoomTypesList();
        $this->data['customer_list']=getCustomerList('get', 'all');
        $this->data['search_data'] = ['customer_id'=>'','room_type_id'=>'','date_from'=>$startDate, 'date_to'=>date('Y-m-d')];

         return view('backend/rooms/room_reservation_list',$this->data);
    }
    public function markAsPaid(Request $request){
        $this->data['data_row']=Reservation::whereId($request->id)->whereIsCheckout(1)->first();
        if($this->data['data_row']){
            Reservation::whereId($request->id)->update(['payment_status'=>1]);
            return redirect()->route('list-reservation')->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        } else {
            return redirect()->route('list-reservation')->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
        }
    }
    public function advancePay(Request $request) {
        $resData = Reservation::find($request->id);
        if($resData){
            $advance = ($resData->advance_payment) ? $resData->advance_payment+$request->advance_payment : $request->advance_payment;
            $postData = ["advance_payment" => $advance];
            $res = Reservation::updateOrCreate(['id'=>$request->id],$postData);
            if($res){
                //add ledger
                if($request->advance_payment){
                    $paymentHistoryData = [
                        'purpose'=>'ROOM_ADVANCE',
                        'tbl_id'=>$resData->id,
                        'tbl_name'=>'reservations',
                    ];
                    $paymentHistoryData['payment_date'] = date('Y-m-d H:i:s');
                    $paymentHistoryData['customer_id'] = $resData->customer_id;
                    $paymentHistoryData['user_id'] = getCustomerInfo($resData->customer_id)->user_id;
                    $paymentHistoryData['added_by'] = Auth::user()->id;
                    $paymentHistoryData['payment_amount'] = $request->advance_payment;
                    $paymentHistoryData['payment_type'] = getPaymentModeById($request->payment_mode);
                    $paymentHistoryData['credit_debit'] = 'Debit';
                    $paymentHistoryData['payment_of'] = 'cr';
                    $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                    $this->core->storePH($paymentHistoryData);
                }

                return redirect()->back()->with(['success' => config('constants.FLASH_REC_ADD_1')]);
            }
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_ADD_0')]);
    }


    public function extendDays(Request $request) {
        $resData = Reservation::findOrFail($request->id);
        if($resData){
            if($request->days_type == 0){
                $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $resData->check_out);
                $daysToAdd = $request->days;
                $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date->addDays($daysToAdd));
            }elseif($request->days_type == 1){
                $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $resData->check_out);
                $daysToAdd = $request->days;
                $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date->subDays($daysToAdd));
            }
            $postData = [
                'check_out'=>$date->toDateTimeString()
            ];
            $reservation_update = $postData;
            $reservation_update['duration_of_stay'] = $resData->duration_of_stay+$daysToAdd;

            $res = Reservation::updateOrCreate(['id'=>$request->id],$reservation_update);
            $res = true;
            if($res){
                BookedRoom::where(['reservation_id'=>$request->id, 'is_checkout'=>0])->update($postData);
                if(env('APP_NT_ENABLE') == true){
                    $settings = getSettings();
                    if(isset($settings['ntmp_status']) && isset($settings['ntmp_api_key'])){
                        if($settings['ntmp_status'] == 'true' && $settings['ntmp_api_key'] != NULL)
                        {
                            $curl_record = CurlRequest::where('reservation_id', $request->id)->first();
                            if($curl_record){
                                $post_data = json_decode($curl_record->post_data, true);
                                $post_data['transactionId'] = getNTTransactionId($request->id);
                                $post_data['cuFlag'] = '2';
                                $change_post_data = getNTDataExtend($request->id, $post_data);
                                $url = getNtmpUrl($settings['ntmp_type'], 'CreateOrUpdateBooking');
                                $header = [
                                    'Content-Type: application/json',
                                    'x-Gateway-APIKey: '.$settings['ntmp_api_key'].'',
                                    'Authorization: Basic '.base64_encode($settings['ntmp_user_id'].':'.$settings['ntmp_password']).''
                                ];

                                $resp = $this->core->sendCurl(
                                    $url,
                                    'POST',
                                    $header,
                                    $change_post_data
                                );
                                CurlHistory::insert(['url' => $url,
                                    'reservation_id'=> $request->id,
                                    'request_type' => 'POST',
                                    'header' => json_encode($header),
                                    'post_data' => json_encode($change_post_data),
                                    'response_data' => $resp['response'],
                                    'what_happen'=> 'Extend booking dates'
                                ]);
                                if($resp['status']){
                                    CurlRequest::updateOrCreate(['reservation_id'=>$request->id], ['url' => $url,
                                        'reservation_id'=> $request->id,
                                        'request_type' => 'POST',
                                        'header' => json_encode($header),
                                        'post_data' => json_encode($change_post_data),
                                        'response_data' => ($resp['status'] == true) ? $resp['response'] : json_encode([]),
                                        'what_happen'=> 'Extend booking dates'
                                    ]);
                                }
                            }
                        }
                    }
                }
             return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
            }else{
                return redirect()->back()->with(['error' => config('constants.FLASH_REC_ADD_0')]);
            }

        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_ADD_0')]);
    }


    public function swapRoom(Request $request) {
        $reservationData = getReservationById($request->id);
        if(!$reservationData){
            return redirect()->back()->with(['error' => config('constants.FLASH_INVALID_PARAMS')]);
        }
        $this->data['reservation_id'] = $request->id;
        $this->data['booked_rooms'] = getBookedRooms(['reservation_id'=>$request->id]);
        $this->data['roomtypes_list']=getRoomTypesListWithRooms('custom');
        return view('backend/rooms/room_swap',$this->data);
    }
    public function saveSwapRoom(Request $request) {


        if(!$request->new_room || !$request->old_room){
            return redirect()->back()->with(['error' => config('constants.FLASH_ALL_FIELD_REQUIRED')]);
        }

        $expNewRoom = explode('~', $request->new_room);
        $expOldRoom = explode('~', $request->old_room);

        //get booked old room info
        $queryBookedRoom = BookedRoom::where('reservation_id', $request->id)->where('room_type_id', $expOldRoom[0])->where('room_id', $expOldRoom[1])->whereIsCheckout(0);
        $bookedRoomData = $queryBookedRoom->first();
        //get roomType by id
        $roomTypeDetails = getRoomTypeById($expNewRoom[0]);

        //set old room data array
        $oldRoomData = [
            'check_in' => $bookedRoomData->check_in,
            'check_out' => date('Y-m-d H:i:s'),
            'swapped_from_room' => $expNewRoom[1],
            'is_checkout' => 1,
        ];

        $queryBookedRoom->update($oldRoomData);



        $settings = getSettings();
        $gstPerc = $settings['gst'];
        $cgstPerc = $settings['cgst'];
        // old logic
        // $base_price = ($request['roomtype_'.$expNewRoom[0]] / (100+$gstPerc+$cgstPerc)) * 100;
        // new logic
        $base_room_price = $request['roomtype_'.$expNewRoom[0]] /  ( (1 + $cgstPerc/100)  + ( (1 + $cgstPerc/100)   * $gstPerc/100 ) );
        $cgst_tax = $base_room_price * ($cgstPerc / 100);
        $gst_tax = ($base_room_price + $cgst_tax) *  ($gstPerc/100);
        //set new room data array
        $newRoomData = [
            'reservation_id'=> $request->id,
            'room_type_id'=> $expNewRoom[0],
            'room_id'=> $expNewRoom[1],
            'room_price'=> $base_room_price,
            'room_cgst'=>$cgst_tax,
            'room_gst'=>$gst_tax,
            'check_in' => date('Y-m-d H:i:s'),
            'check_out' =>$bookedRoomData->check_out,
        ];
        $res = BookedRoom::insert($newRoomData);
        $res = true;

        if(env('APP_NT_ENABLE') == true){
            $settings = getSettings();
            if(isset($settings['ntmp_status']) && isset($settings['ntmp_api_key'])){
                if($settings['ntmp_status'] == 'true' && $settings['ntmp_api_key'] != NULL)
                {
                    $curl_record = CurlRequest::where('reservation_id', $request->id)->first();
                    if($curl_record){
                        $post_data = json_decode($curl_record->post_data, true);
                        $post_data['transactionId'] = getNTTransactionId($request->id);
                        $post_data['cuFlag'] = '2';



                        $change_post_data = getNTRoomSwap($request->id, $post_data, getRoomById($expOldRoom[1])->room_no,getRoomById($expNewRoom[1])->room_no);

                        $url = getNtmpUrl($settings['ntmp_type'], 'CreateOrUpdateBooking');
                        $header = [
                            'Content-Type: application/json',
                            'x-Gateway-APIKey: '.$settings['ntmp_api_key'].'',
                            'Authorization: Basic '.base64_encode($settings['ntmp_user_id'].':'.$settings['ntmp_password']).''
                        ];

                        $resp = $this->core->sendCurl(
                            $url,
                            'POST',
                            $header,
                            $change_post_data
                        );
                        CurlHistory::insert(['url' => $url,
                            'reservation_id'=> $request->id,
                            'request_type' => 'POST',
                            'header' => json_encode($header),
                            'post_data' => json_encode($change_post_data),
                            'response_data' => $resp['response'],
                            'what_happen'=> 'Swap booking room'
                        ]);
                        if($resp['status']){
                            CurlRequest::updateOrCreate(['reservation_id'=>$request->id], ['url' => $url,
                                'reservation_id'=> $request->id,
                                'request_type' => 'POST',
                                'header' => json_encode($header),
                                'post_data' => json_encode($change_post_data),
                                'response_data' => ($resp['status'] == true) ? $resp['response'] : json_encode([]),
                                'what_happen'=> 'Swap booking room'
                            ]);
                        }
                    }
                }
            }
        }


        if($res){
            return redirect()->back()->with(['success' => config('constants.FLASH_ROOM_SWAP_1')]);
        }
        return redirect()->back()->with(['success' => config('constants.FLASH_ROOM_SWAP_0')]);

    }
    public function deleteReservation(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(Reservation::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

/* ***** End RoomReservation Functions ***** */

/* ***** Start FoodCategory Functions ***** */
    public function addFoodCategory() {
        return view('backend/food_category_add_edit',$this->data);
    }
    public function editFoodCategory(Request $request){
        $this->data['data_row']=FoodCategory::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/food_category_add_edit',$this->data);
    }
    public function saveFoodCategory(Request $request) {
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
        $res = FoodCategory::updateOrCreate(['id'=>$request->id],$request->except(['_token']));

        if($res){
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listFoodCategory() {
         $this->data['datalist']=FoodCategory::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->get();
        return view('backend/food_category_list',$this->data);
    }
    public function deleteFoodCategory(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(FoodCategory::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
/* ***** End FoodCategory Functions ***** */

/* ***** Start FoodItems Functions ***** */
    public function addFoodItem() {
        $this->data['category_list']=$this->getFoodCategoryList();
        return view('backend/food_item_add_edit',$this->data);
    }
    public function editFoodItem(Request $request){
        $this->data['category_list']=$this->getFoodCategoryList();
        $this->data['data_row']=FoodItem::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/food_item_add_edit',$this->data);
    }
    public function saveFoodItem(Request $request) {
        if($request->id>0){
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        $res = FoodItem::updateOrCreate(['id'=>$request->id],$request->except(['_token']));

        if($res){
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listFoodItem() {
         $this->data['datalist']=FoodItem::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->get();
        return view('backend/food_item_list',$this->data);
    }
    public function deleteFoodItem(Request $request) {
        if(FoodItem::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
/* ***** End FoodItems Functions ***** */

/* ***** Start ExpenseCategory Functions ***** */
    public function addExpenseCategory() {
        return view('backend/expenses/category_add_edit',$this->data);
    }
    public function editExpenseCategory(Request $request){
        $this->data['data_row']=ExpenseCategory::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/expenses/category_add_edit',$this->data);
    }
    public function saveExpenseCategory(Request $request) {
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
        $res = ExpenseCategory::updateOrCreate(['id'=>$request->id],$request->except(['_token']));

        if($res){
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listExpenseCategory() {
         $this->data['datalist']=ExpenseCategory::whereStatus(1)->orderBy('name','ASC')->get();
        return view('backend/expenses/category_list',$this->data);
    }
    public function deleteExpenseCategory(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(ExpenseCategory::whereId($request->id)->update(['status'=>0])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
/* ***** End ExpenseCategory Functions ***** */

/* ***** Start Expenses Functions ***** */
    public function addExpense() {
        $this->data['category_list']=$this->getExpenseCategoryList();
        return view('backend/expenses/add_edit',$this->data);
    }
    public function editExpense(Request $request){
        $this->data['category_list']=$this->getExpenseCategoryList();
        $this->data['data_row']=Expense::with('attachments')->whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/expenses/add_edit',$this->data);
    }
    public function saveExpense(Request $request) {
        if($request->id>0){
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        $res = Expense::updateOrCreate(['id'=>$request->id],$request->except(['_token']));

        if($res){
            $mediaData = [
                'tbl_id'=>$res->id,
                'media_ids'=>$request->media_ids,
                'files'=>($request->hasFile('attachments')) ? $request->attachments : null,
                'folder_path'=>'uploads/expenses',
                'type'=>'expenses',
            ];
            $this->core->uploadAndUnlinkMediaFile($mediaData);

             if($request->amount){
                $where = [
                    'purpose'=>'EXPENSE',
                    'tbl_id'=>$res->id,
                    'tbl_name'=>'expenses',
                ];
                $paymentHistoryData = $where;
                $paymentHistoryData['payment_date'] = $res->datetime;
                $paymentHistoryData['customer_id'] = null;
                $paymentHistoryData['user_id'] = Auth::user()->id;
                $paymentHistoryData['added_by'] = Auth::user()->id;
                $paymentHistoryData['payment_amount'] = $res->amount;
                $paymentHistoryData['payment_type'] = getPaymentModeById('cash');
                $paymentHistoryData['credit_debit'] = '';
                $paymentHistoryData['payment_of'] = 'dr';
                $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                $this->core->updateOrCreatePH($where, $paymentHistoryData);
            }

            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listExpense() {
        $startDate = getNextPrevDate('prev');
        $this->data['category_list']=$this->getExpenseCategoryList();
         $this->data['datalist']=Expense::whereDate('datetime', '>=', $startDate." 00:00:00")->whereDate('datetime', '<=', DB::raw('CURDATE()'))->orderBy('datetime','DESC')->get();
         $this->data['search_data'] = ['category_id'=>'','date_from'=>$startDate, 'date_to'=>date('Y-m-d')];
        return view('backend/expenses/list',$this->data);
    }
    public function deleteExpense(Request $request) {
        if(Expense::whereId($request->id)->delete()){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
/* ***** End Expenses Functions ***** */

/* ***** Start StockManage Functions ***** */
    public function addProduct() {
        return view('backend/product_add_edit',$this->data);
    }
    public function editProduct(Request $request){
        $this->data['data_row']=Product::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/product_add_edit',$this->data);
    }
    public function saveProduct(Request $request) {
        // dd($request->all());
        // dd($request->status_id);
        if($request->id>0){
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        $res = Product::updateOrCreate(['id'=>$request->id],$request->except(['_token','curr_stock']));
        // dd($res);
        if($res){
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }
    public function listProduct() {
        //  $this->data['datalist']=Product::whereStatus(1)->whereIsDeleted(0)->orderBy('stock_qty','ASC')->get();
         $this->data['datalist']=Product::whereIsDeleted(0)->orderBy('stock_qty','ASC')->get();
        return view('backend/product_list',$this->data);
    }
    public function deleteProduct(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        if(Product::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    public function inOutStock() {
        $this->data['product_list']=$this->getProductList();
        return view('backend/stock_in_out',$this->data);
    }
    public function saveStock(Request $request) {
        $request->merge(['added_by'=>Auth::user()->id]);
        $res = StockHistory::insert($request->except(['_token']));
        if($res){
            if($request->stock_is=='add'){
                Product::whereId($request->product_id)->increment('stock_qty', $request->qty);
            } else {
               Product::whereId($request->product_id)->decrement('stock_qty', $request->qty);
            }
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_ADD_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_ADD_0')]);
    }
    public function stockHistory() {
        $startDate = getNextPrevDate('prev');
        $this->data['datalist']=StockHistory::whereDate('created_at', '>=', $startDate." 00:00:00")->whereDate('created_at', '<=', DB::raw('CURDATE()'))->orderBy('id','DESC')->get();
        $this->data['products']=Product::where('is_deleted',0)->pluck('name','id');
        $this->data['search_data'] = ['product_id'=>'','is_stock'=>'','date_from'=>$startDate, 'date_to'=>date('Y-m-d')];
        return view('backend/stock_history',$this->data);
    }
/* ***** End StockManage Functions ***** */

/* ***** Start FoodOrders Functions ***** */
    public function listOrders() {
        $this->data['datalist']=Order::whereDate('created_at', DB::raw('CURDATE()'))->where('status','!=',4)->orderBy('id','DESC')->get();
        $this->data['search_data'] = ['date_from'=>date('Y-m-d'), 'date_to'=>date('Y-m-d')];
        return view('backend/orders_list',$this->data);
    }
    public function foodOrder() {
        $this->data['categories_list']=FoodCategory::with('food_items')->whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->get();
        return view('backend/food_order_page',$this->data);
    }
    public function foodOrderTable(Request $request) {
        $this->data['categories_list']=FoodCategory::with('food_items')->whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->get();
         $this->data['order_row']=Order::where('id',$request->segment(3))->first();
        return view('backend/food_order_table_page',$this->data);
    }
    public function foodOrderFinal(Request $request) {
        $this->data['categories_list']=FoodCategory::with('food_items')->whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->get();
        $this->data['order_row']=Order::where('id',$request->segment(3))->first();
        return view('backend/food_order_final_page',$this->data);
    }
    public function saveFoodOrder(Request $request){
        // dd($request->all());
        $insertRec = true;
        $insertRecOrderHistorty = true;
        $orderHistoryResId = null;

        $invoiceDate = date('Y-m-d');
        $settings = getSettings();
        $orderArr = [];
        $itemsArr = array_filter($request->item_qty);
        if(count($itemsArr)>0){
            $orderData = [];
            $gstPerc = $cgstPerc = $gstAmount = $cgstAmount = 0;
            if($request->food_gst_apply==1){
                $gstPerc = $request->gst_perc;
                $cgstPerc = $request->cgst_perc;
                $gstAmount = $request->gst_amount;
                $cgstAmount = $request->cgst_amount;
            }
            $orderInfo= [
                'reservation_id'=>$request->reservation_id,
                'invoice_num'=>($request->food_invoice_apply=="on") ? getNextInvoiceNo('orders') : null,
                'invoice_date'=>$invoiceDate,
                'table_num'=>$request->table_num,
                'gst_apply'=>$request->food_gst_apply,
                'gst_perc'=>$gstPerc,
                'gst_amount'=>$gstAmount,
                'cgst_perc'=>$cgstPerc,
                'cgst_amount'=>$cgstAmount,
                'discount'=>$request->discount_amount,
                'total_amount'=>$request->final_amount,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'gender' => $request->gender,
                'num_of_person' => $request->num_of_person,
                'waiter_name' => $request->waiter_name,
                'payment_mode' => $request->payment_mode,

            ];
            if($request->page=='ff_order'){
                $orderInfo['original_date'] = date('Y-m-d H:i:s');
                $orderRes = Order::where('id',$request->order_id)->update($orderInfo);
                if($orderRes){
                    OrderHistory::where('order_id',$request->order_id)->update(['is_book'=>0]);

                    //send sms
                    if($request->mobile){
                        $this->core->sendSms(3,$request->mobile,['name'=>$request->name]);
                    }

                    return redirect()->route('order-invoice-final',[$request->order_id])->with(['success' => 'Orders Successfully submitted']);
                } else {
                    return redirect()->back()->with(['error' => 'Order placed failed.Try again']);
                }

            } else {
                if($request->reservation_id>0){
                    $insertRecOrderHistorty = false;
                } else {
                    // check table num is booked or not (if table num booked , no new orders row added, added in orderHistory table)
                    $isTableBooked = isTableBook($request->table_num);
                    if($isTableBooked){
                        $insertRec = false;
                        $orderResId = $isTableBooked->order_id;
                    }
                }

                if($insertRec){
                    $orderResId = Order::insertGetId($orderInfo);
                }
                if($insertRecOrderHistorty){
                    $orderHistoryResId = OrderHistory::insertGetId(['order_id'=>$orderResId, 'table_num'=>$request->table_num]);
                }

                $lastOrderId = $orderResId; // $orderRes->id;
                foreach($itemsArr as $k=>$val){
                    $exp = explode('~', $request->items[$k]);
                    $jsonData = ['category_id'=>$exp[0], 'category_name'=>$exp[1], 'item_name'=>$exp[2], 'item_id'=>$k];
                    // apply the tax flag on order items
                    $item_tax = $exp[3] * $request->gst_perc/100;
                    if($request->food_tax == "on"){
                        $tax_flag = 1;
                    }else{
                        $tax_flag = 0;
                    }
                    $orderArr[] = [
                        'order_id'=>$lastOrderId,
                        'order_history_id'=>$orderHistoryResId,
                        'reservation_id'=>$request->reservation_id,
                        'item_name'=>$exp[2],
                        'item_price'=>$exp[3],
                        'item_qty'=>$val,
                        'json_data'=>json_encode($jsonData),
                        'status'=>3,
                        'item_tax'=>$item_tax,
                        'tax_flag'=>$tax_flag,
                        'order_gst_perc'=>$request->gst_perc,
                    ];
                }
                $res = OrderItem::insert($orderArr);
                if($res){
                    if($request->reservation_id>0) {
                        return redirect()->route('kitchen-invoice',['order_id'=>$lastOrderId,'order_type'=>'room-order'])->with(['success' => 'Orders Successfully submitted']);
                    }
                    return redirect()->route('kitchen-invoice',['order_id'=>$orderHistoryResId,'order_type'=>'table-order'])->with(['success' => 'Orders Successfully submitted']);
                } else {
                    return redirect()->back()->with(['error' => 'Order placed failed.Try again']);
                }
            }


        }
        return redirect()->back()->with(['error' => 'Please item quantity']);
    }
    public function deleteOrderItem(Request $request) {
        if(OrderItem::whereId($request->id)->delete()){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    public function orderInvoice(Request $request) {
        $id = $request->segment(3);
        $this->data['data_row']=Order::with('orders_items')->whereId($id)->first();
        return view('backend/food_order_invoice',$this->data);
    }
    public function orderInvoiceFinal(Request $request) {
        $this->data['data_row']=Order::where('id',$request->segment(3))->first();
        return view('backend/food_order_final_invoice',$this->data);
    }
    public function kitchenInvoice(Request $request){
        $id = $request->segment(3);
        $type = $request->segment(4);
        if($type=='room-order'){
            $this->data['data_row']=Order::whereId($id)->first();
        } else {
            $this->data['data_row']=OrderHistory::with('order')->whereId($id)->first();
        }
         $this->data['type'] = $type;
        return view('backend/kitchen_invoice',$this->data);
    }
/* ***** End FoodOrders Functions ***** */

/* ***** Start Setting Functions ***** */
    public function settingsSms() {
        $this->data['data_row']=Setting::pluck('value','name');
        return view('backend/sms_settings',$this->data);
    }
    public function settingsForm() {
        $this->data['data_row']=Setting::pluck('value','name');
        return view('backend/settings',$this->data);
    }
    public function saveSettings(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        $requestExcept = ['_token', 'sms_api_active', 'site_logo'];
        $res = null;

        //save settings: sms api active or not
        $value = ($request->sms_api_active && $request->sms_api_active == 'on') ? 1 : 0;
        Setting::updateOrCreate(['name'=>'sms_api_active'], ['name'=>'sms_api_active', 'value'=>$value, 'updated_at'=>date('Y-m-d h:i:s')]);

        //update site logo
        if($request->hasFile('site_logo')){
            unlinkImg(getSettings('site_logo'),'uploads/logo/');
            $filename=$this->core->fileUpload($request->site_logo,'uploads/logo');
            Setting::updateOrCreate(['name'=>'site_logo'], ['name'=>'site_logo', 'value'=>$filename]);
        }
        foreach($request->all() as $key => $value){
            if(!in_array($key, $requestExcept)){
               $res = Setting::updateOrCreate(['name'=>$key], ['name'=>$key, 'value'=>$value, 'updated_at'=>date('Y-m-d h:i:s')]);
            }
        }
        if($res){
           //set updated settings in session
           setSettings();

            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }
/* ***** End Setting Functions ***** */

/* ***** Start Permissions Functions ***** */
    public function listPermission() {
        $this->data['datalist']=Permission::where('status',1)->orderBy('permission_type','ASC')->get();
        return view('backend/permissions/list',$this->data);
    }
    public function savePermission(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
        $requestExcept = ['_token'];
        $res = null;
        $ids = $request->ids;
        $superAdmin = $request->super_admin;
        $admin = $request->admin;
        $receptionist = $request->receptionist;
        $stokManager = $request->store_manager;
        $financialManager = $request->financial_manager;
        foreach($ids as $key => $id){
            $superAdminP = 1; //not change superadmin, so set default 1
            $adminP = $recP = $smP = $fmP = 0;
            if(isset($superAdmin[$id])){
                $superAdminP = 1;
            }
            if(isset($admin[$id])){
                $adminP = 1;
            }
            if(isset($receptionist[$id])){
                $recP = 1;
            }
            if(isset($stokManager[$id])){
                $smP = 1;
            }
            if(isset($financialManager[$id])){
                $fmP = 1;
            }
            $res = Permission::where('id',$id)->update(["super_admin"=>$superAdminP, 'admin'=>$adminP, 'receptionist'=>$recP, 'store_manager'=>$smP, 'financial_manager'=>$fmP ]);
        }
        if($res){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }
/* ***** End Permissions Functions ***** */
    public function deleteMediaFile(Request $request) {
        $row_data= MediaFile::whereId($request->id)->first();
        if(MediaFile::whereId($request->id)->delete()){
            unlinkImg($row_data->file,'uploads/'.$row_data->type.'/');
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

/* ***** Start Dynamic Dropdowns Functions ***** */
    public function listDynamicDropdowns() {
        $dynamicDropdowns=DynamicDropdown::where('status', 1)->where('is_deleted', 0)->orderBy('dropdown_name','ASC')->orderBy('is_deletable','ASC')->get();
        $datalist = [];
        foreach ($dynamicDropdowns as $key => $value) {
            if(isset($datalist[$value->dropdown_name])){
                $datalist[$value->dropdown_name]['values'][] = $value;
            } else {
                $datalist[$value->dropdown_name] = ['dropdown_name'=>$value->dropdown_name, 'title'=>lang_trans('txt_dropdown_'.$value->dropdown_name), 'values'=>[$value]];
            }
        }
        $this->data['datalist'] = $datalist;
        return view('backend/dynamic_dropdowns/list',$this->data);
    }
    public function saveDynamicDropdowns(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
       $res = null;
       foreach($request->all() as $dropdownName => $dropdownValues){
            $ids = [];
            if(is_array($dropdownValues)){
                foreach($dropdownValues as $k=>$v){
                    $where = ["id"=> $k, "dropdown_name"=>$dropdownName];
                    $data = ['dropdown_name'=>$dropdownName, 'dropdown_value'=>$v, 'is_deletable'=>1];

                    $dropdownObj = getDynamicDropdownRecord($where);
                    if($dropdownObj){
                        $data['is_deletable'] = $dropdownObj->is_deletable;
                    }
                    $res = DynamicDropdown::updateOrCreate($where, $data);
                    $ids[] = $res->id;
                }
                if(count($ids) > 0){
                    DynamicDropdown::where("dropdown_name", $dropdownName)->whereNotIn('id', $ids)->where('is_deletable', 1)->where('status', 1)->update(['is_deleted'=>1]);
                }
            }
        }
        if($res){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }
/* ***** End Dynamic Dropdowns Functions ***** */

/* ***** Start Internal Functions ***** */
    function getRoleList(){
        return Role::orderBy('role','ASC')->pluck('role','id');
    }
    function getAmenitiesList(){
        return Amenities::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->get();
    }
    function getFoodCategoryList(){
        return FoodCategory::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->pluck('name','id');
    }
    function getExpenseCategoryList(){
        return ExpenseCategory::whereStatus(1)->orderBy('name','ASC')->pluck('name','id');
    }
    function getProductList(){
        return Product::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->pluck('name','id');
    }
    function getRoomList(){
        $this->data['booked_rooms'] = getBookedRooms();
        $this->data['room_types'] = RoomType::with('rooms')->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
        return $this->data;
    }
    function addReservationRoom($reservationData, $request, $type = ''){
        $roomData = [];
        if($request->room_num && count($request->room_num) > 0){
            if($type == 'custom'){
                $settings = getSettings();
                $gstPerc = $settings['gst'];
                $cgstPerc = $settings['cgst'];
            }
            foreach($request->room_num as $val){
                $exp = explode('~', $val);
                $roomTypeDetails = getRoomTypeById($exp[0]);
                $base_price = $roomTypeDetails->base_price;
                $cgst_tax = $base_price * ($cgstPerc / 100);
                $gst_tax = ($base_price + $cgst_tax) *  ($gstPerc/100);

                if((float) $roomTypeDetails->base_price != (float) $request['roomtype_'.$exp[0]]){
                    $base_price = (float) $request['roomtype_'.$exp[0]];
                    if($type == 'custom'){
                        // $base_price =  $base_price / ( ($base_price + (($base_price/100) * $gstPerc))  + ( ($base_price + (($base_price/100) * $cgstPerc))  * $gstPerc/100 )  );
                        $base_price =  $base_price /  ( (1 + $cgstPerc/100)  + ( (1 + $cgstPerc/100)   * $gstPerc/100 ) );

                        $cgst_tax = $base_price * ($cgstPerc / 100);

                        $gst_tax = ($base_price + $cgst_tax) *  ($gstPerc/100);

                    }else{
                        $base_price = $base_price;
                    }
                }
                $roomData[] = [
                    'reservation_id'=>$reservationData->id,
                    'room_type_id'=>$exp[0],
                    'room_id'=>$exp[1],
                    'room_price'=>$base_price,
                    'room_cgst'=>$cgst_tax,
                    'room_gst'=>$gst_tax,
                    'check_in' =>dateConvert($request->check_in_date, 'Y-m-d H:i'),
                    'check_out' =>dateConvert($request->check_out_date, 'Y-m-d H:i'),
                ];
            }
            BookedRoom::insert($roomData);
        }
    }
    function cancelReservationRoom($reservationData, $request){
        $roomData = [];
        if($reservationData->booked_rooms && count($reservationData->booked_rooms) > 0){
            foreach($reservationData->booked_rooms as $val){
                if($val->cancelled == 0){
                    $roomData = [
                        'cancelled'=>1,
                    ];
                    BookedRoom::where('id', $val->id)->update($roomData);
                }
            }

        }
    }
    function updateReservationRoom($reservationData, $request){
        $roomData = [];
        if($reservationData->booked_rooms && count($reservationData->booked_rooms) > 0){
            foreach($reservationData->booked_rooms as $val){
                if($val->is_checkout == 0){
                    $roomData = [
                        'is_checkout'=>1,
                        'check_out' =>dateConvert($request->check_out_date, 'Y-m-d H:i'),
                    ];
                    BookedRoom::where('id', $val->id)->update($roomData);
                }
            }

        }
    }
/* ***** End Internal Functions ***** */

/* change setting for theme language and visibilty */

    public function changeSetting($val) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }
       
        if($val == "dark" || $val == "light" ){
            Setting::updateOrCreate(['name'=>"site_theme"], ['value'=>$val, 'updated_at'=>date('Y-m-d h:i:s')]);
        }
        
        if($val == "ar" || $val == "en" ){
            Setting::updateOrCreate(['name'=>"site_language"], ['value'=>$val, 'updated_at'=>date('Y-m-d h:i:s')]);
        }
        
        return redirect()->back();
    }

}
