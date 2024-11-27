@extends('layouts.master_backend_new')
@section('content')
@php
  $isEditMode=false;
  $heading=lang_trans('btn_add');
  $calculatedAmount = calcLaundryAmount(null, 1);
  if(isset($data_row) && !empty($data_row)){
      $isEditMode=true;
      $heading=lang_trans('btn_update');
      $calculatedAmount = calcLaundryAmount($data_row, 1);
  }
  $gstApply = $calculatedAmount['gstApply'];
  $gstPerc = $calculatedAmount['gstPerc'];
  $cgstPerc = $calculatedAmount['cgstPerc'];
  $gstAmount = $calculatedAmount['gstAmount'];
  $cgstAmount = $calculatedAmount['cgstAmount'];
  $totalDiscount = $calculatedAmount['totalDiscount'];
  $subtotalAmount = $calculatedAmount['subtotalAmount'];
  $totalAmount = $calculatedAmount['totalAmount'];

  $isShowFinalStepElem = ($isEditMode && $data_row->order_status == 2) ? true : false;
@endphp







@if($isEditMode==1)
    {{ Form::model($data_row,array('url'=>route('save-laundry-order'),'id'=>"laundry-order-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
    {{Form::hidden('id',null)}}
@else
    {{ Form::open(array('url'=>route('save-laundry-order'),'id'=>"laundry-order-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
@endif



<section id="basic-datatable">

      <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{lang_trans('txt_order')}}</h4>
              </div>
              <div class="card-body">
                
                        <div class="row">  
                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="category">{{lang_trans('txt_select_vendor')}}</label>
                                  {{ Form::select('vendor_id',$vendor_list,null,['class'=>'form-select invoice-repeater','placeholder'=>lang_trans('ph_select')]) }}
                              </div>
                          </div>
                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="date_from">{{lang_trans('txt_room')}}</label>
                                  {{ Form::select('room_id',$room_list,null,['class'=>'form-select','placeholder'=>lang_trans('ph_select')]) }}
                              </div>
                          </div>
                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="date_to">{{lang_trans('txt_laundry_order_status')}}</label>
                                  {{ Form::select('order_status',$status_list,null,['class'=>'form-select','placeholder'=>lang_trans('ph_select'), 'readonly'=>$isEditMode, 'disabled'=>$isEditMode]) }}
                              </div>
                          </div>

                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="date_to">{{lang_trans('txt_order_date')}}</label>
                                  {{Form::text('order_date',date('Y-m-d'),['class'=>"form-control col-md-6 col-xs-12 datepicker", "id"=>"order_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                              </div>
                          </div>

                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="date_to">{{lang_trans('txt_remark')}}</label>
                                
                                  {{Form::textarea('remark',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"remark", "rows"=>1])}}
                              </div>
                          </div>
                        </div>

                        @if($isShowFinalStepElem)


                        <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="date_to">{{lang_trans('txt_remark')}}</label>
                                
                                  {{Form::textarea('remark',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"remark", "rows"=>1])}}
                            </div>
                        </div>
                      </div>

                        <div class="row">  
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="category">{{lang_trans('txt_rcv_date')}}</label>
                                    {{Form::text('received_date',date('Y-m-d'),['class'=>"form-control col-md-6 col-xs-12 datepicker", "id"=>"received_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="category">{{lang_trans('txt_rcvd_invoice')}}</label>
                                    {{Form::file('invoice[]',['class'=>"form-control",'id'=>'received_invoice','multiple'=>true])}}
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="category">{{lang_trans('txt_rcvd_invoice_num')}}</label>
                                    {{Form::text('invoice_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"invoice_num"])}}
                                </div>
                            </div>
                          </div>



               
                        @endif


                      <div class="row">  
                          <h4 class="card-title">{{lang_trans('heading_guest_info')}}</h4>
                          <div class="col-md-3 mb-1">
                              <label class="form-label" for="select2-ajax">{{lang_trans('txt_firstname')}}</label>
                              <div class="mb-1">
                                  <!-- <select name="customer_name" class="select2-data-ajax form-select" id="search_guest" ></select> -->
                                  {{Form::text('customer_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_firstname')])}}
                              </div>
                          </div>

                          <div class="col-xl-3 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="category">{{lang_trans('txt_email')}}</label>
                                    {{Form::email('customer_email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                                </div>
                            </div>

                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="category">{{lang_trans('txt_mobile_num')}}</label>
                                  {{Form::text('customer_mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                              </div>
                          </div>

                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="category">{{lang_trans('txt_address')}}</label>
                                  {{Form::textarea('customer_address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                              </div>
                          </div>

                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="category">{{lang_trans('txt_gender')}}</label>
                                  {{ Form::select('customer_gender',config('constants.GENDER'),null,['class'=>'form-select col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                              </div>
                          </div>
                          

                        </div>
                        <!-- start -->
                        <!-- <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>{{lang_trans('txt_laundry_item')}}</h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <div class="laundry_item_parent">
                                                    @if(!$isEditMode)
                                                      @ include('backend/includes/laundry_item_form', ['show_label'=>true, 'show_plus_btn'=>true])

                                                      <div data-repeater-list="invoice">
                                                                                    <div data-repeater-item>
                                                                                        <div class="row d-flex align-items-end">
                                                                                            <div class="col-md-4 col-12">
                                                                                                <div class="mb-1">
                                                                                                    <label class="form-label" for="itemname">Item Name</label>
                                                                                                    <input type="text" class="form-control" id="itemname" aria-describedby="itemname" placeholder="Vuexy Admin Template" />
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-2 col-12">
                                                                                                <div class="mb-1">
                                                                                                    <label class="form-label" for="itemcost">Cost</label>
                                                                                                    <input type="number" class="form-control" id="itemcost" aria-describedby="itemcost" placeholder="32" />
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-2 col-12">
                                                                                                <div class="mb-1">
                                                                                                    <label class="form-label" for="itemquantity">Quantity</label>
                                                                                                    <input type="number" class="form-control" id="itemquantity" aria-describedby="itemquantity" placeholder="1" />
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-2 col-12">
                                                                                                <div class="mb-1">
                                                                                                    <label class="form-label" for="staticprice">Price</label>
                                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticprice" value="$32" />
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-2 col-12 mb-50">
                                                                                                <div class="mb-1">
                                                                                                    <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                                                        <i data-feather="x" class="me-25"></i>
                                                                                                        <span>Delete</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                                                            <i data-feather="plus" class="me-25"></i>
                                                                                            <span>Add New</span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                     


                                                    @endif

                                                    @if($isEditMode)
                                                      @forelse($data_row->order_items as $key=>$item)
                                                        @php
                                                          $show_label = ($key == 0) ? true : false;
                                                          $show_plus_btn = ($key == 0) ? true : false;
                                                        @endphp
                                                        < !-- @ include('backend/includes/laundry_item_form', ['show_label'=>$show_label, 'show_plus_btn'=>$show_plus_btn, 'item'=>$item]) -- >



                                                      @empty
                                                        < !-- @ include('backend/includes/laundry_item_form', ['show_label'=>true, 'show_plus_btn'=>true]) - ->
                                                      @endforelse
                                                    @endif
                                                </div>


                                                  <! -- <div>
                                                    <table class="table table-bordered">
                                                      <tr>
                                                        <th class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[subtotal]',$subtotalAmount,['id'=>'subtotal'])}}</th>
                                                        <td width="25%" class="text-right" id="td_subtotal">{{getCurrencySymbol()}} {{$subtotalAmount}}</td>
                                                      </tr>
                                                      <tr>
                                                        <th class="text-right">{{lang_trans('txt_gst_apply')}}</th>
                                                        <td width="25%">{{ Form::checkbox('gst_apply',$gstApply,($gstApply==1) ? true : false,['id'=>'apply_gst']) }}</td>
                                                      </tr>
                                                      <tr>
                                                        <th class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPerc}}%) {{Form::hidden('amount[total_gst_amount]',null,['id'=>'total_gst_amount'])}}</th>
                                                        <td width="25%" id="td_total_gst_amount" class="text-right">{{getCurrencySymbol()}} {{ $gstAmount }}</td>
                                                      </tr>
                                                      <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                                        <th class="text-right">{{lang_trans('txt_cgst')}} ({{$cgstPerc}}%) {{Form::hidden('amount[total_cgst_amount]',null,['id'=>'total_cgst_amount'])}}</th>
                                                        <td width="25%" id="td_total_cgst_amount" class="text-right">{{getCurrencySymbol()}} {{ $cgstAmount }}</td>
                                                      </tr>
                                                      <tr>
                                                        <th class="text-right">{{lang_trans('txt_discount')}}</th>
                                                        <td width="25%" id="td_advance_amount" class="text-right">
                                                          <div class="col-md-12 col-sm-12 col-xs-12 p-left-0 p-right-0">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                                              {{Form::number('amount[discount_amount]',$totalDiscount,['class'=>"form-control", "id"=>"discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                                              {{ Form::select('amount[laundry_discount_in]',config('constants.DISCOUNT_TYPES'),'amt',['class'=>'form-control', "id"=>"laundry_discount_in"]) }}
                                                            </div>
                                                          </div>
                                                          <span class="error discount_err_msg"></span>
                                                        </td>
                                                      </tr>
                                                      <tr class="bg-warning">
                                                        <th class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[total_amount]',$totalAmount,['id'=>'total_amount'])}}</th>
                                                        <td width="25%" id="td_total_amount" class="text-right">{{getCurrencySymbol()}} {{$totalAmount}}</td>
                                                      </tr>
                                                    </table>
                                                  </div> - ->

                                                <div class="ln_solid"></div>
                                                <! -- <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                                  <! -- <button class="btn btn-success btn-submit-form {{$isShowFinalStepElem ? 'confirm_form' : ''}}" data-form="laundry-order-form" type="submit" disabled_>{{ ($isShowFinalStepElem) ? lang_trans('btn_complete_order') : lang_trans('btn_submit') }}</button> -->
                                                <!-- </div>  - ->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                         <!-- end -->

                         <div class="laundry_item_parent">
                                @if(!$isEditMode)
                                @include('backend/includes/laundry_item_form', ['show_label'=>true, 'show_plus_btn'=>true])
                                @endif

                                @if($isEditMode)
                                @forelse($data_row->order_items as $key=>$item)
                                    @php
                                    $show_label = ($key == 0) ? true : false;
                                    $show_plus_btn = ($key == 0) ? true : false;
                                    @endphp
                                    @include('backend/includes/laundry_item_form', ['show_label'=>$show_label, 'show_plus_btn'=>$show_plus_btn, 'item'=>$item])
                                @empty
                                    @include('backend/includes/laundry_item_form', ['show_label'=>true, 'show_plus_btn'=>true])
                                @endforelse
                                @endif
                            </div> 
                                        

                                        <table class="table table-striped table-bordered">
                                            <tr>
                                            <th class="text-right" style="float: right;" width="30%">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[subtotal]',$subtotalAmount,['id'=>'subtotal'])}}</th>
                                            <td width="20%" id="td_subtotal">{{getCurrencySymbol()}} {{$subtotalAmount}}</td>
                                            </tr>
                                            <tr>
                                            <th class="text-right" style="float: right;" width="30%">{{lang_trans('txt_gst_apply')}}</th>
                                            <td width="20%">{{ Form::checkbox('gst_apply',$gstApply,($gstApply==1) ? true : false,['id'=>'apply_gst', 'class' => 'form-check-input']) }}</td>
                                            </tr>
                                            <tr>
                                            <th class="text-right" style="float: right;" width="30%">{{lang_trans('txt_sgst')}} ({{$gstPerc}}%) {{Form::hidden('amount[total_gst_amount]',null,['id'=>'total_gst_amount'])}}</th>
                                            <td width="20%" id="td_total_gst_amount" class="text-right">{{getCurrencySymbol()}} {{ $gstAmount }}</td>
                                            </tr>
                                            <tr>
                                            <th class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}" style="float: right;" width="30%">{{lang_trans('txt_cgst')}} ({{$cgstPerc}}%) {{Form::hidden('amount[total_cgst_amount]',null,['id'=>'total_cgst_amount'])}}</th>
                                            <td width="20%" id="td_total_cgst_amount" class="text-right">{{getCurrencySymbol()}} {{ $cgstAmount }}</td>
                                            </tr>
                                            <tr>
                                            <th class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}" style="float: right;" width="30%">{{lang_trans('txt_cgst')}} ({{$cgstPerc}}%) {{Form::hidden('amount[total_cgst_amount]',null,['id'=>'total_cgst_amount'])}}</th>
                                            <td width="20%" id="td_total_cgst_amount" class="text-right">{{getCurrencySymbol()}} {{ $cgstAmount }}</td>
                                            </tr>
                                            <tr>
                                            <th class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}" style="float: right;" width="30%">{{lang_trans('txt_cgst')}} ({{$cgstPerc}}%) {{Form::hidden('amount[total_cgst_amount]',null,['id'=>'total_cgst_amount'])}}</th>
                                            <td width="20%" id="td_total_cgst_amount" class="text-right">{{getCurrencySymbol()}} {{ $cgstAmount }}</td>
                                            </tr>
                                            <tr>
                                            <th style="float: right;" width="30%" class="text-right">{{lang_trans('txt_discount')}}</th>
                                            <td width="20%" id="td_advance_amount" class="text-right">
                                                <div class="row col-md-12 col-sm-12 col-xs-12 p-left-0 p-right-0">
                                                <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0" style="padding-right:0px; padding-left: 0px;">
                                                    {{Form::number('amount[discount_amount]',$totalDiscount,['class'=>"form-control", "id"=>"discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0" style="padding-right:0px; padding-left: 0px;">
                                                    {{ Form::select('amount[laundry_discount_in]',config('constants.DISCOUNT_TYPES'),'amt',['class'=>'form-select', "id"=>"laundry_discount_in"]) }}
                                                </div>
                                                </div>
                                                <span class="error discount_err_msg"></span>
                                            </td>
                                            </tr>
                                            <tr class="">
                                            <th style="float: right;" width="30%" class="text-right bg-warning">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[total_amount]',$totalAmount,['id'=>'total_amount'])}}</th>
                                            <td width="20%" id="td_total_amount" class="text-right bg-warning">{{getCurrencySymbol()}} {{$totalAmount}}</td>
                                            </tr>
                                        </table>

                                    <div class="col-xl-3 col-md-6 col-12">
                                        <div class="mb-1">
                                        <br>
                                        <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                                        <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button>
                                        </div>
                                    </div>
                       
                      </div>
                    {{ Form::close() }}
              </div>
            </div>
        </div>
      </div>


    
</section>



<!-- <div class="colne_laundry_item_elem hide_elem">
  @ include('backend/includes/laundry_item_form', ['show_label'=>false, 'show_plus_btn'=>false, 'blank_form'=>true])
</div> -->
{{-- require set var in js var --}}
<script>
  // globalVar.page = 'laundry_order_add_edit';
  // globalVar.customerList = {!! json_encode($customer_list) !!};
  // globalVar.applyGst = {{$gstApply}};
  // globalVar.gstPercent = {{$gstPerc}};
  // globalVar.cgstPercent = {{$cgstPerc}};
  // globalVar.gstAmount = {{$gstAmount}};
  // globalVar.cgstAmount = {{$cgstAmount}};
  // globalVar.subtotalAmount = {{$subtotalAmount}};
  // globalVar.totalAmount = {{$totalAmount}};
  // globalVar.discount = {{$totalDiscount}};
  // globalVar.isError = false;
</script>
<!-- <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script> -->
@endsection
@section('scripts')

  <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/pages/app-invoice.js')}}"></script>
@endsection
