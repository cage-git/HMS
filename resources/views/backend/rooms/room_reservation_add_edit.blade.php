@extends('layouts.master_backend_new')
@section('content')

{{--    $quickCheckIn = (Request::route()->action['as'] == 'quick-check-in') ? true : false;--}}
@php
    $quickCheckIn = false;
    $flag=0;
    $heading=lang_trans('btn_add');
    if(isset($data_row) && !empty($data_row)){
        $flag=1;
        $heading=lang_trans('btn_update');
    }
    $lang = getSettings('site_language');
    $RESERVATION_TYPE = getSettings('site_language') == 'ar'? config('constants.RESERVATION_TYPE_AR'): config('constants.RESERVATION_TYPE');
    $PAYMENT_MODES= getSettings('site_language') == 'ar'? config('constants.PAYMENT_MODES_AR'): config('constants.PAYMENT_MODES');
    $GENDER= getSettings('site_language') == 'ar'? config('constants.GENDER_AR'): config('constants.GENDER');

  @endphp

<style>
    .hide_elem{
       display:none;
    }
    .per_item_elem:first-child .align-items-end .delete_btn {
        display: none;
    } 
</style>


<div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{lang_trans('heading_guest_type')}}</h4>
            </div>
            <div class="card-body">
                @if($flag==1)
                    {{ Form::model($data_row,array('url'=>route('save-reservation'),'id'=>"update-reservation-form", 'class'=>"form-horizontal form-label-left",'files'=>true)) }}
                    {{Form::hidden('id',null)}}
                @else
                    {{ Form::open(array('url'=>route('save-reservation'),'id'=>"add-reservation-form", 'class'=>"form-horizontal form-label-left",'files'=>true)) }}
                @endif
                        <div class="row">
                                <div class="col-xl-8 col-md-6 col-12">
                                    <div class="demo-inline-spacing">
                                        <div class="form-check form-check-primary">

                                            <label class="form-check-label" for="new_guest">{{Form::radio('guest_type','new',true,['class'=>"form-check-input guest_type", 'id'=>'new_guest'])}}
                                            {{lang_trans('txt_new_guest')}}</label>
                                        </div>
                                        <div class="form-check form-check-primary">

                                            <label class="form-check-label" for="new_company">{{Form::radio('guest_type','new_company',false,['class'=>"form-check-input guest_type", 'id'=>'new_company'])}}
                                            {{lang_trans('txt_new_company')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_reservation_type')}}</label>
                                        {{ Form::select('reservation_type',$RESERVATION_TYPE,null,['class'=>'form-select']) }}

                                    </div>
                                </div>
                        </div>

                        <hr />

                        <div class="row">
                                <h4 class="card-title"> {{lang_trans('heading_search_from_customer')}}</h4>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_search_from_phone_idcard')}}</label>

                                        <select name="customer_name" class="select2-data-ajax form-select" id="search_customer" ></select>
                                    </div>
                                </div>
                        </div>

                        <hr />

                        @if(!$quickCheckIn)
                        <div class="row">

                                <h4 class="card-title"> {{lang_trans('heading_idcard_info')}}</h4>

                                <div class="col-xl-4 col-md-6 col-12" id="idcard_select_div">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_id_number">{{lang_trans('txt_id_number')}}</label>
                                        <select class="select2-data-ajax form-select" id="search_from_phone_idcard">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12"  id="idcard_input_div" style="display:none;">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_id_number">{{lang_trans('txt_id_number')}}</label>
                                            <label class="control-label"> {{lang_trans('txt_id_number')}} <span class="required">*</span> </label>
                                            {{Form::text('idcard_no',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_id_number')])}}
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_type_id">{{lang_trans('txt_type_id')}}</label>
                                        {{ Form::select('idcard_type',getDynamicDropdownList('type_of_ids', false, $lang),null,['class'=>'form-select col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'id'=>'type_of_ids_selector']) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_type_id">{{lang_trans('txt_gender')}}</label>
                                        {{ Form::select('gender',$GENDER,null,['class'=>'form-select col-md-6 col-xs-12', "id"=>"gender",'placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                @if(!$quickCheckIn)
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="txt_type_id">{{lang_trans('txt_dob')}}</label>
                                            {{Form::date('dob',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"dob", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_dob')])}}
                                        </div>
                                    </div>
                                @endif


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_type_id">{{lang_trans('txt_reason_of_visit')}}</label>
                                        {{Form::textarea('reason_visit_stay',null,['class'=>"form-control h34 col-md-6 col-xs-12", "id"=>"reason_visit_stay", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_reason_of_visit'),"rows"=>1])}}
                                    </div>
                                </div>


                        </div>
                    @endif

                        <hr />

                        <div class="row" id="new_guest_section">
                                <h4 class="card-title"> {{lang_trans('heading_guest_info')}}</h4>

                                <input name="guest_type_category" id="guest_type_category" value="new" type="hidden" />
                                <input name="selected_customer_id" id="selected_customer_id" value="" type="hidden" />

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_firstname')}}</label>
                                        {{Form::text('name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_firstname')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_surname')}}</label>
                                        {{Form::text('surname',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"surname", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_surname')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_email')}}</label>
                                        {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_email')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12" id="mobile_select_div" >
                                    <div class="mb-1" >
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_mobile_num')}}</label>
                                        <select class="select2-data-ajax form-select" id="search_customer_from_phone">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12"  id="mobile_input_div" style="display:none;">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_mobile_num')}}</label>
                                        {{Form::text('mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_mobile_num')])}}
                                    </div>
                                </div>
                                <!-- <input name="mobile"> -->

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_address')}}</label>
                                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_address'),"rows"=>1])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_country')}}</label>
                                        {{ Form::select('country',getCountryList(),getSettings('default_country'),['class'=>'form-select col-md-6 col-xs-12', "id"=>"country", 'placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_state')}}</label>
                                        {{Form::text('state',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"state", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_state')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_city')}}</label>
                                        {{Form::text('city',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"city", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_city')])}}
                                    </div>
                                </div>


                        </div>

                        <div class="row " id="new_company_section">
                                <h4 class="card-title"> {{lang_trans('heading_company_info')}}</h4>

                                <div class="col-xl-4 col-md-6 col-12" id="companyname_select_div">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_name')}}</label>
                                        <select class="select2-data-ajax form-select" id="search_from_company_name">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12"  id="companyname_input_div" style="display:none;">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_id_number">{{lang_trans('txt_company_name')}}</label>
                                            <!-- <label class="control-label"> {{lang_trans('txt_company_name')}} <span class="required">*</span> </label> -->
                                            {{Form::text('company_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_name", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_id_number')])}}
                                    </div>
                                </div>

<!--

                                <div class="col-xl-4 col-md-6 col-12" id="idcard_select_div">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_id_number">{{lang_trans('txt_id_number')}}</label>
                                        <select class="select2-data-ajax form-select" id="search_from_phone_idcard">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12"  id="idcard_input_div" style="display:none;">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_id_number">{{lang_trans('txt_id_number')}}</label>
                                            <label class="control-label"> {{lang_trans('txt_id_number')}} <span class="required">*</span> </label>
                                            {{Form::text('idcard_no',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_id_number')])}}
                                    </div>
                                </div>

-->

                                <!-- <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_name')}}</label>

                                    </div>
                                </div> -->

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_gst_num')}}</label>
                                        {{Form::text('company_gst_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_gst_num", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_company_gst_num')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_email')}}</label>
                                        {{Form::email('company_email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_email", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_company_email')])}}
                                    </div>
                                </div>

                                <!-- <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_mobile_num')}}</label>
                                        <select class="select2-data-ajax form-select" id="search_from_company_phone">
                                            <! -- <option value="" disable>Please enter a phone number and ID card number</option> - ->
                                        </select>
                                    </div>
                                </div> -->

                                <!-- new changes -->

                                <div class="col-xl-4 col-md-6 col-12" id="companyphone_select_div">
                                    <div class="mb-1">
                                    <label class="form-label" for="season_start_date">{{lang_trans('txt_company_mobile_num')}}</label>
                                        <select class="select2-data-ajax form-select" id="search_from_company_phone">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12"  id="companyphone_input_div" style="display:none;">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_id_number">{{lang_trans('txt_company_mobile_num')}}</label>
                                        {{Form::text('company_mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_mobile", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_id_number')])}}
                                    </div>
                                </div>

                                <!-- end new changes -->

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_address')}}</label>
                                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_address", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_address'),"rows"=>1])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_country')}}</label>
                                        {{ Form::select('company_country',getCountryList(),getSettings('default_country'),['class'=>'form-select col-md-6 col-xs-12', "id"=>"company_country", 'placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_state')}}</label>
                                        {{Form::text('company_state',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_state", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_company_state')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_city')}}</label>
                                        {{Form::text('company_city',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_city", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_company_city')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_remark')}}</label>
                                        {{Form::textarea('remark',null,['class'=>"form-control h34 col-md-6 col-xs-12", "id"=>"remark", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_remark'),"rows"=>1])}}
                                    </div>
                                </div>


                        </div>

                        <hr />


                        <div class="row">
                                <h4 class="card-title"> {{lang_trans('heading_checkin_info')}}</h4>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_checkin')}}</label>
                                        {{Form::text('check_in_date',null,['class'=>"form-control col-md-6 col-xs-12  flatpickr-basic", "id"=>"check_in_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off", "readonly"=>true])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_checkout')}}</label>
                                        {{Form::text('check_out_date',null,['class'=>"form-control col-md-6 col-xs-12  flatpickr-basic", "id"=>"check_out_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off", "readonly"=>true])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_duration_of_stay')}}</label>
                                        {{Form::number('duration_of_stay',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"duration_of_stay", "placeholder"=>lang_trans('ph_day_night'),"min"=>1, "readonly"=>true])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_adults')}}</label>
                                        {{Form::number('adult',1,['class'=>"form-control col-md-7 col-xs-12", "id"=>"adult", "required"=>"required","placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_adults'),"min"=>1])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_kids')}}</label>
                                        {{Form::number('kids',0,['class'=>"form-control col-md-7 col-xs-12", "id"=>"kids", "required"=>"required","placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_kids'),"min"=>0])}}
                                    </div>
                                </div>


                        </div>

                        <hr />


                        <!-- <div class="">
                            @foreach($roomtypes_list as $k=>$val)
                                @php
                                    $change_value = explode('||',$val);
                                @endphp
                                <div class="row col-xl-6 col-md-6 col-12">
                                    <h4 class="panel-title">
                                        <i class="fa fa-list"></i>
                                        <a class="room_type_by_rooms" data-roomtypeid="{{$k}}" data-toggle="collapse" href="#collapse{{$k}}">
                                        {!! $val !!}
                                        </a>
                                        {{Form::number('roomtype_'.$k,rtrim($change_value[1], ')'),[ "data-original"=>rtrim($change_value[1], ')'),"class"=>"room_price calculate_total_amount form-control col-4","required"=>"required"])}}
                                    </h4>
                                </div>

                            @endforeach
                        </div> -->


                        <div class="row hide_elem" id="room_list_section">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <div class="row">
                                        @foreach($roomtypes_list as $k=>$val)
                                            @php
                                                $change_value = explode('||',$val);
                                            @endphp
                                            <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                <h4 class="row panel-title">
                                                    <i class="fa fa-list"></i>
                                                    <a class="room_type_by_rooms col-xl-3 col-md-6 col-sm-12" data-roomtypeid="{{$k}}" data-toggle="collapse" href="#collapse{{$k}}">
                                                    {!! $val !!}
                                                    </a>
                                                    <div class="col-xl-4 col-md-6 col-12">
                                                        {{Form::number('roomtype_'.$k,rtrim($change_value[1], ')'),[ "data-original"=>rtrim($change_value[1], ')'),"class"=>"room_price calculate_total_amount form-control","required"=>"required"])}}
                                                    </div>
                                                </h4>
                                                </div>
                                                <div id="collapse{{$k}}" class="panel-collapse collapse">
                                                <div class="row">
                                                    <label>Search Room: </label>
                                                    <div class="col-xl-4 col-md-6 col-12">
                                                        <input type="text" class="form-control" onkeyup="search_from_table('table_search_<?php echo $k; ?>',$(this).val())">
                                                    </div>
                                                </div>
                                                <table class="table table-striped table-bordered table_search" id="table_search_<?php echo $k; ?>">
                                                <!-- <table class="datatables-basic table "> -->
                                                    <thead>
                                                    <tr>
                                                        <th>{{lang_trans('txt_sno')}}</th>
                                                        <th>{{lang_trans('txt_select')}}</th>
                                                        <th>{{lang_trans('txt_room_num')}}</th>
                                                        <th>{{lang_trans('txt_status')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="rooms_list">

                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />


                        @if(!$quickCheckIn)
                        <div class="row  item-repeater">
                                <h4 class="card-title"> {{lang_trans('heading_person_info')}}</h4>

                                <div data-repeater-list="item">
                                            <div data-repeater-item class="per_item_elem">

                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_name')}}</label>{{Form::text('persons_info[name][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_name", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_name')])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_gender')}}</label>{{ Form::select('persons_info[gender][]',$GENDER,null,['class'=>'form-select col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="txt_type_id">{{lang_trans('txt_dob')}}</label>
                                                            {{Form::date('dob',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"dob", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_dob')])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_address')}}</label>{{Form::textarea('persons_info[address][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_address'),"rows"=>1])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_type_id')}}</label>{{ Form::select('persons_info[idcard_type][]',getDynamicDropdownList('type_of_ids', false, $lang),null,['class'=>'form-select col-md-6 col-xs-12',"id"=>"type_of_ids", 'placeholder'=>lang_trans('ph_select')]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_id_number')}}</label>{{Form::text('persons_info[idcard_no][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_id_number')])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-9 mb-50 ">
                                                        <div class="mb-1 delete_btn">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </div>
                                                

                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1">
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                                
                                            </div>
                                        </div>
                        </div>

                        <hr />

                        <div class="row">
                                <h4 class="card-title"> {{lang_trans('heading_payment_info')}} ({{lang_trans('txt_total')}}:</h4>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_advance_payment')}}</label>
                                        {{Form::number('advance_payment',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"advance_payment", "placeholder"=>lang_trans('ph_enter')." ".lang_trans('txt_advance_payment'),"min"=>0])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_payment_mode')}}</label>
                                        {{Form::select('payment_mode',$PAYMENT_MODES,1,['class'=>"form-select", 'required'=>true])}}
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <button class="btn btn-success btn-submit-form" type="submit">{{lang_trans('btn_submit')}}</button>
                                </div>
                        </div>

                        <!-- <hr /> -->

                        @endif

                </form>
            </div>
        </div>
    </div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
{{-- require set var in js var --}}
<script>
  globalVar.page = 'room_reservation_add';
  globalVar.customerList = {!! json_encode($customer_list) !!};
  globalVar.companiesList = {!! json_encode($companies_list) !!};
  var route_search_customer = '{{ route("search-from-customer")}}';
  var lang = "<?php if(getSettings('site_language') == 'en'){ echo 'en'; }else{ echo 'ar'; }  ?>";

  $(document).ready(function(){
    $('#new_company_section').hide();
  });
</script>
 <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script>
 <script type="text/javascript" src="{{URL::asset('public/js/page_js/room_reg_add_edit.js?v='.rand(1111,9999).'')}}"></script>

@endsection

@section('scripts')



<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
  <script src="{{URL::asset('public/custom/js/add_reservation.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/customer.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
<!-- END: Page JS-->

<script>

  $(document).on('submit', '#add-reservation-form', function(e){
            e.preventDefault();
            // checkError();
            var app_nt_enable = $("#app_nt_enable").val();
            if(app_nt_enable == "1"){
                console.log("app_nt_enable", app_nt_enable);
                var error = "";
                var error_flag = false;
                var dob = $("#dob").val();
                var gender = $("#gender").val();
                var advance_payment = $("#advance_payment").val();
                var mt_nationality = $("#mt_nationality").val();
                var mt_room_rent_type = $("#mt_room_rent_type").val();
                var mt_customer_types = $("#mt_customer_types").val();
                var mt_room_type = $("#mt_room_type").val();
                var mt_reason_of_visit = $("#mt_reason_of_visit").val();
                var mt_payment_type = $("#mt_payment_type").val();
                // var mt_reason_of_visit = $("input[name=mt_reason_of_visit]").val();
                var div_id = "";

                if(!gender){
                    error = "{{lang_trans('txt_gender')}}";
                    error_flag = true;
                    div_id = "gender";
                }else if(!dob){
                    error = "{{lang_trans('txt_dob')}}";
                    error_flag = true;
                    div_id = "dob";
                }else if(!advance_payment){
                    error = "{{lang_trans('txt_advance_payment')}}";
                    error_flag = true;
                    div_id = "advance_payment";
                }else if(!mt_nationality){
                    error = "{{lang_trans('txt_nationality')}}";
                    error_flag = true;
                    div_id = "mt_nationality";
                }else if(!mt_room_rent_type){
                    error = "{{lang_trans('txt_room_rent_type')}}";
                    error_flag = true;
                    div_id = "mt_room_rent_type";
                }else if(!mt_customer_types){
                    error = "{{lang_trans('txt_customer_types')}}";
                    error_flag = true;
                    div_id = "mt_customer_types";
                }else if(!mt_room_type){
                    error = "{{lang_trans('txt_room_type')}}";
                    error_flag = true;
                    div_id = "mt_room_type";
                }else if(!mt_reason_of_visit){
                    error = "{{lang_trans('txt_reason_of_visit')}} ";
                    error_flag = true;
                    div_id = "mt_reason_of_visit";
                }else if(!mt_payment_type){
                    error = "{{lang_trans('txt_payment_type')}}";
                    error_flag = true;
                    div_id = "mt_payment_type";
                }

                if(error_flag == true){
                    Swal.fire({
                        title: error + " {{lang_trans('txt_require')}}",
                        // showCancelButton: true,
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        $("#"+div_id).focus();
                        // setTimeout(function() { $('#dob').focus() }, 3000);
                        // return;
                    })
                    // $("#"+div_id).focus();
                    // setTimeout(function() { $('#dob').focus() }, 3000);
                     return;
                }

                // console.log("done");
                // return;
            }else{

                var guest_type = $('input:radio[name="guest_type"]:checked').val();

                var error = "";
                var error_flag = false;

                var check_in_date = $("#check_in_date").val();
                var check_out_date = $("#check_out_date").val();
                var duration_of_stay = $("#duration_of_stay").val();
                var adult = $("#adult").val();
                var div_id = "";

                if(guest_type=="new_company"){
                    var company_address = $("#company_address").val();
                    var company_name = $("#company_name").val();
                    var company_mobile = $("#company_mobile").val();
                    if(!company_name){
                        error = "{{lang_trans('txt_company_name')}}";
                        error_flag = true;
                        div_id = "search_companyname";
                    }else if(!company_mobile){
                        error = "{{lang_trans('txt_company_mobile_num')}}";
                        error_flag = true;
                        div_id = "company_mobile";
                    }else if(!company_address){
                        error = "{{lang_trans('txt_company_address')}}";
                        error_flag = true;
                        div_id = "company_address";
                    }

                }else if(guest_type=="new"){
                    var idcard_no = $("#idcard_no").val();
                    var type_of_ids_selector = $("#type_of_ids_selector").val();
                    var gender = $("#gender").val();
                    var name = $("#name").val();
                    var surname = $("#surname").val();
                    // var mobile = $("#mobile").val();
                    // if(!idcard_no){
                    //     error = "{{lang_trans('txt_id_number')}}";
                    //     error_flag = true;
                    //     div_id = "idcard_select_div";
                    // }else
                    if(!type_of_ids_selector){
                        error = "{{lang_trans('txt_type_id')}}";
                        error_flag = true;
                        div_id = "type_of_ids_selector";
                    }else if(!gender){
                        error = "{{lang_trans('txt_gender')}}";
                        error_flag = true;
                        div_id = "gender";
                    }else if(!name){
                        error = "{{lang_trans('txt_name')}}";
                        error_flag = true;
                        div_id = "name";
                    }else if(!surname){
                        error = "{{lang_trans('txt_surname')}}";
                        error_flag = true;
                        div_id = "surname";
                    // }else if(!mobile){
                    //     error = "{{lang_trans('txt_mobile_num')}}";
                    //     error_flag = true;
                    //     div_id = "mobile";
                    }
                }



                if(!check_in_date){
                    error = "{{lang_trans('txt_checkin')}}";
                    error_flag = true;
                    div_id = "check_in_date";
                }else if(!check_out_date){
                    error = "{{lang_trans('txt_checkout')}}";
                    error_flag = true;
                    div_id = "check_out_date";
                }else if(!duration_of_stay){
                    error = "{{lang_trans('txt_duration_of_stay')}}";
                    error_flag = true;
                    div_id = "duration_of_stay";
                }else if(!adult){
                    error = "{{lang_trans('txt_adults')}}";
                    error_flag = true;
                    div_id = "adult";
                }

                if(error_flag == true){
                    Swal.fire({
                        title: error + " {{lang_trans('txt_require')}}",
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        $("#"+div_id).focus();
                    })

                     return;
                }
            }


            $('#custom-loader').css('display', 'flex');
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    $('#custom-loader').css('display', 'none');
                    Swal.fire({
                        title: data.msg,
                        showCancelButton: true,
                        confirmButtonText: "{{lang_trans('txt_view_invoice')}}",
                    }).then((result) => {
                        // console.log(result);
                        if (result.isConfirmed) {
                            window.location = data.invoice
                        } else {
                            location.reload();
                        }
                    })
                },
                error: function(error){
                    alert(error.responseJSON.msg);
                    $('#custom-loader').css('display', 'none');
                }
            });
        });


// var oTable = $('.table_search').DataTable(Testing);
// $('#search_from_table').keyup(function(){
//     console.log("test",testing);
//     oTable.search($(this).val()).draw();
// })

//     $(".search_from_table").on("keyup", function() {
//     var value = $(this).val();
// console.log("test",value);
//     $(".table_search tr").each(function(index) {
//         if (index != 0) {

//             $row = $(this);

//             var id = $row.find("td:first").text();

//             if (id.indexOf(value) != 0) {
//                 $(this).hide();
//             }
//             else {
//                 $(this).show();
//             }
//         }
//     });
// });​


function search_from_table(table_name,val){
    console.log(table_name,val);
    $("#"+ table_name +" tr").each(function(index) {

        if (index != 0) {
            $row = $(this);
            var id = $row.find("td:nth-child(3)").text();
            if (id.indexOf(val) != 0) {
                $(this).hide();
            }else {
                $(this).show();
            }
        }
    });
}

</script>

@endsection
