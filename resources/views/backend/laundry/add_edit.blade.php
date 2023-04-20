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

// New changes


  $settings = getSettings();
 // dd($settings);
// $gstApply = $settings['gst'];
  $gstPerc = $settings['gst'];
//  $cgstPerc = $settings['cgst'];
//  $gstAmount = $settings['gstAmount'];
// $cgstAmount = $settings['cgstAmount'];
//  $subtotalAmount = $settings['subtotalAmount'];
//  $totalAmount = $settings['totalAmount'];
//  $totalDiscount = $settings['totalDiscount'];

@endphp





@if($isEditMode==1)
    {{ Form::model($data_row,array('url'=>route('save-laundry-order'),'id'=>"laundry-order-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
    {{Form::hidden('id',null)}}
@else
    {{ Form::open(array('url'=>route('save-laundry-order'),'id'=>"laundry-order-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
@endif

<style>
  .remove_padding{
    padding-left: 0px;
    padding-right: 0px;
  }

  .hide_elem{
    display:none;
  }
</style>

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
                                  {{ Form::select('vendor_id',$vendor_list,null,['class'=>'form-select','placeholder'=>lang_trans('ph_select')]) }}
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


                        @if(!$isEditMode)
                          <!-- <div class="row">
                            <div class="ln_solid"></div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-2 col-sm-2 col-xs-12">
                                {{Form::radio('guest_type','new',true,['class'=>"flat guest_type", 'id'=>'new_guest'])}} <label for="new_guest">{{lang_trans('txt_new_guest')}}</label>
                              </div>
                              <div class="col-md-2 col-sm-2 col-xs-12">
                                {{Form::radio('guest_type','existing',false,['class'=>"flat guest_type", 'id'=>'existing_guest'])}} <label for="existing_guest">{{lang_trans('txt_existing_guest')}}</label>
                              </div>
                            </div>
                          </div> -->

                          <div class="demo-inline-spacing">
                            <div class="form-check form-check-inline">
                                  {{Form::radio('guest_type','new',true,['class'=>"form-check-input guest_type", 'id'=>'new_guest'])}}
                                  <label class="form-check-label" for="inlineRadio1">{{lang_trans('txt_new_guest')}}</label>
                            </div>  
                          </div>

                          <div class="demo-inline-spacing">
                            <div class="form-check form-check-inline">
                            {{Form::radio('guest_type','existing',false,['class'=>"form-check-input guest_type", 'id'=>'existing_guest'])}} 
                                  <label class="form-check-label" for="inlineRadio1">{{lang_trans('txt_existing_guest')}}</label>
                            </div>  
                          </div>
                        @endif

                        <div class="row hide_elem" id="existing_guest_section">  
                          <div class="card-header">
                              <h4 class="card-title">{{lang_trans('heading_existing_guest_list')}}</h4>
                          </div>

                          <div class="col-md-3 mb-1">
                              <label class="form-label" for="select2-ajax">{{lang_trans('txt_guest')}}</label>
                              <div class="mb-1">
                                  <!-- {{Form::text('selected_customer_id',null,['class'=>"form-control", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}} -->

                          <select name="selected_customer_id" class="form-select" >
                        
                                @foreach($customer_list as $val)
                                  <option value="{{$val->id}}">{{$val->display_text}}</option>
                                  @endforeach
                                </select>
                          
                              </div>
                          </div>

                        </div>



                      <div class="row" id="new_guest_section">  
                        <div class="card-header">
                            <h4 class="card-title">{{lang_trans('heading_guest_info')}}</h4>
                        </div>
                    
                          <div class="col-md-3 mb-1">
                              <label class="form-label" for="select2-ajax">{{lang_trans('txt_firstname')}}</label>
                              <div class="mb-1">
                                  <!-- <select name="customer_name" class="select2-data-ajax form-select" id="search_guest" ></select> -->
                                  {{Form::text('customer_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_firstname')])}}
                              </div>
                          </div>

                          <div class="col-xl-3 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="category">{{lang_trans('txt_email')}}</label>
                                    {{Form::email('customer_email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_email')])}}
                                </div>
                            </div>

                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="category">{{lang_trans('txt_mobile_num')}}</label>
                                  {{Form::text('customer_mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_mobile_num')])}}
                              </div>
                          </div>

                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="category">{{lang_trans('txt_address')}}</label>
                                  {{Form::textarea('customer_address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_address'),"rows"=>1])}}
                              </div>
                          </div>

                          <div class="col-xl-3 col-md-6 col-12">
                              <div class="mb-1">
                                  <label class="form-label" for="category">{{lang_trans('txt_gender')}}</label>
                                  {{ Form::select('customer_gender',config('constants.GENDER'),null,['class'=>'form-select col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                              </div>
                          </div>
                          

                        </div>
<!-- 
                @if(!$isEditMode)
                    <div class="row">
                      <div class="ln_solid"></div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          {{Form::radio('guest_type','new',true,['class'=>"flat guest_type", 'id'=>'new_guest'])}} <label for="new_guest">{{lang_trans('txt_new_guest')}}</label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          {{Form::radio('guest_type','existing',false,['class'=>"flat guest_type", 'id'=>'existing_guest'])}} <label for="existing_guest">{{lang_trans('txt_existing_guest')}}</label>
                        </div>
                      </div>
                    </div>
                  @endif

               

                        <div class="row hide_elem" id="existing_guest_section">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_existing_guest_list')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                   <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label">{{lang_trans('txt_guest')}}</label>
                        {{Form::text('selected_customer_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div> 

    <div class="row" id="new_guest_section">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_guest_info')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">

                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_firstname')}} <span class="required">*</span></label>
                      {{Form::text('customer_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_firstname')])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_email')}} </label>
                      {{Form::email('customer_email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_mobile_num')}} <span class="required">*</span></label>
                      {{Form::text('customer_mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_address')}}</label>
                      {{Form::textarea('customer_address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_gender')}} <span class="required">*</span></label>
                        {{ Form::select('customer_gender',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div> -->
                        <!-- end old code  -->

                        
                        <!-- start -->

                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                                      <div class="x_panel">
                                          <div class="x_title">
                                              <h2>{{lang_trans('txt_laundry_item')}}</h2>
                                              <div class="clearfix"></div>
                                          </div>
                                          <div class="x_content">
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
                                              <hr />

                                                <div>
                                                  <table class="table" >
                                                    <tr>
                                                      <th  style="float: right;" width="30%"  class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[subtotal]',$subtotalAmount,['id'=>'subtotal'])}}</th>
                                                      <td width="25%" class="text-right" id="td_subtotal">{{getCurrencySymbol()}} {{$subtotalAmount}}</td>
                                                    </tr>
                                                    <tr>
                                                      <th  style="float: right;" width="30%"  class="text-right">{{lang_trans('txt_gst_apply')}}</th>
                                                      <td width="25%">{{ Form::checkbox('gst_apply',$gstApply,($gstApply==1) ? true : false,['id'=>'apply_gst']) }}</td>
                                                    </tr>
                                                    <tr>
                                                      <th  style="float: right;" width="30%"  class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPerc}}%) {{Form::hidden('amount[total_gst_amount]',null,['id'=>'total_gst_amount'])}}</th>
                                                      <td width="25%" id="td_total_gst_amount" class="text-right">{{getCurrencySymbol()}} {{ $gstAmount }}</td>
                                                    </tr>
                                                    <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                                                      <th  style="float: right;" width="30%"  class="text-right">{{lang_trans('txt_cgst')}} ({{$cgstPerc}}%) {{Form::hidden('amount[total_cgst_amount]',null,['id'=>'total_cgst_amount'])}}</th>
                                                      <td width="25%" id="td_total_cgst_amount" class="text-right">{{getCurrencySymbol()}} {{ $cgstAmount }}</td>
                                                    </tr>
                                                    <tr>
                                                      <th  style="float: right;" width="30%" class="text-right">{{lang_trans('txt_discount')}}</th>
                                                      <td width="25%" id="td_advance_amount" class="text-right">
                                                        <div class="row"  style="height:20px;">
                                                          <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0 remove_padding">
                                                            {{Form::number('amount[discount_amount]',$totalDiscount,['class'=>"form-control", 'style'=>"padding:0.3rem 1rem", "id"=>"discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                                          </div>
                                                          <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0 remove_padding">
                                                            {{ Form::select('amount[laundry_discount_in]',config('constants.DISCOUNT_TYPES'),'amt',['class'=>'form-control', 'style'=>"padding:0.3rem 1rem", "id"=>"laundry_discount_in"]) }}
                                                          </div>
                                                        </div>
                                                        <span class="error discount_err_msg"></span>
                                                      </td>
                                                    </tr>
                                                    <tr class="">
                                                      <th  style="float:right;" width="30%" class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[total_amount]',$totalAmount,['id'=>'total_amount'])}}</th>
                                                      <td width="25%" id="td_total_amount" class="text-right">{{getCurrencySymbol()}} {{$totalAmount}}</td>
                                                    </tr>
                                                  </table>
                                                </div>

                                              <div class="ln_solid"></div>
                                              <!-- <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                                <button class="btn btn-success btn-submit-form {{$isShowFinalStepElem ? 'confirm_form' : ''}}" data-form="laundry-order-form" type="submit" disabled_>{{ ($isShowFinalStepElem) ? lang_trans('btn_complete_order') : lang_trans('btn_submit') }}</button>
                                              </div> -->
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <hr /> 
                              <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                              <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button>
                          </div>

                         <!-- end -->

                        <!-- <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1"> -->
                            <!-- <br> -->
                            <!-- <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button> -->
                            <!-- </div>
                        </div> -->
                       
                      </div>
                    <!-- {{ Form::close() }} -->
              </div>
            </div>
        </div>
      </div>

    <!-- <div class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('txt_order_list')}}</h4>
                    <a href="{{route('add-laundry-order')}}"><button class="btn btn-primary" >{{lang_trans('sidemenu_order_add')}} </button></a>
                </div>
                 
            </div>
        </div>
    </div> -->
    
</section>



<!-- {{ Form::close() }} -->
<!-- <div class="colne_laundry_item_elem hide_elem">
  < !-- @ include('backend/includes/laundry_item_form', ['show_label'=>false, 'show_plus_btn'=>false, 'blank_form'=>true]) -- > 
</div> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
{{-- require set var in js var --}}
<script>
  globalVar.page = 'laundry_order_add_edit';
  globalVar.customerList = {!! json_encode($customer_list) !!};
  globalVar.applyGst = {{$gstApply}};
  globalVar.gstPercent = {{$gstPerc}};
  globalVar.cgstPercent = {{$cgstPerc}};
  globalVar.gstAmount = {{$gstAmount}};
  globalVar.cgstAmount = {{$cgstAmount}};
  globalVar.subtotalAmount = {{$subtotalAmount}};
  globalVar.totalAmount = {{$totalAmount}};
  globalVar.discount = {{$totalDiscount}};
  globalVar.isError = false;
</script>
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script>
@endsection
@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-repeater.js')}}"></script>

  <script>
    (function (window, document, $) {
  'use strict';
  var select = $('.select2'),
    selectIcons = $('.select2-icons'),
    maxLength = $('.max-length'),
    hideSearch = $('.hide-search'),
    selectArray = $('.select2-data-array'),
    selectAjax = $('.select2-data-ajax'),
    selectLg = $('.select2-size-lg'),
    selectSm = $('.select2-size-sm'),
    selectInModal = $('.select2InModal');

  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      // the following code is used to disable x-scrollbar when click in select input and
      // take 100% width in responsive also
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });

  // Select With Icon
  selectIcons.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      dropdownAutoWidth: true,
      width: '100%',
      minimumResultsForSearch: Infinity,
      dropdownParent: $this.parent(),
      templateResult: iconFormat,
      templateSelection: iconFormat,
      escapeMarkup: function (es) {
        return es;
      }
    });
  });

  // Format icon
  function iconFormat(icon) {
    var originalOption = icon.element;
    if (!icon.id) {
      return icon.text;
    }

    var $icon = feather.icons[$(icon.element).data('icon')].toSvg() + icon.text;

    return $icon;
  }

  // Limiting the number of selections
  maxLength.wrap('<div class="position-relative"></div>').select2({
    dropdownAutoWidth: true,
    width: '100%',
    maximumSelectionLength: 2,
    dropdownParent: maxLength.parent(),
    placeholder: 'Select maximum 2 items'
  });

  // Hide Search Box
  hideSearch.select2({
    placeholder: 'Select an option',
    minimumResultsForSearch: Infinity
  });

  // Loading array data
  var data = [
    { id: 0, text: 'enhancement' },
    { id: 1, text: 'bug' },
    { id: 2, text: 'duplicate' },
    { id: 3, text: 'invalid' },
    { id: 4, text: 'wontfix' }
  ];

  selectArray.wrap('<div class="position-relative"></div>').select2({
    dropdownAutoWidth: true,
    dropdownParent: selectArray.parent(),
    width: '100%',
    data: data
  });

  // Loading remote data
  selectAjax.wrap('<div class="position-relative"></div>').select2({
    dropdownAutoWidth: true,
    dropdownParent: selectAjax.parent(),
    width: '100%',
    tags: true,
    ajax: {
      // url: 'https://api.github.com/search/repositories',
      url: '{{route("search-from-customer")}}',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          // q: params.term, // search term
          // page: params.page
          search_from_phone_idcard: params.term, 
          category: "user",
          type: "name",
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        // params.page = params.page || 1;

        return {
          // results: $.map(data.customers, function(obj) {
          //     return { id: obj.mobile , text: obj.name+' '+obj.mobile };
          // })
          results: data.customers,
          // results: data.items,
          // pagination: {
          //   more: params.page * 30 < data.total_count
          // }
        };
      },
      cache: true
    },
    placeholder: 'Search a guest',
    escapeMarkup: function (markup) {
      return markup;
    }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
  });

  function formatRepo(repo) {
    console.log("reo",repo)
    // if (repo.loading) return repo.text;
    if(repo.name){
      var markup =
      "<div class='select2-result-repository clearfix'>" +
      // "<div class='select2-result-repository__avatar'><img src='" +
      // repo.owner.avatar_url +
      // "' /></div>" +
      "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'>" +
      repo.name +
      '</div>';

      if (repo.mobile) {
        markup += "<div class='select2-result-repository__description'>" + repo.mobile + '</div>';
      }
    }else{
      var markup =
      "<div class='select2-result-repository clearfix'>" +
      // "<div class='select2-result-repository__avatar'><img src='" +
      // repo.owner.avatar_url +
      // "' /></div>" +
      "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'>" +
      repo.text +
      '</div>';
    }

    return markup;
  }

  function formatRepoSelection(repo) {
    return repo.name || repo.text;
  }

  // Sizing options

  // Large
  selectLg.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      dropdownAutoWidth: true,
      dropdownParent: $this.parent(),
      width: '100%',
      containerCssClass: 'select-lg'
    });
  });

  // Small
  selectSm.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      dropdownAutoWidth: true,
      dropdownParent: $this.parent(),
      width: '100%',
      containerCssClass: 'select-sm'
    });
  });

  $('#select2InModal').on('shown.bs.modal', function () {
    selectInModal.select2({
      placeholder: 'Select a state'
    });
  });
})(window, document, jQuery);






$(document).on('change', '.guest_type', function(){
  if($("input:radio[name='guest_type'][value='existing']").is(":checked")) { 
    console.log("test");
    $("#existing_guest_section").show();
    $("#new_guest_section").hide();
  }else{
    // console.log("test1");
    $("#existing_guest_section").hide();
    $("#new_guest_section").show();
  }
});


$(document).on('change', '#search_idcard', function(){
    var val = $('#search_idcard').val();      
    var guest_type = $('input:radio[name="guest_type"]:checked').val();
    console.log("val",val);
    getAjaxResponse('idcard_select_div', val, 'user', guest_type, 'search_idcard');
});


function getAjaxResponse(div_id, val, category, guest_type, field_id){
             // var formData = new FormData(this);
            // var search_from_phone_idcard = $("#search_from_phone_idcard").val();
            $.ajax({
                type:'GET',
                url: '{{route("search-from-customer")}}',
                data: {
                    search_from_phone_idcard  : val,
                    category: category,
                },
                dataType: "json",
                success:function(data){
                    // alert( "success");
                    // if(typeof(data) !== 'undefined' ){
                        console.log(data.customers[0], "success");
                        var data = data.customers[0]; 
                        if(data){
                        if(data.cat && data.cat == "user"){
                            // console.log( "success1");
                            setCustomerData(data, div_id);
                        }else if(data.cat && data.cat == "company"){
                            // console.log( "succesxs2");
                            setCompanydata(data, div_id);
                        }
                        }else{
                            console.log("data not found", div_id, val, category, guest_type, field_id);
                            if(field_id == "search_idcard"){
                                $("#idcard_no").val(val);
                            }else if(field_id == "search_phone"){

                                $("#mobile").val(val);
                            }else if(field_id == "search_companyname"){
                                $("#company_name").val(val);
                                $("#guest_type_category").val("new_company");
                            }else if(field_id == "search_companyphone"){
                                $("#company_mobile").val(val); 
                                $("#guest_type_category").val("new_company");
                            }

                        }
                },
                error: function(error){
                    console.log("error", error);
                }
            });
        }


        function setCompanydata(data_customer, id){

          console.log("company data");
          if(id == "companyname_select_div"){
              $('#idcard_input_div').show();
              $('#idcard_select_div').hide();
              $('#companyphone_input_div').show();
              $('#companyphone_select_div').hide();
          }else if(id == "idcard_select_div"){
              $('#companyname_select_div').hide();
              $('#companyname_input_div').show();
              $('#companyphone_input_div').show();
              $('#companyphone_select_div').hide();
          }else if(id == "companyphone_select_div"){
              $('#companyname_select_div').hide();
              $('#companyname_input_div').show();
              $('#idcard_input_div').show();
              $('#idcard_select_div').hide();
          }

          $("#company_name").val(data_customer.name);
          $('#guest_type_category').val('existing_company');
          $("#company_gst_num").val(data_customer.company_gst_num);
          $("#type_of_ids_selector").val(data_customer.idcard_type);
          $("#company_email").val(data_customer.email);
          $("#company_mobile").val(data_customer.mobile);                
          $("#company_address").val(data_customer.address);
          $("#company_country").val(data_customer.country);
          $("#company_state").val(data_customer.state);
          $("#company_city").val(data_customer.city);
          $("#selected_customer_id").val(data_customer.id);
          if(data_customer.dob !=""){
              $("#dob").val(data_customer.dob);
          }else{
              $("#dob").val("");
          }

          }

      function setCustomerData(data_customer, id){
          console.log(id);
          // setCustomerNull();
          if(id == "mobile_select_div"){
              $('#idcard_input_div').show();
              $('#idcard_select_div').hide();
          }else if(id == "idcard_select_div"){
              $('#mobile_input_div').show();
              $('#mobile_select_div').hide();
          }
          console.log("testing", data_customer);

          $('#guest_type_category').val('existing');
          $("#idcard_no").val(data_customer.id_card_no);
          $("#type_of_ids_selector").val(data_customer.idcard_type);
          $("#mobile").val(data_customer.mobile);
          $("#surname").val(data_customer.surname);
          $("#name").val(data_customer.name);
          $("#middle_name").val(data_customer.namiddle_nameme);
          $("#email").val(data_customer.email);
          $("#address").val(data_customer.address);
          $("#country").val(data_customer.country);
          $("#state").val(data_customer.state);
          $("#city").val(data_customer.city);
          $("#gender").val(data_customer.gender);
          $("#dob").val(data_customer.dob);
          $("#selected_customer_id").val(data_customer.id);
          if(data_customer.dob !=""){
              $("#dob").val(data_customer.dob);
          }else{
              $("#dob").val("");
          }
      }

      function setCompanyNull(){
          $('#guest_type_category').val('new');
          $("#company_name").val('');
          $("#company_gst_num").val('');
          $("#type_of_ids_selector").val('');
          $("#company_email").val('');
          $("#company_mobile").val('');                
          $("#company_address").val('');
          $("#company_country").val('');
          $("#company_state").val('');
          $("#company_city").val('');
          $("#selected_customer_id").val('');
          }

          function setCustomerNull(){
          $('#guest_type_category').val('new');
          $("#type_of_ids_selector").val('');
          $("#surname").val('');
          $("#name").val('');
          $("#middle_name").val('');
          $("#email").val('');
          $("#mobile").val('');
          $("#address").val('');
          $("#country").val('');
          $("#state").val('');
          $("#city").val('');
          $("#gender").val('');
          $("#dob").val('');
          $("#selected_customer_id").val('');
      }

</script>
  <!-- <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script> -->
  <!-- <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script> -->
<!-- END: Page JS-->
@endsection

@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
<!-- END: Page JS-->
@endsection
