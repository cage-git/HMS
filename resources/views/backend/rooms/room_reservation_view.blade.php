@extends('layouts.master_backend_new')
@section('content')
@php
  use Carbon\Carbon;
  $calculatedAmount = calcFinalAmount($data_row, 0);
  $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
  $advancePayment = $calculatedAmount['advancePayment'];
  $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
  $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
  $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
  $roomAmountWithCGstAmount = $calculatedAmount['totalRoomAmountWithCGstAmount'];
  $finalRoomAmount = $calculatedAmount['finalRoomAmount'];

  $totalOrderAmountGst = $calculatedAmount['totalOrderAmountGst'];
  $totalOrderAmountCGst = $calculatedAmount['totalOrderAmountCGst'];
  $totalOrderAmountDiscount = $calculatedAmount['totalOrderAmountDiscount'];
  $orderGst = $calculatedAmount['totalOrderGstPerc'];
  $orderCGst = $calculatedAmount['totalOrderCGstPerc'];
  $totalOrdersAmount = $calculatedAmount['subtotalOrderAmount'];
  $finalOrderAmount = $calculatedAmount['finalOrderAmount'];

  $additionalAmount = $calculatedAmount['additionalAmount'];
  $additionalAmountReason = $data_row->additional_amount_reason;
@endphp

@php
    $settings = getSettings();
     $calculatedAmount = calcFinalAmount($data_row, 1, false);
     $additionalAmount = $calculatedAmount['additionalAmount'];
     $additionalAmountReason = $data_row->additional_amount_reason;
     $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
     $gstPerc = $calculatedAmount['totalRoomGstPerc'];
     $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
     $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
     $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
     $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
     // $subTotalRoomAmount = (($totalRoomAmount+$roomAmountGst+$roomAmountCGst) - $roomAmountDiscount)+$additionalAmount;
     $subTotalRoomAmount = (($roomAmountWithCGstAmount + $roomAmountGst ) )+$additionalAmount;
     $advancePayment = $calculatedAmount['advancePayment'];

     $finalAmount = $subTotalRoomAmount + $finalOrderAmount ;
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
    $dateOfBirth = Carbon::parse($data_row->customer->dob);
    $age = $dateOfBirth->age;
@endphp

<style>

.child_table_left_col{
    float: right;
    width: 30%;
  }

  .child_table_right_col{
    width: 15%;
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
  }


</style>


<section id="basic-datatable">
    <div class="row">
        <div class=" col-12">
          <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-50">{{lang_trans('heading_guest_info')}}</h4>
                </div>
                <hr/>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-7 col-12">
                            <dl class="row mb-0">
                                <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_name')}}:</dt>
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

                                <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_surname')}}:</dt>
                                <dd class="col-sm-8 mb-1">{{$data_row->customer->surname}}</dd>

                                <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_mobile_num')}}:</dt>
                                <dd class="col-sm-8 mb-1">{{$data_row->customer->mobile}}</dd>

                                <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_age')}}:</dt>
                                <dd class="col-sm-8 mb-1">{{$age}} {{lang_trans('txt_years')}}</dd>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
</section>



<div class="card">
      <div class="card-header">
          <h4 class="card-title mb-50">{{lang_trans('heading_checkInOut_info')}}</h4>
      </div>
      <hr/>
      <div class="card-body">
          <div class="row">
              <div class="col-xl-6 col-12">
                  <dl class="row mb-0">
                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('btn_checkin')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{dateConvert($data_row->check_in,'d-m-Y H:i')}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_checkin_from_date')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{ ($data_row->created_at_checkin!=null) ? dateConvert($data_row->created_at_checkin,'d-m-Y H:i') : 'NA'}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_checkout_from_date')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{ ($data_row->created_at_checkout!=null) ? dateConvert($data_row->created_at_checkout,'d-m-Y H:i') : 'NA'}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_idcard_type')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{@getDynamicDropdownById($data_row->idcard_type, 'dropdown_value')}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_inv_applicable')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{($data_row->invoice_num!='') ? 'Yes' : 'No'}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_booked_by')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->booked_by}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_referred_by')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->referred_by}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_payment_mode')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{ @config('constants.PAYMENT_MODES')[$data_row->payment_mode]}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_reason_of_visit')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->reason_visit_stay}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_remark_amount')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->remark_amount}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_remark')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->remark}}</dd>

                  </dl>
              </div>
              <div class="col-xl-6 col-12">
                  <dl class="row mb-0">

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('btn_checkout')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{ dateConvert($data_row->check_out,'d-m-Y H:i')}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_duration_of_stay')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->duration_of_stay}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_persons')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{lang_trans('txt_adults')}}:</b> {{$data_row->adult}} <b>{{lang_trans('txt_kids')}}:</b> {{$data_row->kids}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_idcard_num')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->idcard_no}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_company_gst_num')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->company_gst_num}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_vehicle_number')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->vehicle_number}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_referred_by_name')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->referred_by_name}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_room_plan')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->room_plan}}</dd>

                        
                  </dl>
              </div>
          </div>
      </div>
  </div>
  <section>
    <div class="row">
        <div class="col-12">
            <div class="card">
              @if ($data_row->persons->isEmpty())
                  <!-- blank if there is no person included -->
                 @else
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{lang_trans('heading_person_info')}}</h4>
                    </div>
                    
                    <table class="datatables-basic table table-responsive">
                        <tr>
                            <th>{{lang_trans('txt_sno')}}.</th>
                            <th>{{lang_trans('txt_name')}}</th>
                            <th>{{lang_trans('txt_gender')}}</th>
                            <th>{{lang_trans('txt_age')}}</th>
                            <th>{{lang_trans('txt_address')}}</th>
                            <th>{{lang_trans('txt_idcard_type')}}</th>
                            <th>{{lang_trans('txt_idcard_num')}}</th>
                        </tr>
                    
                        @if($data_row->persons)
                                  @foreach($data_row->persons as $k=>$val)
                                    <tr>
                                      <td>{{$k+1}}</td>
                                      <td>{{$val->name}}</td>
                                      <td>{{$val->gender}}</td>
                                      <td>{{$val->age}}</td>
                                      <td>{{$val->address}}</td>
                                      <td>{{@getDynamicDropdownById($val->idcard_type, 'dropdown_value')}}</td>
                                      <td>{{$val->idcard_no}}</td>
                                    </tr>
                                  @endforeach
                                @else
                                  <tr>
                                      <td colspan="7">{{lang_trans('txt_no_record')}}</td>
                                  </tr>
                                @endif
                    </table>
                @endif
            </div>
        </div>
    </div>
    
</section>

<section>
  @if ($data_row->id_cards->isEmpty())
       <!-- hidden section if no id card information is there -->
    @else
    <div class="row"> 
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('txt_idcard_uploaded')}}</h4>
                </div>                 
                    <table class="datatables-basic table table-responsive">
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

    </div>
     @endif
</section>


<section>
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                <div class="card-header px-0 border-bottom">
                    <h4 class="card-title">{{lang_trans('heading_payment_info')}}</h4>
                </div>
                <table class="datatables-basic table table-responsive">
                  <tr>
                    <th>{{lang_trans('txt_payment_mode')}}</th>
                    <td>{{ ($data_row->payment_mode>0) ? config('constants.PAYMENT_MODES')[$data_row->payment_mode] : 'NA' }}</td>
                  </tr>
                </table>
            

                <table class="datatables-basic table table-responsive dataTable" >
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
          
                <table class="table child">
                              <tr>
                                <th class="text-right child_table_left_col">{{lang_trans('txt_subtotal')}}</th>
                                <td class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($totalRoomAmount) }}</td>
                              </tr>
                              <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                <th class="text-right child_table_left_col">{{lang_trans('txt_cgst')}}</th>
                                <td id="td_advance_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($roomAmountCGst) }}</td>
                              </tr>

                              <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                <th class="text-right child_table_left_col">{{lang_trans('txt_total_cgst')}}</th>
                                <td id="td_advance_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($roomAmountWithCGstAmount) }}</td>
                              </tr>
                              
                              <tr>
                                <th class="text-right child_table_left_col">{{lang_trans('txt_sgst')}} ({{$gstPerc}}%)</th>
                                <td class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($roomAmountGst) }}</td>
                              </tr>

                              <tr>
                                <th class="text-right child_table_left_col">{{lang_trans('txt_discount')}}</th>
                                <td id="td_advance_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($roomAmountDiscount) }}</td>
                              </tr>
                            <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                <th class="text-right child_table_left_col">{{lang_trans('txt_subtotal')}}</th>
                                <td  id="td_advance_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($subTotalRoomAmount) }}</td>
                            </tr>

                            <tr>
                                <th class="text-right child_table_left_col">{{lang_trans('txt_advance_amount')}}</th>
                                <td id="td_advance_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($advancePayment) }}</td>
                            </tr>
                              <tr>
                                <th  class="text-right child_table_left_col">{{lang_trans('txt_final_amount')}}</th>
                                <td  id="td_final_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($subTotalRoomAmount - $advancePayment) }}</td>
                              </tr>
                        </table>
                        <hr/>
                 
                <div class="card-header px-0 border-bottom">
                    <h4 class="card-title">{{lang_trans('txt_food_orders')}}</h4>
                </div>
                @if ($data_row->orders_items->isEmpty())
                  <p class="py-1 m-0">No food items are ordered.</p>
                @else 
                    <table
                     class="datatables-basic table table-responsive dataTable" >
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

                    <table class="table">
                        <tr>
                          <th  class="text-right child_table_left_col">{{lang_trans('txt_subtotal')}}</th>
                          <td class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($totalOrdersAmount) }}</td>
                        </tr>
                        <tr>
                          <th class="text-right child_table_left_col">{{lang_trans('txt_sgst')}} ({{$gstPercFood}}%)</th>
                          <td class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($foodAmountGst) }}</td>
                        </tr>

                        <tr class="{{$cgstPercFood > 0 ? '' : 'hide_elem'}}">
                          <th class="text-right child_table_left_col">{{lang_trans('txt_cgst')}} ({{$cgstPercFood}}%)</th>
                          <td id="td_advance_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($foodAmountCGst) }}</td>
                        </tr>
                        <tr>
                          <th class="text-right child_table_left_col">{{lang_trans('txt_discount')}}</th>
                          <td id="td_advance_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($totalOrderAmountDiscount)}}</td>
                        </tr>
                        <tr class="">
                          <th class="text-right child_table_left_col">{{lang_trans('txt_final_amount')}}</th>
                          <td id="td_final_amount" class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($finalOrderAmount) }}</td>
                        </tr>
                    </table>

                    <table class="table ">
                        <tr class="">
                          <th class="text-right child_table_left_col bg-default">
                            {{ ($additionalAmountReason) ? $additionalAmountReason : lang_trans('txt_additional_amount_reason') }}
                          </th>
                          <td  class="text-right child_table_right_col">
                            {{getCurrencySymbol()}} {{ numberFormat($additionalAmount) }}
                          </td>
                        </tr>
                    </table>

                    <table class="table ">
                          <tr class="">
                            <th class="text-right child_table_left_col">{{lang_trans('txt_grand_total')}}</th>
                            <!-- <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($finalRoomAmount+$finalOrderAmount+$additionalAmount) }}</td> -->
                            <!-- change the logic of filnal price -->
                            <td class="text-right child_table_right_col">{{getCurrencySymbol()}} {{ numberFormat($finalAmount) }}</td>
                          </tr>
                    </table>
                @endif             
            </div>
        </div>

    </div>
</section>

<!-- 
<div class="">
      <div class="row" id="new_guest_section">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_guest_info')}}</h2>
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
                              <th>{{lang_trans('txt_gender')}}</th>
                              <td>{{$data_row->customer->gender}}</td>
                              <th>{{lang_trans('txt_age')}}</th>
                              <td>{{$data_row->customer->age}} {{lang_trans('txt_years')}}</td>
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
  </div> -->

  <!-- <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_checkInOut_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-bordered">
                            <tr>
                              <th>{{lang_trans('btn_checkin')}}</th>
                              <td>{{dateConvert($data_row->check_in,'d-m-Y H:i')}}</td>
                              <th>{{lang_trans('btn_checkout')}}</th>
                              <td>{{ dateConvert($data_row->check_out,'d-m-Y H:i')}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_checkin_from_date')}}</th>
                              <td>{{ ($data_row->created_at_checkin!=null) ? dateConvert($data_row->created_at_checkin,'d-m-Y H:i') : 'NA'}}</td>
                              <th>{{lang_trans('txt_checkout_from_date')}}</th>
                              <td>{{ ($data_row->created_at_checkout!=null) ? dateConvert($data_row->created_at_checkout,'d-m-Y H:i') : 'NA'}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_duration_of_stay')}}</th>
                              <td>{{$data_row->duration_of_stay}}</td>
                              <th>{{lang_trans('txt_persons')}}</th>
                              <td><b>{{lang_trans('txt_adults')}}:</b> {{$data_row->adult}} <b>{{lang_trans('txt_kids')}}:</b> {{$data_row->kids}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_idcard_type')}}</th>
                              <td>{{@getDynamicDropdownById($data_row->idcard_type, 'dropdown_value')}}</td>
                              <th>{{lang_trans('txt_idcard_num')}}</th>
                              <td>{{$data_row->idcard_no}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_inv_applicable')}}</th>
                              <td>{{($data_row->invoice_num!='') ? 'Yes' : 'No'}}</td>
                              <th>{{lang_trans('txt_company_gst_num')}}</th>
                              <td>{{$data_row->company_gst_num}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_booked_by')}}</th>
                              <td>{{$data_row->booked_by}}</td>
                              <th>{{lang_trans('txt_vehicle_number')}}</th>
                              <td>{{$data_row->vehicle_number}}</td>
                            </tr>
                             <tr>
                              <th>{{lang_trans('txt_referred_by')}}</th>
                              <td>{{$data_row->referred_by}}</td>
                              <th>{{lang_trans('txt_referred_by_name')}}</th>
                              <td>{{$data_row->referred_by_name}}</td>
                            </tr>
                             <tr>
                              <th>{{lang_trans('txt_payment_mode')}}</th>
                              <td>{{ @config('constants.PAYMENT_MODES')[$data_row->payment_mode]}}</td>
                              <th>{{lang_trans('txt_room_plan')}}</th>
                              <td>{{$data_row->room_plan}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_reason_of_visit')}}</th>
                              <td colspan="3">{{$data_row->reason_visit_stay}}</td>
                            </tr>
                             <tr>
                              <th>{{lang_trans('txt_remark_amount')}}</th>
                              <td colspan="3">{{$data_row->remark_amount}}</td>
                            </tr>
                             <tr>
                              <th>{{lang_trans('txt_remark')}}</th>
                              <td colspan="3">{{$data_row->remark}}</td>
                            </tr>
{{--                              <tr>--}}
{{--                                  <th>{{lang_trans('txt_purpose_of_the_visiting')}}</th>--}}
{{--                                  <td colspan="3">{{$data_row->purpose_of_the_visiting}}</td>--}}
{{--                              </tr>--}}
                          </table>
                        </div>

                  </div>
              </div>
          </div>
      </div>
  </div> -->
<!-- 
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_person_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-bordered">
                            <tr>
                              <th>{{lang_trans('txt_sno')}}.</th>
                              <th>{{lang_trans('txt_name')}}</th>
                              <th>{{lang_trans('txt_gender')}}</th>
                              <th>{{lang_trans('txt_age')}}</th>
                              <th>{{lang_trans('txt_address')}}</th>
                              <th>{{lang_trans('txt_idcard_type')}}</th>
                              <th>{{lang_trans('txt_idcard_num')}}</th>
                            </tr>
                            @if($data_row->persons)
                              @foreach($data_row->persons as $k=>$val)
                                <tr>
                                  <td>{{$k+1}}</td>
                                  <td>{{$val->name}}</td>
                                  <td>{{$val->gender}}</td>
                                  <td>{{$val->age}}</td>
                                  <td>{{$val->address}}</td>
                                  <td>{{@getDynamicDropdownById($val->idcard_type, 'dropdown_value')}}</td>
                                  <td>{{$val->idcard_no}}</td>
                                </tr>
                              @endforeach
                            @else
                              <tr>
                                  <td colspan="7">{{lang_trans('txt_no_record')}}</td>
                              </tr>
                            @endif
                          </table>
                        </div>

                  </div>
              </div>
          </div>
      </div>
  </div> -->

   <!-- <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_idcard_uploaded')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-bordered">
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
              </div>
          </div>
      </div>
  </div> -->

  <!-- <div class="row">
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
                          <tr>
                            <th>{{lang_trans('txt_payment_mode')}}</th>
                            <td>{{ ($data_row->payment_mode>0) ? config('constants.PAYMENT_MODES')[$data_row->payment_mode] : 'NA' }}</td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                              <th class="text-center" width="20%">{{lang_trans('txt_room')}}</th>
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

                        <table class="table table-bordered">
                              <tr>
                                <th class="text-right">{{lang_trans('txt_subtotal')}}</th>
                                <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalRoomAmount) }}</td>
                              </tr>
                              <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                <th class="text-right">{{lang_trans('txt_cgst')}}</th>
                                <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($roomAmountCGst) }}</td>
                              </tr>

                              <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                <th class="text-right">{{lang_trans('txt_total_cgst')}}</th>
                                <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($roomAmountWithCGstAmount) }}</td>
                              </tr>
                              
                              <tr>
                                <th class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPerc}}%)</th>
                                <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($roomAmountGst) }}</td>
                              </tr>


{{--                            @if($additionalAmount>0)--}}

{{--                                <tr class="{{$additionalAmount > 0 ? '' : 'hide_elem'}}">--}}
{{--                                    <th class="text-right">{{$additionalAmountReason}}</th>--}}
{{--                                    <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($additionalAmount) }}</td>--}}
{{--                                </tr>--}}

{{--                            @endif--}}

                              <tr>
                                <th class="text-right">{{lang_trans('txt_discount')}}</th>
                                <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($roomAmountDiscount) }}</td>
                              </tr>
                            <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                <th class="text-right">{{lang_trans('txt_subtotal')}}</th>
                                <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($subTotalRoomAmount) }}</td>
                            </tr>



                            <tr>
                                <th class="text-right">{{lang_trans('txt_advance_amount')}}</th>
                                <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($advancePayment) }}</td>
                            </tr>
                              <tr class="bg-success">
                                <th class="text-right">{{lang_trans('txt_final_amount')}}</th>
                                <td width="15%" id="td_final_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($subTotalRoomAmount - $advancePayment) }}</td>
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
                              <th width="10%">{{lang_trans('txt_total_amount')}}</th>
                            </tr>
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

                        <table class="table table-bordered">
                                    <tr>
                                      <th class="text-right">{{lang_trans('txt_subtotal')}}</th>
                                      <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalOrdersAmount) }}</td>
                                    </tr>
                                    <tr>
                                      <th class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPercFood}}%)</th>
                                      <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($foodAmountGst) }}</td>
                                    </tr>

                                    <tr class="{{$cgstPercFood > 0 ? '' : 'hide_elem'}}">
                                      <th class="text-right">{{lang_trans('txt_cgst')}} ({{$cgstPercFood}}%)</th>
                                      <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($foodAmountCGst) }}</td>
                                    </tr>
                                    <tr>
                                      <th class="text-right">{{lang_trans('txt_discount')}}</th>
                                      <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalOrderAmountDiscount)}}</td>
                                    </tr>
                                    <tr class="bg-success">
                                      <th class="text-right">{{lang_trans('txt_final_amount')}}</th>
                                      <td width="15%" id="td_final_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($finalOrderAmount) }}</td>
                                    </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr class="bg-default">
                              <th class="text-right">
                                {{ ($additionalAmountReason) ? $additionalAmountReason : lang_trans('txt_additional_amount_reason') }}
                              </th>
                              <td width="15%" class="text-right">
                               {{getCurrencySymbol()}} {{ numberFormat($additionalAmount) }}
                              </td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                              <tr class="bg-warning">
                                <th class="text-right">{{lang_trans('txt_grand_total')}}</th>
                                < !-- <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($finalRoomAmount+$finalOrderAmount+$additionalAmount) }}</td> -- >
                                <! -- change the logic of filnal price - ->
                                <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($finalAmount) }}</td>
                              </tr>
                        </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div> -->
@endsection
