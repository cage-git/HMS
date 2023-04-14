<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\StockHistory;
use App\Reservation;
use App\Order,App\OrderItem,App\OrderHistory;
use App\Product;
use App\Customer;
use App\Expense,App\ExpenseCategory;
use App\PaymentHistory;
use App\Exports\CheckoutExport;
use App\Exports\StockHistoryExport;
use App\Exports\ExpenseExport;
use App\Exports\CustomerExport;
use App\Exports\OrderExport;
use App\Exports\PaymentHistoryExport;
use App\Exports\BladiExport;
use App\LaundryOrder;

class ReportController extends Controller
{
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $startDate = getNextPrevDate('prev');
        $searcData = ['date_from'=>$startDate, 'date_to'=>date('Y-m-d')];

        $this->data['report_of'] = $request->get('type');
        $this->data['customer_list']=getCustomerList('get');

        if($this->data['report_of'] == 'checkouts'){
            $this->data['roomtypes_list']=getRoomTypesList();
            $searcData['customer_id'] = '';
            $searcData['room_type_id'] = '';
        }
        else if($this->data['report_of'] == 'bladi_report'){
            $this->data['roomtypes_list']=getRoomTypesList();
            $searcData['customer_id'] = '';
            $searcData['room_type_id'] = '';
            $searcData['checkout_years'] = Reservation::selectRaw('extract(year FROM check_out) AS year')
                                        ->distinct()
                                        ->orderBy('year', 'asc')
                                        ->get();
        }else if($this->data['report_of'] == 'expense'){
            $this->data['category_list']=getExpenseCategoryList();
            $searcData['category_id'] = '';
        } else {
            $this->data['report_of'] = 'transactions';
            $this->data['roomtypes_list']=getRoomTypesList();
            $this->data['datalist'] = PaymentHistory::get();
        }

        $this->data['search_data'] = $searcData;
        // dd($this->data);
        return view('backend/reports',$this->data);
    }

    public function searchCheckins(Request $request) {
        $this->data['list'] = 'check_ins';
         $this->data['datalist']=Reservation::whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(0)->orderBy('created_at','DESC')->get();
         return view('backend/rooms/room_reservation_list',$this->data);
    }
    public function searchCheckouts(Request $request) {
        // dd($request->all());
        $this->data['list'] = 'check_outs';
        $query = Reservation::
        leftjoin('customers as c', 'c.id', '=', 'reservations.customer_id')->
        select('reservations.*')->
        whereStatus(1)->where('reservations.is_deleted',0)->whereIsCheckout(1)->orderBy('reservations.created_at','DESC');
        if($request->customer_name){
            // $query->where('customer_id', $request->customer_id);
            $query->where('c.name', 'like', "%{$request->customer_name}%");
        }
        if($request->date_from){
            $query->whereDate('check_out', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('check_out', '<=', dateConvert($request->date_to,'Y-m-d'));
        }
        if($request->room_type_id != null && $request->room_type_id){
            $query->with(['booked_rooms' => function ($q) use($request){
                $q->where('room_type_id', $request->room_type_id);
            }]);
        }

        if($request->payment_status != null && ($request->payment_status == 0 || $request->payment_status == 1)){
            $query->where('payment_status', $request->payment_status);
        }
        $this->data['datalist']=$query->get();
        $this->data['roomtypes_list']=getRoomTypesList();
        $this->data['customer_list']=getCustomerList();
        $this->data['search_data'] = $request->all();
        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.checkouts_excel'];
            $filename='check_outs.xlsx';
            return Excel::download(new CheckoutExport($params), $filename);
        } else {
            return view('backend/rooms/room_reservation_list',$this->data);
        }
    }

    public function searchBladi(Request $request) {
    //  Code for bladi report and only search from years and month
        $this->data['list'] = 'bladi';
        $query = Reservation::whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(1)->orderBy('created_at','DESC');
        if($request->customer_id){
            $query->where('customer_id', $request->customer_id);
        }
        if($request->report_year && $request->report_month){
          
              $days=cal_days_in_month(CAL_GREGORIAN, $request->report_month,$request->report_year);

              $firstdateValue =$request->report_year.'-'.$request->report_month.'-01';
              $lastdateValue =$request->report_year.'-'.$request->report_month.'-'.$days;
              $first_date_value = strtotime($firstdateValue);
              $last_date_value = strtotime($lastdateValue);
              $fdate = date('Y-m-d', $first_date_value);
              $ldate = date('Y-m-d', $last_date_value);

              $query->WhereBetween('check_in', array($fdate ,$ldate));
              $query->orWhereBetween('check_out', array($fdate ,$ldate));
             
        }

            $query->with(['booked_rooms' => function ($q) use($request){

            }]);


        if($request->payment_status != null && ($request->payment_status == 0 || $request->payment_status == 1)){
            $query->where('payment_status', $request->payment_status);
        }
        $this->data['datalist']=$query->get();
        $this->data['days'] = $days;
        $this->data['report_month'] = $request->report_month;
        $this->data['report_year'] = $request->report_year;

        $this->data['roomtypes_list']=getRoomTypesList();
        $this->data['customer_list']=getCustomerList();

        $this->data['search_data'] = $request->all();
        $this->data['search_data']['checkout_years'] = Reservation::selectRaw('extract(year FROM check_out) AS year')
        ->distinct()
        ->orderBy('year', 'asc')
        ->get();

        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],
                    'days'=>$this->data['days'],
                    'report_month'=>$this->data['report_month'],
                    'report_year'=>$this->data['report_year'],
                    'view'=>'excel_view.bladi_excel'];
            $filename=lang_trans('txt_bladi_report').'-'.$request->report_month.'-'.$request->report_year.'.xlsx';
            return Excel::download(new BladiExport($params), $filename);
        } else {
            return view('backend/rooms/room_reservation_list',$this->data);
        }
    }

    public function searchStockHistory(Request $request) {
   
        $query = StockHistory::orderBy('id','DESC');
        if($request->product_id){
            $query->where('product_id', $request->product_id);
        }
        if($request->date_from){
            $query->whereDate('created_at', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('created_at', '<=', dateConvert($request->date_to,'Y-m-d'));
        }
        if($request->is_stock){
            $query->where('stock_is', $request->is_stock);
        }

        $this->data['datalist']=$query->get();
        $this->data['products']=Product::where('is_deleted',0)->pluck('name','id');
        $this->data['search_data'] = $request->all();
        // dd($this->data['datalist'],$this->data['search_data']);

        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.stock_history_excel'];
            $filename='stock_history.xlsx';
            return Excel::download(new StockHistoryExport($params), $filename);
        } else {
            return view('backend/stock_history',$this->data);
        }
    }
    public function searchExpense(Request $request) {
        $query = Expense::orderBy('datetime','DESC');
        if($request->category_id){
            $query->where('category_id', $request->category_id);
        }
        if($request->date_from){
            $query->whereDate('datetime', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('datetime', '<=', dateConvert($request->date_to,'Y-m-d'));
        }
        $this->data['datalist']=$query->get();
        $this->data['category_list']=ExpenseCategory::whereStatus(1)->orderBy('name','ASC')->pluck('name','id');
        $this->data['search_data'] = $request->all();

        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.expense_excel'];
            $filename='expenses.xlsx';
            return Excel::download(new ExpenseExport($params), $filename);
        } else {
            return view('backend/expenses/list',$this->data);
        }
    }
    public function searchOrders(Request $request) {
        $query=Order::where('status','!=',4)->orderBy('created_at','DESC');
        if($request->order_type=='roomOrders'){
            $query->whereNotNull('reservation_id');
        } else if($request->order_type=='tableOrders'){
            $query->whereNotNull('table_num');
        }
        if($request->date_from){
            $query->whereDate('created_at', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('created_at', '<=', dateConvert($request->date_to,'Y-m-d'));
        }

        $this->data['datalist']=$query->get();
        $this->data['search_data'] = $request->all();
        if($request->submit_btn=='export'){
            $params=['data'=>$this->data,'view'=>'excel_view.orders_excel'];
            $filename='orders.xlsx';
            return Excel::download(new OrderExport($params), $filename);
        } else {
            return view('backend/orders_list',$this->data);
        }
    }
    public function searchCustomer(Request $request) {
        $query = Customer::where('cat','=','user')->where('is_deleted',0)->orderBy('name','ASC');
        if($request->customer_name){
            // $query->where('id', $request->customer_id);
            $query->where('name', 'like', "%{$request->customer_name}%");
        }
        if($request->mobile_num){
            $query->where('mobile', $request->mobile_num);
        }
        if($request->city){
            $query->where('city', $request->city);
        }
        if($request->state){
            $query->where('state', $request->state);
        }
        if($request->country){
            $query->where('country', $request->country);
        }

        $this->data['datalist']=$query->get();
        $this->data['customer_list']=getCustomerList('get');
        $this->data['search_data'] = $request->all();

        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.customer_excel'];
            $filename='customers.xlsx';
            return Excel::download(new CheckoutExport($params), $filename);
        } else {
            return view('backend/customers/list',$this->data);
        }
    }
    public function searchCompany(Request $request) {
        // dd($request->all());
        $query = Customer::where('cat','=','company')->where('is_deleted',0)->orderBy('name','ASC');
        if($request->company_name){
            // $query->where('id', $request->customer_id);
            $query->where('name', 'like', "%{$request->company_name}%");
        }
        if($request->mobile_num){
            $query->where('mobile', $request->mobile_num);
        }
        if($request->city){
            $query->where('city', $request->city);
        }
        if($request->state){
            $query->where('state', $request->state);
        }
        if($request->country){
            $query->where('country', $request->country);
        }

        // dd($request->customer_name, $query->get());
        $this->data['datalist']=$query->get();
        $this->data['customer_list']=getCustomerList('get','company');
        $this->data['search_data'] = $request->all();

        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.company_excel'];
            $filename='companies.xlsx';
            return Excel::download(new CheckoutExport($params), $filename);
        } else {
            return view('backend/companys/list',$this->data);
        }
    }



    public function searchPaymentHistory(Request $request) {
        // dd($request->all());
        // $query = PaymentHistory::orderBy('created_at','DESC');
        $query = PaymentHistory::leftjoin('customers as c', 'c.id', '=', 'payment_history.customer_id')->with('reservation')->orderBy('payment_history.created_at','DESC');
        if($request->customer_name){
            $query->where('c.name', $request->customer_name);
        }
        if($request->user_id){
            $query->where('user_id', $request->user_id);
        }
        if($request->date_from){
            $query->whereDate('payment_history.payment_date', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('payment_history.payment_date', '<=', dateConvert($request->date_to,'Y-m-d'));
        }
        if($request->payment_of){
            $query->where('payment_history.payment_of', $request->payment_of);
        }
        if($request->payment_type){
            $query->where('payment_history.payment_type', $request->payment_type);
        }
        $this->data['datalist']=$query->get();
        $this->data['search_data'] = $request->all();
         $this->data['customer_list']=getCustomerList('get');
        $this->data['report_of'] = 'transactions';
        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.payment_history_excel'];
            $filename='payment_history.xlsx';
            return Excel::download(new CheckoutExport($params), $filename);
        } else {
            return view('backend/reports',$this->data);
        }
    }


    // New Method for Search laundary Orders

    public function searchLaundryOrder(Request $request) {

        // dd($request->all());

        $query=LaundryOrder::orderBy('created_at','DESC');
        
        if($request->order_num){
            $query->where('status', '=', $request->order_status);
        }

        if($request->vendor_id){
            $query->where('vendor_id', '=', $request->vendor_id);
        }

        if($request->room_id){
            $query->where('room_id', '=', $request->room_id);
        }

        if($request->order_num){
            $query->where('id', '=', $request->order_num);
        }

        if($request->date_from){
            $query->whereDate('created_at', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('created_at', '<=', dateConvert($request->date_to,'Y-m-d'));
        }

        // $this->data['datalist']=$query->get();
        // $this->data['search_data'] = $request->all();
        $startDate = getNextPrevDate('prev'); 
        $this->data['datalist']= $query->get(); //LaundryOrder::whereStatus(1)->whereDate('order_date', '>=', $startDate." 00:00:00")->whereDate('order_date', '<=', DB::raw('CURDATE()'))->orderBy('order_status','ASC')->orderBy('order_num','DESC')->get();
        $this->data['vendor_list'] = getVendorList();
        $this->data['room_list'] = getRoomList(2);
        $this->data['status_list']=getConstants('LIST_LAUNDRY_ORDER_STATUS');
        $this->data['search_data'] = ['order_num'=>'','vendor_id'=>'','room_id'=>'','order_status'=>'','date_from'=>$startDate, 'date_to'=>date('Y-m-d')];
        // dd($this->data);
        return view('backend/laundary_orders_list',$this->data);
    }

}
