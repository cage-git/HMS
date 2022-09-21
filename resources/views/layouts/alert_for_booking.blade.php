@if($alert_for_booking)
    <style>
        .nav_list_tab>a{background: #ff9297 !important;
            color: white !important;
            font-size: 18px;
            font-weight: 900;}
        .nav_list_tab.active>a{background: #37cfb5 !important;
            color: white !important;
            font-size: 18px;
            font-weight: 900;}
    </style>
{{--    in active--}}
{{--    class="active"--}}
<div class="container">
    <ul class="nav nav-tabs nav-justified">
        <li class="nav_list_tab"><a data-toggle="tab" href="#home">{{lang_trans('heading_today_checkouts')}}</a></li>
        <li class="nav_list_tab"><a data-toggle="tab" href="#menu1">{{lang_trans('heading_tommorow_checkouts')}}</a></li>
    </ul>

    <div class="tab-content" id="contentdiv_notification" style="
    border: 10px solid #ff9297;
">
        <div id="home" class="tab-pane fade">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{lang_trans('heading_today_checkouts')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>



                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{{lang_trans('txt_sno')}}</th>
                                    <th>{{lang_trans('txt_reservation_type')}}</th>
                                    <th>{{lang_trans('txt_guest_name')}}</th>
                                    <th>{{lang_trans('txt_mobile_num')}}</th>
                                    <th>{{lang_trans('txt_email')}}</th>
                                    <th>{{lang_trans('txt_room')}}</th>
                                    <th>{{lang_trans('txt_checkin')}}</th>
                                    <th>{{lang_trans('txt_checkout')}}</th>
                                    <th>{{lang_trans('txt_total_amount')}}</th>
                                    <th>{{lang_trans('txt_due_amount')}}</th>
                                    <th>{{lang_trans('txt_action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $one_j = 0;
                                    $one_totalAmount = 0;
                                @endphp
                                @foreach($alert_for_booking['today_datalist'] as $k=>$val)
                                    @if($val->is_checkout==0)
                                        @php
                                            $dateDiff = dateDiff($val->check_in, date('Y-m-d'), 'daysWIthSymbol');
                                            $calc = calcFinalAmount($val);
                                            $one_totalAmount = $one_totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
                                            $one_j++;
                                        @endphp
                                        @php
                                            $calculatedAmount = calcFinalAmount($val, 1);
                                            $additionalAmount = $calculatedAmount['additionalAmount'];
                                            $additionalAmountReason = $val->additional_amount_reason;
                                            $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
                                            $gstPerc = $calculatedAmount['totalRoomGstPerc'];
                                            $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
                                            $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
                                            $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
                                            $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
                                            $subTotalRoomAmount = (($totalRoomAmount+$roomAmountGst+$roomAmountCGst) - $roomAmountDiscount)+$additionalAmount;
                                            $advancePayment = $calculatedAmount['advancePayment'];
                                            $dueAmount = $subTotalRoomAmount-$advancePayment;
                                        @endphp
                                        <tr @if($val->reservation_type == 1) style="background: lightgoldenrodyellow" @endif>
                                            <td>{{$one_j}}</td>
                                            <td>
                                                @if($val->reservation_type == 1)
                                                    Booking
                                                @else
                                                    Check-in
                                                @endif
                                            </td>
                                            <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                                            <td>{{($val->customer) ? $val->customer->mobile : 'NA'}}</td>
                                            <td>{{($val->customer) ? $val->customer->email : 'NA'}}</td>
                                            <td>
                                                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#booked_room_alert_{{$val->id}}">{{lang_trans('btn_view')}}</button>
                                                @include('backend/model/booked_rooms_alert_modal',['val'=>$val])
                                            </td>
                                            <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td>
                                            <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td>
                                            <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                                            <td>

                                                {{getCurrencySymbol()}}
                                                {{($dueAmount) ? number_format((float)$dueAmount, 2, '.', '') : 0}}
                                            </td>
                                            <td>
                                                @if($val->reservation_type == 1)
                                                    @if($val->cancelled == 1)
                                                        <i class="btn btn-xs btn-danger">{{lang_trans('booking_is_cancelled')}}</i>
                                                    @else
                                                        <a class="btn btn-sm btn-danger" href="{{route('cancel-reservation',[$val->id])}}">{{lang_trans('btn_cancel_booking')}}</a>
                                                        <a class="btn btn-sm btn-info" href="{{route('changeto-checkin-reservation',[$val->id])}}">{{lang_trans('btn_check_in')}}</a>
                                                        <a class="btn btn-sm btn-primary" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                                    @endif
                                                    <a class="btn btn-sm btn-primary" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                                @else
                                                    @if($val->cancelled == 1)
                                                        <i class="btn btn-xs btn-danger">{{lang_trans('reservation_is_cancelled')}}</i>
                                                    @else
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#advance_pay_alert_{{$val->id}}">{{lang_trans('btn_advance_pay')}}</button>
                                                        <a class="btn btn-sm btn-info" href="{{route('advance-slip',[base64_encode($val->id)])}}" target="_blank">{{lang_trans('btn_advance_slip')}}</a>
                                                        <a class="btn btn-sm btn-warning" href="{{route('food-order',[$val->id])}}">{{lang_trans('btn_food_order')}}</a>
                                                        <a class="btn btn-sm btn-primary" href="{{route('view-reservation',[$val->id])}}">{{lang_trans('btn_view')}}</a>
                                                        <a class="btn btn-sm btn-danger" href="{{route('check-out-room',[$val->id])}}">{{lang_trans('btn_checkout')}}</a>
                                                        <a class="btn btn-sm btn-danger" href="{{route('cancel-reservation',[$val->id])}}">{{lang_trans('btn_cancel_reservation')}}</a>


                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#extend_reservation_alert_{{$val->id}}">{{lang_trans('btn_extend_reservation')}}</button>
                                                        {{--                                      <a class="btn btn-sm btn-info" href="{{route('extend-reservation',[$val->id])}}" target="_blank">{{lang_trans('btn_extend_reservation')}}</a>--}}
                                                        @if($dateDiff >= 0)
                                                            <a class="btn btn-sm btn-success" href="{{route('swap-room',[$val->id])}}">{{lang_trans('btn_swap_room')}}</a>
                                                        @endif
                                                        @include('backend/model/extend_reservation_alert_modal',['val'=>$val, 'dueAmount'=>$dueAmount])
                                                        @include('backend/model/advance_pay_alert_modal',['val'=>$val, 'dueAmount'=>$dueAmount])
                                                        {{--<a class="btn btn-sm btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'dup'])}}" target="_blank">{{lang_trans('btn_invoice_room_dup')}}</a>--}}
                                                        {{--<a class="btn btn-sm btn-warning" href="{{route('invoice',[$val->id,2])}}" target="_blank">{{lang_trans('btn_invoice_food')}}</a>--}}
                                                    @endif
                                                    <a class="btn btn-sm btn-primary" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{lang_trans('heading_tommorow_checkouts')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{{lang_trans('txt_sno')}}</th>
                                    <th>{{lang_trans('txt_reservation_type')}}</th>
                                    <th>{{lang_trans('txt_guest_name')}}</th>
                                    <th>{{lang_trans('txt_mobile_num')}}</th>
                                    <th>{{lang_trans('txt_email')}}</th>
                                    <th>{{lang_trans('txt_room')}}</th>
                                    <th>{{lang_trans('txt_checkin')}}</th>
                                    <th>{{lang_trans('txt_checkout')}}</th>
                                    <th>{{lang_trans('txt_total_amount')}}</th>
                                    <th>{{lang_trans('txt_due_amount')}}</th>
                                    <th>{{lang_trans('txt_action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $two_j = 0;
                                    $two_totalAmount = 0;
                                @endphp
                                @foreach($alert_for_booking['tommorow_datalist'] as $k=>$val)
                                    @if($val->is_checkout==0)
                                        @php
                                            $dateDiff = dateDiff($val->check_in, date('Y-m-d'), 'daysWIthSymbol');
                                            $calc = calcFinalAmount($val);
                                            $two_totalAmount = $two_totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
                                            $two_j++;
                                        @endphp
                                        @php
                                            $calculatedAmount = calcFinalAmount($val, 1);
                                            $additionalAmount = $calculatedAmount['additionalAmount'];
                                            $additionalAmountReason = $val->additional_amount_reason;
                                            $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
                                            $gstPerc = $calculatedAmount['totalRoomGstPerc'];
                                            $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
                                            $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
                                            $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
                                            $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
                                            $subTotalRoomAmount = (($totalRoomAmount+$roomAmountGst+$roomAmountCGst) - $roomAmountDiscount)+$additionalAmount;
                                            $advancePayment = $calculatedAmount['advancePayment'];
                                            $dueAmount = $subTotalRoomAmount-$advancePayment;
                                        @endphp
                                        <tr @if($val->reservation_type == 1) style="background: lightgoldenrodyellow" @endif>
                                            <td>{{$two_j}}</td>
                                            <td>
                                                @if($val->reservation_type == 1)
                                                    Booking
                                                @else
                                                    Check-in
                                                @endif
                                            </td>
                                            <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                                            <td>{{($val->customer) ? $val->customer->mobile : 'NA'}}</td>
                                            <td>{{($val->customer) ? $val->customer->email : 'NA'}}</td>
                                            <td>
                                                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#booked_room_alert_{{$val->id}}">{{lang_trans('btn_view')}}</button>
                                                @include('backend/model/booked_rooms_alert_modal',['val'=>$val])
                                            </td>
                                            <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td>
                                            <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td>
                                            <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                                            <td>

                                                {{getCurrencySymbol()}}
                                                {{($dueAmount) ? number_format((float)$dueAmount, 2, '.', '') : 0}}
                                            </td>
                                            <td>
                                                @if($val->reservation_type == 1)
                                                    @if($val->cancelled == 1)
                                                        <i class="btn btn-xs btn-danger">{{lang_trans('booking_is_cancelled')}}</i>
                                                    @else
                                                        <a class="btn btn-sm btn-danger" href="{{route('cancel-reservation',[$val->id])}}">{{lang_trans('btn_cancel_booking')}}</a>
                                                        <a class="btn btn-sm btn-info" href="{{route('changeto-checkin-reservation',[$val->id])}}">{{lang_trans('btn_check_in')}}</a>
                                                        <a class="btn btn-sm btn-primary" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                                    @endif
                                                    <a class="btn btn-sm btn-primary" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                                @else
                                                    @if($val->cancelled == 1)
                                                        <i class="btn btn-xs btn-danger">{{lang_trans('reservation_is_cancelled')}}</i>
                                                    @else
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#advance_pay_alert_{{$val->id}}">{{lang_trans('btn_advance_pay')}}</button>
                                                        <a class="btn btn-sm btn-info" href="{{route('advance-slip',[base64_encode($val->id)])}}" target="_blank">{{lang_trans('btn_advance_slip')}}</a>
                                                        <a class="btn btn-sm btn-warning" href="{{route('food-order',[$val->id])}}">{{lang_trans('btn_food_order')}}</a>
                                                        <a class="btn btn-sm btn-primary" href="{{route('view-reservation',[$val->id])}}">{{lang_trans('btn_view')}}</a>
                                                        <a class="btn btn-sm btn-danger" href="{{route('check-out-room',[$val->id])}}">{{lang_trans('btn_checkout')}}</a>
                                                        <a class="btn btn-sm btn-danger" href="{{route('cancel-reservation',[$val->id])}}">{{lang_trans('btn_cancel_reservation')}}</a>


                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#extend_reservation_alert_{{$val->id}}">{{lang_trans('btn_extend_reservation')}}</button>
                                                        {{--                                      <a class="btn btn-sm btn-info" href="{{route('extend-reservation',[$val->id])}}" target="_blank">{{lang_trans('btn_extend_reservation')}}</a>--}}
                                                        @if($dateDiff >= 0)
                                                            <a class="btn btn-sm btn-success" href="{{route('swap-room',[$val->id])}}">{{lang_trans('btn_swap_room')}}</a>
                                                        @endif
                                                        @include('backend/model/extend_reservation_alert_modal',['val'=>$val, 'dueAmount'=>$dueAmount])
                                                        @include('backend/model/advance_pay_alert_modal',['val'=>$val, 'dueAmount'=>$dueAmount])
                                                        {{--<a class="btn btn-sm btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'dup'])}}" target="_blank">{{lang_trans('btn_invoice_room_dup')}}</a>--}}
                                                        {{--<a class="btn btn-sm btn-warning" href="{{route('invoice',[$val->id,2])}}" target="_blank">{{lang_trans('btn_invoice_food')}}</a>--}}
                                                    @endif
                                                    <a class="btn btn-sm btn-primary" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click','.nav_list_tab.active', function(){
        $(this).removeClass('active');
        $('.nav_list_tab').each(function (e) {
            $(this).addClass('pickertab')
        })
        $('#contentdiv_notification').addClass('hide');
    });
    $(document).on('click','.nav_list_tab.pickertab', function(){
        $('#contentdiv_notification').removeClass('hide');
        $('.nav_list_tab').each(function (e) {
            $(this).removeClass('pickertab')
        })
    });
</script>


@endif
