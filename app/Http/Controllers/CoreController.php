<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use File;
use Excel;
use Intervention\Image\ImageManagerStatic as Image;
use App\AlertTemplate;
use App\PaymentHistory;
use App\MediaFile;
use App\Customer, App\User;
use App\RoomCart;
class CoreController extends Controller {

    function checkWebPortal(){
        return config('constants.WEB_PORTAL');
    }

    function fileUpload($file,$path,$original_name=0,$resize=0){
        $filename='';
        $full_path='public/'.$path;
        File::isDirectory($full_path) or File::makeDirectory($full_path, 0777, true, true);
        if($file!=''){
            if($original_name==1){
                $filename=$file->getClientOriginalName();
            } else {
                $filename=md5($file->getClientOriginalName()).'_'.time().'.'.$file->getClientOriginalExtension();
            }
            if($resize==1){
                switch($path){
                    case "uploads/_img":
                        $file->move($full_path, $filename);
                        break;
                    default:
                        $file->move($full_path, $filename);
                        break;
                }
            } else {
               $file->move($full_path, $filename);
            }
        }
        return $filename;
    }

    function resizeImage($file,$path,$filename,$w,$h){
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize($w, $h);
        $image_resize->save(public_path($path.'/'.$filename));
    }
    function unlinkImg($img,$path) {
        if($img !=null || $img !='')
        {
            $path='public/'.$path.'/';
            $image_path = app()->basePath($path.$img);
            if(File::exists($image_path))
                unlink($image_path);
        }
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

        if (isset($error_msg) || json_decode($response)->errorCode[0] != "0") {
            return ['status'=>false, 'response'=>$response, 'error_msg' =>$error_msg];
        }else{
            return ['status'=>true, 'response'=>$response];
        }
        //return $response;
    }
    function sendSms($templateId,$mobile,$data=null) {
        $settings = getSettings();
        if(isset($settings['sms_api_active']) && $settings['sms_api_active']==1){
            if(!isset($settings['sms_sender_id']) || !isset($settings['sms_api_key']) || !isset($settings['sms_api_url']) || !isset($settings['sms_api_username'])){
                return false;
            }
            $senderId = @$settings['sms_sender_id'];
            $apiKey = @$settings['sms_api_key'];
            $apiUrl = @$settings['sms_api_url'];
            $apiUsername = @$settings['sms_api_username'];

            $templateData = AlertTemplate::whereId($templateId)->first();
            $name = '';
            if(isset($data['name'])){
                if($data['name']!=''){
                    $name = $data['name'];
                }
            }
            $smsTxt = str_replace(['##NAME##'], [$name] , $templateData->template);
            $message = urlencode($smsTxt);

            $send_url = $apiUrl."?username=".$apiUsername."&message=" .$message. "&sendername=" .$senderId. "&smstype=TRANS&numbers=" .$mobile. "&apikey=".$apiKey;
            $send_url = trim($send_url);
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $send_url
            ));
            $result=curl_exec ($ch);
            curl_close ($ch);
            return true;
        }
        return false;
    }

    function removeRoomCartData($deleteData = 'user'){
        if(Auth::user() && $deleteData == 'user'){
            RoomCart::where('user_id', Auth::user()->id)->delete();
        } else {
            RoomCart::whereDate('created_at', '<', DB::raw('CURDATE()'))->delete(); // remove previous cart data
        }
    }

/* ********** Start Payment History ********** */
   function storePH($data){
        return PaymentHistory::insert($data);
   }
   function updateOrCreatePH($where,$data){
        return PaymentHistory::updateOrCreate($where,$data);
   }
   function getPH($where){
        return PaymentHistory::where($where)->get();
   }
/* ********** End Payment History ********** */
/* ***** Start MediaFile Functions ***** */
    function uploadAndUnlinkMediaFile($data) {
        if($data['media_ids']){
            if(count($data['media_ids'])>0){
                $row_data= MediaFile::whereIn($data['media_ids'])->get();
                foreach ($row_data as $key => $value) {
                    unlinkImg($value->file, $data['folder_path'].'/');
                }
            }
        }
        if($data['files']){
            $idImages = [];
            foreach($data['files'] as $img){
                $filename=$this->fileUpload($img, $data['folder_path']);
                $idImages[] = ['tbl_id'=>$data['tbl_id'], 'type'=>$data['type'], 'file'=>$filename];
            }
            if(count($idImages)>0){
                MediaFile::insert($idImages);
            }
        }
    }
/* ***** End MediaFile Functions ***** */
    function isUserEmailExist($emailId) {
        $exist = User::where('email', $emailId)->first();
        if($exist){
           return true;
        }
        return false;
    }
    function syncUserAndCustomer() {
        $customers = Customer::whereNull('user_id')->get();
        if($customers){
            foreach ($customers as $key => $cust) {
                $userData = [
                    'role_id'=> 6,
                    'name'=> $cust->name.' '.$cust->surname,
                    'gender'=> $cust->gender,
                    'email'=> $cust->email,
                    'password'=> $cust->password,
                    'mobile'=> $cust->mobile,
                    'address'=> $cust->address,
               ];
               $userId = User::insertGetId($userData);
               if($userId){
                Customer::where('id', $cust->id)->update(['user_id'=>$userId]);
               }
            }
        }
    }

}
