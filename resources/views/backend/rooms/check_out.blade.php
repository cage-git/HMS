@extends('layouts.master_backend_new')
@section('content')
@php
  use Carbon\Carbon;
  $userRole = Auth::user()->role_id;
  $settings = getSettings();

  $calculatedAmount = calcFinalAmount($data_row, 1,true,true);
  $gstPerc = $calculatedAmount['totalRoomGstPerc'];
  $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
  $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
  $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
  $roomAmountWithCGstAmount = $calculatedAmount['totalRoomAmountWithCGstAmount'];
  $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
  $advancePayment = $calculatedAmount['advancePayment'];
  $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
  $finalRoomAmount = $calculatedAmount['finalRoomAmount'];
  $grandRoomAmount = $calculatedAmount['grandRoomTotal'];

  $gstPercFood = $calculatedAmount['totalOrderGstPerc'];
  $cgstPercFood = $calculatedAmount['totalOrderCGstPerc'];
  $foodAmountGst = $calculatedAmount['totalOrderAmountGst'];
  $foodAmountCGst = $calculatedAmount['totalOrderAmountCGst'];
  $foodOrderAmountDiscount = $calculatedAmount['totalOrderAmountDiscount'];
  $gstFoodApply = $calculatedAmount['gstFoodApply'];
  $totalOrdersAmount = $calculatedAmount['subtotalOrderAmount'];
  $finalOrderAmount = $calculatedAmount['finalOrderAmount'];
  $additionalOrderAmount = $calculatedAmount['additionalOrderAmount'];
  $additionalOrderAmountReason = $data_row->orders_info!= null ? $data_row->orders_info->additional_order_amount_reason:'';

  $additionalAmount = $calculatedAmount['additionalAmount'];
  $additionalAmountReason = $data_row->additional_amount_reason;

  $finalAmount = $finalRoomAmount+$finalOrderAmount+$additionalAmount;
    $dateOfBirth = Carbon::parse($data_row->customer->dob);
    $age = $dateOfBirth->age;
    $discount_lang= getSettings('site_language') == 'ar'? config('constants.DISCOUNT_TYPES_AR'): config('constants.DISCOUNT_TYPES');
@endphp

<style>
 .remove_padding{
  padding-left: 0px;
  padding-right: 0px;
 }

.child_table_left_col{
    float: right;
    width: 30%;
  }

  .child_table_right_col{
    width: 15%;
  }

  .overflow_text{
    overflow-x: hidden;
    overflow-y: scroll;
  }

  @media screen and (max-width: 410px) {
    /* .table.child > :not(caption) > * > * {
      padding: 0rem 0rem !important;
    } */
    .child_table_left_col{
      float:left;
      width: 50%;
    }

    .child_table_right_col{
      float:right;
      width: 50%;
    }

    .spacing{
      border-top: 60px solid transparent;
    }
/* 
    .remove_padding{
      padding:5px 0px !important;
    } */
  }

</style>
<div class="col-md-12 col-12">
              <div class="card">
                  <!-- <div class="card-header">
                      <h4 class="card-title"> {{lang_trans('heading_guest_type')}}</h4>
                  </div> -->
                  <div class="card-body">
                  {{ Form::model($data_row,array('url'=>route('check-out'),'id'=>"check-out-form", 'class'=>"form-horizontal form-label-left",'files'=>true,'autocomplete'=>"off")) }}
                    {{Form::hidden('id',null)}}
                              
                    <div class="card">
                          <div class="card-header px-0">
                              <h4 class="card-title mb-50">{{lang_trans('heading_guest_info')}}</h4>
                          </div>
                          <!-- <hr/> -->
                          <div class="card-body px-0">
                              <div class="row">
                                  <div class="col-xl-7 col-12">
                                      <dl class="row mb-0">
                                          <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_fullname')}}:</dt>
                                          <dd class="col-sm-8 mb-1">{{$data_row->customer->name}}</dd>

                                          <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_email')}}:</dt>
                                          <dd class="col-sm-8 mb-1">{{$data_row->customer->email}}</dd>

                                          <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_gender')}}:</dt>
                                          <dd class="col-sm-8 mb-1">{{$data_row->customer->gender}}</dd>

                                        

                                          <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_address')}}:</dt>
                                          <dd class="col-sm-8 mb-1">{{$data_row->customer->address}}, {{$data_row->customer->city}}, {{$data_row->customer->state}}, {{$data_row->customer->country}}</dd>
                                      </dl>
                                  </div>
                                  <div class="col-xl-5 col-12">
                                      <dl class="row mb-0">

                                          <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_father_name')}}:</dt>
                                          <dd class="col-sm-8 mb-1">{{$data_row->customer->father_name}}</dd>

                                          <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_mobile_num')}}:</dt>
                                          <dd class="col-sm-8 mb-1">{{$data_row->customer->mobile}}</dd>

                                          <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_age')}}:</dt>
                                          <dd class="col-sm-8 mb-1">{{ $age }} {{lang_trans('txt_years')}}</dd>
                                      </dl>
                                  </div>
                              </div>
                          </div>
                      </div>

                        <hr />
                    

                        <div class="row">
                                <h4 class="card-title"> {{lang_trans('heading_checkin_info')}}</h4>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_checkin')}}</label>
                                        <!-- {{Form::text('check_in_date',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"check_in_date", "placeholder"=>lang_trans('ph_date'),'readonly'=>true,'disabled'=>true])}} -->
                                        {{Form::text('check_in_date',$data_row->check_in,['class'=>"form-control col-md-6 col-xs-12", "id"=>"check_in_date", "placeholder"=>lang_trans('ph_date'),'readonly'=>true,'disabled'=>true])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_checkout')}}</label>
                                        {{Form::text('check_out_date', addSubDate('+', $data_row->duration_of_stay, $data_row->check_in, 'Y-m-d H:i:s') ,['class'=>"form-control col-md-6 col-xs-12 flatpickr-basic", "id"=>"check_out_date", "placeholder"=>lang_trans('ph_date'),'required'=>true,'autocomplete'=>false, "readonly"=>true])}}
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_duration_of_stay')}}</label>
                                        {{Form::number('duration_of_stay',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"duration_of_stay", "placeholder"=>lang_trans('ph_day_night'),"min"=>1,'required'=>true, 'readonly'=>true])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_remark_amount')}}</label>
                                        {{Form::number('remark_amount',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"Remark Amount","placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_remark_amount'),"min"=>0])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_remark')}}</label>
                                        {{Form::textarea('remark',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"remark", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_remark'),"rows"=>1])}}
                                    </div>
                                </div>


                        </div>

                      
                        <hr />


                        <div class="row">
                                <h4 class="card-title"> {{lang_trans('heading_idcard_info')}}</h4>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                      
                                        <label class="form-label">{{lang_trans('txt_type_id')}}</label>
                                        {{ Form::select('idcard_type',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-select col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_id_number')}}</label>
                                        {{Form::text('idcard_no',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_id_number')])}}
                                    </div>
                                </div>
                                
                                <!-- <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_duration_of_stay')}}</label>
                                        {{Form::number('duration_of_stay',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"duration_of_stay", "placeholder"=>lang_trans('ph_day_night'),"min"=>1,'required'=>true, 'readonly'=>true])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_remark_amount')}}</label>
                                        {{Form::number('remark_amount',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"Remark Amount","placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark_amount'),"min"=>0])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_remark')}}</label>
                                        {{Form::textarea('remark',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"remark", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark'),"rows"=>1])}}
                                    </div>
                                </div> -->


                        </div>

                      
                        <hr />

                        <section id="basic-datatable">
                            <div class="row">
                                <div class=" col-12">
                                    <div class="card">
                                        <div class="card-header px-0 border-bottom">
                                            <h4 class="card-title">{{lang_trans('heading_payment_info')}}</h4>
                                        </div>
                                        <table class="datatables-basic table">
                                          <tr>
                                            <th class="px-0">{{lang_trans('txt_payment_mode')}}</th>
                                            <td>{{ ($data_row->payment_mode>0) ? config('constants.PAYMENT_MODES')[$data_row->payment_mode] : 'NA' }}</td>
                                          </tr>
                                        </table>
                                    

                                        <table class="datatables-basic table table-responsive dataTable">
                                          <thead>
                                            <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                                            <th class="text-center" width="20%">{{lang_trans('txt_room')}}</th>
                                            <th class="text-center" width="5%">{{lang_trans('txt_duration_of_stay')}}</th>
                                            <th class="text-center" width="5%">{{lang_trans('txt_base_price')}}</th>
                                            <th class="text-center" width="10%">{{lang_trans('txt_total_amount')}}</th>
                                          </thead>
                                          <tbody>
                                              @if($data_row->booked_rooms)
                                                @foreach($data_row->booked_rooms as $key=>$roomInfo)
                                                  @php
                                                    $checkIn = dateConvert($roomInfo->check_in, 'Y-m-d');
                                                    $checkOut = dateConvert($roomInfo->check_out, 'Y-m-d');
                                                    $durOfStayPerRoom = dateDiff($checkIn, $checkOut, 'days');
                                                    $amountPerRoom = ($durOfStayPerRoom * $roomInfo->room_price);
                                                    //$totalRoomAmount = $totalRoomAmount+$amountPerRoom;
                                                  @endphp
                                                  <tr class="per_room_tr">
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td>
                                                        {{ ($roomInfo->room_type) ? $roomInfo->room_type->title : ""}}<br/>
                                                        ({{lang_trans('txt_room_num')}} : {{$roomInfo->room->room_no}})
                                                    </td>
                                                    <th class="text-center">
                                                      <span class="duration_of_per_room {{ ($roomInfo->swapped_from_room) ? 'swapped_room' : 'no_swapped_room'}}">{{$durOfStayPerRoom}}</span>
                                                    </th>
                                                    <td>
                                                      {{getCurrencySymbol()}} {{$roomInfo->room_price}}
                                                    </td>
                                                    <td class="text-right">{{getCurrencySymbol()}} {{ $amountPerRoom }}</td>
                                                  </tr>
                                                @endforeach
                                              @endif
                                          </tbody>
                                        </table>
                                  
                                        <table class="table">
                                                    <tr>
                                                      <th class="text-right child_table_left_col">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[total_room_amount]',$totalRoomAmount,['id'=>'total_room_amount'])}}</th>
                                                      <td class="text-right td_total_room_amount child_table_right_col">{{getCurrencySymbol()}} {{ $totalRoomAmount }}</td>
                                                    </tr>
                                                      <tr>
                                                          <th class="text-right child_table_left_col">{{lang_trans('txt_discount')}}</th>
                                                          <td id="td_advance_amount" class="text-right child_table_right_col">
                                                              <div class="row" style="height:20px;">
                                                                  <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0 remove_padding">
                                                                      {{Form::number('discount_amount',$roomAmountDiscount,['class'=>"form-control", 'style'=>"padding:0.3rem 1rem", "id"=>"discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                                                  </div>
                                                                  <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0 remove_padding">
                                                                      {{ Form::select('room_discount_in',$discount_lang,'amt',['class'=>'form-control', 'style'=>"padding:0.3rem 1rem", "id"=>"room_discount_in"]) }}
                                                                  </div>
                                                              </div>
                                                              <span class="error discount_room_err_msg"></span>
                                                          </td>
                                                      </tr>
                                                  
                                                    <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                                        <th class="text-right child_table_left_col spacing"> {{lang_trans('txt_cgst')}} ({{$cgstPerc}}%) {{Form::hidden('amount[total_room_amount_cgst]',$roomAmountCGst,['id'=>'total_room_amount_cgst'])}}
                                                        {{Form::hidden('amount[org_room_amount_cgst]',$roomAmountCGst,['id'=>'org_room_amount_cgst'])}}
                                                        </th>
                                                        <td id="td_total_room_amount_cgst" class="text-right child_table_right_col spacing">{{getCurrencySymbol()}} {{ $roomAmountCGst }}</td>
                                                      </tr>
                                                      <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                                        <th class="text-right child_table_left_col">{{lang_trans('txt_total_cgst')}}  {{Form::hidden('amount[total_room_amount_with_cgst]',null,['id'=>'total_room_amount_with_cgst'])}}</th>
                                                        <td id="td_total_room_amount_with_cgst" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ $roomAmountWithCGstAmount }}</td>
                                                      </tr>
                                                      <tr>
                                                        <th class="text-right child_table_left_col">{{lang_trans('txt_sgst')}} ({{$gstPerc}}%) {{Form::hidden('amount[total_room_amount_gst]',$roomAmountGst,['id'=>'total_room_amount_gst'])}}
                                                        {{Form::hidden('amount[org_room_amount_gst]',$roomAmountGst,['id'=>'org_room_amount_with_cgst'])}}
                                                        </th>
                                                        <td id="td_total_room_amount_gst" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ $roomAmountGst }}</td>
                                                      </tr>

                                                    <tr>
                                                      <th   class="text-right child_table_left_col" >{{lang_trans('txt_advance_amount')}} {{Form::hidden('amount[total_room_advance_amount]',$advancePayment)}}</th>
                                                      <td id="td_room_advance_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ $advancePayment }}</td>
                                                    </tr>

                                                    <tr class="">
                                                      <th class="text-right child_table_left_col">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[total_room_final_amount]',$finalRoomAmount,['id'=>'total_room_final_amount'])}}</th>
                                                      <td id="td_room_final_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ $finalRoomAmount }}</td>
                                                    </tr>
                                                </table>
                                                
                                                <table class="table ">
                                                    <tr class="bg-default">
                                                      <th class="text-right child_table_left_col">
                                                          @if(env('APP_NT_ENABLE'))
                                                              <label class="control-label"> &nbsp;</label>
                                                          @endif
                                                        {{Form::text('amount[additional_order_amount_reason]',$additionalOrderAmountReason,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_order_amount_reason", "placeholder"=>lang_trans('txt_additional_amount_reason')])}}
                                                      </th>
                                                        @if(env('APP_NT_ENABLE'))
                                                      <th class="">
                                                          <label class="control-label"> {{lang_trans('ministory_of_tourism_section')}} <span class="required">*</span></label>
                                                          {{ Form::select('mt_expence_type_id_additional',getDynamicDropdownList('expence_type_id', true),null,['class'=>'form-control col-md-6 col-xs-12', 'required'=>'required']) }}
                                                      </th>
                                                        @endif
                                                      <td id="td_additional_amount" class="text-right child_table_right_col">
                                                          @if(env('APP_NT_ENABLE'))
                                                              <label class="control-label"> &nbsp;</label>
                                                          @endif
                                                        {{Form::number('amount[additional_order_amount]',$additionalOrderAmount,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_order_amount", "placeholder"=>lang_trans('txt_additional_amount'),"min"=>0])}}
                                                      </td>
                                                    </tr>
                                                </table>

                                                <!-- <table class="table ">
                                                    <tr>
                                                      <th class="child_table_left_col remove_padding">{{lang_trans('txt_grand_food_total')}} {{Form::hidden('amount[total_food_final_amount]',null,['id'=>'total_food_final_amount'])}}</th>
                                                      <td id="td_total_food_final_amount" class="text-right child_table_right_col remove_padding">{{getCurrencySymbol()}} {{ $finalOrderAmount }}</td>
                                                    </tr>
                                                </table> -->

                                                <!-- <table class="table ">
                                                    <tr class="">
                                                      <th class="text-right bg-default child_table_left_col remove_padding" >
                                                        {{ ($additionalAmountReason) ? $additionalAmountReason : lang_trans('txt_additional_amount_reason') }}
                                                      </th>
                                                      <td class="text-right child_table_right_col remove_padding">
                                                        {{getCurrencySymbol()}} {{ numberFormat($additionalAmount) }}
                                                      </td>
                                                    </tr>
                                                    <td id="td_additional_amount" class="text-right child_table_right_col">
                                                      @if(env('APP_NT_ENABLE'))
                                                          <label class="control-label"> &nbsp;</label>
                                                      @endif
                                                    {{Form::number('additional_amount',$additionalAmount,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_amount", "placeholder"=>lang_trans('txt_additional_amount'),"min"=>0])}}
                                                  </td>
                                                </table> -->
                                                <hr/>
                                        <div class="card-header px-0 border-bottom">
                                            <h4 class="card-title">{{lang_trans('txt_food_orders')}}</h4>
                                        </div>
                                        @if($data_row->orders_items->isEmpty())
                                            <p class="py-1 m-0">No food items are ordered.</p>
                                        @else
                                            <table class="datatables-basic table table-responsive dataTable">
                                              <thead>
                                                  <th width="2%">{{lang_trans('txt_sno')}}.</th>
                                                  <th width="20%">{{lang_trans('txt_item_details')}}</th>
                                                  <th width="5%">{{lang_trans('txt_date')}}</th>
                                                  <th width="5%">{{lang_trans('txt_item_qty')}}</th>
                                                  <th width="5%">{{lang_trans('txt_item_price')}}</th>
                                                  <th width="10%">{{lang_trans('txt_total_amount')}}</th>
                                              </thead>
                                              <tbody>
                                                @forelse($data_row->orders_items as $k=>$val)
                                                  <tr>
                                                    <td>{{$k+1}}</td>
                                                    <td>{{$val->item_name}}</td>
                                                    <td>{{dateConvert($val->created_at,'d-m-Y')}}</td>
                                                    <td>{{$val->item_qty}}</td>
                                                    <td>{{getCurrencySymbol()}} {{$val->item_price}}</td>
                                                    <td>{{getCurrencySymbol()}} {{$val->item_qty*$val->item_price}}</td>
                                                  </tr>
                                                @empty
                                                  <tr>
                                                    <td colspan="6">{{lang_trans('txt_no_orders')}}</td>
                                                  </tr>
                                                @endforelse
                                              </tbody>
                                            </table>

                                            <table class="table ">
                                              <tr>
                                                <!-- <th class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[order_amount]',$totalOrdersAmount,['id'=>'total_order_amount'])}}</th>
                                                <td width="15%" id="td_total_order_amount" class="text-right">{{getCurrencySymbol()}} {{ $totalOrdersAmount }}</td> -->


                                              </tr>
                                              <tr>
                                                  <th class="text-right child_table_left_col">{{lang_trans('txt_discount')}}</th>
                                                  <td id="td_advance_amount" class="text-right child_table_right_col">
                                                      <!-- <div class="col-md-12 col-sm-12 col-xs-12 p-left-0 p-right-0"> -->
                                                      <div class="row" style="height:20px;">
                                                          <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0 remove_padding" >
                                                              {{Form::number('discount_order_amount',$foodOrderAmountDiscount,['class'=>"form-control col-md-7 col-xs-12", 'style'=>"padding:0.3rem 1rem", "id"=>"order_discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                                          </div>
                                                          <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0 remove_padding">
                                                              {{ Form::select('order_discount_in',config('constants.DISCOUNT_TYPES'),'amt',['class'=>'form-control', 'style'=>"padding:0.3rem 1rem", "id"=>"order_discount_in"]) }}
                                                          </div>
                                                      </div>
                                                      <span class="error discount_order_err_msg"></span>
                                                  </td>
                                              </tr>
                                                    
                                              <tr>
                                              <th class="text-right child_table_left_col spacing">{{lang_trans('txt_sgst')}} ({{$gstPercFood}}%) {{Form::hidden('amount[order_amount_gst]',$foodAmountGst,['id'=>'total_order_amount_gst'])}}</th>
                                                <td id="td_order_amount_gst" class="text-right child_table_right_col spacing">{{getCurrencySymbol()}} {{$foodAmountGst}}</td>

                                              </tr>
                                      
                                              <tr class="{{$cgstPercFood > 0 ? '' : 'hide_elem'}}">
                                                <th   class="text-right child_table_left_col">{{lang_trans('txt_cgst')}} ({{$cgstPercFood}}%) {{Form::hidden('amount[order_amount_cgst]',$foodAmountCGst,['id'=>'total_order_amount_cgst'])}}</th>
                                                <td id="td_order_amount_cgst" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{$foodAmountCGst}}</td>
                                              </tr>
                                            
                                              <tr class="">
                                                <th  class="text-right child_table_left_col">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[order_final_amount]',null,['id'=>'total_order_final_amount'])}}</th>
                                                <td id="td_order_final_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ $finalOrderAmount }}</td>
                                                <!-- <th class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[order_final_amount]',null,['id'=>'total_order_final_amount'])}}</th>
                                                <td width="15%" id="td_order_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalOrderAmount }}</td> -->
                                              </tr>
                                            </table>
                                            <table class="table ">
                                                <tr class="bg-default">
                                                  <th class="text-right child_table_left_col">
                                                      @if(env('APP_NT_ENABLE'))
                                                          <label class="control-label"> &nbsp;</label>
                                                      @endif
                                                    {{Form::text('amount[additional_order_amount_reason]',$additionalOrderAmountReason,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_order_amount_reason", "placeholder"=>lang_trans('txt_additional_amount_reason')])}}
                                                  </th>
                                                    @if(env('APP_NT_ENABLE'))
                                                  <th class="child_table_left_col">
                                                      <label class="control-label"> {{lang_trans('ministory_of_tourism_section')}} <span class="required">*</span></label>
                                                      {{ Form::select('mt_expence_type_id_additional',getDynamicDropdownList('expence_type_id', true),null,['class'=>'form-control col-md-6 col-xs-12', 'required'=>'required']) }}
                                                  </th>
                                                    @endif
                                                  <td  id="td_additional_amount" class="text-right child_table_right_col">
                                                      @if(env('APP_NT_ENABLE'))
                                                          <label class="control-label"> &nbsp;</label>
                                                      @endif
                                                    {{Form::number('amount[additional_order_amount]',$additionalOrderAmount,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_order_amount", "placeholder"=>lang_trans('txt_additional_amount'),"min"=>0])}}
                                                  </td>
                                                </tr>
                                            </table>

                                            <table class="table ">
                                                <tr >
                                                  <th class="child_table_left_col">{{lang_trans('txt_grand_food_total')}} {{Form::hidden('amount[total_food_final_amount]',null,['id'=>'total_food_final_amount'])}}</th>
                                                  <td id="td_total_food_final_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ $finalOrderAmount }}</td>
                                                </tr>
                                            </table>

                                            <!-- <table class="table ">
                                                <tr class="">
                                                  <th  class="text-right bg-default child_table_left_col">
                                                    {{ ($additionalAmountReason) ? $additionalAmountReason : lang_trans('txt_additional_amount_reason') }}
                                                  </th>
                                                  <td class="text-right child_table_left_col">
                                                    {{getCurrencySymbol()}} {{ numberFormat($additionalAmount) }}
                                                  </td>
                                                </tr>
                                            </table> -->

                                            <table class="table ">
                                                  <tr class="">
                                                    <th class="text-right child_table_left_col">{{lang_trans('txt_grand_total')}}</th>
                                                    <!-- <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($finalRoomAmount+$finalOrderAmount+$additionalAmount) }}</td> -->
                                                    <!-- change the logic of filnal price -->
                                                    <td  class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($finalAmount) }}</td>
                                                  </tr>
                                            </table>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </section>

                        <div class="row">
                                <h4 class="card-title"> {{lang_trans('heading_additional_info')}}</h4>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="demo-inline-spacing">
                                        <div class="form-check form-check-primary">
                                           
                                            <!-- {{Form::radio('guest_type','new',true,['class'=>"form-check-input guest_type", 'id'=>'new_guest'])}} -->
                                            {{Form::radio('invoice_applicable',1,true,['class'=>"form-check-input invoice_applicable", 'id'=>'yes_invoice'])}}
                                            <label class="form-check-label" for="customColorRadio1">{{lang_trans('txt_yes')}}</label>
                                        </div>
                                        <div class="form-check form-check-primary">
                                           
                                            <!-- {{Form::radio('guest_type','new_company',false,['class'=>"form-check-input guest_type", 'id'=>'new_company'])}}  -->
                                            {{Form::radio('invoice_applicable',0,false,['class'=>"form-check-input invoice_applicable", 'id'=>'no_invoice'])}}
                                            <label class="form-check-label" for="customColorRadio2">{{lang_trans('txt_no')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_company_gst_num')}}</label>
                                        {{Form::text('company_gst_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_gst_num", "placeholder"=>"Enter Tax Number"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_payment_status')}}</label>
                                        {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-select col-md-6 col-xs-12", "placeholder"=>"--Select"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_payment_mode')}}</label>
                                        {{Form::select('payment_mode',config('constants.PAYMENT_MODES'),null,['class'=>"form-select col-md-6 col-xs-12", "placeholder"=>"--Select"])}}
                                    </div>
                                </div>

                                
                                <!-- <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_duration_of_stay')}}</label>
                                        {{Form::number('duration_of_stay',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"duration_of_stay", "placeholder"=>lang_trans('ph_day_night'),"min"=>1,'required'=>true, 'readonly'=>true])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_remark_amount')}}</label>
                                        {{Form::number('remark_amount',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"Remark Amount","placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark_amount'),"min"=>0])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="">{{lang_trans('txt_remark')}}</label>
                                        {{Form::textarea('remark',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"remark", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark'),"rows"=>1])}}
                                    </div>
                                </div> -->


                                <!-- <div class="x_content">
                                  <div class="row">
                                    <div class="x_title">
                                        <h2>{{lang_trans('heading_additional_info')}}</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-12 col-sm-12 col-xs-12">{{lang_trans('txt_inv_applicable')}}</label>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                          {{Form::radio('invoice_applicable',1,true,['class'=>"flat invoice_applicable", 'id'=>'yes_invoice'])}}
                                          <label for="yes_invoice">{{lang_trans('txt_yes')}}</label>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                          {{Form::radio('invoice_applicable',0,false,['class'=>"flat invoice_applicable", 'id'=>'no_invoice'])}}
                                          <label for="no_invoice">{{lang_trans('txt_no')}}</label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label"> {{lang_trans('txt_company_gst_num')}}</label>
                                        {{Form::text('company_gst_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_gst_num", "placeholder"=>"Enter Tax Number"])}}
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label"> {{lang_trans('txt_payment_status')}}</label>
                                        {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-control col-md-6 col-xs-12", "placeholder"=>"--Select"])}}
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label"> {{lang_trans('txt_payment_mode')}}</label>
                                        {{Form::select('payment_mode',config('constants.PAYMENT_MODES'),null,['class'=>"form-control col-md-6 col-xs-12", "placeholder"=>"--Select"])}}
                                      </div>
                                    </div>
                                </div>
                              </div>
                                  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                      <button class="btn btn-success btn-submit-form" type="submit">{{lang_trans('btn_submit')}}</button>
                                  </div>
                              </div>
                          </div> -->


                        </div>

                      
                        <hr />
                        <button class="btn btn-success btn-submit-form" type="submit">{{lang_trans('btn_submit')}}</button>
                </form>
            </div>
        </div>
    </div>


<!--
<div class="">
      {{ Form::model($data_row,array('url'=>route('check-out'),'id'=>"check-out-form", 'class'=>"form-horizontal form-label-left",'files'=>true,'autocomplete'=>"off")) }}
      {{Form::hidden('id',null)}}
      <div class="row" id="new_guest_section">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <div class="col-sm-4 p-left-0">
                      <h2>{{lang_trans('heading_guest_type')}}</h2>
                  </div>
                  <div class="col-sm-8 text-right">
                      <a href="{{route('edit-customer',['id'=>$data_row->customer_id])}}" class="btn btn-xs btn-info" target="_blank">{{lang_trans('btn_update_customer_info')}}</a>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <tr>
                              <th>{{lang_trans('txt_fullname')}}</th>
                              <td>{{$data_row->customer->name}}</td>
                              <th>{{lang_trans('txt_father_name')}}</th>
                              <td>{{$data_row->customer->father_name}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_email')}}</th>
                              <td>{{$data_row->customer->email}}</td>
                              <th>{{lang_trans('txt_mobile_num')}}</th>
                              <td>{{$data_row->customer->mobile}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_address')}}</th>
                              <td colspan="3">{{$data_row->customer->address}}, {{$data_row->customer->city}}, {{$data_row->customer->state}}, {{$data_row->customer->country}}</td>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_checkin_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_checkin')}} <span class="required">*</span></label>
                        {{Form::text('check_in_date',$data_row->check_in,['class'=>"form-control col-md-6 col-xs-12", "id"=>"check_in_date", "placeholder"=>lang_trans('ph_date'),'readonly'=>true,'disabled'=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_checkout')}} <span class="required">*</span></label>
                        {{Form::text('check_out_date', addSubDate('+', $data_row->duration_of_stay, $data_row->check_in, 'Y-m-d H:i:s') ,['class'=>"form-control col-md-6 col-xs-12", "id"=>"check_out_date", "placeholder"=>lang_trans('ph_date'),'required'=>true,'autocomplete'=>false, "readonly"=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_duration_of_stay')}} <span class="required">*</span></label>
                        {{Form::number('duration_of_stay',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"duration_of_stay", "placeholder"=>lang_trans('ph_day_night'),"min"=>1,'required'=>true, 'readonly'=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_remark_amount')}} </label>
                          {{Form::number('remark_amount',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"Remark Amount","placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark_amount'),"min"=>0])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_remark')}}</label>
                        {{Form::textarea('remark',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"remark", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark'),"rows"=>1])}}
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_idcard_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label">{{lang_trans('txt_type_id')}}</label>
                          {{ Form::select('idcard_type',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_id_number')}} <span class="required">*</span></label>
                        {{Form::text('idcard_no',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_id_number')])}}
                      </div>
                      < !-- We comment the image here is no need of image file - ->
                      <! -- <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_upload_idcard')}} <sup class="color-ff4">{{lang_trans('txt_multiple')}}</sup> </label>
                        {{Form::file('id_image[]',['class'=>"form-control",'id'=>'idcard_image','multiple'=>true])}}
                      </div> - ->
                  </div>
                  @if($data_row->id_cards->count())
                    <div class="row">
                        <div class="col-sm-12">
                            <br/>
                            <table class="table table-bordered">
                              <tr>
                                <th colspan="2">{{lang_trans('txt_uploaded_files')}}</th>
                              </tr>
                              <tr>
                                <th>{{lang_trans('txt_sno')}}.</th>
                                <th>{{lang_trans('txt_action')}}</th>
                              </tr>
                              @if($data_row->id_cards)
                                @foreach($data_row->id_cards as $k=>$val)
                                  @if($val->file!='')
                                    <tr>
                                      <td>{{$k+1}}</td>
                                      <td>
                                        <a href="{{checkFile($val->file,'uploads/id_cards/','blank_id.jpg')}}" data-toggle="lightbox"  data-title="{{lang_trans('txt_idcard')}}" data-footer="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> </a>
                                        <a href="{{checkFile($val->file,'uploads/id_cards/','blank_id.jpg')}}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i> </a>
                                       <button type="button" class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-mediafile',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                                      </td>
                                    </tr>
                                  @endif
                                @endforeach
                              @else
                                <tr>
                                    <td colspan="2">{{lang_trans('txt_no_file')}}</td>
                                </tr>
                              @endif
                            </table>
                        </div>
                    </div>
                  @endif
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_payment_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                              <th class="text-center" width="20%">{{lang_trans('txt_room')}}</th>
                              <th class="text-center" width="5%">{{lang_trans('txt_swapped_room')}}</th>
                              <th class="text-center" width="5%">{{lang_trans('txt_duration_of_stay')}}</th>
                              <th class="text-center" width="5%">{{lang_trans('txt_base_price')}}</th>
                              <th class="text-center" width="10%">{{lang_trans('txt_total_amount')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($data_row->booked_rooms)
                              @foreach($data_row->booked_rooms as $key=>$roomInfo)
                                @php
                                  $checkIn = dateConvert($roomInfo->check_in, 'Y-m-d');
                                  $checkOut = dateConvert($roomInfo->check_out, 'Y-m-d');
                                  $durOfStayPerRoom = dateDiff($checkIn, $checkOut, 'days');
                                  //$durOfStayPerRoom = ($durOfStayPerRoom == 0) ? 1: $durOfStayPerRoom;
                                  $durOfStayPerRoom = ($durOfStayPerRoom == 0) ? 0: $durOfStayPerRoom;
                                  $amountPerRoom = ($durOfStayPerRoom * $roomInfo->room_price);
                                @endphp
                                <tr class="per_room_tr">
                                  <td class="text-center">{{$key+1}}</td>
                                  <td>
                                      {{ ($roomInfo->room_type) ? $roomInfo->room_type->title : ""}}<br/>
                                      ({{lang_trans('txt_room_num')}} : {{$roomInfo->room->room_no}})
                                  </td>
                                  <td class="text-center">{{ config('constants.YES_NO')[($roomInfo->swapped_from_room)?1:0] }}</td>
                                  <th class="text-center">
                                    <span class="duration_of_per_room {{ ($roomInfo->swapped_from_room) ? 'swapped_room' : 'no_swapped_room'}}">{{$durOfStayPerRoom}}</span>
                                  </th>
                                  <td>
                                    {{Form::number('amount[per_room_price]',$roomInfo->room_price,['class'=>'form-control per_room_price', 'min'=>$roomInfo->room_price])}}
                                    <span class="error base_price_err_msg"></span>
                                  </td>
                                  <td class="text-right td_total_per_room_amount">{{getCurrencySymbol()}} {{ $amountPerRoom }}</td>
                                </tr>
                              @endforeach
                            @endif
                          </tbody>
                        </table>


                        <table class="table table-bordered">
                          <tr>
                            <th class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[total_room_amount]',$totalRoomAmount,['id'=>'total_room_amount'])}}</th>
                            <td width="15%" class="text-right td_total_room_amount">{{getCurrencySymbol()}} {{ $totalRoomAmount }}</td>
                          </tr>
                            <tr>
                                <th class="text-right">{{lang_trans('txt_discount')}}</th>
                                <td width="15%" id="td_advance_amount" class="text-right">
                                    <div class="col-md-12 col-sm-12 col-xs-12 p-left-0 p-right-0">
                                        <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                            {{Form::number('discount_amount',$roomAmountDiscount,['class'=>"form-control", "id"=>"discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                            {{ Form::select('room_discount_in',config('constants.DISCOUNT_TYPES'),'amt',['class'=>'form-control', "id"=>"room_discount_in"]) }}
                                        </div>
                                    </div>
                                    <span class="error discount_room_err_msg"></span>
                                </td>
                            </tr>
                         
                          <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                              <th class="text-right"> {{lang_trans('txt_cgst')}} ({{$cgstPerc}}%) {{Form::hidden('amount[total_room_amount_cgst]',null,['id'=>'total_room_amount_cgst'])}}
                              {{Form::hidden('amount[org_room_amount_cgst]',$roomAmountCGst,['id'=>'org_room_amount_cgst'])}}
                              </th>
                              <td width="15%" id="td_total_room_amount_cgst" class="text-right">{{getCurrencySymbol()}} {{ $roomAmountCGst }}</td>
                            </tr>
                            <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                              <th class="text-right">{{lang_trans('txt_total_cgst')}}  {{Form::hidden('amount[total_room_amount_with_cgst]',null,['id'=>'total_room_amount_with_cgst'])}}</th>
                              <td width="15%" id="td_total_room_amount_with_cgst" class="text-right">{{getCurrencySymbol()}} {{ $roomAmountWithCGstAmount }}</td>
                            </tr>
                            <tr>
                              <th class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPerc}}%) {{Form::hidden('amount[total_room_amount_gst]',null,['id'=>'total_room_amount_gst'])}}
                              {{Form::hidden('amount[org_room_amount_gst]',$roomAmountGst,['id'=>'org_room_amount_with_cgst'])}}
                              </th>
                              <td width="15%" id="td_total_room_amount_gst" class="text-right">{{getCurrencySymbol()}} {{ $roomAmountGst }}</td>
                            </tr>

                          <tr>
                            <th class="text-right">{{lang_trans('txt_advance_amount')}} {{Form::hidden('amount[total_room_advance_amount]',$advancePayment)}}</th>
                            <td width="15%" id="td_room_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ $advancePayment }}</td>
                          </tr>

                          <tr class="bg-warning">
                            <th class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[total_room_final_amount]',null,['id'=>'total_room_final_amount'])}}</th>
                            <td width="15%" id="td_room_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalRoomAmount }}</td>
                          </tr>
                        </table>

                        <! --  This is green section which is calculate our grand total with additional amount -- >

                        <table class="table table-bordered">
                            <tr class="bg-default">
                              <th class="text-right">
                                  @if(env('APP_NT_ENABLE'))
                                      <label class="control-label"> &nbsp;</label>
                                  @endif
                                {{Form::text('additional_amount_reason',$additionalAmountReason,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_amount_reason", "placeholder"=>lang_trans('txt_additional_amount_reason')])}}
                              </th>
                                @if(env('APP_NT_ENABLE'))
                              <th width="30%">
                                  <label class="control-label"> {{lang_trans('ministory_of_tourism_section')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_expence_type_id_additional',getDynamicDropdownList('expence_type_id', true),null,['class'=>'form-control col-md-6 col-xs-12', 'required'=>'required']) }}
                              </th>
                                @endif
                              <td width="15%" id="td_additional_amount" class="text-right">
                                  @if(env('APP_NT_ENABLE'))
                                      <label class="control-label"> &nbsp;</label>
                                  @endif
                                {{Form::number('additional_amount',$additionalAmount,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_amount", "placeholder"=>lang_trans('txt_additional_amount'),"min"=>0])}}
                              </td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr >
                              <th class="text-right bg-success">{{lang_trans('txt_room_grand_room_total')}} {{Form::hidden('total_grand_room_amount',null,['id'=>'total_grand_room_amount'])}}</th>
                              <td width="15%" id="td_total_grand_room_amount" class="text-right">{{getCurrencySymbol()}} {{ $grandRoomAmount }}</td>
                            </tr>
                        </table>


                        <div class="x_title">
                            <h2>{{lang_trans('txt_food_orders')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="2%">{{lang_trans('txt_sno')}}.</th>
                              <th width="20%">{{lang_trans('txt_item_details')}}</th>
                              <th width="5%">{{lang_trans('txt_date')}}</th>
                              <th width="5%">{{lang_trans('txt_item_qty')}}</th>
                              <th width="5%">{{lang_trans('txt_item_price')}}</th>
                              <th width="5%">{{lang_trans('txt_tax')}}</th>
                              <th width="10%">{{lang_trans('txt_total_amount')}}</th>
                              @if(env('APP_NT_ENABLE'))
                                    <th width="15%">{{lang_trans('ministory_of_tourism_section')}}</th>
                              @endif
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // Declare new variables for calculations
                                  $order_sub_total = 0;
                                  $total_order_tax = 0;
                                  $order_total_with_tax = 0;
                                  $kk = 0;
                                  $tax_flag=true; 
                                  $grand_total_order_tax=0;
                                  $order_tax_percentage = 0;
                              ?>
                            @forelse($data_row->orders_items as $k=>$val)
                              <?php
                                // dd($k);
                                // Calculate of order amount and quantity and tax
                                  // $kk++;
                                  // if($val->tax_flag==false){
                                  //   $tax_flag=false; 
                                  // }
                                  // $order_sub_total += $val->item_qty * $val->item_price;
                                  // $total_order_tax += ($val->item_qty * $val->item_tax);
                                  // $grand_total_order_tax = $total_order_tax + $grand_total_order_tax;
                                  // $order_total_with_tax += $val->item_qty * ($val->item_price + $val->item_tax);
                                  // $order_tax_percentage = $val->order_gst_perc;
                              ?>
                              <tr>
                                <td>{{$k+1}} </td>
                                <td>{{$val->item_name}}</td>
                                <td>{{dateConvert($val->created_at,'d-m-Y')}}</td>
                                <td>{{$val->item_qty}}</td>
                                <td>{{getCurrencySymbol()}} {{$val->item_price}}</td>
                                <td>{{getCurrencySymbol()}} {{$val->item_qty*$val->item_tax}}</td>
                                <td>{{getCurrencySymbol()}} {{$val->item_qty*$val->item_price}}</td>
                                  @if(env('APP_NT_ENABLE'))
                                      <td>
                                          {{ Form::select('mt_expence_type_id_'.$val->id.'',getDynamicDropdownList('expence_type_id', true),null,['class'=>'form-control col-md-6 col-xs-12', 'required'=>'required']) }}
                                      </td>
                                  @endif

                              </tr>
                              @empty
                              <tr>
                                <td colspan="6">{{lang_trans('txt_no_orders')}}</td>
                              </tr>
                              @endforelse
                              @if(count($data_row->orders_items) == ($kk) )
                                <tr>
                                  <th colspan="5" class="text-right">{{lang_trans('txt_gst_apply')}}</th>
                                  <td>{{ Form::checkbox('food_gst_apply',($tax_flag==true) ? 1 : 0,($tax_flag==true) ? true : false,['id'=>'apply_gst']) }}</td>
                                  <! -- <td>{{ Form::checkbox('food_gst_apply',1,($gstFoodApply==1) ? true : false,['id'=>'apply_gst']) }}</td> -- >
                                </tr>
                                
                              @endif
                             
                            <! -- @ endforelse - ->
                          </tbody>
                        </table>
                         
                        <table class="table table-bordered">
                            <tr>
                              <! -- <th class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[order_amount]',$totalOrdersAmount,['id'=>'total_order_amount'])}}</th>
                              <td width="15%" id="td_total_order_amount" class="text-right">{{getCurrencySymbol()}} {{ $totalOrdersAmount }}</td> - ->

                              <th class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[order_amount]',$order_sub_total,['id'=>'total_order_amount'])}}</th>
                              <td width="15%" id="td_total_order_amount" class="text-right">{{getCurrencySymbol()}} {{ $order_sub_total }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">{{lang_trans('txt_discount')}}</th>
                                <td width="15%" id="td_advance_amount" class="text-right">
                                    <div class="col-md-12 col-sm-12 col-xs-12 p-left-0 p-right-0">
                                        <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                            {{Form::number('discount_order_amount',$foodOrderAmountDiscount,['class'=>"form-control col-md-7 col-xs-12", "id"=>"order_discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                            {{ Form::select('order_discount_in',config('constants.DISCOUNT_TYPES'),'amt',['class'=>'form-control', "id"=>"order_discount_in"]) }}
                                        </div>
                                    </div>
                                    <span class="error discount_order_err_msg"></span>
                                </td>
                            </tr>
                                   
                            <tr>
                            <th class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPercFood}}%) {{Form::hidden('amount[order_amount_gst]',$foodAmountGst,['id'=>'total_order_amount_gst'])}}</th>
                              <td width="15%" id="td_order_amount_gst" class="text-right">{{getCurrencySymbol()}} {{$foodAmountGst}}</td>

                            </tr>
                     
                            <tr class="{{$cgstPercFood > 0 ? '' : 'hide_elem'}}">
                              <th class="text-right">{{lang_trans('txt_cgst')}} ({{$cgstPercFood}}%) {{Form::hidden('amount[order_amount_cgst]',$foodAmountCGst,['id'=>'total_order_amount_cgst'])}}</th>
                              <td width="15%" id="td_order_amount_cgst" class="text-right">{{getCurrencySymbol()}} {{$foodAmountCGst}}</td>
                            </tr>
                           
                            <tr class="bg-warning">
                              <th class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[order_final_amount]',null,['id'=>'total_order_final_amount'])}}</th>
                              <td width="15%" id="td_order_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalOrderAmount }}</td>
                              <! -- <th class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[order_final_amount]',null,['id'=>'total_order_final_amount'])}}</th>
                              <td width="15%" id="td_order_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalOrderAmount }}</td> - ->
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr class="bg-default">
                              <th class="text-right">
                                  @if(env('APP_NT_ENABLE'))
                                      <label class="control-label"> &nbsp;</label>
                                  @endif
                                {{Form::text('amount[additional_order_amount_reason]',$additionalOrderAmountReason,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_order_amount_reason", "placeholder"=>lang_trans('txt_additional_amount_reason')])}}
                              </th>
                                @if(env('APP_NT_ENABLE'))
                              <th width="30%">
                                  <label class="control-label"> {{lang_trans('ministory_of_tourism_section')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_expence_type_id_additional',getDynamicDropdownList('expence_type_id', true),null,['class'=>'form-control col-md-6 col-xs-12', 'required'=>'required']) }}
                              </th>
                                @endif
                              <td width="15%" id="td_additional_amount" class="text-right">
                                  @if(env('APP_NT_ENABLE'))
                                      <label class="control-label"> &nbsp;</label>
                                  @endif
                                {{Form::number('amount[additional_order_amount]',$additionalOrderAmount,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_order_amount", "placeholder"=>lang_trans('txt_additional_amount'),"min"=>0])}}
                              </td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr >
                              <th class="text-right bg-success">{{lang_trans('txt_grand_food_total')}} {{Form::hidden('amount[total_food_final_amount]',null,['id'=>'total_food_final_amount'])}}</th>
                              <td width="15%" id="td_total_food_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalOrderAmount }}</td>
                            </tr>
                        </table>
                   
                        < !-- <hr>

                        <table class="table table-bordered">
                            <tr class="bg-success">
                              <th class="text-right">{{lang_trans('txt_grand_total')}} {{Form::hidden('amount[total_final_amount]',null,['id'=>'total_final_amount'])}}</th>
                              <td width="15%" id="td_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalAmount }}</td>
                            </tr>
                        </table> - ->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
                  <div class="row">
                    <div class="x_title">
                        <h2>{{lang_trans('heading_final_total')}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <tr >
                              <th class="text-right bg-success">{{lang_trans('txt_grand_total')}} {{Form::hidden('amount[total_final_amount]',null,['id'=>'total_final_amount'])}}</th>
                              <td width="15%" id="td_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalAmount }}</td>
                            </tr>
                        </table>
                        
                      </div>
                    </div>
                  
                </div>
              </div>
                  
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
                  <div class="row">
                    <div class="x_title">
                        <h2>{{lang_trans('heading_additional_info')}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="col-md-12 col-sm-12 col-xs-12">{{lang_trans('txt_inv_applicable')}}</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          {{Form::radio('invoice_applicable',1,true,['class'=>"flat invoice_applicable", 'id'=>'yes_invoice'])}}
                          <label for="yes_invoice">{{lang_trans('txt_yes')}}</label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          {{Form::radio('invoice_applicable',0,false,['class'=>"flat invoice_applicable", 'id'=>'no_invoice'])}}
                          <label for="no_invoice">{{lang_trans('txt_no')}}</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_company_gst_num')}}</label>
                        {{Form::text('company_gst_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_gst_num", "placeholder"=>"Enter Tax Number"])}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_payment_status')}}</label>
                        {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-control col-md-6 col-xs-12", "placeholder"=>"--Select"])}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_payment_mode')}}</label>
                        {{Form::select('payment_mode',config('constants.PAYMENT_MODES'),null,['class'=>"form-control col-md-6 col-xs-12", "placeholder"=>"--Select"])}}
                      </div>
                    </div>
                </div>
              </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                      <button class="btn btn-success btn-submit-form" type="submit">{{lang_trans('btn_submit')}}</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
  {{ Form::close() }}
</div>
                                -->
{{-- require set php var in js var --}}
<script>
  globalVar.page = 'checkout';
  globalVar.userRole = {{$userRole}};
  globalVar.checkInDate='';
  globalVar.checkOutDate='';
  globalVar.gstPercent = {{$gstPerc}};
  globalVar.cgstPercent = {{$cgstPerc}};
  globalVar.gstPercentFood = {{$gstPercFood}};
  globalVar.cgstPercentFood = {{$cgstPercFood}};
  globalVar.roomQty = 0;
  globalVar.advanceAmount = {{$advancePayment}};
  globalVar.totalOrdersAmount = {{$totalOrdersAmount}};
  globalVar.subTotalRoomAmount = {{$totalRoomAmount}};
  globalVar.discount = {{$roomAmountDiscount}};
  globalVar.foodOrderDiscount = {{$foodOrderAmountDiscount}};
  globalVar.gstOrderAmount = 0;
  globalVar.gstRoomAmount = {{$roomAmountGst}};
  globalVar.applyFoodGst = {{$gstFoodApply}};
  // add these two values for js code which is used in js to correct the tax logic and percentage
  globalVar.grandTotalFoodGst = {{$total_order_tax}};
  globalVar.OrderTaxPercentage = {{$order_tax_percentage}};
  globalVar.additionalAmount = {{$additionalAmount}};
  // add additional order amount for calculation in javascript
  globalVar.additionalOrderAmount = {{$additionalOrderAmount}};
  globalVar.isError = false;
  globalVar.startDate = moment("{{$data_row->check_in}}", "YYYY.MM.DD");
</script>
 <!-- <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script> -->
@endsection


@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
  <!-- <script src="{{URL::asset('public/custom/js/add_reservation.js')}}"></script> -->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
  <!-- <script src="{{URL::asset('public/app-assets/js/scripts/forms/customer.js')}}"></script> -->
  <!-- <script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script> -->
  <!-- <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script> -->
  <script type="text/javascript">
$(document).ready(function() {
    $('#room_discount_in, #total_room_amount, #discount').on('input', function() {
        makeDiscount();
    });
    var originalTotal = parseFloat($("#total_room_amount").val()) || 0;

    function makeDiscount() {
        var selected = $("#room_discount_in").val();
        var discount = parseFloat($("#discount").val()) || 0;

        if (discount > 100) {
            alert("Discount cannot be greater than 100%");
            $("#discount").val("");
            return;
        }
        var discountedAmount = originalTotal;

        if (selected == 'perc') {
            discountedAmount = originalTotal - ((originalTotal * discount) / 100);
        } else {
            discountedAmount = originalTotal - discount;
        }
        var taxRateCGST = parseFloat($("#org_room_amount_cgst").val()) || 0;
        var taxRateGST = parseFloat($("#org_room_amount_with_cgst").val()) || 0;
        var cgst = originalTotal * (taxRateCGST / 100);
        var gst = originalTotal * (taxRateGST / 100); 
        var finalTotal = discountedAmount + cgst + gst;
        $("#total_room_final_amount").val(finalTotal.toFixed(2)); 
        $("#td_room_final_amount").text("﷼ " + finalTotal.toFixed(2)); 
    }
});

  </script>
  @endsection

  