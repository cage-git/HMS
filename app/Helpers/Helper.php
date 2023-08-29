<?php
use App\Permission;
use App\Setting;
use App\Reservation;
use App\Order,App\OrderHistory;
use App\Room,App\RoomType,App\BookedRoom,App\Amenities;
use App\Unit,App\Customer,App\Country;
use App\PaymentHistory;
use App\DynamicDropdown;
use App\User,App\Role;
use App\ExpenseCategory;
use App\Notification;
use App\Language,App\LanguageTranslation;
use App\Vendor;
use App\LaundryOrder;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;
function getPaginationNum($num = 10){
    return $num;
}
function getLangages(){
    return Language::where('status', 1)->pluck('lang_name','lang_code');
}
function lang_trans($key){
    $defaultLang = 'en';
    $cacheKey = getCacheKey('langTranslationsCache');
    if(isset(Session::get('settings')['site_language'])){
        $defaultLang = Session::get('settings')['site_language'];
    }
//    if(isset(config('lang_admin')[$key][$defaultLang])){
//        return config('lang_admin')[$key][$defaultLang];
//    }
    if (Cache::has($cacheKey)){
        $lang = Cache::get($cacheKey);
    } else {
        $lang = LanguageTranslation::where('pannel', 'backend')->pluck($defaultLang, 'lang_key')->toArray();
        Cache::put($cacheKey, $lang, config('constants.CACHING_TIME'));
    }
    if(isset($lang[$key])){
        return $lang[$key];
    }
    return $key;
}
function getCacheKey($key){
    $num = Auth::user() ? Auth::user()->id : date('ymd');
    return $key.'_'.$num;
}
function removeCacheKeys($key = null){
    if($key){
        Cache::forget($key);
    } else {
        Cache::flush();
    }
    return true;
}
function getAuthUserInfo($info = 'all'){
    $user = Auth::user() ? Auth::user() : null;

    if($info == 'id'){
      return $user->id;
    }

    $user->additional_info = null;
    if($user){
        $customerInfo = Customer::where('user_id', $user->id)->first();
        if($customerInfo) {
            $user->additional_info = $customerInfo;
        }
    }
    return $user;
}
function getCustomerInfo($customerId){
    return Customer::where('id', $customerId)->first();
}
function setSettings(){
    $settings = Setting::pluck('value','name');
    Session::put('settings', $settings);
    return $settings;
}
function getSettings($clm=null){
    // dd("asd");
    // if(Session::get('settings')){
    //     $settings = Session::get('settings');
    // } else {
        $settings = setSettings();
    //}

    if($clm==null){
        return $settings;
    }
    if(isset($settings[$clm])){
        return $settings[$clm];
    }
    return '';
}
function getDynamicDropdownById($id, $clm = 'all'){
    $data = DynamicDropdown::whereId($id)->first();
    if($data){
        if($clm != 'all'){
            return $data->{$clm};
        }
    }
    return $data;
}
function getDynamicDropdownRecord($where){
    return DynamicDropdown::where($where)->first();
}
function getDynamicDropdownList($dropdownName, $hasKey = false, $lang=""){
    $data = DynamicDropdown::where('dropdown_name', $dropdownName)->where('is_deleted', 0)->where('status', 1)->get();
    $list = [];
    if($data){
        foreach ($data as $key => $value) {
            if($hasKey){
                // if($lang=="ar"){
                //     $list[$value->drop_down_key] = $value->dropdown_value_ar;
                // }else if($lang=="en"){
                //     $list[$value->drop_down_key] = $value->dropdown_value_en;
                // }else{
                //     $list[$value->drop_down_key] = $value->dropdown_value;
                // }
                  $list[$value->drop_down_key] = $value->dropdown_value;
            }else{
                // if($lang=="ar"){
                //     $list[$value->id] = $value->dropdown_value_ar;
                // }else if($lang=="en"){
                //     $list[$value->id] = $value->dropdown_value_en;
                // }else{
                //     $list[$value->id] = $value->dropdown_value;
                // }
                 $list[$value->id] = $value->dropdown_value;
            }
        }
    }
    return $list;
}
function getCountries(){
    return Country::orderBy('name', 'ASC')->pluck('name','id');
}
function sendCurl($url, $type = 'GET', $header = [], $data = []) {
    $curl = curl_init();
    $curlOptions = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $type,
        CURLOPT_HTTPHEADER => $header,
    ];
    if($type == 'POST'){
        $curlOptions[CURLOPT_POSTFIELDS] = json_encode($data);
    }
    curl_setopt_array($curl, $curlOptions);
    $response = curl_exec($curl);
    $error_msg = null;
    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
    }
    curl_close($curl);
    if (isset($error_msg)) {
        return ['status'=>false, 'response'=>$response, 'error_msg' =>$error_msg];
    }else{
        return ['status'=>true, 'response'=>$response];
    }
    //return $response;
}
function getNTTransactionId($id = 0, $get_staus=false){
    $settings = getSettings();
    $url = getNtmpUrl($settings['ntmp_type'], 'GetTransactionIDByBookingNo');
    $header = [
        'Content-Type: application/json',
        'x-Gateway-APIKey: '.$settings['ntmp_api_key'].'',
        'Authorization: Basic '.base64_encode($settings['ntmp_user_id'].':'.$settings['ntmp_password']).''
    ];
    $prev_response_data = null;
    $getTranID = ["bookingNo"=>[$id.'_']];
    $resp = sendCurl(
        $url,
        'POST',
        $header,
        $getTranID
    );
    if($resp['status']){
        if($get_staus == false){
            $prev_response_data = (string) json_decode($resp['response'])->transactionDetails[0]->transactionId;
        }
        elseif($get_staus == true){
            $prev_response_data = (string) json_decode($resp['response'])->transactionDetails[0]->currentState;
        }

    }
    return $prev_response_data;
}

function getNTDataCancellation($request){
    $settings = getSettings();
        $url = getNtmpUrl($settings['ntmp_type'], 'GetTransactionIDByBookingNo');
    $header = [
        'Content-Type: application/json',
        'x-Gateway-APIKey: '.$settings['ntmp_api_key'].'',
        'Authorization: Basic '.base64_encode($settings['ntmp_user_id'].':'.$settings['ntmp_password']).''
    ];
    $datas = null;
    $getTranID = ["bookingNo"=>[$request->id.'_']];
    $resp = sendCurl(
        $url,
        'POST',
        $header,
        $getTranID
    );
    if($resp['status']){
        $prev_response_data = (array) json_decode($resp['response'])->transactionDetails[0];
        $datas = [
            "transactionId" => (string) $prev_response_data['transactionId'],
            "cancelReason" => "1",
            "cancelWithCharges" => "0",
            "chargeableDays" => "0",
            "roomRentType" => "0",
            "dailyRoomRate" => "0",
            "totalRoomRate" => "0",
            "vat" => "0",
            "municipalityTax" => "0",
            "discount" => "0",
            "grandTotal" => "0",
            "userId" => "Divllo",
            "paymentType" => "1",
            "cuFlag" => "2",
            "esbRefNo" => "",
            "channel" => "divllo"
        ];
    }

    return $datas;
}

function getNTExpenseItems($id, $request, $get_percentage_tax, $get_percentage_discount, $get_percentage_ctax){
    $data_row = Reservation::with('orders_items','orders_info', 'booked_rooms')->whereId($id)->first();

    $invoiceNum = ($data_row->orders_info != null) ? $data_row->orders_info->invoice_num : '';
    $calculatedAmount = calcFinalAmount($data_row, 1, false);
    $additionalAmount = $calculatedAmount['additionalAmount'];
    $additionalAmountReason = $data_row->additional_amount_reason;
    $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
    $gstPerc = $calculatedAmount['totalRoomGstPerc'];
    $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
    $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
    $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
    $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
    $subTotalRoomAmount = (($totalRoomAmount+$roomAmountGst+$roomAmountCGst) - $roomAmountDiscount)+$additionalAmount;
    $advancePayment = $calculatedAmount['advancePayment'];

    $dueAmount = $subTotalRoomAmount-$advancePayment;


    $gstPercFood = $calculatedAmount['totalOrderGstPerc'];
    $cgstPercFood = $calculatedAmount['totalOrderCGstPerc'];
    $foodAmountGst = $calculatedAmount['totalOrderAmountGst'];
    $foodAmountCGst = $calculatedAmount['totalOrderAmountCGst'];
    $foodOrderAmountDiscount = $calculatedAmount['totalOrderAmountDiscount'];
    $gstFoodApply = $calculatedAmount['gstFoodApply'];
    $totalOrdersAmount = $calculatedAmount['subtotalOrderAmount'];
    $finalOrderAmount = $calculatedAmount['finalOrderAmount'];
    $data_date = date('Y-m-d h:i:s', strtotime(str_replace('/','-', $data_row->check_out)));

    $make_expense_item = [];
//    $get_percentage_tax, $get_percentage_discount
    foreach($data_row->orders_items as $k=>$val){
        $_gt = numberFormat($val->item_qty*$val->item_price);
        $_dis = (($_gt/ 100) * $get_percentage_discount);
        $_vat = (($_gt/ 100) * $get_percentage_tax);
        $_cvat = (($_gt/ 100) * $get_percentage_ctax);
        $_sgt = ($_gt+$_vat+$_cvat) - $_dis;
        $make_expense_item[] = [
            "expenseDate"=> (string) dateConvert($val->check_out, 'Ymd'),
            "itemNumber"=> (string) $val->id,
            "expenseTypeId"=> (string) $request['mt_expence_type_id_'.$val->id.''],
            "unitPrice"=> (string) $_gt,
            "discount"=> (string) $_dis,
            "vat"=> (string) $_vat,
            "municipalityTax"=> (string) $_cvat,
            "grandTotal"=> (string) $_sgt,
            "paymentType"=> "1",
            "cuFlag"=> "1"
        ];
//        $totalOrdersAmount = $totalOrdersAmount + ($val->item_qty*$val->item_price);
//        echo ($k+1).'</br>';
//        echo $val->item_name.'</br>';
//        echo dateConvert($val->check_out,'d-m-Y').'</br>';
//        echo $val->item_qty.'</br>';
//        echo numberFormat($val->item_price).'</br>';
//        echo numberFormat($val->item_qty*$val->item_price).'</br>';
    }
//    echo numberFormat($totalOrdersAmount).'</br>';
//    if($foodAmountGst>0){
//        echo $gstPercFood.'</br>';
//        echo numberFormat($foodAmountGst).'</br>';
//    }
//    if($foodAmountCGst>0){
//        echo $cgstPercFood.'</br>';
//        echo numberFormat($foodAmountCGst).'</br>';
//    }
//    if($foodOrderAmountDiscount>0){
//        echo numberFormat($foodOrderAmountDiscount).'</br>';
//    }
//    echo numberFormat($finalOrderAmount).'</br>';
//    echo getIndianCurrency(numberFormat($finalOrderAmount)).'</br>';

    return $make_expense_item;
}
function getNTDataExtend($id, $post_data){
    $data_type = 'org';
    $data_data_row = Reservation::with('orders_items','orders_info', 'booked_rooms')->whereId($id)->first();
    //GETING CALCULATION
    $calculatedAmount = calcFinalAmount($data_data_row, 1, false);
    $additionalAmount = $calculatedAmount['additionalAmount'];
    $additionalAmountReason = $data_data_row->additional_amount_reason;
    $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
    $gstPerc = $calculatedAmount['totalRoomGstPerc'];
    $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
    $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
    $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
    $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
    $subTotalRoomAmount = (($totalRoomAmount+$roomAmountGst+$roomAmountCGst) - $roomAmountDiscount)+$additionalAmount;
    $advancePayment = $calculatedAmount['advancePayment'];
    $dueAmount = $subTotalRoomAmount-$advancePayment;
    $gstPercFood = $calculatedAmount['totalOrderGstPerc'];
    $cgstPercFood = $calculatedAmount['totalOrderCGstPerc'];
    $foodAmountGst = $calculatedAmount['totalOrderAmountGst'];
    $foodAmountCGst = $calculatedAmount['totalOrderAmountCGst'];
    $foodOrderAmountDiscount = $calculatedAmount['totalOrderAmountDiscount'];
    $gstFoodApply = $calculatedAmount['gstFoodApply'];
    $totalOrdersAmount = $calculatedAmount['subtotalOrderAmount'];
    $finalOrderAmount = $calculatedAmount['finalOrderAmount'];
    $data_date = date('Y-m-d h:i:s', strtotime(str_replace('/','-', $data_data_row->check_out)));

    $post_data['checkOutDate'] = (string) dateConvert($data_data_row->check_out, 'Ymd');
    $post_data['checkOutTime'] = (string) dateConvert($data_data_row->check_out, 'His');
    $post_data['totalDurationDays'] = (string) $data_data_row->duration_of_stay;
    $post_data['totalRoomRate'] = (string) $totalRoomAmount;
    $post_data['dailyRoomRate'] = (string) floor($totalRoomAmount / $data_data_row->duration_of_stay);
    $post_data['discount'] = (string) $roomAmountDiscount;
    $post_data['vat'] = (string) numberFormat($roomAmountGst);
    $post_data['municipalityTax'] = (string) numberFormat($roomAmountCGst);
    $post_data['grandTotal'] = (string) numberFormat($subTotalRoomAmount);
    return $post_data;






    //END CALCULATION













}

function getNTRoomSwap($id, $post_data, $old_room, $new_room){
    $data_type = 'org';
    $data_data_row = Reservation::with('orders_items','orders_info', 'booked_rooms')->whereId($id)->first();
    //GETING CALCULATION
    $calculatedAmount = calcFinalAmount($data_data_row, 1, false);
    $additionalAmount = $calculatedAmount['additionalAmount'];
    $additionalAmountReason = $data_data_row->additional_amount_reason;
    $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
    $gstPerc = $calculatedAmount['totalRoomGstPerc'];
    $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
    $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
    $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
    $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
    $subTotalRoomAmount = (($totalRoomAmount+$roomAmountGst+$roomAmountCGst) - $roomAmountDiscount)+$additionalAmount;
    $advancePayment = $calculatedAmount['advancePayment'];
    $dueAmount = $subTotalRoomAmount-$advancePayment;
    $gstPercFood = $calculatedAmount['totalOrderGstPerc'];
    $cgstPercFood = $calculatedAmount['totalOrderCGstPerc'];
    $foodAmountGst = $calculatedAmount['totalOrderAmountGst'];
    $foodAmountCGst = $calculatedAmount['totalOrderAmountCGst'];
    $foodOrderAmountDiscount = $calculatedAmount['totalOrderAmountDiscount'];
    $gstFoodApply = $calculatedAmount['gstFoodApply'];
    $totalOrdersAmount = $calculatedAmount['subtotalOrderAmount'];
    $finalOrderAmount = $calculatedAmount['finalOrderAmount'];
    $data_date = date('Y-m-d h:i:s', strtotime(str_replace('/','-', $data_data_row->check_out)));

    $exp_rooms = explode(',',$post_data['allotedRoomNo']);
    $exp_rooms[array_search ($old_room, $exp_rooms)] = $new_room;

    $post_data['allotedRoomNo'] = implode(',' , $exp_rooms);
    $post_data['checkOutDate'] = (string) dateConvert($data_data_row->check_out, 'Ymd');
    $post_data['checkOutTime'] = (string) dateConvert($data_data_row->check_out, 'His');
    $post_data['totalDurationDays'] = (string) $data_data_row->duration_of_stay;
    $post_data['totalRoomRate'] = (string) $totalRoomAmount;
    $post_data['dailyRoomRate'] = (string) floor($totalRoomAmount / $data_data_row->duration_of_stay);
    $post_data['discount'] = (string) $roomAmountDiscount;
    $post_data['vat'] = (string) numberFormat($roomAmountGst);
    $post_data['municipalityTax'] = (string) numberFormat($roomAmountCGst);
    $post_data['grandTotal'] = (string) numberFormat($subTotalRoomAmount);
    return $post_data;






    //END CALCULATION













}

function getNTData($res, $request, $dataPH = false, $delete = false, $customerId = 0){
    $room_nam = '';
    $droom_rt = 0;
    $custData = Customer::whereId($customerId)->first();
    $bookedRoom = BookedRoom::with(['room','room_type'])->where('reservation_id', $res->id)->get();
    foreach ($bookedRoom as $b){
        $room_nam .= $b->room->room_no.',';
        $droom_rt = $droom_rt + $b->room_price;
    }
    $for_mt_calculatedAmount = calcFinalAmount($res, 1);
    $for_mt_additionalAmount = $for_mt_calculatedAmount['additionalAmount'];
    $for_mt_additionalAmountReason = $res->additional_amount_reason;
    $for_mt_roomAmountDiscount = $for_mt_calculatedAmount['totalRoomAmountDiscount'];
    $for_mt_gstPerc = $for_mt_calculatedAmount['totalRoomGstPerc'];
    $for_mt_cgstPerc = $for_mt_calculatedAmount['totalRoomCGstPerc'];
    $for_mt_roomAmountGst = $for_mt_calculatedAmount['totalRoomAmountGst'];
    $for_mt_roomAmountCGst = $for_mt_calculatedAmount['totalRoomAmountCGst'];
    $for_mt_totalRoomAmount = $for_mt_calculatedAmount['subtotalRoomAmount'];
    $for_mt_subTotalRoomAmount = (($for_mt_totalRoomAmount+$for_mt_roomAmountGst+$for_mt_roomAmountCGst) - $for_mt_roomAmountDiscount)+$for_mt_additionalAmount;
    $for_mt_advancePayment = $for_mt_calculatedAmount['advancePayment'];
    $for_mt_dueAmount = $for_mt_subTotalRoomAmount-$for_mt_advancePayment;
    $for_mt_gstPercFood = $for_mt_calculatedAmount['totalOrderGstPerc'];
    $for_mt_cgstPercFood = $for_mt_calculatedAmount['totalOrderCGstPerc'];
    $for_mt_foodAmountGst = $for_mt_calculatedAmount['totalOrderAmountGst'];
    $for_mt_foodAmountCGst = $for_mt_calculatedAmount['totalOrderAmountCGst'];
    $for_mt_foodOrderAmountDiscount = $for_mt_calculatedAmount['totalOrderAmountDiscount'];
    $for_mt_gstFoodApply = $for_mt_calculatedAmount['gstFoodApply'];
    $for_mt_totalOrdersAmount = $for_mt_calculatedAmount['subtotalOrderAmount'];
    $for_mt_finalOrderAmount = $for_mt_calculatedAmount['finalOrderAmount'];
    if($delete){
        Reservation::whereId($res->id)->delete();
        BookedRoom::where('reservation_id', $res->id)->delete();
    }
$randnum = '';
    $datas = [
        'bookingNo' => (string) $res->id.'_'.$randnum,
        "userId" => (string) $res->id.'_'.$randnum,
        'nationalityCode' => (string) $request->mt_nationality,
        'checkInDate' => (string) dateConvert($request->check_in_date, 'Ymd'),
        'checkOutDate' => (string) dateConvert($request->check_out_date, 'Ymd'),
        'totalDurationDays' => (string) $request->duration_of_stay,
        'allotedRoomNo' => (string) substr(rtrim($room_nam,','), 0, 49) ,
        'roomRentType' => (string) $request->mt_room_rent_type,
        'dailyRoomRate' => (string) rtrim($droom_rt, ','),
        'totalRoomRate' => (string) numberFormat($for_mt_totalRoomAmount),
        'discount' => (string) numberFormat($for_mt_roomAmountDiscount),
        'vat' => (string) numberFormat($for_mt_roomAmountGst),
        'municipalityTax' => (string) numberFormat($for_mt_roomAmountCGst),
        'grandTotal' => (string) numberFormat($for_mt_subTotalRoomAmount),
        'gender' => (string) config('constants.MT_GENDER')[$custData->gender],
        'checkInTime' => (string) dateConvert($request->check_in_date, 'His'),
        'checkOutTime' => (string) dateConvert($request->check_out_date, 'His'),
        'customerType' => (string) $request->mt_customer_types,
        'noOfGuest' => (string) ($request->adult+$request->kids),
        'roomType' => (string) $request->mt_room_type,
        'purposeOfVisit' => (string) $request->mt_reason_of_visit,
        'paymentType' => (string) $request->mt_payment_type,
        'noOfRooms' => (string) count($request->room_num) | (string) 1,
        'dateOfBirth' => (string) dateConvert($request->dob, 'Ymd'),
        // 'dateOfBirth' => (string) dateConvert($request->mt_date_of_birth, 'Ymd'),
    ];
    if($request->mt_iscreate == 1){
        $datas['transactionTypeId'] = (string) $request->reservation_type == 0 ?  '2' : '1';
        if($request->advance_payment && $dataPH != false){
//            $datas['transactionId'] = (string) $dataPH->id;
        }
        $datas['channel'] = (string) 'divllo';
        $datas['cuFlag'] = (string) '1';
    }
    else{
        $datas['transactionTypeId'] = (string) $request->reservation_type == 0 ?  '2' : '1';
        if($request->advance_payment && $dataPH != false){
//            $datas['transactionId'] = (string) $dataPH->id;
        }
        $datas['channel'] = (string) 'divllo';
        $datas['cuFlag'] = (string) '1';
    }

    return $datas;
}










function getUnits(){
    return getDynamicDropdownList('measurement');
}
function getRoomList($listType = 1){
    if($listType==2){
        $roomList = [];
        $rooms = Room::whereStatus(1)->where('is_deleted', 0)->orderBy('room_name','ASC')->get();
        if($rooms->count()){
            foreach ($rooms as $key => $value) {
                $roomList[$value->id] = $value->room_name.' (RoomNo.: '.$value->room_no.' | Type: '.ucfirst($value->room_type->is_type).')';
            }
        }
        return $roomList;
    }
    return Room::select('id',DB::raw('CONCAT(room_no, " (", room_name,")") AS title'))->whereStatus(1)->whereIsDeleted(0)->orderBy('room_no','ASC')->pluck('title','id');
}
function getRoomByNum($roomNum){
    return Room::where('room_no', $roomNum)->first();
}
function getRoomById($roomId){
    return Room::where('id', $roomId)->first();
}
function getRoomTypeById($id){
    return RoomType::where('id', $id)->first();
}
function getRoomTypesList($listType = 'original'){
    $settings = getSettings();
    $gstPerc = $settings['gst'];
    $cgstPerc = $settings['cgst'];
//    dd([$gstPerc, $cgstPerc]);
    if($listType == 'custom'){
        // return RoomType::select('id','base_price',DB::raw('CONCAT(title, " (Price||", TRUNCATE((base_price + ( ((base_price/100) * '.$gstPerc.') + ((base_price/100) * '.$cgstPerc.') ) ) ,2),")") AS title'))->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->pluck('title','id');
        return RoomType::select('id','base_price',DB::raw('CONCAT(title, " (Price||", TRUNCATE(  (  (base_price + ((base_price/100) * '.$cgstPerc.'))  + (  (base_price + ((base_price/100) * '.$cgstPerc.'))   * '.$gstPerc.'/100)  ) ,5),")") AS title'))->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->pluck('title','id');
    }
    if($listType == 'original'){
        return RoomType::whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->pluck('title','id');
    }
}
function getRoomTypesListWithRooms($listType = ''){

    if($listType == 'custom'){
        $settings = getSettings();
        $gstPerc = $settings['gst'];
        $cgstPerc = $settings['cgst'];
        return RoomType::
            select(
                'id',
                'base_price',
                DB::raw('CONCAT(title, " (Price||", TRUNCATE(  (  (base_price + ((base_price/100) * '.$cgstPerc.'))  + (  (base_price + ((base_price/100) * '.$cgstPerc.'))   * '.$gstPerc.'/100)  ) ,5),")") AS title')
                // DB::raw('CONCAT(title, " (Price||", TRUNCATE((base_price + ( ((base_price/100) * '.$gstPerc.') + ((base_price/100) * '.$cgstPerc.') ) ) ,2),")") AS title')
        )->
            with('rooms')
            ->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
    }

    return RoomType::with('rooms')->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
}
function getReservationById($id){
    return Reservation::whereId($id)->first();
}
function getAmenitiesById($id){
    return Amenities::where('id', $id)->first();
}
function getCustomerByUserId($userId){
    return Customer::whereUserId($userId)->first();
}
function getCustomerList($type='pluck', $category='user'){
    if($category == 'user'){
        if($type == 'get') return Customer::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->where('cat', '=', $category)->whereNotNull('name')->whereIsDeleted(0)->orderBy('name','ASC')->get();
        else return Customer::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->where('cat', '=', $category)->whereIsDeleted(0)->orderBy('name','ASC')->pluck('display_text','id');
    }elseif($category == 'company'){
        if($type == 'get') return Customer::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->where('cat', '=', $category)->whereNotNull('name')->whereIsDeleted(0)->orderBy('name','ASC')->get();
        else return Customer::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->where('cat', '=', $category)->whereIsDeleted(0)->orderBy('name','ASC')->pluck('display_text','id');
    }elseif($category == 'all'){
        if($type == 'get') return Customer::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->whereNotNull('name')->whereIsDeleted(0)->orderBy('name','ASC')->get();
        else return Customer::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->whereIsDeleted(0)->orderBy('name','ASC')->pluck('display_text','id');
    }
}
function getHousekeeperList($type='pluck'){
    if($type == 'get') return User::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->whereNotNull('name')->whereIsDeleted(0)->where('role_id', 7)->orderBy('name','ASC')->get();
    else return User::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->whereIsDeleted(0)->orderBy('name','ASC')->where('role_id', 7)->pluck('display_text','id');
}
function getVendorList($type='pluck'){
    if($type == 'get') Vendor::with('category', 'country')->where('is_deleted', 0)->orderBy('vendor_name','ASC')->get();
    else return Vendor::where('is_deleted', 0)->orderBy('vendor_name','ASC')->pluck('vendor_name','id');
}
function getExpenseCategoryList(){
    return ExpenseCategory::whereStatus(1)->orderBy('name','ASC')->pluck('name','id');
}
function getRoomsWithPrice($params = []){
    $totalNight = 0;
    if(isset($params['checkin_date']) && isset($params['checkout_date'])){
        $checkinDate = dateConvert($params['checkin_date']);
        $checkoutDate = dateConvert($params['checkout_date']);
        $bookingDateRange = dateRange($checkinDate, $checkoutDate,'+1 day','Y-m-d');
        $totalNight = dateDiff($checkinDate, $checkoutDate);
    }

    $roomTypesQuery=RoomType::with('rooms','room_price')->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC');
    if(isset($params['room_type_ids'])){
        $roomTypesQuery->whereIn('id', $params['room_type_ids']);
    }
    $roomTypes = $roomTypesQuery->get();
    $datalist = [];
    $seasonsDatesArr = [];
    foreach ($roomTypes as $key => $roomTypeVal) {
        $roomBasePrice = $roomTypeVal->base_price;
        $params = [
            'bookingDateRange'=>$bookingDateRange,
            'roomBasePrice'=>$roomBasePrice,
            'totalNight'=>$totalNight,
            'dateRange'=>[],
            'roomSeasonPrice'=>0,
        ];
        $priceList = getDatesWithPrice($params);
        $dataArr = [
            'title'=> $roomTypeVal->title,
            'is_type'=> $roomTypeVal->is_type,
            'adult_capacity'=> $roomTypeVal->adult_capacity,
            'kids_capacity'=> $roomTypeVal->kids_capacity,
            'base_price'=> $roomBasePrice,
            'rooms'=>$roomTypeVal->rooms,
            'dates_with_price'=> $priceList[0],
            'total_price'=> $priceList[1],
        ];


        if($roomTypeVal->room_price->count()){
            foreach ($roomTypeVal->room_price as $roomPriceVal) {
                if($roomPriceVal->season_info){
                    $dateRange = dateRange($roomPriceVal->season_info->start_date, $roomPriceVal->season_info->end_date,'+1 day','Y-m-d');

                    foreach ($dateRange as $sDate) {
                        $dayName = strtolower(date('D', strtotime($sDate)));
                        $daysArr = splitText($roomPriceVal->season_info->days);
                        if(in_array($dayName, $daysArr)){
                            $seasonsDatesArr[$sDate] = $roomPriceVal->price;
                        }
                    }
                }
            }
            $params['dateRange'] = $seasonsDatesArr;
            $priceList = getDatesWithPrice($params);
            $dataArr['dates_with_price'] = $priceList[0];
            $dataArr['total_price'] = $priceList[1];
        }
        $datalist[$roomTypeVal->id] = $dataArr;
    }
    return $datalist;
}
function getDatesWithPrice($params){
    $dateWisePrice = [];
    $totalPrice = 0;
    foreach ($params['bookingDateRange'] as $bdKey=>$bookingDateVal) {
        $roomPrice = ($bdKey < $params['totalNight']) ? $params['roomBasePrice'] : 0;
        if(isset($params['dateRange'][$bookingDateVal]) && $bdKey < $params['totalNight']){
            $roomPrice = ($bdKey < $params['totalNight']) ? $params['dateRange'][$bookingDateVal] : 0;
        }
        $totalPrice += $roomPrice;
        $dateWisePrice[$bookingDateVal]=['price'=>$roomPrice];
    }
    return [$dateWisePrice, numberFormat($totalPrice)];
}
function getBookedRooms($params = []){
    $bookedRooms = [];
    $bookedRoomst = [];

    $query = Reservation::with('booked_rooms')
//        ->whereDate('check_in', '>=', $params['checkin_date'])
        ->whereStatus(1)->whereIsDeleted(0)->whereCancelled(0)->whereIsCheckout(0)->orderBy('created_at','DESC');
    if(isset($params['reservation_id'])){
        $query->where('id', $params['reservation_id']);
    }
    $reservationData = $query->get();

    $isBooked = true;
    $dateRange = null;
    if(isset($params['checkin_date']) && isset($params['checkout_date'])){
        $dateRange = dateRange(($params['checkin_date']), ($params['checkout_date']),'+1 day','Y-m-d H:i:s');
    }
    if($reservationData->count()>0){
        foreach($reservationData as $val){
            if($val->booked_rooms){
                foreach($val->booked_rooms as $k=>$v){
                    if($dateRange){
                        $isBooked = false;
                        if(in_array(dateConvert($v->check_in,'Y-m-d H:i:s'), $dateRange)){
                            $isBooked = true;
                        }
                        if(in_array(dateConvert($v->check_out,'Y-m-d H:i:s'), $dateRange)){
                            $isBooked = true;
                        }
                        if(isset($params['checkin_date'])){

                            $new_dr = null;
                            if(isset($v->check_in) && isset($v->check_out)){
                                /* the checkin time will be 00:00:00 because when the time change it is not calculated conflict and make room available. */ 
                                $checkIn = dateConvert($v->check_in,'Y-m-d 00:00:00');
                                $checkOut = dateConvert($v->check_out,'Y-m-d H:i:s');
                                $new_dr = dateRange($checkIn, $checkOut,'+1 day','Y-m-d H:i:s');
                            }

                            if(in_array(dateConvert($params['checkin_date'],'Y-m-d H:i:s'), $new_dr) || in_array(dateConvert($params['checkout_date'],'Y-m-d H:i:s'), $new_dr) ){
                                $isBooked = true;
                            }
                            /* This logic didn't find correct conflict therefore i commented this else statement  */
                            // else {
                            //     $isBooked = false;
                            //     // print_r("_|*_".$v->room_id."_n_".$v->is_checkout."_*|_");
                            // }

//                            dd([
//                                new DateTime($v->check_out),
//                                new DateTime($params['checkin_date'])
//                            ]);
//                            if(new DateTime($v->check_out) > new DateTime($params['checkin_date'])){
//                                $isBooked = true;
//                            } else {
//                                $isBooked = false;
//                            }
                        }
                    }

                    if($v->is_checkout == 0 && $isBooked){        
                        $bookedRooms[$v->room_id] = $v->room_id;
                        $bookedRoomst[$v->room_id] = [
                            'room_id'=>$v->room_id,
                            'checkin_date'=>$v->check_in,
                            'checkout_date'=>$v->check_out,
                        ];
                    }
                }
            }
        }
    }
//    dd($bookedRoomst);
    return $bookedRooms;
}

function getAllBookedRooms(){
    $bookedRooms = [];
    $reservationData = Reservation::with('booked_rooms')->whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(0)->orderBy('created_at','DESC')->get();
    if($reservationData && $reservationData->count()>0){
        foreach($reservationData as $val){
            if($val->booked_rooms){
                foreach($val->booked_rooms as $k=>$v){

                    $date_1 = new DateTime(date('Y-m-d'));
                    $date_2 = new DateTime($v->check_out);
                    $isValidDate = ($date_1 < $date_2) ? true : false;

                    if($v->is_checkout == 0 && $isValidDate){
                        $bookedRooms[$v->room_id] = $v->room_id;
                    }
                }
            }
        }
    }
    return $bookedRooms;
}

function getCalendarEventsByDate($params){
    $datalist = [];
    $bookedRooms = [];
    $bookedDates = [];
    $paramsDatesRange = $dateRange = dateRange(dateConvert($params['start_date']), dateConvert($params['end_date']));

    $bookedRoomsData = BookedRoom::where('booked_rooms.is_checkout', '=', 0)
        ->join('reservations' , function($q){
            $q->on('reservations.id', '=', 'booked_rooms.reservation_id');
            $q->where('reservations.cancelled', '=', 0);
        })
        ->orderBy('booked_rooms.check_in','DESC')->get();
    if($bookedRoomsData && $bookedRoomsData->count()>0){
        foreach($bookedRoomsData as $k=>$v){
            $dateRange = dateRange(dateConvert($v->check_in), dateConvert($v->check_out));
            foreach ($dateRange as $key => $date) {
                $bookedRooms[$v->room_id][dateConvert($date, 'Ymd')] = $v->room_id;
            }
            $bookedDates[] = ['roomId'=>$v->room_id, 'dateRange'=>$dateRange];
            try{
                $rtitle = ' ('.$v->room_type->title.')';
            }catch(\Exception $e){
                $rtitle = '';
            }
            // Old Code
            // $datalist[] = [
            //     'title'=>$v->room->room_no.$rtitle,
            //     'start'=>dateConvert($v->check_in).'T01:00:00+05:30',
            //     'end'=>dateConvert($v->check_out).'T01:00:00+05:30',
            //     'color'=>$v->reservation_type == 1? '#aeae1a' :'#f56868',
            //     'url'=>route('check-out-room',[$v->reservation_id]),
            //     'extendedProps'=>['is_booked'=>1, 'room_info'=>$v->room],
            // ];
            // New code 
            $datalist[] = [
                'title'=>$v->room->room_no.$rtitle,
                'start'=> dateConvert($v->check_in).'T01:00:00+05:30',
                'end'=> dateConvert($v->check_out).'T01:00:00+05:30',
                'color'=>$v->reservation_type == 1? '#aeae1a' :'#f56868',
                'url'=>route('check-out-room',[$v->reservation_id]),
                'extendedProps'=>[
                //     // 'is_booked'=>1, 
                //     // 'room_info'=>$v->room, 
                    'calendar' => 'Business' ],
                'allDay'=> false,
            ];

        }
    }

    $allRooms = Room::whereIsDeleted(0)->whereStatus(1)->get();
    foreach ($allRooms as $key => $room) {
        $dates = (isset($bookedDates[$room->id])) ? $bookedDates[$room->id] : [];
        foreach ($paramsDatesRange as $d) {
            //if(count($bookedRooms) > 0){
                if(!isset($bookedRooms[$room->id][dateConvert($d, 'Ymd')]) ){
                    try{
                        $rtitle = ' ('.$room->room_type->title.')';
                    }catch(\Exception $e){
                        $rtitle = '';
                    }
                    $datalist[] = [
                        'title'=>$room->room_no.$rtitle,
                        'start'=>$d.'T01:00:00+05:30',
                        'end'=>$d.'T01:00:00+05:30',
                        'color'=>'#02b92e',
//                        'url'=>route('quick-check-in'),
                        'url'=>route('room-reservation'),
                        'extendedProps'=>['is_booked'=>0, 'room_info'=>$room]
                    ];
                }
            //}
        }
    }
    //dd($params,$datalist, $allRooms);
    return $datalist;
}
function getWeekDaysList($params){
    $list = config('constants.WEEK_DAYS');
    $data = [];
    foreach($list as $key => $val){
        $weekName = ($params['is_name'] == 'full') ? lang_trans('txt_day_full_'.$key) : lang_trans('txt_day_short_'.$key);
        if($params['type'] == 1)
            $data[$key] = $weekName;
    }
    return $data;
}
function getNtmpUrl($type, $url){
    $urls = [
        'Sandbox'=>[
            'CreateOrUpdateBooking' => 'https://dev-api.ntmp.gov.sa/gateway/CreateOrUpdateBooking/1.0/createOrUpdateBooking',
            'CancelBooking' => 'https://dev-api.ntmp.gov.sa/gateway/CancelBooking/1.0/cancelBooking',
            'BookingExpenseDetails' => 'https://dev-api.ntmp.gov.sa/gateway/BookingExpense/1.0/bookingExpense',
            'OccupancyUpdate_v1' => 'https://dev-api.ntmp.gov.sa/gateway/OccupancyUpdate/1.0/occupancyUpdate',
            'OccupancyUpdate_v2' => 'https://dev-api.ntmp.gov.sa/gateway/OccupancyUpdate/2.0/occupancyUpdate',
            'GetTransactionIDByBookingNo' => 'https://dev-api.ntmp.gov.sa/gateway/GetTransactionIDByBookingNo/1.0/getTransactionIDByBookingNo',
        ],
        'Testing'=>[
            'CreateOrUpdateBooking' => 'https://api-stg.ntmp.gov.sa/gateway/CreateOrUpdateBooking/1.0/createOrUpdateBooking',
            'CancelBooking' => 'https://api-stg.ntmp.gov.sa/gateway/CancelBooking/1.0/cancelBooking',
            'BookingExpenseDetails' => 'https://api-stg.ntmp.gov.sa/gateway/BookingExpense/1.0/bookingExpense',
            'OccupancyUpdate' => 'https://api-stg.ntmp.gov.sa/gateway/OccupancyUpdate/1.0/occupancyUpdate',
            'OccupancyUpdate_v2' => 'https://api-stg.ntmp.gov.sa/gateway/OccupancyUpdate/2.0/occupancyUpdate',
            'GetTransactionIDByBookingNo' => 'https://api-stg.ntmp.gov.sa/gateway/GetTransactionIDByBookingNo/1.0/getTransactionIDByBookingNo',
        ],
        'Production'=>[
            'CreateOrUpdateBooking' => 'https://api.ntmp.gov.sa/gateway/CreateOrUpdateBooking/1.0/createOrUpdateBooking',
            'CancelBooking' => 'https://api.ntmp.gov.sa/gateway/CancelBooking/1.0/cancelBooking',
            'BookingExpenseDetails' => 'https://api.ntmp.gov.sa/gateway/BookingExpense/1.0/bookingExpense',
            'OccupancyUpdate' => 'https://api.ntmp.gov.sa/gateway/OccupancyUpdate/1.0/occupancyUpdate',
            'OccupancyUpdate_v2' => 'https://api.ntmp.gov.sa/gateway/OccupancyUpdate/2.0/occupancyUpdate',
            'GetTransactionIDByBookingNo' => 'https://api.ntmp.gov.sa/gateway/GetTransactionIDByBookingNo/1.0/getTransactionIDByBookingNo',
        ],
    ];
    return $urls[$type][$url];
}
function getNtmpList(){
    return [
        'Production'=>'Production',
        'Sandbox'=>'Sandbox',
        'Testing'=>'Testing',
    ];
}
function getCurrencyList(){
    $list = config('currencies')['CURRENCY_LIST'];
    $currencies = [];
    foreach($list as $val){
        $currencies[$val['code']] = $val['code'].' ('.$val['country'].')';
    }
    return $currencies;
}
function getCurrencySymbol($isCode=false){
    $settings = getSettings();
    if(isset($settings['currency_symbol']) && $settings['currency_symbol']!='' && !$isCode){
        return $settings['currency_symbol'];
    }
    if(isset($settings['currency']) && $settings['currency']!=''){
        return $settings['currency'];
    }
    return ($isCode) ? 'USD' : '$';
}
function getCountryList(){
    $list = config('constants.COUNTRY_LIST');
    foreach($list as $k=>$val){
        $countries[$val['name']] = $val['name'];
    }
    return $countries;
}

function getPurposeOfVisit(){
    $list = config('constants.PURPOSE_OF_VISIT');
    foreach($list as $k=>$val){
        $countries[$val['name']] = $val['name'];
    }
    return $countries;
}
//function getRoles(){
//    return Role::pluck('slug','id')->toArray();
//}
function getRoles(){
    $roles = [];
    $cacheKey = getCacheKey('rolesListCache');
    if (Cache::has($cacheKey)){
        $roles = Cache::get($cacheKey);
    } else {
        $roles = Role::pluck('slug','id')->toArray();
        Cache::put($cacheKey, $roles, config('constants.CACHING_TIME'));
    }
    return $roles;
}
function getFormatedPermissionsList($permissions){
    $roles = getRoles();
    $permissionArr = [];
    if($permissions){
        foreach($permissions as $k=>$val){
            $permissionArr[$val->slug] = $val->{$roles[Auth::user()->role_id]};
        }
    }
    return $permissionArr;
}
function getPermissions($type){
    $permissionArr = [];
    if($type=='menu'){
        $cacheKey = getCacheKey('menuPermissionListCache');
        if (Cache::has($cacheKey)){
            $permissionArr = Cache::get($cacheKey);
        } else {
            $permissions = Permission::where('permission_type','menu')->get();
            $permissionArr = getFormatedPermissionsList($permissions);
            Cache::put($cacheKey, $permissionArr, config('constants.CACHING_TIME'));
        }
    } else if($type=='route'){
        $cacheKey = getCacheKey('routePermissionListCache');
        if (Cache::has($cacheKey)){
            $permissionArr = Cache::get($cacheKey);
        } else {
            $permissions = Permission::where('permission_type','route')->get();
            $permissionArr = getFormatedPermissionsList($permissions);
            Cache::put($cacheKey, $permissionArr, config('constants.CACHING_TIME'));
        }
    }
    return $permissionArr;
}
function getMenuPermission(){
    return getPermissions('menu');
}
function getRoutePermission(){
    return getPermissions('route');
}
function isPermission($route){
    $permissionArr = getRoutePermission();
    if(isset($permissionArr[$route])){
        if($permissionArr[$route]==1){
            return true;
        }
    }
    return false;
}
//function getMenuPermission(){
//    $permissions = Permission::where('permission_type','menu')->get();
//    $roles = getRoles();
//    $permissionArr = [];
//    if($permissions){
//        foreach($permissions as $k=>$val){
//            $permissionArr[$val->slug] = $val->{$roles[Auth::user()->role_id]};
//        }
//    }
//    return $permissionArr;
//}
//function getRoutePermission(){
//    $permissions = Permission::where('permission_type','route')->get();
//    $roles = getRoles();
//    $permissionArr = [];
//    if($permissions){
//        foreach($permissions as $k=>$val){
//           $permissionArr[$val->slug] = $val->{$roles[Auth::user()->role_id]};
//        }
//    }
//    return $permissionArr;
//}

function genRandomValue($length=5,$type='digit',$prefix=null){
    if($type=='digit'){
        $characters = date('Ymd').'123456789987654321564738291918273645953435764423'.time();
    } else {
        $characters = date('Ymd').'192837465TransactionRandomId987654321AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz111xxxBheemSwamixxx9OO14568O8xxxBikanerRajasthan34OO1'.time();
    }
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $prefix.$randomString;
}

function getNextPrevDate($isDate='prev', $days=null){
    if($isDate=='prev'){
        $symbol = '-';
    } else {
        $symbol = '+';
    }
    if($days==null){
        $days = getSettings('default_rec_days');
    }
    return date('Y-m-d', strtotime(date('Y-m-d'). $symbol.$days.' days'));
}


function getNextSecondPrevDate($days=null){
    if($days==null){
        $days = getSettings('default_rec_days');
    }
    return date('Y-m-d', strtotime(date('Y-m-d'). '+'.$days.' days'));
}

function addSubDate($isDate, $val, $date, $format='d-m-Y', $adsSub='days'){
    //$isDate: +,- | $val: numericVal | $adsSub: days, months, year
    return date($format, strtotime($date. $isDate.$val.' '.$adsSub));
}

function timeAgo($date) {
    $timestamp = strtotime($date);

    $strTime = ["second", "minute", "hour", "day", "month", "year"];
    $length = ["60","60","24","30","12","10"];

    $currentTime = time();
    if($currentTime >= $timestamp) {
        $diff     = time()- $timestamp;
        for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        if($diff < 10){
            return dateConvert($date, 'Y-m-d h:i');
        }
        return $diff . " " . $strTime[$i] . "(s) ago ";
    }
}
function dateConvert($date=null,$format=null){
    if($date==null)
        return date($format);
    if($format==null)
        return date('Y-m-d',strtotime($date));
    else
        return date($format,strtotime($date));
}

function dateDiff($sDate, $eDate, $format = 'days'){
    $date1=date_create($sDate);
    $date2=date_create($eDate);
    $diff=date_diff($date1,$date2);
    if($format == 'days') {
        return $diff->format("%a");
    }
    return $diff->format("%R%a"); // if daysWIthSymbol
}

function dateIfInBetween($sDate, $eDate){

    $current_date = date('Y-m-d H:i:s');
    $current_date = date('Y-m-d H:i:s', strtotime($current_date));

    $start_date = date('Y-m-d H:i:s', strtotime($sDate));
    $end_date = date('Y-m-d H:i:s', strtotime($eDate));

    if (($current_date >= $start_date) && ($current_date <= $end_date)){
        return true;
    }else{
        return false;
    }


}

function dateRange($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

function timeConvert($time,$format=null){
    if($format==null)
        return date('H:i:s',strtotime($time));
    else
        return date($format,strtotime($time));
}
function timeFormatAmPm($time=null){
    if($time==null || $time==''){
        return '';
    }
    $exp = explode(' ', $time);
    $temp = date_parse($exp[0]);
    $temp['minute'] = str_pad($temp['minute'], 2, '0', STR_PAD_LEFT);
    return date('h:i a', strtotime($temp['hour'] . ':' . $temp['minute']));
}
function splitText($string=null, $splitBy = ','){
    if($string==null || $string==''){
        return [];
    }
    return explode($splitBy, $string);
}
function limit_text($text, $limit) {
  if (strlen($text) > $limit) {
        $text = substr($text, 0, $limit) . '...';
  }
  return $text;
}
function limit_words($string, $word_limit)
{
    if (str_word_count($string, 0) > $word_limit) {
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit)).'...';
    }
    return $string;
}

function checkFile($filename,$path,$default=null) {
    $src=url('public/images/'.$default);
    $path='public/'.$path;
    if($filename != NULL && $filename !='' && $filename != '0')
    {
        $file_path = app()->basePath($path.$filename);
        if(File::exists($file_path)){
            $src=url($path.$filename);
        }
    }
    return $src;
}
function unlinkImg($img,$path) {
    if($img !=null || $img !='')
    {
        $path='public/'.$path;
        $image_path = app()->basePath($path.$img);
        if(File::exists($image_path))
            unlink($image_path);
    }
}
function getNextInvoiceNo($type=null){
    $initNum = 1;
    if($type=='ph'){
        //$data = PaymentHistory::whereNotNull('transaction_id')->orderBy('transaction_id','DESC')->first();
        //return ($data) ? $data->transaction_id + 1 : $initNum;
        $data = genRandomValue(8, 'mix');
        return $data;
    }
    if($type=='orders'){
        $data = Order::whereNotNull('invoice_num')->orderBy('invoice_num','DESC')->first();
        return ($data) ? $data->invoice_num + 1 : $initNum;
    }
    if($type=='laundry_order'){
        $data = LaundryOrder::whereNotNull('order_num')->orderBy('order_num','DESC')->first();
        return ($data) ? $data->order_num + 1 : $initNum;
    }
    $data = Reservation::whereNotNull('invoice_num')->orderBy('invoice_num','DESC')->first();
    return ($data) ? $data->invoice_num + 1 : $initNum;
}
function getStatusBtn($status, $listType = 1){
    $statusList = config('constants.LIST_STATUS');
    $btnClass = ['badge bg-secondary', 'badge bg-success', 'badge bg-danger'];
    // $btnClass = ['btn-default', 'btn-success', 'btn-danger'];
    if($listType == 2){
        $statusList = config('constants.LIST2_STATUS');
    }
    else if($listType == 3){
        $btnClass = ['badge bg-secondary', 'badge bg-success', 'badge bg-danger'];
        // $btnClass = ['btn-default', 'btn-primary', 'btn-success'];
        $statusList = config('constants.LIST_HOUSEKEEPING_ORDER_STATUS');
    }
    else if($listType == 4){
        $btnClass = ['badge bg-secondary', 'badge bg-success', 'badge bg-danger'];
        // $btnClass = ['btn-default', 'btn-primary', 'btn-info', 'btn-success'];
        $statusList = config('constants.LIST_LAUNDRY_ORDER_STATUS');
    }

    $txt = '';
    if(isset($statusList[$status])){
        $txt = $statusList[$status];
    }
    if($status==1){
        // return '<button type="button" class="btn btn-xs '.$btnClass[$status].'">'.$txt.'</button>';
        return '<span  class="'.$btnClass[$status].'">'.$txt.'</span>';
    } if($status==2){
        // return '<button type="button" class="btn btn-xs '.$btnClass[$status].'">'.$txt.'</button>';
        return '<span  class="'.$btnClass[$status].'">'.$txt.'</span>';
    } if($status==3){
        // return '<button type="button" class="btn btn-xs '.$btnClass[$status].'">'.$txt.'</button>';
        return '<span  class=" '.$btnClass[$status].'">'.$txt.'</span>';
    } else {
        // return '<button type="button" class="btn btn-xs '.$btnClass[$status].'">'.$txt.'</button>';
        return '<span  class=" '.$btnClass[$status].'">'.$txt.'</span>';
    }
}
//function getNextInvoiceNo($type=null){
//    if($type=='ph'){
//        //$data = PaymentHistory::whereNotNull('transaction_id')->orderBy('transaction_id','DESC')->first();
//        $data = genRandomValue(8, 'mix');
//        return $data;
//    } else if($type=='orders'){
//        $data = Order::whereNotNull('invoice_num')->orderBy('invoice_num','DESC')->first();
//    } else {
//        $data = Reservation::whereNotNull('invoice_num')->orderBy('invoice_num','DESC')->first();
//    }
//
//    if($data){
//        $nextNum = ($type=='ph') ? $data->transaction_id+1 : $data->invoice_num+1;
//    } else {
//        $nextNum ='1';
//    }
//    return $nextNum;
//}

//function getStatusBtn($status){
//    $txt = '';
//    if(isset(config('constants.LIST_STATUS')[$status])){
//        $txt = config('constants.LIST_STATUS')[$status];
//    }
//    if($status==1){
//        return '<button type="button" class="btn btn-success btn-xs">'.$txt.'</button>';
//    } else {
//        return '<button type="button" class="btn btn-default btn-xs">'.$txt.'</button>';
//    }
//}
function getTableNums($excOrderId=0){
    $bookedTablesQuery =  OrderHistory::where('is_book',1);
    if($excOrderId>0){
        $bookedTablesQuery->where('order_id','<>',$excOrderId);
    }
    $bookedTables =  $bookedTablesQuery->pluck('table_num')->toArray();
    $tableNums = [];
    for($i=1; $i<=50; $i++){
        if(!in_array($i,$bookedTables)) $tableNums[$i] = $i;
    }
    return $tableNums;
}

function isTableBook($tableNum=0){
    return OrderHistory::where('table_num',$tableNum)->where('is_book',1)->orderBy('id','DESC')->first();
}
function getOrderInfo($id){
    return Order::where('reservation_id',$id)->first();
}

function gstCalc($amount,$type,$gstPerc=null,$cgstPerc=null){
    $gstAmount = $cgstAmount = 0;
    if($type=='room_amount'){
        $cgstAmount = ($cgstPerc/100)*$amount;
        $gstAmount = ($gstPerc/100)*($amount + $cgstAmount);
        
    } else {
        $cgstAmount = ($cgstPerc/100)*$amount;
        $gstAmount = ($gstPerc/100)*($amount+$cgstAmount);
       
    }

    return ['gst'=>$gstAmount, 'cgst'=>$cgstAmount];
}
function getDateWisePriceList($data){
    $decodedData = json_decode($data, true);
    $total = 0;
    if(count($decodedData)){
        foreach ($decodedData as $key => $value) {
            $total +=  $value['price'];
        }
    }
    return [$decodedData, $total];
}
function calcFinalAmount($val, $isTotalWithGst = 0, $default_stay = true){
    $settings = getSettings();
    $totalAmount = 0;
    if($val->booked_rooms){
        foreach($val->booked_rooms as $key=>$roomInfo){
            $durOfStay = dateDiff(dateConvert($roomInfo->check_in), dateConvert($roomInfo->check_out), 'days');
            if($default_stay){
                /* If i swaped a room and the date is current date it showed that we already stayed this room for one day and make a wrong calculation  */
                // $durOfStay = ($durOfStay == 0) ? 1 : $durOfStay;
                $durOfStay = ($durOfStay == 0) ? 0 : $durOfStay;
            }
            $perRoomPrice = ($durOfStay * $roomInfo->room_price);

            $totalAmount = $totalAmount+$perRoomPrice;
        }
    }

    $gstPerc = $val->gst_perc!= null ?   $val->gst_perc: $settings['gst'];
    $cgstPerc = $val->cgst_perc!= null ?   $val->cgst_perc: $settings['cgst'];
    if($val->is_checkout == 0 && $isTotalWithGst == 1){
        $gstPerc = $settings['gst'];
        $cgstPerc = $settings['cgst'];
    }
    $totalRoomAmountDiscount = ($val->discount > 0 ) ? $val->discount : 0;
    $gstCal = gstCalc(($totalAmount - $totalRoomAmountDiscount),'room_amount', $gstPerc, $cgstPerc);
    // If database has cgst and gst amount then fetch there otherwise calculate here
    // $totalRoomAmountGst = $gstCal['gst'];
    // $totalRoomAmountCGst = $gstCal['cgst'];
    $totalRoomAmountGst = $val->gst_amount != null ? $val->gst_amount:$gstCal['gst'];
    $totalRoomAmountCGst = $val->cgst_amount != null ? $val->cgst_amount:$gstCal['cgst'];
    

    $totalRoomAmountWithCGstAmount = 0;
    if($val->room_amount_with_cgst > 0){
        // $totalRoomAmountWithCGstAmount = $val->room_amount_with_cgst;
        $totalRoomAmountWithCGstAmount = $val->room_amount_with_cgst;
    }else{
        // $totalRoomAmountWithCGstAmount =  $totalAmount + $gstCal['cgst'];
        $totalRoomAmountWithCGstAmount =  $totalAmount + $totalRoomAmountCGst;
    }
    $advancePayment = ($val->advance_payment > 0 ) ? $val->advance_payment : 0;
    $additionalAmount = ($val->addtional_amount > 0 ) ? $val->addtional_amount : 0;
    $grandRoomTotal = $val->grand_room_total;

    // $finalRoomAmount = $totalAmount+$totalRoomAmountGst+$totalRoomAmountCGst-$advancePayment-$totalRoomAmountDiscount;
    $finalRoomAmount = $totalAmount+$totalRoomAmountGst+$totalRoomAmountWithCGstAmount-$advancePayment-$totalRoomAmountDiscount;
    // $totalRoomAmountDiscount += $totalRoomAmountGst;

    //start calculation of order amount
    $totalOrderAmountGst = $totalOrderAmountCGst = $totalOrderAmountDiscount = $orderGstPerc = $orderCGstPerc = 0;
    $gstFoodApply = 1;
    $additionalOrderAmount = 0;
    $additionalOrderAmountReason = '';

    $orderInfo = getOrderInfo($val->id);
    if($orderInfo){
        if($orderInfo->gst_amount){
            $gst_value = $orderInfo->gst_amount;
        }
        $orderGstPerc = $orderInfo->gst_perc;
        $orderCGstPerc = $orderInfo->cgst_perc;

        $totalOrderAmountDiscount = $orderInfo->discount;
        $gstFoodApply = ($orderInfo->gst_apply==1) ? 1 : 0;
        $additionalOrderAmount = $orderInfo->additional_order_amount;
        $additionalOrderAmountReason = $orderInfo->additional_order_amount_reason;
    }


    $totalOrdersAmount = 0;
    $order_gst = 0;
    $gst=0;
    if($val->orders_items->count()>0){
        foreach($val->orders_items as $k=>$orderVal){
            // correct the order amount and tax logic
            $totalOrdersAmount = $totalOrdersAmount + ($orderVal->item_qty*$orderVal->item_price);
            // $order_gst = ($orderVal->item_qty * $orderVal->item_tax);
            // $gst = $gst + $order_gst;  
        }
    }

    if($isTotalWithGst == 1){
        $orderGstPerc = $settings['food_gst'];
        $orderCGstPerc = $settings['food_cgst'];
    }
    // find the gst tax on order items from database otherwise from calculation
    if($orderInfo && $orderInfo->gst_amount){
        $gst = $orderInfo->gst_amount;
    }else{
        $gst_values = gstCalc($totalOrdersAmount,'food_amount',$orderGstPerc,$orderCGstPerc);
        $gst = $gst_values['gst'];
    }
    $totalOrderAmountGst = $gst; //$gst['gst']; //  $gst;
    // $totalOrderAmountCGst = $gst; //$gst['cgst'];


    // $finalOrderAmount = ($totalOrdersAmount+$totalOrderAmountGst+$totalOrderAmountCGst-$totalOrderAmountDiscount);
    // $finalOrderAmount = ($totalOrdersAmount+$totalOrderAmountCGst-$totalOrderAmountDiscount);
    $finalOrderAmount = ($totalOrdersAmount+$totalOrderAmountGst+$additionalOrderAmount -$totalOrderAmountDiscount);
    return [
        'totalRoomGstPerc' => checkAmount($gstPerc),
        'totalRoomCGstPerc' => checkAmount($cgstPerc),
        'totalRoomAmountGst' => checkAmount($totalRoomAmountGst),
        'totalRoomAmountCGst' => checkAmount($totalRoomAmountCGst),
        'totalRoomAmountWithCGstAmount' => checkAmount($totalRoomAmountWithCGstAmount),
        'totalRoomAmountDiscount'=> checkAmount($totalRoomAmountDiscount),
        'subtotalRoomAmount'=> checkAmount($totalAmount),
        'finalRoomAmount'=> checkAmount($finalRoomAmount),
        'grandRoomTotal' => checkAmount($grandRoomTotal),

        'totalOrderGstPerc' => checkAmount($orderGstPerc),
        'totalOrderCGstPerc' => checkAmount($orderCGstPerc),
        'totalOrderAmountGst'=> checkAmount($totalOrderAmountGst),
        'totalOrderAmountCGst'=> checkAmount($totalOrderAmountCGst),
        'totalOrderAmountDiscount'=> checkAmount($totalOrderAmountDiscount),
        'subtotalOrderAmount'=> checkAmount($totalOrdersAmount),
        'finalOrderAmount'=> checkAmount($finalOrderAmount),
        'gstFoodApply'=> checkAmount($gstFoodApply),
        'additionalOrderAmount' => checkAmount($additionalOrderAmount),

        'advancePayment'=> checkAmount($advancePayment),
        'additionalAmount'=> checkAmount($additionalAmount),


        'wo_ca_totalRoomGstPerc' => $gstPerc,
        'wo_ca_totalRoomCGstPerc' => $cgstPerc,
        'wo_ca_totalRoomAmountGst' => $totalRoomAmountGst,
        'wo_ca_totalRoomAmountCGst' => $totalRoomAmountCGst,
        'wo_ca_totalRoomAmountDiscount'=> $totalRoomAmountDiscount,
        'wo_ca_subtotalRoomAmount'=> $totalAmount,
        'wo_ca_finalRoomAmount'=> $finalRoomAmount,

        'wo_ca_totalOrderGstPerc' => $orderGstPerc,
        'wo_ca_totalOrderCGstPerc' => $orderCGstPerc,
        'wo_ca_totalOrderAmountGst'=> $totalOrderAmountGst,
        'wo_ca_totalOrderAmountCGst'=> $totalOrderAmountCGst,
        'wo_ca_totalOrderAmountDiscount'=> $totalOrderAmountDiscount,
        'wo_ca_subtotalOrderAmount'=> $totalOrdersAmount,
        'wo_ca_finalOrderAmount'=> $finalOrderAmount,
        'wo_ca_gstFoodApply'=> $gstFoodApply,

        'wo_ca_advancePayment'=> $advancePayment,
        'wo_ca_additionalAmount'=> $additionalAmount,
    ];
}

function calcLaundryAmount($val, $isTotalWithGst = 0){
    $gstApply = 0;
    $gstPerc = $cgstPerc = $gstAmount = $cgstAmount = $totalDiscount = $subtotalAmount = $totalAmount = 0;
    if($val){
        $settings = getSettings();
        $subtotalAmount = 0;
        if($val->order_items){
            foreach($val->order_items as $key=>$itemInfo){
                $price = ($itemInfo->rcv_item_qty * $itemInfo->item_price);
                $subtotalAmount += $price;
            }
        }

        $gstApply = ($val->gst_apply==1) ? 1 : 0;
        $gstPerc = $val->gst_perc;
        $cgstPerc = $val->cgst_perc;
        if($isTotalWithGst == 1){
            $gstPerc = $settings['laundry_gst'];
            $cgstPerc = $settings['laundry_cgst'];
        }

        $gstCal = gstCalc($subtotalAmount,'laundry_amount', $gstPerc, $cgstPerc);

        $gstAmount = $gstCal['gst'];
        $cgstAmount = $gstCal['cgst'];
        $totalDiscount = ($val->discount > 0 ) ? $val->discount : 0;
        $totalAmount = $subtotalAmount+$gstAmount+$cgstAmount-$totalDiscount;
    }

    return [
        'gstApply' => $gstApply,
        'gstPerc' => checkAmount($gstPerc),
        'cgstPerc' => checkAmount($cgstPerc),
        'gstAmount' => checkAmount($gstAmount),
        'cgstAmount' => checkAmount($cgstAmount),
        'totalDiscount'=> checkAmount($totalDiscount),
        'subtotalAmount'=> checkAmount($subtotalAmount),
        'totalAmount'=> checkAmount($totalAmount),
    ];
}

function checkAmount($val){
    return ($val > 0) ? $val : 0;
}

function getMaxDiscount($amount,$perc=100){
    //$maxDiscount = ($perc/100)*$amount;
    $maxDiscount = $amount;
    return $maxDiscount;
}
function numberFormat($num){
        return sprintf('%0.2f',$num);
}
function getIndianCurrency(float $number){
    $negative = false;
    if($number < 0){
        $negative = true;
        $number = abs($number);
    }
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? " Point " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) : '';
    $amount =  ($Rupees ? $Rupees : '') . $paise . ' '.getCurrencySymbol(true);
    if($negative){
        $amount = '(Minus) '. $amount;
    }
    return $amount;
}

function stockInfoColor($stock){
    if($stock < 10) return 'bg-danger';
    if($stock < 50) return 'bg-warning';
    return "";
}
function checkboxTickOrNot($value, $val_from=null){
    if($val_from=='view'){
        if($value == 1) return true; else return false;
    } else {
        if($value == 'on') return 1; else return 0;
    }
}
function getIcon($icon, $defaultIcon='ti-shine'){
    return $icon ? $icon : $defaultIcon;
}
function getPaymentPurpose($type){
    $datalist = config('constants.PAYMENT_PURPOSE');
    if(isset($datalist[$type])){
        return $datalist[$type];
    }
    return '';
}
function getPaymentModeById($id){
    $datalist = config('constants.PAYMENT_MODES');
    if(isset($datalist[$id])){
        return $datalist[$id];
    }
    return 'Cash';
}
function getPaymentOptions($isList = 'admin'){
    $datalist = config('constants.PAYMENT_MODES');
    if($isList == 'admin'){
        return $datalist;
    }
    if($isList == 'front'){
        $excludeIds = [1, 2, 3, 4, 5, 6];
        foreach ($excludeIds as $value) {
            unset($datalist[$value]);
        }
        return $datalist;
    }
}
function getConstants($list, $exclude = []){
    if($list == 'LIST_LAUNDRY_ORDER_STATUS'){
        $datalist = config('constants.LIST_LAUNDRY_ORDER_STATUS');
        if(count($exclude)){
            foreach ($exclude as $value) {
                unset($datalist[$value]);
            }
        }
        return $datalist;
    }
    if($list == 'LIST_ROOM_CATEGORY'){
        return config('constants.LIST_ROOM_CATEGORY');
    }
    if($list == 'PAYMENT_PURPOSE'){
        return config('constants.PAYMENT_PURPOSE');
    }
    return null;
}
function getBookingStatus($data){
    $status = ['Pending', 'Confirmed', 'Completed', 'Expired'];
    $statusText = 'Pending';
    $statusClass = "warning";

    $daysDiff = dateDiff($data->check_out, date('Y-m-d'), 'daysWIthSymbol');

    if($data->is_confirmed == 1){
        $statusText = $status[1];
        $statusClass = "info";

    }
    if($daysDiff < 0 && $data->is_confirmed == 0){
        $statusText = $status[3];
        $statusClass = "danger";

    }
    if($daysDiff < 0){
        $statusText = $status[2];
        $statusClass = "success";

    }
    return ['status'=>$statusText, 'statusClass'=>$statusClass];
}
function getNotifications(){
    $where = ['notifi_to'=> Auth::user()->id];
    $totalUnread = Notification::where($where)->whereStatus(0)->count();
    $list = Notification::where($where)->whereStatus(0)->orderBy('notifi_datetime')->orderBy('status', 'ASC')->get();
    return ['totalUnread'=>$totalUnread, 'datalist'=>$list];
}
function getSplashMsg($params){
    $data = ['success'=>'', 'error'=>''];
    if(isset($params['type']) && $params['type'] == 'add_update'){
        if(isset($params['id']) && $params['id'] > 0){
            $data['success'] = config('constants.FLASH_REC_UPDATE_1');
            $data['error'] = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $data['success'] = config('constants.FLASH_REC_ADD_1');
            $data['error'] = config('constants.FLASH_REC_ADD_0');
        }
    }
    return $data;
}
function getLangForUpdateDisable(){
//    return ['en', 'ar', 'hi'];
    return ['en'];
}

function translate($key, $value, $file_name = 'dynamic_dropdown', $lang = null){
    if($lang != null){
        $local = strtolower($lang);
    }
    dd($key, $value);
    $lang_array = include(base_path('resources/lang/' . $local . '/'.$file_name.'.php'));
    $processed_key = ucfirst(str_replace('_', ' ', Helpers::remove_invalid_charcaters($key)));
    if (!array_key_exists(strtolower($key), $lang_array)) {
        $lang_array[strtolower($key)] = $processed_key;
        $str = "<?php return " . var_export($lang_array, true) . ";";
        file_put_contents(base_path('resources/lang/' . $local . '/'.$file_name.'.php'), $str);
        $result = $processed_key;
    } else {
        // $result = __('messages.' . $key);
        $result = __(''.$file_name.'.' . strtolower($key));
    }
    return $result;
}

function remove_invalid_charcaters($str)
{
    return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
}