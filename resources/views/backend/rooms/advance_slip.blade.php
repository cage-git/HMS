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
    $label_advance_slip = $setVar('advance_slip');
    $label_description = $setVar('description');






@endphp
<!DOCTYPE html>
<html lang="en">
     <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <title>{{$settings['site_page_title']}}: Invoice</title>
        <link href="{{URL::asset('public/assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('public/css/invoice_style.css')}}" rel="stylesheet">
    </head>
    <body>
        @php
            $invTypeList = ['org'=>$label_invoice_name_for_original, 'dup'=>$label_invoice_name_for_duplicate, 'cnl'=>$label_invoice_name_for_cancel];
            $invoiceType = (isset($invTypeList[Request::segment(5)])) ? $invTypeList[Request::segment(5)] : '';

            $invoiceNum = $data_row->invoice_num;

            if($type==2){
                $invoiceNum = ($data_row->orders_info!=null) ? $data_row->orders_info->invoice_num : '';
            }


      $jsonDecode = json_decode($data_row->amount_json);

      $discount = (isset($jsonDecode->room_amount_discount)) ? $jsonDecode->room_amount_discount : 0;

      $durOfStay = $data_row->duration_of_stay;
      $perRoomPrice = $data_row->per_room_price;
      $roomQty = $data_row->room_qty;
      $totalAmount = ($durOfStay * $perRoomPrice * $roomQty);

      $gstPerc = $data_row->gst_perc;
      $cgstPerc = $data_row->cgst_perc;

      $gst =  gstCalc($totalAmount,'room_amount',$gstPerc,$cgstPerc);
      $roomAmountGst = $gst['gst'];
      $roomAmountCGst = $gst['cgst'];

      $advancePayment = $data_row->advance_payment;
      $finalAmount = $totalAmount+$roomAmountGst+$roomAmountCGst-$advancePayment-$discount;

      $totalOrdersAmount = 0;

      $invoiceNum = $data_row->invoice_num;
      if($type==2){
        $invoiceNum = ($data_row->orders_info!=null) ? $data_row->orders_info->invoice_num : '';
      }

      $rooms = [];
      if($data_row->room_num){
        $exp = explode(',', $data_row->room_num);
        foreach($exp as $roomNum){
            $roomData = getRoomByNum($roomNum);
            if($roomData){
                $rooms[$roomNum] = $roomData->room_name;
            }
        }
      }
@endphp
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 class-inv-11">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <strong>
                            {{$label_tax_number}}: {{$settings['gst_num']}}
                        </strong>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                        <strong>
                            {{$label_advance_slip}}
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
                            E-mail:-
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
    </body>
</html>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table bank-details-tbl">
            <thead>
                <tr>
                    <th>{{$label_customer_name}}:</th>
                    <td colspan="2">
                        <div class="class-inv-16">
                            {{$data_row->customer->surname}} {{$data_row->customer->name}} {{$data_row->customer->middle_name}}
                        </div>
                    </td>
                    <th class="text-right">{{strtoupper($invoiceType)}}</th>
                </tr>
                <tr>
                    <th>{{$label_company_name}}:</th>
                    <td colspan="{{(!$data_row->company_gst_num) ? 3 : ''}}">
                        <div class="class-inv-16">
                            {{$data_row->company_name}}&nbsp;
                        </div>
                    </td>
                    @if($data_row->company_gst_num)
                        <th>{{$label_tax_number}}</th>
                        <td>
                            <div class="class-inv-16">
                                {{$data_row->company_gst_num}}
                            </div>
                        </td>
                    @endif
                </tr>
                <tr>
                    <th>{{$label_address}}:</th>
                    <td colspan="3">
                        <div class="class-inv-16">
                            {{$data_row->customer->address}}
                        </div>
                    </td>
                </tr>
                @if($type==1)
                <tr>
                    <th>{{$label_checkin}}:</th>
                    <td>
                        <div class="class-inv-16">
                            {{dateConvert($data_row->check_in,'d-m-Y H:i')}}
                        </div>
                    </td>
                    <th>{{$label_checkout}}:</th>
                    <td>
                        <div class="class-inv-16">
                            {{addSubDate('+', $data_row->duration_of_stay, $data_row->check_in, 'd-m-Y H:i')}}
                        </div>
                    </td>
                </tr>
                @endif
            </thead>
        </table>
    </div>
</div>
@if($type==1)
<div class="row page-break">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" width="5%" colspan="2">
                        {{lang_trans('txt_sno')}}.
                    </th>
                    <th class="text-center" width="30%">
                        {{$label_description}}
                    </th>
{{--                    <th class="text-center" width="10%">--}}
{{--                        HSN/SAC--}}
{{--                    </th>--}}
                    <th class="text-center" width="30%">
                        {{$label_room_name_number}}
                    </th>
                    <th class="text-center" width="10%">
                        عدد الغرف
                    </th>
                    <th class="text-center" width="10%">
                        {{$label_room_rent}}  ({{getCurrencySymbol()}})
                    </th>
                    <th class="text-center" width="10%">
                        {{$label_total_days}}
                    </th>
                    <th class="text-center" width="10%">
                        {{$label_amount}} ({{getCurrencySymbol()}})
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" colspan="2">
                        1.
                    </td>
                    <td class="text-center">
                        {{$data_row->customer->name}}
                    </td>
{{--                    <td class="text-center">--}}
{{--                        9963--}}
{{--                    </td>--}}
                    <td class="text-center">
                        @if(count($rooms))
                            @foreach($rooms as $rNum=>$rName)
                                {{$rName.' ('.$rNum.')'}}<br/>
                            @endforeach
                        @else
                            {{$data_row->room_num}}
                        @endif
                    </td>
                    <td class="text-center">
                        {{$data_row->room_qty}}<br/>
                    </td>
                    <td class="text-center">
                        {{$data_row->per_room_price}}
                    </td>
                    <td class="text-center">
                        {{$data_row->duration_of_stay}}
                    </td>
                    <td class="text-center">
                        {{ $totalAmount }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right" colspan="7">
                        {{$label_total}}
                    </th>
                    <td class="text-right">
                        {{ numberFormat($totalAmount) }}
                    </td>
                </tr>
                @if($roomAmountGst>0)
                <tr>
                    <th class="text-right" colspan="7">
                        {{$label_tax}} ({{$gstPerc}} %)
                    </th>
                    <td class="text-right">
                        {{ numberFormat($roomAmountGst) }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right" colspan="7">
                        {{$label_c_tax}} ({{$cgstPerc}} %)
                    </th>
                    <td class="text-right">
                        {{ numberFormat($roomAmountCGst) }}
                    </td>
                </tr>
                @endif
                    @if($advancePayment>0)
                <tr>
                    <th class="text-right" colspan="7">
                        {{$label_advance_amount}}
                    </th>
                    <td class="text-right">
                        {{ numberFormat($advancePayment) }}
                    </td>
                </tr>
                @endif
                    @if($discount>0)
                <tr>
                    <th class="text-right" colspan="7">
                        {{$label_discount}}
                    </th>
                    <td class="text-right">
                        {{ numberFormat($discount) }}
                    </td>
                </tr>
                @endif
                <tr>
                    <th class="text-right" colspan="7">
                        {{$label_grand_total}}
                    </th>
                    <td class="text-right">
                        {{ numberFormat(abs($finalAmount)) }}
                    </td>
                </tr>

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
            </tbody>
        </table>
    </div>
</div>


@endif

<div class="col-sm-12 text-center no-print">
    <br/>
    <button class="btn btn-sm btn-success no-print" onclick="window.print()">
        {{lang_trans('btn_print')}}
    </button>
    <br/><br/>
</div>
