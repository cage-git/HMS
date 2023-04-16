@extends('layouts.master_backend_new')
@section('content')
@php
$i = $j = 0;
$totalAmount = 0;
@endphp
<style>
    .w-100{
        width: 100%;
        margin-top: 1.5%;
        margin-bottom: 1.5%;
    }
    .btn-sm{
      margin-top: 1px;
      margin-bottom: 1px;
      margin:2px;
    }
  .btn-xs{
    margin-top: 1px;
    margin-bottom: 1px;
    margin:2px;
  }

</style>
<div class="">
  @if($list=='check_outs')
   <!-- start new ui of report -->
   <section id="basic-datatable">
    <div class="row">
        <div class=" col-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{lang_trans('txt_checkout_report')}}</h4>
              </div>
              <div class="card-body">
                  {{ Form::model($search_data,array('url'=>route('search-checkouts'),'id'=>"search-checkouts", 'class'=>"form-horizontal form-label-left")) }}
                      <div class="row">  
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="category">{{lang_trans('txt_guest')}}</label>
                              
                                {{Form::text('customer_name',null,['class'=>"form-control", "id"=>"customers", "placeholder"=>lang_trans('txt_fullname')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_from">{{lang_trans('txt_room_type')}}</label>
                              
                                {{Form::select('room_type_id',$roomtypes_list,null,['class'=>"form-select flatpickr-basic",'placeholder'=>lang_trans('ph_select')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_payment_status')}}</label>
                              
                                {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-select flatpickr-basic",'placeholder'=>lang_trans('ph_select')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_date_from')}}</label>
                                {{Form::text('date_from',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_date_from')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_date_to')}}</label>
                                {{Form::text('date_to',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_date_to')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                            <br>
                            <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button>
                            </div>
                        </div>
                       
                      </div>
                  </form>
              </div>
            </div>
        </div>
      </div>
  
   <!-- end new ui of report -->



<!-- 
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2>{{lang_trans('heading_filter_checkouts')}}</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
              {{ Form::model($search_data,array('url'=>route('search-checkouts'),'id'=>"search-checkouts", 'class'=>"form-horizontal form-label-left")) }}
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_guest')}}</label>
                  {{Form::select('customer_id',$customer_list,null,['class'=>"form-control", "placeholder"=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_room_type')}}</label>
                  {{Form::select('room_type_id',$roomtypes_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_payment_status')}}</label>
                  {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_date_from')}}</label>
                  {{Form::text('date_from',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_from')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_date_to')}}</label>
                  {{Form::text('date_to',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_to')])}}
                </div>
                <div class="form-group col-sm-2">
                  <br/>
                   <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                   <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
    </div> -->
  @endif

  @if($list=='bladi')



   <!-- start new ui of report -->
<section id="basic-datatable">
    <div class="row">
        <div class=" col-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{lang_trans('txt_checkout_report')}}</h4>
              </div>
              <div class="card-body">
                  {{ Form::model($search_data,array('url'=>route('search-bladi'),'id'=>"search-bladi", 'class'=>"form-horizontal form-label-left")) }}
                      <div class="row">  
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="category">{{lang_trans('txt_year')}}</label>
                              
                                <select name="report_year"  class="form-select" placeholder="{{lang_trans('ph_select')}}">
                                      
                                    <?php 
                                      foreach($search_data['checkout_years'] as $val)
                                      {
                                          echo '<option value='.$val->year.'>'.$val->year.'</option>';
                                      } ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_from">{{lang_trans('txt_Month')}}</label>
                              
                                <select name="report_month"  class="form-select" placeholder="{{lang_trans('ph_select')}}">
                                  <option value="01">{{lang_trans('txt_Jan')}}</option>
                                  <option value="02">{{lang_trans('txt_Feb')}}</option>
                                  <option value="03">{{lang_trans('txt_Mar')}}</option>
                                  <option value="04">{{lang_trans('txt_Apr')}}</option>
                                  <option value="05">{{lang_trans('txt_May')}}</option>
                                  <option value="06">{{lang_trans('txt_Jun')}}</option>
                                  <option value="07">{{lang_trans('txt_Jul')}}</option>
                                  <option value="08">{{lang_trans('txt_Aug')}}</option>
                                  <option value="09">{{lang_trans('txt_Sep')}}</option>
                                  <option value="10">{{lang_trans('txt_Oct')}}</option>
                                  <option value="11">{{lang_trans('txt_Nov')}}</option>
                                  <option value="12">{{lang_trans('txt_Dec')}}</option>
                                </select>
                            </div>
                        </div>
                        

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                            <br>
                            <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button>
                            </div>
                        </div>
                       
                      </div>
                  </form>
              </div>
            </div>
        </div>
      </div>
</section>
<!--   
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2>{{lang_trans('heading_filter_bladi')}}</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
              {{ Form::model($search_data,array('url'=>route('search-bladi'),'id'=>"search-bladi", 'class'=>"form-horizontal form-label-left")) }}
              <! -- These are the filter of customer, payment and room types  -->
              <!-- <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_guest')}}</label>
                  {{Form::select('customer_id',$customer_list,null,['class'=>"form-control", "placeholder"=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_room_type')}}</label>
                  {{Form::select('room_type_id',$roomtypes_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_payment_status')}}</label>
                  {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                </div> -- >
            
                <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_year')}}</label>
                    <select name="report_year"  class="form-control" placeholder="{{lang_trans('ph_select')}}">
                      
                    <?php 
                      // foreach($search_data['checkout_years'] as $val)
                      // {
                      //     echo '<option value='.$val->year.'>'.$val->year.'</option>';
                      // }
                       ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_Month')}}</label>
                    <select name="report_month"  class="form-control" placeholder="{{lang_trans('ph_select')}}">
                      <option value="01" @if($search_data['report_month'] == '01') selected @endif >{{lang_trans('txt_Jan')}}</option>
                      <option value="02" @if($search_data['report_month'] == '02') selected @endif>{{lang_trans('txt_Feb')}}</option>
                      <option value="03" @if($search_data['report_month'] == '03') selected @endif >{{lang_trans('txt_Mar')}}</option>
                      <option value="04" @if($search_data['report_month'] == '04') selected @endif>{{lang_trans('txt_Apr')}}</option>
                      <option value="05" @if($search_data['report_month'] == '05') selected @endif>{{lang_trans('txt_May')}}</option>
                      <option value="06" @if($search_data['report_month'] == '06') selected @endif>{{lang_trans('txt_Jun')}}</option>
                      <option value="07" @if($search_data['report_month'] == '07') selected @endif>{{lang_trans('txt_Jul')}}</option>
                      <option value="08" @if($search_data['report_month'] == '08') selected @endif>{{lang_trans('txt_Aug')}}</option>
                      <option value="09" @if($search_data['report_month'] == '09') selected @endif>{{lang_trans('txt_Sep')}}</option>
                      <option value="10" @if($search_data['report_month'] == '10') selected @endif>{{lang_trans('txt_Oct')}}</option>
                      <option value="11" @if($search_data['report_month'] == '11') selected @endif>{{lang_trans('txt_Nov')}}</option>
                      <option value="12" @if($search_data['report_month'] == '12') selected @endif>{{lang_trans('txt_Dec')}}</option>
                    </select>
                  </div>
                <div class="form-group col-sm-4">
                  <br/>
                   <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                   <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
    </div> -->
  @endif



  @if($list=='check_ins')

<section>
  <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('heading_checkout_list')}}</h4>
                </div>
                  @php
                    $totalAmount = 0;
                  @endphp
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                          <th>{{lang_trans('txt_sno')}}</th>
                          <th>{{lang_trans('txt_action')}}</th>
                          <th>{{lang_trans('txt_reservation_type')}}</th>
                          <th>{{lang_trans('txt_guest_name')}}</th>
                          <th>{{lang_trans('txt_mobile_num')}}</th>
                          <!-- <th>{{lang_trans('txt_email')}}</th> -->
                          <th>{{lang_trans('txt_room')}}</th>
                          <th>{{lang_trans('txt_checkin')}}</th>
                          <th>{{lang_trans('txt_checkout')}}</th>
                          <th>{{lang_trans('txt_total_amount')}}</th>
                          <th>{{lang_trans('txt_due_amount')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($datalist as $k=>$val)
                              @if($val->is_checkout==0)
                                @php

                                  $dateDiff = dateIfInBetween($val->check_in, $val->check_out);
                                  $calc = calcFinalAmount($val);
                                  $totalAmount = $totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
                                  $i++;
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
                                <td>{{$i}}</td>

                                <td>
                                    <!-- <div class="btn-group"> -->
                                        <!-- <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button> -->
                                        <!-- <div class="dropdown-menu"> -->
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm  dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                              
                                                @if($val->reservation_type == 1)
                                                    @if($val->cancelled == 1)
                                                        <i class="btn btn-xs btn-danger dropdown-item w-100">{{lang_trans('booking_is_cancelled')}}</i>
                                                    @else
                                                        @if($val->reservation_type == 1)
                                                            <a class="btn btn-sm btn-danger dropdown-item w-100" href="{{route('cancel-reservation',[$val->id])}}">
                                                            <i data-feather="trash" class="me-50"></i>  
                                                            <span>{{lang_trans('btn_cancel_booking')}}</span>
                                                            </a>
                                                        @endif
                                                        <a class="btn btn-sm btn-info dropdown-item w-100" href="{{route('changeto-checkin-reservation',[$val->id])}}">{{lang_trans('btn_check_in')}}</a>
                                                    @endif
                                                    <a class="btn btn-sm btn-primary dropdown-item w-100" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                                @else
                                                    @if($val->cancelled == 1)
                                                        <i class="btn btn-xs btn-danger dropdown-item w-100">{{lang_trans('reservation_is_cancelled')}}</i>
                                                    @else
                                                        @if(isPermission('add-housekeeping-order') && $val->booked_rooms->count())
                                                            <a class="btn btn-sm btn-success dropdown-item w-100" href="{{route('add-housekeeping-order',['room_id'=>$val->booked_rooms[0]->room_id, 'reservation_id'=>$val->id])}}" target="_blank">
                                                              <i data-feather='wind'></i> 
                                                              <span>{{lang_trans('sidemenu_housekeeping')}}</span>
                                                            </a>
                                                        @endif
                                                        <button class="btn btn-sm btn-warning dropdown-item w-100" data-toggle="modal" data-target="#advance_pay_{{$val->id}}">
                                                          <i data-feather='dollar-sign'></i>
                                                          <span>{{lang_trans('btn_advance_pay')}}</span>
                                                        </button>
                                                        <a class="btn btn-sm btn-info dropdown-item w-100" href="{{route('advance-slip',[base64_encode($val->id)])}}" target="_blank">
                                                          <i data-feather='file-text'></i>
                                                          <span>{{lang_trans('btn_advance_slip')}}</span>
                                                        </a>
                                                        <a class="btn btn-sm btn-warning dropdown-item w-100" href="{{route('food-order',[$val->id])}}">
                                                          <i data-feather='file-text'></i>
                                                          <span>{{lang_trans('btn_food_order')}}</span>
                                                        </a>
                                                        <a class="btn btn-sm btn-primary dropdown-item w-100" href="{{route('view-reservation',[$val->id])}}">
                                                          <i data-feather='eye'></i>
                                                          <span>{{lang_trans('btn_view')}}</span></a>
                                                        <a class="btn btn-sm btn-danger dropdown-item w-100" href="{{route('check-out-room',[$val->id])}}">
                                                          <i data-feather='dollar-sign'></i>
                                                          <span>{{lang_trans('btn_checkout')}}</span>
                                                        </a>
                                                        @if($val->reservation_type == 1)
                                                            <a class="btn btn-sm btn-danger dropdown-item w-100" href="{{route('cancel-reservation',[$val->id])}}">{{lang_trans('btn_cancel_reservation')}}</a>
                                                        @endif

                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#extend_reservation_{{$val->id}}" >
                                                        <!-- class="btn btn-sm btn-info dropdown-item w-100" 
                                                        data-toggle="modal" data-target="#extend_reservation_{{$val->id}}" -->
                                                        
                                                        {{lang_trans('btn_extend_reservation')}}</button>
                                                        @if($dateDiff)
                                                            <a class="btn btn-sm btn-success dropdown-item w-100" href="{{route('swap-room',[$val->id])}}">
                                                              <i data-feather='arrow-up'></i>
                                                              <span>{{lang_trans('btn_swap_room')}}</span>
                                                            </a>
                                                        @endif
                                                    @endif
                                                    <a class="btn btn-sm btn-primary dropdown-item w-100" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank"><i data-feather='file-text'></i>
                                                          <span>{{lang_trans('btn_invoice_room_org')}}</span></a>
                                                @endif
                                            </div>
                                        </div>

                                            <!-- @if($val->reservation_type == 1)
                                                @if($val->cancelled == 1)
                                                    <i class="btn btn-xs btn-danger dropdown-item w-100">{{lang_trans('booking_is_cancelled')}}</i>
                                                @else
                                                    @if($val->reservation_type == 1)
                                                        <a class="btn btn-sm btn-danger dropdown-item w-100" href="{{route('cancel-reservation',[$val->id])}}">{{lang_trans('btn_cancel_booking')}}</a>
                                                    @endif
                                                    <a class="btn btn-sm btn-info dropdown-item w-100" href="{{route('changeto-checkin-reservation',[$val->id])}}">{{lang_trans('btn_check_in')}}</a>
                                                @endif
                                                <a class="btn btn-sm btn-primary dropdown-item w-100" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                            @else
                                                @if($val->cancelled == 1)
                                                    <i class="btn btn-xs btn-danger dropdown-item w-100">{{lang_trans('reservation_is_cancelled')}}</i>
                                                @else
                                                    @if(isPermission('add-housekeeping-order') && $val->booked_rooms->count())
                                                        <a class="btn btn-sm btn-success dropdown-item w-100" href="{{route('add-housekeeping-order',['room_id'=>$val->booked_rooms[0]->room_id, 'reservation_id'=>$val->id])}}" target="_blank">{{lang_trans('sidemenu_housekeeping')}}</a>
                                                    @endif
                                                    <button class="btn btn-sm btn-warning dropdown-item w-100" data-toggle="modal" data-target="#advance_pay_{{$val->id}}">{{lang_trans('btn_advance_pay')}}</button>
                                                    <a class="btn btn-sm btn-info dropdown-item w-100" href="{{route('advance-slip',[base64_encode($val->id)])}}" target="_blank">{{lang_trans('btn_advance_slip')}}</a>
                                                    <a class="btn btn-sm btn-warning dropdown-item w-100" href="{{route('food-order',[$val->id])}}">{{lang_trans('btn_food_order')}}</a>
                                                    <a class="btn btn-sm btn-primary dropdown-item w-100" href="{{route('view-reservation',[$val->id])}}">{{lang_trans('btn_view')}}</a>
                                                    <a class="btn btn-sm btn-danger dropdown-item w-100" href="{{route('check-out-room',[$val->id])}}">{{lang_trans('btn_checkout')}}</a>
                                                    @if($val->reservation_type == 1)
                                                        <a class="btn btn-sm btn-danger dropdown-item w-100" href="{{route('cancel-reservation',[$val->id])}}">{{lang_trans('btn_cancel_reservation')}}</a>
                                                    @endif

                                                    <button class="btn btn-sm btn-info dropdown-item w-100" data-toggle="modal" data-target="#extend_reservation_{{$val->id}}">{{lang_trans('btn_extend_reservation')}}</button>
                                                    @if($dateDiff)
                                                        <a class="btn btn-sm btn-success dropdown-item w-100" href="{{route('swap-room',[$val->id])}}">{{lang_trans('btn_swap_room')}}</a>
                                                    @endif
                                                @endif
                                                <a class="btn btn-sm btn-primary dropdown-item w-100" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                            @endif -->
                                        <!-- </div> -->
                                    <!-- </div> -->
                                    @if($val->reservation_type != 1 && $val->cancelled != 1)
                                        @include('backend/model/extend_reservation_modal',['val'=>$val, 'dueAmount'=>$dueAmount])
                                        @include('backend/model/advance_pay_modal',['val'=>$val, 'dueAmount'=>$dueAmount])
                                    @endif
                                </td>
                                <td>
                                    @if($val->reservation_type == 1)
                                        Booking
                                    @else
                                        Check-in
                                    @endif
                                </td>
                                <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                                <td>{{($val->customer) ? $val->customer->mobile : 'NA'}}</td>
                                <!-- <td>{{($val->customer) ? $val->customer->email : 'NA'}}</td> -->
                                <td>
                                  <!-- <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#booked_room_{{$val->id}}">{{lang_trans('btn_view')}}</button> -->
                                  <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" id="onshowbtn" data-bs-target="#booked_room_{{$val->id}}">
                                      {{lang_trans('btn_view')}}
                                  </button>
                                  @include('backend/model/booked_rooms_modal',['val'=>$val])
                                </td>
                                <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td>
                                <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td>
                                <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                                <td>

                                    {{getCurrencySymbol()}}
                                    {{($dueAmount) ? number_format((float)$dueAmount, 2, '.', '') : 0}}
                                </td>
                                
                </tr>
                @endif
              @endforeach
                    </tbody>
                </table>

                <table class="table table-striped table-bordered">
                    <tr>
                      <th class="text-right"  width="30%">{{lang_trans('txt_grand_total')}}</th>
                      <th width="20%"><b>{{getCurrencySymbol()}} {{numberFormat($totalAmount)}}</b></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>


    <!-- <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_checkin_list')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_action')}}</th>
                        <th>{{lang_trans('txt_reservation_type')}}</th>
                        <th>{{lang_trans('txt_guest_name')}}</th>
                        <th>{{lang_trans('txt_mobile_num')}}</th>
                        <th>{{lang_trans('txt_email')}}</th>
                        <th>{{lang_trans('txt_room')}}</th>
                        <th>{{lang_trans('txt_checkin')}}</th>
                        <th>{{lang_trans('txt_checkout')}}</th>
                        <th>{{lang_trans('txt_total_amount')}}</th>
                        <th>{{lang_trans('txt_due_amount')}}</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($datalist as $k=>$val)
                        @if($val->is_checkout==0)
                          @php

                            $dateDiff = dateIfInBetween($val->check_in, $val->check_out);
                            $calc = calcFinalAmount($val);
                            $totalAmount = $totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
                            $i++;
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
                          <td>{{$i}}</td>

                          <td>
                              <div class="btn-group">
                                  <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                  </button>
                                  <div class="dropdown-menu">
                                      @if($val->reservation_type == 1)
                                          @if($val->cancelled == 1)
                                              <i class="btn btn-xs btn-danger dropdown-item w-100">{{lang_trans('booking_is_cancelled')}}</i>
                                          @else
                                              @if($val->reservation_type == 1)
                                                  <a class="btn btn-sm btn-danger dropdown-item w-100" href="{{route('cancel-reservation',[$val->id])}}">{{lang_trans('btn_cancel_booking')}}</a>
                                              @endif
                                              <a class="btn btn-sm btn-info dropdown-item w-100" href="{{route('changeto-checkin-reservation',[$val->id])}}">{{lang_trans('btn_check_in')}}</a>
                                          @endif
                                          <a class="btn btn-sm btn-primary dropdown-item w-100" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                      @else
                                          @if($val->cancelled == 1)
                                              <i class="btn btn-xs btn-danger dropdown-item w-100">{{lang_trans('reservation_is_cancelled')}}</i>
                                          @else
                                              @if(isPermission('add-housekeeping-order') && $val->booked_rooms->count())
                                                  <a class="btn btn-sm btn-success dropdown-item w-100" href="{{route('add-housekeeping-order',['room_id'=>$val->booked_rooms[0]->room_id, 'reservation_id'=>$val->id])}}" target="_blank">{{lang_trans('sidemenu_housekeeping')}}</a>
                                              @endif
                                              <button class="btn btn-sm btn-warning dropdown-item w-100" data-toggle="modal" data-target="#advance_pay_{{$val->id}}">{{lang_trans('btn_advance_pay')}}</button>
                                              <a class="btn btn-sm btn-info dropdown-item w-100" href="{{route('advance-slip',[base64_encode($val->id)])}}" target="_blank">{{lang_trans('btn_advance_slip')}}</a>
                                              <a class="btn btn-sm btn-warning dropdown-item w-100" href="{{route('food-order',[$val->id])}}">{{lang_trans('btn_food_order')}}</a>
                                              <a class="btn btn-sm btn-primary dropdown-item w-100" href="{{route('view-reservation',[$val->id])}}">{{lang_trans('btn_view')}}</a>
                                              <a class="btn btn-sm btn-danger dropdown-item w-100" href="{{route('check-out-room',[$val->id])}}">{{lang_trans('btn_checkout')}}</a>
                                              @if($val->reservation_type == 1)
                                                  <a class="btn btn-sm btn-danger dropdown-item w-100" href="{{route('cancel-reservation',[$val->id])}}">{{lang_trans('btn_cancel_reservation')}}</a>
                                              @endif

                                              <button class="btn btn-sm btn-info dropdown-item w-100" data-toggle="modal" data-target="#extend_reservation_{{$val->id}}">{{lang_trans('btn_extend_reservation')}}</button>
                                              @if($dateDiff)
                                                  <a class="btn btn-sm btn-success dropdown-item w-100" href="{{route('swap-room',[$val->id])}}">{{lang_trans('btn_swap_room')}}</a>
                                              @endif
                                          @endif
                                          <a class="btn btn-sm btn-primary dropdown-item w-100" href="{{route('invoice',[$val->id,1,'inv_type'=>($val->cancelled == 1) ? 'cnl' : 'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                      @endif
                                  </div>
                              </div>
                              @if($val->reservation_type != 1 && $val->cancelled != 1)
                                  @include('backend/model/extend_reservation_modal',['val'=>$val, 'dueAmount'=>$dueAmount])
                                  @include('backend/model/advance_pay_modal',['val'=>$val, 'dueAmount'=>$dueAmount])
                              @endif

            </td>

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
                            <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#booked_room_{{$val->id}}">{{lang_trans('btn_view')}}</button>
                            @include('backend/model/booked_rooms_modal',['val'=>$val])
                          </td>
                          <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td>
                          <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td>
                          <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                          <td>

                              {{getCurrencySymbol()}}
                              {{($dueAmount) ? number_format((float)$dueAmount, 2, '.', '') : 0}}
                          </td>
                          
          </tr>
          @endif
        @endforeach
      </tbody>
    </table>
    <table class="table table-striped table-bordered">
        <tr>
          <th class="text-right" width="70%">{{lang_trans('txt_grand_total')}}</th>
          <th width="30%"><b>{{getCurrencySymbol()}} {{numberFormat($totalAmount)}}</b></th>
        </tr>
    </table>
  </div>
</div>
</div>
    </div> -->

@elseif($list=='check_outs')



<div class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('heading_checkout_list')}}</h4>
                </div>
                  @php
                    $totalAmount = 0;
                  @endphp
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_guest_name')}}</th>
                        <th>{{lang_trans('txt_mobile_num')}}</th>
                        <!-- <th>{{lang_trans('txt_email')}}</th> -->
                        <th>{{lang_trans('txt_room')}}</th>
                        <th>{{lang_trans('txt_payment_status')}}</th>
                        <th>{{lang_trans('txt_checkin')}}</th>
                        <th>{{lang_trans('txt_checkout')}}</th>
                        <th>{{lang_trans('txt_total_amount')}}</th>
                        <th>{{lang_trans('txt_action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datalist as $k=>$val)
                      @if($val->is_checkout == 1)
                      @php
                        $calc = calcFinalAmount($val);
                        $totalAmount = $totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
                        $j++;
                                    @endphp
                                    <tr>
                                      <td>{{$j}}</td>
                                      <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                                      <td>{{($val->customer) ? $val->customer->mobile : 'NA'}}</td>
                                      <!-- <td>{{($val->customer) ? $val->customer->email : 'NA'}}</td> -->
                                      <td>
                                        <!-- <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#booked_room_{{$val->id}}">{{lang_trans('btn_view')}}</button> -->
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" id="onshowbtn" data-bs-target="#booked_room_{{$val->id}}">
                                            {{lang_trans('btn_view')}}
                                        </button>
                                        @include('backend/model/booked_rooms_modal',['val'=>$val])
                                        
                                        <!-- <div class="modal fade text-start" id="onshow" tabindex="-1" aria-labelledby="myModalLabel21" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel21">Basic Modal</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Donut chocolate halvah I love caramels. Dessert croissant I love icing I love dragée candy canes
                                                        chocolate bar. Oat cake lollipop I love cake chocolate bar jelly sweet. I love cotton candy oat
                                                        cake jelly.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Accept</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                      </td>
                                      <td class="text-center {{($val->payment_status == 1) ? 'text-success' : 'text-danger'}}">
                                        {{config('constants.PAYMENT_STATUS')[$val->payment_status]}}
                                        @if($val->payment_status == 0)
                                          <button type="button" class="btn btn-xs btn-success confirm_btn" data-url="{{route('mark-as-paid',[$val->id])}}">{{lang_trans('btn_mark_as_paid')}}</button>
                                        @endif
                                      </td>
                                      <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td>
                                      <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td>
                                      <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                                      <td>
                                        <a class="btn btn-sm btn-success" href="{{route('view-reservation',[$val->id])}}">{{lang_trans('btn_view')}}</a>
                                        <a class="btn btn-sm btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                                        <a class="btn btn-sm btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'dup'])}}" target="_blank">{{lang_trans('btn_invoice_room_dup')}}</a>
                                        <a class="btn btn-sm btn-warning" href="{{route('invoice',[$val->id,2])}}" target="_blank">{{lang_trans('btn_invoice_food')}}</a>
                                      </td>
                                    </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</section>
<!-- 
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
      <h2>{{lang_trans('heading_checkout_list')}}</h2>
      <div class="clearfix"></div>
  </div>
  <div class="x_content">
      <br/>
      <table id="datatable" class="table table-striped table-bordered data-table">
      <thead>
        <tr>
          <th>{{lang_trans('txt_sno')}}</th>
          <th>{{lang_trans('txt_guest_name')}}</th>
          <th>{{lang_trans('txt_mobile_num')}}</th>
          <th>{{lang_trans('txt_email')}}</th>
          <th>{{lang_trans('txt_room')}}</th>
          <th>{{lang_trans('txt_payment_status')}}</th>
          <th>{{lang_trans('txt_checkin')}}</th>
          <th>{{lang_trans('txt_checkout')}}</th>
          <th>{{lang_trans('txt_total_amount')}}</th>
          <th>{{lang_trans('txt_action')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($datalist as $k=>$val)
          @if($val->is_checkout == 1)
          @php
            $calc = calcFinalAmount($val);
            $totalAmount = $totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
            $j++;
                        @endphp
                        <tr>
                          <td>{{$j}}</td>
                          <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->mobile : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->email : 'NA'}}</td>
                          <td>
                            <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#booked_room_{{$val->id}}">{{lang_trans('btn_view')}}</button>
                            @include('backend/model/booked_rooms_modal',['val'=>$val])
                          </td>
                          <td class="text-center {{($val->payment_status == 1) ? 'text-success' : 'text-danger'}}">
                            {{config('constants.PAYMENT_STATUS')[$val->payment_status]}}
                            @if($val->payment_status == 0)
                              <button type="button" class="btn btn-xs btn-success confirm_btn" data-url="{{route('mark-as-paid',[$val->id])}}">{{lang_trans('btn_mark_as_paid')}}</button>
                            @endif
                          </td>
                          <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td>
                          <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td>
                          <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                          <td>
                            <a class="btn btn-sm btn-success" href="{{route('view-reservation',[$val->id])}}">{{lang_trans('btn_view')}}</a>
                            <a class="btn btn-sm btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                            <a class="btn btn-sm btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'dup'])}}" target="_blank">{{lang_trans('btn_invoice_room_dup')}}</a>
                            <a class="btn btn-sm btn-warning" href="{{route('invoice',[$val->id,2])}}" target="_blank">{{lang_trans('btn_invoice_food')}}</a>
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                  <table class="table table-striped table-bordered">
                      <tr>
                        <th class="text-right" width="70%">{{lang_trans('txt_grand_total')}}</th>
                        <th width="30%"><b>{{getCurrencySymbol()}} {{numberFormat($totalAmount)}}</b></th>
                      </tr>
                  </table>
                </div>
            </div>
        </div>
    </div>
 -->

@elseif($list=='bladi')

<div class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('heading_bladi_list')}}</h4>
                </div>
                  @php
                    $totalAmount = 0;
                  @endphp
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_room')}}</th>
                        <th>{{lang_trans('txt_guest_name')}}</th>
                        <th>{{lang_trans('txt_booking')}}</th>
                        <th>{{lang_trans('txt_checkin')}}</th>
                        <th>{{lang_trans('txt_checkout')}}</th>
                        <th>{{lang_trans('txt_room_amount')}}</th>
                        <th>{{lang_trans('txt_room_type')}}</th>
                        <th>{{lang_trans('txt_remark')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datalist as $k=>$val)
                      <?php 
                      $flag = true;
                      $checkin_datetime;
                      $checkout_datetime;  
                        if($val->duration_of_stay > 1 ){
                            $flag = true;
                            if(($report_month != date('m', strtotime($val->check_out))) && ($report_month == date('m', strtotime($val->check_in)))){
                                $sdate = $val->check_in;
                                $edate = $report_year.'-'.$report_month.'-'.$days;
                                $checkout_datetime = date('d-m-Y', strtotime($edate));
                                $checkin_datetime = date('d-m-Y', strtotime($sdate));
                              }else if(($report_month != date('m', strtotime($val->check_in))) && ($report_month == date('m', strtotime($val->check_out)))){          
                                $sdate = $report_year.'-'.$report_month.'-01';
                                $edate = $val->check_out;
                                $checkin_datetime = date('d-m-Y', strtotime($sdate));
                                $checkout_datetime = date('d-m-Y', strtotime($edate));
                              }else if(($report_month != date('m', strtotime($val->check_in))) && ($report_month != date('m', strtotime($val->check_out)))){
                                $checkin_datetime = date('d-m-Y', strtotime($report_year.'-'.$report_month.'-01'));
                                $checkout_datetime = date('d-m-Y', strtotime($report_year.'-'.$report_month.'-'.$days));
                                $total_days = $days;
                              }else{
                                $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                                $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                                $total_days = $val->duration_of_stay; 
                              }
                        }else{
                          if((date('m', strtotime($val->check_in)) != date('m', strtotime($val->check_out)))){
                            if(date('m', strtotime($val->check_in)) == $report_month){
                              $flag = false;
                            }else if(date('m', strtotime($val->check_out)) == $report_month){
                              $flag = true;
                              $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                              $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                            }
                          }else{
                            $flag = true;
                            $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                            $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                            $total_days = $val->duration_of_stay; 
                          }
                        }
                      ?>
          @if($val->is_checkout == 1)
            @if( $flag == true)
            @foreach($val->booked_rooms as $k=>$value)
             <?php   $j++;
                  $roomData = getRoomById($value->room_id);
                  $roomTypeData = getRoomTypeById($value->room_type_id);
              ?>
                        <tr>
                          <td>{{$j}}</td>
                          <td>{{($value->room_id) ? $roomData->room_no : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                          <td>{{($val) ? $val->id : 'NA'}}</td>
                          <!-- <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td> -->
                          <!-- <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td> -->
                          <td>{{$checkin_datetime}}</td>
                          <td>{{$checkout_datetime}}</td>
                          <td>{{($value->room_price) ? numberFormat(($value->room_price + $value->room_cgst + $value->room_gst) ) : 'NA'}}</td>
                          <td>{{($value->room_type_id)  ? $roomTypeData->title : 'NA'}}</td>
                          <td>{{($val) ? $val->remark : 'NA'}}</td>
                        </tr>
                        @endforeach
                        @endif
                        @endif
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</section>

<!-- 
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
      <h2>{{lang_trans('heading_bladi_list')}}</h2>
      <div class="clearfix"></div>
  </div>
  <div class="x_content">
      <br/>
      <table id="datatable" class="table table-striped table-bordered data-table">
      <thead>
        <tr>
          <th>{{lang_trans('txt_sno')}}</th>
          <th>{{lang_trans('txt_room')}}</th>
          <th>{{lang_trans('txt_guest_name')}}</th>
          <th>{{lang_trans('txt_booking')}}</th>
          <th>{{lang_trans('txt_checkin')}}</th>
          <th>{{lang_trans('txt_checkout')}}</th>
          <th>{{lang_trans('txt_room_amount')}}</th>
          <th>{{lang_trans('txt_room_type')}}</th>
          <th>{{lang_trans('txt_remark')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($datalist as $k=>$val)
                      <?php 
                      // $flag = true;
                      // $checkin_datetime;
                      // $checkout_datetime;  
                      //   if($val->duration_of_stay > 1 ){
                      //       $flag = true;
                      //       if(($report_month != date('m', strtotime($val->check_out))) && ($report_month == date('m', strtotime($val->check_in)))){
                      //           $sdate = $val->check_in;
                      //           $edate = $report_year.'-'.$report_month.'-'.$days;
                      //           $checkout_datetime = date('d-m-Y', strtotime($edate));
                      //           $checkin_datetime = date('d-m-Y', strtotime($sdate));
                      //         }else if(($report_month != date('m', strtotime($val->check_in))) && ($report_month == date('m', strtotime($val->check_out)))){          
                      //           $sdate = $report_year.'-'.$report_month.'-01';
                      //           $edate = $val->check_out;
                      //           $checkin_datetime = date('d-m-Y', strtotime($sdate));
                      //           $checkout_datetime = date('d-m-Y', strtotime($edate));
                      //         }else if(($report_month != date('m', strtotime($val->check_in))) && ($report_month != date('m', strtotime($val->check_out)))){
                      //           $checkin_datetime = date('d-m-Y', strtotime($report_year.'-'.$report_month.'-01'));
                      //           $checkout_datetime = date('d-m-Y', strtotime($report_year.'-'.$report_month.'-'.$days));
                      //           $total_days = $days;
                      //         }else{
                      //           $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                      //           $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                      //           $total_days = $val->duration_of_stay; 
                      //         }
                      //   }else{
                      //     if((date('m', strtotime($val->check_in)) != date('m', strtotime($val->check_out)))){
                      //       if(date('m', strtotime($val->check_in)) == $report_month){
                      //         $flag = false;
                      //       }else if(date('m', strtotime($val->check_out)) == $report_month){
                      //         $flag = true;
                      //         $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                      //         $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                      //       }
                      //     }else{
                      //       $flag = true;
                      //       $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                      //       $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                      //       $total_days = $val->duration_of_stay; 
                      //     }
                      //   }
                      ?>
          @if($val->is_checkout == 1)
            @if( $flag == true)
            @foreach($val->booked_rooms as $k=>$value)
             <?php   
            //  $j++;
            //       $roomData = getRoomById($value->room_id);
            //       $roomTypeData = getRoomTypeById($value->room_type_id);
              ?>
                        <tr>
                          <td>{{$j}}</td>
                          <td>{{($value->room_id) ? $roomData->room_no : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                          <td>{{($val) ? $val->id : 'NA'}}</td>
                          < !-- <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td> -- >
                          < !-- <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td> -- >
                          <td>{{$checkin_datetime}}</td>
                          <td>{{$checkout_datetime}}</td>
                          <td>{{($value->room_price) ? numberFormat(($value->room_price + $value->room_cgst + $value->room_gst) ) : 'NA'}}</td>
                          <td>{{($value->room_type_id)  ? $roomTypeData->title : 'NA'}}</td>
                          <td>{{($val) ? $val->remark : 'NA'}}</td>
                        </tr>
                        @endforeach
                        @endif
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div> -->
  @endif
</div>
<script>
    globalVar.customerList = {!! json_encode($customer_list) !!};
</script>
@endsection
@section('scripts')
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/components/components-modals.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
@endsection
