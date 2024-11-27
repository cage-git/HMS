



@extends('layouts.master_backend')
@section('content')

@php
  $userRole = Auth::user()->role_id;
  $settings = getSettings();
  $days_array = [];
  for($i=0; $i <= $data_row->duration_of_stay; $i++):
    $days_array[$i] = $i;
  endfor;

  $calculatedAmount = calcFinalAmount($data_row, 1);
  $gstPerc = $calculatedAmount['totalRoomGstPerc'];
  $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
  $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
  $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
  $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
  $advancePayment = $calculatedAmount['advancePayment'];
  $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
  $finalRoomAmount = $calculatedAmount['finalRoomAmount'];

  $gstPercFood = $calculatedAmount['totalOrderGstPerc'];
  $cgstPercFood = $calculatedAmount['totalOrderCGstPerc'];
  $foodAmountGst = $calculatedAmount['totalOrderAmountGst'];
  $foodAmountCGst = $calculatedAmount['totalOrderAmountCGst'];
  $foodOrderAmountDiscount = $calculatedAmount['totalOrderAmountDiscount'];
  $gstFoodApply = $calculatedAmount['gstFoodApply'];
  $totalOrdersAmount = $calculatedAmount['subtotalOrderAmount'];
  $finalOrderAmount = $calculatedAmount['finalOrderAmount'];

  $additionalAmount = $calculatedAmount['additionalAmount'];
  $additionalAmountReason = $data_row->additional_amount_reason;

  $finalAmount = $finalRoomAmount+$finalOrderAmount+$additionalAmount;
@endphp

<div class="">

      {{ Form::model($data_row,array('url'=>route('cancel-reservation-submit', [$data_row->id]),'id'=>"check-out-form", 'class'=>"form-horizontal form-label-left",'files'=>true,'autocomplete'=>"off")) }}
      {{Form::hidden('id',null)}}


  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
                  <div class="row">
                    <div class="x_title">
                        <h2>{{lang_trans('ministory_of_tourism_section_for_cancellation')}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label class="control-label"> {{lang_trans('txt_cancel_reason')}} <span class="required">*</span></label>
                            {{ Form::select('mt_cancel_reason',getDynamicDropdownList('booking_cancel_reasons', true),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label class="control-label"> {{lang_trans('txt_cancel_with_charges')}} <span class="required">*</span></label>
                            {{ Form::select('mt_cancel_with_charges',getDynamicDropdownList('cancel_with_charges', true),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label class="control-label"> {{lang_trans('txt_chargeable_days')}} <span class="required">*</span></label>
                            {{ Form::select('mt_chargeable_days',$days_array,null,['class'=>'form-control col-md-6 col-xs-12', 'required'=>'required']) }}
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
  globalVar.additionalAmount = {{$additionalAmount}};
  globalVar.isError = false;
  globalVar.startDate = moment("{{$data_row->check_in}}", "YYYY.MM.DD");
</script>
 <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script>
@endsection
