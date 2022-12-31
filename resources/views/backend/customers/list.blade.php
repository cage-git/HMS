@extends('layouts.master_backend')
@section('content')
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2>{{lang_trans('heading_filter_customer')}}</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
              {{ Form::model($search_data,array('url'=>route('search-customer'),'id'=>"search-customer", 'class'=>"form-horizontal form-label-left")) }}
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_fullname')}}</label>
                  {{Form::text('customer_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_mobile_num')}}</label>
                  {{Form::text('mobile_num',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_city')}}</label>
                  {{Form::text('city',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_city')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_state')}}</label>
                  {{Form::text('state',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_state')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_country')}}</label>
                  {{Form::text('country',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_country')])}}
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
  </div>
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_list_customers')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_fullname')}}</th>
{{--                      <th>{{lang_trans('txt_father_name')}}</th>--}}
                      <th>{{lang_trans('txt_mobile_num')}}</th>
{{--                      <th>{{lang_trans('txt_email')}}</th>--}}
{{--                      <th>{{lang_trans('txt_gender')}}</th>--}}
                      <th>{{lang_trans('txt_address')}}</th>
                      <th>{{lang_trans('txt_reservations')}}</th>
{{--                      <th>{{lang_trans('txt_nationality')}}</th>--}}
{{--                      <th>{{lang_trans('txt_country')}}</th>--}}
{{--                      <th>{{lang_trans('txt_state')}}</th>--}}
{{--                      <th>{{lang_trans('txt_city')}}</th>--}}
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                        @php
                            $data_rows = \App\Reservation::with('orders_items','orders_info', 'booked_rooms')->whereCustomerId($val->id)->get();
                        @endphp
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->name}}</td>
{{--                        <td>{{$val->father_name}}</td>--}}
                        <td>{{$val->mobile}}</td>
{{--                        <td>{{$val->email}}</td>--}}
{{--                        <td>{{$val->gender}}</td>--}}
                        <td>{{$val->address}}</td>
                        <td>
                            <div style="max-height: 110px; overflow: scroll;">
                            <?php


                                foreach ($data_rows as $k => $data_row){
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

                                    ?>

                                {{lang_trans('txt_reservation')}} {{$k+1}} : <a class="btn btn-xs btn-primary" href="{{route('view-reservation',[$data_row->id])}}" target="_blank">{{lang_trans('btn_view')}}</a>
{{--                                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#booked_room_{{$data_row->id}}">--}}
{{--                                    {{lang_trans('btn_view')}} {{lang_trans('txt_room')}}--}}
{{--                                </button> --}}
                                <?php
                                if($dueAmount > 0){
                                    echo 'Balance: '. numberFormat($dueAmount);
                                }else{
                                    echo 'Balance: '. numberFormat($dueAmount);
                                }

                                ?><br/>
                                @include('backend/model/booked_rooms_modal',['val'=>$data_row])
                            <?php

                                }
                            ?>


                            </div>
                        </td>
{{--                        <td>{{@config('constants.NATIONALITY_LIST')[$val->nationality]}}</td>--}}
{{--                        <td>{{$val->country}}</td>--}}
{{--                        <td>{{$val->state}}</td>--}}
{{--                        <td>{{$val->city}}</td>--}}
                        <td>
                          <a class="btn btn-sm btn-info" href="{{route('edit-customer',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>
<script>
  globalVar.customerList = {!! json_encode($customer_list) !!};
</script>
@endsection
