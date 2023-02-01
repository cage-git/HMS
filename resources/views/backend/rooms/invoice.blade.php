@php
    use Salla\ZATCA\GenerateQrCode;
    use Salla\ZATCA\Tags\InvoiceDate;
    use Salla\ZATCA\Tags\InvoiceTaxAmount;
    use Salla\ZATCA\Tags\InvoiceTotalAmount;
    use Salla\ZATCA\Tags\Seller;
    use Salla\ZATCA\Tags\TaxNumber;
    $settings = getSettings();
    $invoiceLang = $settings['invoice_language'];

    $setVar = function ($value) use ($settings, $invoiceLang){
        $label = @$settings[$invoiceLang.'_'.$value];
        $config = config('constants.INVOICE_INPUTS_VALUE_AR');
        return (isset($label) && $label != '')
                    ? $label
                    : $config[$value];
    };

    $label_invoice_page_label = $setVar('invoice_page_label');
    $label_invoice_name_for_original = $setVar('invoice_name_for_original');
    $label_invoice_name_for_duplicate = $setVar('invoice_name_for_duplicate');
    $label_invoice_name_for_cancel = $setVar('invoice_name_for_cancel');
    $label_tax_number = $setVar('tax_number');
    $label_tax_invoice = $setVar('tax_invoice');
    $label_ph_landline = $setVar('ph_landline');
    $label_ph_mobile = $setVar('ph_mobile');
    $label_email = $setVar('email');
    $label_invoice_no = $setVar('invoice_no');
    $label_invoice_date = $setVar('invoice_date');
    $label_customer_name = $setVar('customer_name');
    $label_customer_mobile = $setVar('customer_mobile');
    $label_company_name = $setVar('company_name');
    $label_address = $setVar('address');
    $label_checkin = $setVar('checkin');
    $label_checkout = $setVar('checkout');
    $label_serial_no = $setVar('serial_no');
    $label_room_name_number = $setVar('room_name_number');
    $label_total_days = $setVar('total_days');
    $label_room_rent = $setVar('room_rent');
    $label_amount = $setVar('amount');
    $label_total = $setVar('total');
    $label_grand_total = $setVar('grand_total');
    $label_tax = $setVar('tax');
    $label_c_tax = $setVar('c_tax');
    $label_discount = $setVar('discount');
    $label_subtotal = $setVar('subtotal');
    $label_advance_amount = $setVar('advance_amount');
    $label_due_amount = $setVar('due_amount');
    $label_customer_balance = $setVar('customer_balance');
    $label_returned = $setVar('returned');
    $label_refund_amount = $setVar('refund_amount');
    $label_balance_amount = $setVar('balance_amount');
    $label_amount_in_words = $setVar('amount_in_words');
    $label_bank_details = $setVar('bank_details');
    $label_acc_name = $setVar('acc_name');
    $label_ifsc_code = $setVar('ifsc_code');
    $label_account_number = $setVar('account_number');
    $label_bank_and_branch = $setVar('bank_and_branch');
    $label_guest_sign = $setVar('guest_sign');
    $label_cashier_sign = $setVar('cashier_sign');
    $label_terms_condition_heading = $setVar('terms_condition_heading');
    $label_terms_condition_descriptions = $setVar('terms_condition_descriptions');
    $label_terms_condition_note = $setVar('terms_condition_note');
    $label_food_item_details = $setVar('food_item_details');
    $label_food_date = $setVar('food_date');
    $label_food_item_qty = $setVar('food_item_qty');
    $label_food_item_price = $setVar('food_item_price');
    $label_food_no_of_orders = $setVar('food_no_of_orders');
    $label_total_c_tax = $setVar('total_c_tax');





@endphp
<!DOCTYPE html>
<html lang="en">
     <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <title>{{$settings['site_page_title']}}: {{$label_invoice_page_label}}</title>
        <link href="{{URL::asset('public/assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('public/css/invoice_style.css')}}" rel="stylesheet">
         <style>
             table>thead>tr>th,
             table>thead>tr>td,
             table>tbody>tr>th,
             table>tbody>tr>td{
                 padding: 3px !important;
             }
             .class-inv-20{
                 padding-top: 3px !important;
             }
         </style>
    </head>
    <body>
        @php
            $invTypeList = ['org'=>$label_invoice_name_for_original, 'dup'=>$label_invoice_name_for_duplicate, 'cnl'=>$label_invoice_name_for_cancel];
            $invoiceType = (isset($invTypeList[Request::segment(5)])) ? $invTypeList[Request::segment(5)] : '';

            $invoiceNum = $data_row->invoice_num;
            if($type==2){
                $invoiceNum = ($data_row->orders_info!=null) ? $data_row->orders_info->invoice_num : '';
            }
            $calculatedAmount = calcFinalAmount($data_row, 1, false);
            $additionalAmount = $calculatedAmount['additionalAmount'];
            $additionalAmountReason = $data_row->additional_amount_reason;
            $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
            $gstPerc = $calculatedAmount['totalRoomGstPerc'];
            $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
            $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
            $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
            $roomAmountWithCGstAmount = $calculatedAmount['totalRoomAmountWithCGstAmount'];
            $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
            // change the subtotal 
            //$subTotalRoomAmount = (($totalRoomAmount+$roomAmountGst+$roomAmountCGst) - $roomAmountDiscount)+$additionalAmount;
            $subTotalRoomAmount = (($roomAmountWithCGstAmount + $roomAmountGst ) )+$additionalAmount;
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
            // Get the order additional value and reason
            $additionalOrderAmount = $calculatedAmount['additionalOrderAmount'];
            $additionalOrderAmountReason = $data_row->orders_info !=null ? $data_row->orders_info->additional_order_amount_reason:'';


            $data_date = date('Y-m-d h:i:s', strtotime(str_replace('/','-', $data_row->created_at)));
            $zatca = [];
            $zatca[] = new Seller($settings['site_page_title']);
            $zatca[] = new TaxNumber($settings['gst_num']);
            $zatca[] = new InvoiceDate($data_date);

        @endphp
        <div style="padding: 10px">
        <div class="container" style="width: 100%;">
        <div class="row">
            <div class="col-lg-6 col-md-6" style="border-right: 3px solid #929292;">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 class-inv-11">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <strong>
                                    {{$label_tax_number}} : {{$settings['gst_num']}}
                                </strong>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                                <strong>
                                    {{$label_tax_invoice}}
                                </strong>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                                <strong>
                                    {{$label_ph_landline}}. {{$settings['hotel_phone']}}
                                </strong>
                                <br/>
                                <strong>
                                    {{$label_ph_mobile}} {{$settings['hotel_mobile']}}
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center p-rel">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span class="class-inv-12">
                        {{$settings['hotel_name']}}
                    </span>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <img src="{{checkFile(@$settings['site_logo'],'uploads/logo/','default_logo.jpg')}}" width="{{@$settings['site_logo_width']}}" height="{{@$settings['site_logo_height']}}" class="inv-logo">
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div class="class-inv-13">
                                {{$settings['hotel_tagline']}}
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="class-inv-14">
                                {{$settings['hotel_address']}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="class-inv-15">
                        <span>
                            {{$settings['hotel_website']}}
                        </span>
                                |
                                <span>
                            {{$label_email}}:-
                        </span>
                                <span>
                            {{$settings['hotel_email']}}
                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 class-inv-6">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <strong class="fsize-label">
                                    {{$label_invoice_no}}.:
                                    <span class="class-inv-19">
                                {{$invoiceNum}}
                            </span>
                                </strong>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                <br/>
                                <strong class="fsize-label">
                                    {{$label_invoice_date}} :
                                </strong>
                                <spa class-inv-16n="">
                                    {{dateConvert($data_row->created_at,'d-m-Y H:i')}}
                                </spa>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="col-lg-6 col-md-6" style="padding-top: 1%;">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table bank-details-tbl">
                            <thead>
                            <tr>
                                <th>{{$label_customer_name}}:</th>
                                <td colspan="2">
                                    <div class="class-inv-16">

                                        <?php
                                        if($data_row->customer->cat == "user"){
                                            echo $data_row->customer->surname.' '.$data_row->customer->name.' '.$data_row->customer->middle_name;
                                        }else{
                                            echo 'N/A';
                                        }
                                        ?>
                                    </div>
                                </td>
                                <th>{{$label_customer_mobile}}:</th>
                                <td colspan="2">
                                    <div class="class-inv-16">
                                        {{$data_row->customer->mobile}}
                                    </div>
                                </td>
                                <th class="text-right">{{strtoupper($invoiceType)}}</th>
                            </tr>
                            <tr>
                                <th>{{$label_company_name}}:</th>
                                <td colspan="{{(!$data_row->company_gst_num) ? 5 : 2}}">
                                    <div class="class-inv-16">
                                    <?php
                                        if($data_row->customer->cat == "company"){
                                            echo $data_row->customer->name; 
                                        }else{
                                            echo 'N/A';
                                        }
                                     ?>&nbsp;
                                    </div>
                                </td>
                                @if($data_row->company_gst_num)
                                    <th>{{$label_tax_number}}.</th>
                                    <td>
                                        <div class="class-inv-16">
                                            <!-- {{$data_row->company_gst_num}} -->
                                            <?php
                                            if($data_row->customer->cat == "company"){
                                                echo $data_row->customer->company_gst_num; 
                                            }else{
                                                echo 'N/A';
                                            }
                                        ?>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <th>{{$label_address}}:</th>
                                <td colspan="5">
                                    <div class="class-inv-16">
                                        {{$data_row->customer->address}}
                                    </div>
                                </td>
                            </tr>
                            @if($type==1)
                                <tr>
                                    <th>{{$label_checkin}}:</th>
                                    <td colspan="2">
                                        <div class="class-inv-16">
                                            {{dateConvert($data_row->check_in,'d-m-Y H:i')}}
                                        </div>
                                    </td>
                                    <th>{{$label_checkout}}:</th>
                                    <td colspan="2">
                                        <div class="class-inv-16">
                                            {{dateConvert($data_row->check_out,'d-m-Y H:i')}}
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <br/>




    </body>
</html>

@if($type==1)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="5%" colspan="2">{{$label_serial_no}}.</th>
{{--                        <th class="text-center" width="10%">HSN/SAC</th>--}}
                        <th class="text-center" width="30%">{{$label_room_name_number}}</th>
                        <th class="text-center" width="10%">{{$label_total_days}}</th>
                        <th class="text-center" width="10%">{{$label_room_rent}} ({{getCurrencySymbol()}})</th>
                        <th class="text-center" width="10%">{{$label_amount}} ({{getCurrencySymbol()}})</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data_row->booked_rooms)
                        @php
                            $settings = getSettings();
                            $gstPerc = $settings['gst'];
                            $cgstPerc = $settings['cgst'];


                            @endphp
                        @foreach($data_row->booked_rooms as $key=>$roomInfo)
                            @php
                                $romprice = $roomInfo->room_price+ (($roomInfo->room_price /100) * $gstPerc) + (($roomInfo->room_price /100) * $cgstPerc);
                                $romprice = $roomInfo->room_price+ (($roomInfo->room_price /100) * $gstPerc) + (($roomInfo->room_price /100) * $cgstPerc);
                                $checkIn = dateConvert($roomInfo->check_in, 'Y-m-d');
                                $checkOut = dateConvert($roomInfo->check_out, 'Y-m-d');
                                $durOfStayPerRoom = dateDiff($checkIn, $checkOut, 'days');
                                $amountPerRoom = ($durOfStayPerRoom * $romprice);
                            @endphp
                            <tr>
                              <td class="text-center" colspan="2">{{$key+1}}</td>
{{--                              <td class="text-center">9963</td>--}}
                              <td>
                                  {{ ($roomInfo->room_type) ? $roomInfo->room_type->title : ""}}
                                  ({{lang_trans('txt_room_num')}} : {{$roomInfo->room->room_no}})
                              </td>
                              <td class="text-center">
                                <span class="{{ ($roomInfo->swapped_from_room) ? 'swapped_room' : 'no_swapped_room'}}">{{$durOfStayPerRoom}}</span>
                              </td>
{{--                              <td class="text-right">{{ numberFormat($romprice) }}</td>--}}
                              <td class="text-right">{{ numberFormat($roomInfo->room_price) }}</td>
{{--                              <td class="text-right">{{ numberFormat($amountPerRoom) }}</td>--}}
{{--                              <td class="text-right">{{ numberFormat($totalRoomAmount) }}</td>--}}
                              <td class="text-right">{{ numberFormat(($durOfStayPerRoom * $roomInfo->room_price)) }}</td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <th class="text-right" colspan="5">{{$label_total}}</th>
                        <td class="text-right">{{ numberFormat($totalRoomAmount) }}</td>
                    </tr>
                    @if($roomAmountDiscount>0)
                        <tr>
                            <th class="text-right" colspan="5">{{$label_discount}}</th>
                            <td class="text-right">{{ numberFormat($roomAmountDiscount) }}</td>
                        </tr>
                    @endif
                    @if($roomAmountGst>0)
                    
                    <tr>
                        <th class="text-right" colspan="5"> {{$label_c_tax}} {{$cgstPerc}}%</th>
                        <td class="text-right">{{ numberFormat($roomAmountCGst) }}</td>
                    </tr>

                    <tr>
                        <th class="text-right" colspan="5">{{$label_total_c_tax}}</th>
                        <td class="text-right">{{ numberFormat($roomAmountWithCGstAmount) }}</td>
                    </tr>

                    <tr>
                        <th class="text-right" colspan="5">{{$label_tax}} {{$gstPerc}}% </th>
                        <td class="text-right">{{ numberFormat($roomAmountGst ) }}</td>
                    </tr>
                    @if($additionalAmount>0)
                        <tr>
                            <th class="text-right" colspan="5">{{$additionalAmountReason}}</th>
                            <td class="text-right">{{ numberFormat($additionalAmount) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th class="text-right" colspan="5">{{$label_subtotal}}</th>
                        <td class="text-right">{{ numberFormat($subTotalRoomAmount) }}</td>
                    </tr>
                    @endif
                        @if($advancePayment>0)
                    <tr>
                        <th class="text-right" colspan="5">{{$label_advance_amount}}</th>
                        <td class="text-right">{{ numberFormat($advancePayment) }}</td>
                    </tr>
                    @endif
                    @if($dueAmount > 0)
                    <tr>
                        <th class="text-right" colspan="5">{{$label_due_amount}}</th>
                        <td class="text-right">{{ ($dueAmount < 0) ? 0 : numberFormat($dueAmount) }}</td>
                    </tr>
                    @else
                    <tr>
                        <th class="text-right" colspan="5"> {{$label_customer_balance}} {{($dueAmount < 0) ? '('.$label_returned.')':''}}</th>
                        <td class="text-right">{{ numberFormat(abs($dueAmount)) }}</td>
                    </tr>
                    @endif
                    @if($invoiceType == $label_invoice_name_for_cancel)
                        <tr>
                            <th class="text-right" colspan="5">{{$label_refund_amount}}</th>
                            <td class="text-right">{{ numberFormat($advancePayment) }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" colspan="5">{{$label_balance_amount}}</th>
                            <td class="text-right">{{ numberFormat(0) }}</td>
                        </tr>
                    @endif
                    @if($invoiceType != $label_invoice_name_for_cancel)
{{--                        <tr>--}}
{{--                            <th class="text-right" colspan="2">{{$label_amount_in_words}}:-</th>--}}
{{--                            <td class="class-inv-17" colspan="4">{{ getIndianCurrency(numberFormat(abs($dueAmount))) }}</td>--}}
{{--                        </tr>--}}

                        <tr>
                            <td class="class-inv-17" colspan="6">
                                <!-- add Gst tax value correctly -->
                                @php
                                    $zatca[] = new InvoiceTotalAmount(numberFormat($subTotalRoomAmount));
                                    $zatca[] = new InvoiceTaxAmount(($roomAmountGst));
                                    $generatedString = GenerateQrCode::fromArray($zatca);
                                @endphp
                                <img class="center-block mt-5" src="{!! @$generatedString->render() !!}" style="width: 150px;">
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <td colspan="4">
                            @if(@$settings['bank_name'] && @$settings['bank_acc_num'])
                                <div>
                                    <table class="table table-condensed bank-details-tbl">
                                        <tr>
                                            <th colspan="2">{{$label_bank_details}}</th>
                                        </tr>
                                        <tr>
                                            <td>{{$label_acc_name}}:</td>
                                            <td>{{@$settings['bank_acc_name']}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{$label_ifsc_code}}:</td>
                                            <td>{{@$settings['bank_ifsc_code']}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{$label_account_number}}:</td>
                                            <td>{{@$settings['bank_acc_num']}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{$label_bank_and_branch}}:</td>
                                            <td>{{@$settings['bank_name']}}, {{$settings['bank_branch']}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </td>
                        <td colspan="1">
                            <div class="class-inv-20">
                                {{$label_guest_sign}}
                            </div>
                        </td>
                        <td class="text-right" colspan="1">
                            <div class="class-inv-20">
                               {{$label_cashier_sign}}
                                <br />
                                {{Auth::user()->name}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">{{$label_terms_condition_heading}}</th>
                        <td colspan="4">{!!$label_terms_condition_descriptions!!}</td>
                    </tr>
                    <tr>
                        <th class="text-center" colspan="6">
                                {{$label_terms_condition_note}}
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif

@if($type==2)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="2%" colspan="2">{{lang_trans('txt_sno')}}.</th>
                        <th class="text-center" width="20%">{{$label_food_item_details}}</th>
{{--                        <th class="text-center" width="5%">HSN/SAC</th>--}}
                        <th class="text-center" width="5%">{{$label_food_date}}</th>
                        <th class="text-center" width="5%">{{$label_food_item_qty}}</th>
                        <th class="text-center" width="5%"> {{$label_food_item_price}} ({{getCurrencySymbol()}})</th>
                        <th class="text-center" width="10%">{{$label_amount}} ({{getCurrencySymbol()}})</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data_row->orders_items as $k=>$val)
                      @php
                        $totalOrdersAmount = $totalOrdersAmount;
                      @endphp
                        <tr>
                            <td class="text-center" colspan="2">{{$k+1}}</td>
                            <td class="">{{$val->item_name}}</td>
{{--                            <td class="text-center">9963</td>--}}
                            <td class="text-center">{{dateConvert($val->check_out,'d-m-Y')}}</td>
                            <td class="text-center">{{$val->item_qty}}</td>
                            <td class="text-center">{{numberFormat($val->item_price)}}</td>
                            <td class="text-center">{{numberFormat($val->item_qty*$val->item_price)}}</td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="7">{{$label_food_no_of_orders}}</td>
                    </tr>
                    @endforelse
                    <tr>
                        <th class="text-right" colspan="6">{{$label_total}}</th>
                        <td class="text-right">{{ numberFormat($totalOrdersAmount) }}</td>
                    </tr>
                    @if($foodAmountGst>0)
                    <tr>
                        <th class="text-right" colspan="6">{{$label_tax}} ({{$gstPercFood}} %)</th>
                        <td class="text-right">{{ numberFormat($foodAmountGst) }}</td>
                    </tr>
                    @endif
                    <!-- add additional value and reason into orders -->
                    @if($additionalOrderAmount>0)
                        <tr>
                            <th class="text-right" colspan="6">{{$additionalOrderAmountReason}}</th>
                            <td class="text-right">{{ numberFormat($additionalOrderAmount) }}</td>
                        </tr>
                    @endif

                        @if($foodAmountCGst>0)
                    <tr>
                        <th class="text-right" colspan="6">{{$label_c_tax}} ({{$cgstPercFood}} %)</th>
                        <td class="text-right">{{ numberFormat($foodAmountCGst) }}</td>
                    </tr>
                    @endif

                    @if($foodOrderAmountDiscount>0)
                        <tr>
                            <th class="text-right" colspan="6">{{$label_discount}}</th>
                            <td class="text-right">{{ numberFormat($foodOrderAmountDiscount) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th class="text-right" colspan="6">{{$label_grand_total}}</th>
                        <td class="text-right">{{ numberFormat($finalOrderAmount) }}</td>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="2">{{$label_amount_in_words}}:-</th>
                        <td class="class-inv-17" colspan="5">{{ getIndianCurrency(numberFormat($finalOrderAmount)) }}</td>
                    </tr>
                    <tr>
                        <!-- add QR code into food invoice  -->
                    @php
                        $data_date = date('Y-m-d h:i:s', strtotime(str_replace('/','-', $data_row->created_at)));
                        $zatca = [];
                        $zatca[] = new Seller($settings['site_page_title']);
                        $zatca[] = new TaxNumber($settings['gst_num']);
                        $zatca[] = new InvoiceDate($data_date);
                        $zatca[] = new InvoiceTotalAmount(numberFormat($finalOrderAmount));
                        $zatca[] = new InvoiceTaxAmount(($foodAmountGst));
                        $generatedString = GenerateQrCode::fromArray($zatca);
                        
                    @endphp
                    <td class="class-inv-17" colspan="7"><img class="center-block mt-5" src="{!! @$generatedString->render() !!}" style="width: 150px;"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div>
                                <table class="table table-condensed bank-details-tbl">
                                    <tr>
                                        <th colspan="2">{{$label_bank_details}}</th>
                                    </tr>
                                    <tr>
                                        <td>{{$label_acc_name}}:</td>
                                        <td>{{$settings['bank_acc_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$label_ifsc_code}}:</td>
                                        <td>{{$settings['bank_ifsc_code']}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$label_account_number}}:</td>
                                        <td>{{$settings['bank_acc_num']}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$label_bank_and_branch}}:</td>
                                        <td>{{$settings['bank_name']}}, {{$settings['bank_branch']}}</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="class-inv-20">
                                {{$label_guest_sign}}
                            </div>
                        </td>
                        <td class="text-right" colspan="2">
                            <div class="class-inv-20">
                               {{$label_cashier_sign}}
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <th colspan="2">{{$label_terms_condition_heading}}</th>
                        <td class="" colspan="5">{!!$label_terms_condition_descriptions!!}</td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="7">
                            <div class="">
                                {{$label_terms_condition_note}}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- <div>
        {!!$settings['invoice_term_condition']!!}
    </div> --}}
@endif



<div class="col-sm-12 text-center no-print">
    <br/>
    <button class="btn btn-sm btn-success no-print" onclick="window.print()">
        {{lang_trans('btn_print')}}
    </button>
    <br/><br/>
</div>
