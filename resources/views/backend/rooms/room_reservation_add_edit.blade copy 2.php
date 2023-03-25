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
  @endphp
  

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
                                           
                                            {{Form::radio('guest_type','new',true,['class'=>"form-check-input guest_type", 'id'=>'new_guest'])}}
                                            <label class="form-check-label" for="customColorRadio1">{{lang_trans('txt_new_guest')}}</label>
                                        </div>
                                        <div class="form-check form-check-primary">
                                           
                                            {{Form::radio('guest_type','new_company',false,['class'=>"form-check-input guest_type", 'id'=>'new_company'])}} 
                                            <label class="form-check-label" for="customColorRadio2">{{lang_trans('txt_new_company')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_reservation_type')}}</label>
                                        {{ Form::select('reservation_type',config('constants.RESERVATION_TYPE'),null,['class'=>'form-select']) }}
                                       
                                    </div>
                                </div>
                        </div>

                        <hr />
                        
                        <div class="row">
                                <h4 class="card-title"> {{lang_trans('heading_search_from_customer')}}</h4>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_search_from_phone_idcard')}}</label>
                                      
                                        <select class="select2-data-ajax form-select" id="select2-ajax"></select>
                                    </div>
                                </div>
                        </div>

                        <hr />

                        @if(!$quickCheckIn)
                        <div class="row">

                                <h4 class="card-title"> {{lang_trans('heading_idcard_info')}}</h4>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_id_number">{{lang_trans('txt_id_number')}}</label>

                                        <select class="select2-data- ajax form-select" id="search_from_phone_idcard">
                                                <option value="" disable>Please enter a phone number and ID card number</option>
                                            </select>

                                         <!-- <select class="select2-data-ajax form-select" id="select2-ajax"></select> -->
                                    </div>
                                </div>

                               

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_type_id">{{lang_trans('txt_type_id')}}</label>
                                        {{ Form::select('idcard_type',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-select col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'id'=>'type_of_ids_selector']) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_type_id">{{lang_trans('txt_gender')}}</label>
                                        {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-select col-md-6 col-xs-12', "id"=>"gender",'placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                @if(!$quickCheckIn)
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="txt_type_id">{{lang_trans('txt_dob')}}</label>
                                            {{Form::date('dob',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"dob", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_dob')])}}
                                        </div>
                                    </div>
                                @endif


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="txt_type_id">{{lang_trans('txt_reason_of_visit')}}</label>
                                        {{Form::textarea('reason_visit_stay',null,['class'=>"form-control h34 col-md-6 col-xs-12", "id"=>"reason_visit_stay", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_reason_of_visit'),"rows"=>1])}}
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
                                        {{Form::text('name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_firstname')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_surname')}}</label>
                                        {{Form::text('surname',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"surname", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_surname')])}}
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_email')}}</label>
                                        {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_mobile_num')}}</label>
                                        <select class="select2-data- ajax form-select" id="search_from_phone_idcard">
                                            <option value="" disable>Please enter a phone number and ID card number</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_address')}}</label>
                                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_country')}}</label>
                                        {{ Form::select('country',getCountryList(),getSettings('default_country'),['class'=>'form-control col-md-6 col-xs-12', "id"=>"country", 'placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_state')}}</label>
                                        {{Form::text('state',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"state", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_state')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_city')}}</label>
                                        {{Form::text('city',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"city", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_city')])}}
                                    </div>
                                </div>


                        </div>

                        <div class="row hide_elem" id="new_company_section">
                                <h4 class="card-title"> {{lang_trans('heading_company_info')}}</h4>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_name')}}</label>
                                        <select class="select2-data-ajax form-select" >
                                            <option value="" disable>Please enter a phone number and ID card number</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_gst_num')}}</label>
                                        {{Form::text('company_gst_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_gst_num", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_gst_num')])}}
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_email')}}</label>
                                        {{Form::email('company_email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_email')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_mobile_num')}}</label>
                                        <select class="select2-data- ajax form-select" id="search_from_phone_idcard">
                                            <option value="" disable>Please enter a phone number and ID card number</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_address')}}</label>
                                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
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
                                        {{Form::text('company_state',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_state", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_state')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_company_city')}}</label>
                                        {{Form::text('company_city',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_city", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_city')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_remark')}}</label>
                                        {{Form::textarea('remark',null,['class'=>"form-control h34 col-md-6 col-xs-12", "id"=>"remark", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark'),"rows"=>1])}}
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
                                        {{Form::number('adult',1,['class'=>"form-control col-md-7 col-xs-12", "id"=>"adult", "required"=>"required","placeholder"=>lang_trans('ph_enter').lang_trans('txt_adults'),"min"=>1])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_kids')}}</label>
                                        {{Form::number('kids',0,['class'=>"form-control col-md-7 col-xs-12", "id"=>"kids", "required"=>"required","placeholder"=>lang_trans('ph_enter').lang_trans('txt_kids'),"min"=>0])}}
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
                                                <table class="table table-striped table-bordered">
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
                        <div class="row  counter-repeater">
                                <h4 class="card-title"> {{lang_trans('heading_person_info')}}</h4>

                                <div data-repeater-list="counter">
                                            <div data-repeater-item>
                                          
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_name')}}</label>{{Form::text('persons_info[name][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_name')])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_gender')}}</label>{{ Form::select('persons_info[gender][]',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_age')}}</label>{{Form::number('persons_info[age][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_age", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_age'),"min"=>10])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_address')}}</label>{{Form::textarea('persons_info[address][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_type_id')}}</label>{{ Form::select('persons_info[idcard_type][]',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-control col-md-6 col-xs-12',"id"=>"type_of_ids", 'placeholder'=>lang_trans('ph_select')]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"> {{lang_trans('txt_id_number')}}</label>{{Form::text('persons_info[idcard_no][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_id_number')])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-9 mb-50">
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
                                                <div class="form-check form-check-inline">
                                                
                                                </div>
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
                                        {{Form::number('advance_payment',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"advance_payment", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_advance_payment'),"min"=>0])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_payment_mode')}}</label>
                                        {{Form::select('payment_mode',config('constants.PAYMENT_MODES'),1,['class'=>"form-control", 'required'=>true])}}
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <button class="btn btn-success btn-submit-form" type="submit" disabled>{{lang_trans('btn_submit')}}</button>
                                </div>
                        </div>

                        <!-- <hr /> -->

                        @endif

<!-- 
                        <br />
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit">{{lang_trans('btn_submit')}}</button>
                    <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button> -->
                </form>
            </div>
        </div>
    </div>

<!-- 

<div class="">
  @if($flag==1)
      {{ Form::model($data_row,array('url'=>route('save-reservation'),'id'=>"update-reservation-form", 'class'=>"form-horizontal form-label-left",'files'=>true)) }}
      {{Form::hidden('id',null)}}
  @else
      {{ Form::open(array('url'=>route('save-reservation'),'id'=>"add-reservation-form", 'class'=>"form-horizontal form-label-left",'files'=>true)) }}
  @endif
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_guest_type')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                    <div class="col-md-10 col-sm-12 col-xs-12">
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            {{Form::radio('guest_type','new',true,['class'=>"flat guest_type", 'id'=>'new_guest'])}} <label for="new_guest">{{lang_trans('txt_new_guest')}}</label>
                          </div>
                        
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            {{Form::radio('guest_type','new_company',false,['class'=>"flat guest_type", 'id'=>'new_company'])}} <label for="new_company">{{lang_trans('txt_new_company')}}</label>
                        </div>
                       
                                <br><select class="js-example-data-ajax" id="search_from_phone_idcard">
                                    <option value="" disable>Please enter a phone number and ID card number</option>
                                </select>
                                <button type="button" class="btn btn-primary" onclick="location.reload()">Reset</button>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>



    <div class="row" >

            
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{lang_trans('heading_search_from_customer')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_search_from_phone_idcard')}} </label>
                      
                        <br><select class="js-example-data-ajax" id="search_from_phone_idcard">
                            <option value="" disable>Please enter a phone number and ID card number</option>
                        </select>
                        <button type="button" class="btn btn-primary" onclick="location.reload()">Reset</button>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>




<div class="row" >

            
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{lang_trans('heading_search_from_customer')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_search_from_phone_idcard')}} </label>
                     
                        <br><select class="js-example-data-ajax" id="search_from_phone_idcard">
                            <option value="" disable>Please enter a phone number and ID card number</option>
                        </select>
                        <button type="button" class="btn btn-primary" onclick="location.reload()">Reset</button>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>

        @if(!$quickCheckIn)
            
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>{{lang_trans('heading_idcard_info')}}</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                
                <div class="col-md-4 col-sm-4 col-xs-12" id="idcard_select_div">
                        <label class="control-label"> {{lang_trans('txt_id_number')}} <span id="id_card_req" class="required">*</span> <span id="number_validation" style="display:none;color:red;">Test</span></label>
                            <select class="js-example-data-ajax" id="search_idcard">
                                <option value="" disable>Please enter a phone number and ID card number</option>
                            </select>
                    </div>
                

                    <div class="col-md-4 col-sm-4 col-xs-12" id="idcard_input_div" style="display:none;">
                        <label class="control-label"> {{lang_trans('txt_id_number')}} <span  class="required">*</span> </label>
                        {{Form::text('idcard_no',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_id_number')])}}
                                        
                    </div>

                   
                    

                               
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label">{{lang_trans('txt_type_id')}} <span id="type_id_card_req" class="required">*</span></label>
                                        {{ Form::select('idcard_type',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'id'=>'type_of_ids_selector']) }}
                                    </div>


                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label"> {{lang_trans('txt_gender')}} <span id="gender_req" class="required">*</span></label>
                                        {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12', "id"=>"gender",'placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                    @if(!$quickCheckIn)
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label"> {{lang_trans('txt_dob')}} </label>
                                        {{Form::date('dob',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"dob", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_dob')])}}
                                        </div>
                                    @endif
                                    
                                   

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label"> {{lang_trans('txt_reason_of_visit')}} </label>{{--<span class="required">*</span>--}}
                                        {{Form::textarea('reason_visit_stay',null,['class'=>"form-control h34 col-md-6 col-xs-12", "id"=>"reason_visit_stay", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_reason_of_visit'),"rows"=>1])}}
                                    </div>
                              


                            </div>
                        </div>
                    </div>
                
        @endif

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
                        <input name="guest_type_category" id="guest_type_category" value="new" type="hidden" />
                        <input name="selected_customer_id" id="selected_customer_id" value="" type="hidden" />
                    
                        

                     

                      
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_firstname')}} <span class="required">*</span></label>
                        {{Form::text('name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_firstname')])}}
                      </div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_surname')}} <span class="required">*</span></label>
                        {{Form::text('surname',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"surname", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_surname')])}}
                      </div>
                   
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_email')}} </label>
                        {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                      </div>
                    
                      <div class="col-md-4 col-sm-4 col-xs-12" id="mobile_select_div">
                                <label class="control-label"> {{lang_trans('txt_mobile_num')}}<span class="required">*</span></label>
                                <select class="js-example-data-ajax" id="search_phone">
                                    <option value="" disable>Please enter a phone number and ID card number</option>
                                </select>
                        </div>
                      

                        <div class="col-md-4 col-sm-4 col-xs-12" id="mobile_input_div" style="display:none;">
                                <label class="control-label"> {{lang_trans('txt_mobile_num')}}<span class="required">*</span></label>
                                {{Form::text('mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                        </div>

                       

                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_address')}} </label>
                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_country')}} </label>
                        {{ Form::select('country',getCountryList(),getSettings('default_country'),['class'=>'form-control col-md-6 col-xs-12', "id"=>"country", 'placeholder'=>lang_trans('ph_select')]) }}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_state')}} </label>
                        {{Form::text('state',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"state", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_state')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_city')}} </label>
                        {{Form::text('city',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"city", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_city')])}}
                      </div>
                     
                    </div>
                  </div>
              </div>
          </div>
      </div>

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
                              
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="row hide_elem" id="new_company_section">

         

          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>{{lang_trans('heading_company_info')}}</h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                      
                      
                      <div class="col-md-4 col-sm-4 col-xs-12" id="companyname_select_div">
                            <label class="control-label"> {{lang_trans('txt_company_name')}} <span class="required">*</span></label>
                            <br />
                            <select class="form-control js-example-data-ajax" id="search_companyname">
                                <option value="" disable>Please enter a phone number and ID card number</option>
                            </select>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12" id="companyname_input_div" style="display:none;">
                            <label class="control-label"> {{lang_trans('txt_company_name')}} </label>
                              {{Form::text('company_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_name')])}}
                        </div>

                        

                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label"> {{lang_trans('txt_company_gst_num')}}</label>
                              {{Form::text('company_gst_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_gst_num", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_gst_num')])}}
                          </div>

                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label"> {{lang_trans('txt_company_email')}} </label>
                              {{Form::email('company_email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_email')])}}
                          </div>
                          
                        <div class="col-md-4 col-sm-4 col-xs-12" id="companyphone_select_div">
                        <label class="control-label"> {{lang_trans('txt_company_mobile_num')}} <span class="required">*</span></label>
                        <br/>
                                <select class="js-example-data-ajax" id="search_companyphone">
                                    <option value="" disable>Please enter a phone number and ID card number</option>
                                </select>
                        </div>


                        <div class="col-md-4 col-sm-4 col-xs-12" id="companyphone_input_div" style="display:none;">
                                <label class="control-label"> {{lang_trans('txt_company_mobile_num')}} <span class="required">*</span></label>
                              {{Form::text('company_mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_mobile_num')])}}
                                   
                        </div>

                  

                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label"> {{lang_trans('txt_company_address')}} <span class="required">*</span></label>
                              {{Form::textarea('company_address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_address'),"rows"=>1])}}
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label"> {{lang_trans('txt_company_country')}} </label>
                              {{ Form::select('company_country',getCountryList(),getSettings('default_country'),['class'=>'form-control col-md-6 col-xs-12', "id"=>"company_country", 'placeholder'=>lang_trans('ph_select')]) }}
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label"> {{lang_trans('txt_company_state')}} </label>
                              {{Form::text('company_state',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_state", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_state')])}}
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label"> {{lang_trans('txt_company_city')}} </label>
                              {{Form::text('company_city',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_city", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_city')])}}
                          </div>




                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label"> {{lang_trans('txt_remark')}}</label>
                              {{Form::textarea('remark',null,['class'=>"form-control h34 col-md-6 col-xs-12", "id"=>"remark", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark'),"rows"=>1])}}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="row hide_elem" id="existing_company_section">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>{{lang_trans('heading_existing_company_list')}}</h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label">{{lang_trans('txt_company')}}</label>
                        
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
                        <label class="control-label"> {{lang_trans('txt_checkin')}}<span class="required">*</span></label>
                        {{Form::text('check_in_date',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"check_in_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off", "readonly"=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 hide_elem_">
                        <label class="control-label"> {{lang_trans('txt_checkout')}} <span class="required">*</span></label>
                        {{Form::text('check_out_date',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"check_out_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off", "readonly"=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_duration_of_stay')}} <span class="required">*</span></label>
                        {{Form::number('duration_of_stay',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"duration_of_stay", "placeholder"=>lang_trans('ph_day_night'),"min"=>1, "readonly"=>true])}}
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_adults')}} <span class="required">*</span></label>
                          {{Form::number('adult',1,['class'=>"form-control col-md-7 col-xs-12", "id"=>"adult", "required"=>"required","placeholder"=>lang_trans('ph_enter').lang_trans('txt_adults'),"min"=>1])}}
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_kids')}} </label>
                          {{Form::number('kids',0,['class'=>"form-control col-md-7 col-xs-12", "id"=>"kids", "required"=>"required","placeholder"=>lang_trans('ph_enter').lang_trans('txt_kids'),"min"=>0])}}
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
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
                          <h4 class="panel-title">
                            <i class="fa fa-list"></i>
                            <a class="room_type_by_rooms" data-roomtypeid="{{$k}}" data-toggle="collapse" href="#collapse{{$k}}">
                               {!! $val !!}
                            </a>
                              {{Form::number('roomtype_'.$k,rtrim($change_value[1], ')'),[ "data-original"=>rtrim($change_value[1], ')'),"class"=>"room_price calculate_total_amount","required"=>"required"])}}
                          </h4>
                        </div>
                        <div id="collapse{{$k}}" class="panel-collapse collapse">
                          <table class="table table-striped table-bordered">
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



  @if(!$quickCheckIn)
   
  @endif

  @if(!$quickCheckIn)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_person_info')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="persons_info_parent">
                      <div class="row persons_info_elem">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_name')}} </label>
                          {{Form::text('persons_info[name][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_name')])}}
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_gender')}} </label>
                          {{ Form::select('persons_info[gender][]',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_age')}} </label>
                          {{Form::number('persons_info[age][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_age", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_age'),"min"=>10])}}
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_address')}} </label>
                          {{Form::textarea('persons_info[address][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label class="control-label">{{lang_trans('txt_type_id')}} </label>
                            {{ Form::select('persons_info[idcard_type][]',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-control col-md-6 col-xs-12',"id"=>"type_of_ids", 'placeholder'=>lang_trans('ph_select')]) }}
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <label class="control-label">{{lang_trans('txt_id_number')}} </label>
                          {{Form::text('persons_info[idcard_no][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_id_number')])}}
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                          <label class="control-label"> &nbsp;</label><br/>
                          <button type="button" class="btn btn-success add-new-row"><i class="fa fa-plus"></i></button>
                        </div>
                      </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
  @endif

      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>{{lang_trans('heading_payment_info')}} ({{lang_trans('txt_total')}}: <i id="total_amount_show">0</i>)</h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label"> {{lang_trans('txt_advance_payment')}}</label>
                              {{Form::number('advance_payment',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"advance_payment", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_advance_payment'),"min"=>0])}}
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label">{{lang_trans('txt_payment_mode')}}<span class="required">*</span></label>
                              {{Form::select('payment_mode',config('constants.PAYMENT_MODES'),1,['class'=>"form-control", 'required'=>true])}}
                          </div>
                      </div>
                      @if(!env('APP_NT_ENABLE'))
                          <div class="ln_solid"></div>
                          <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                              <button class="btn btn-success btn-submit-form" type="submit" disabled>{{lang_trans('btn_submit')}}</button>
                          </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>



     {{--  @if(env('APP_NT_ENABLE')) --}} 
      @if(config('app.nt_enable'))
            <input id="app_nt_enable" value="1" type="hidden"> 
          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                      <div class="x_title">
                          <h2>{{lang_trans('ministory_of_tourism_section')}}</h2>
                          <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                          <div class="row">

                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_nationality')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_nationality',getDynamicDropdownList('nationalities', true),null,['class'=>'form-control col-md-6 col-xs-12', "id"=>"mt_nationality", 'placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_room_rent_type')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_room_rent_type',getDynamicDropdownList('room_rent_type', true),null,['class'=>'form-control col-md-6 col-xs-12',"id"=>"mt_room_rent_type", 'placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>

                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_customer_types')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_customer_types',getDynamicDropdownList('customer_types', true),null,['class'=>'form-control col-md-6 col-xs-12',"id"=>"mt_customer_types", 'placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_room_type')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_room_type',getDynamicDropdownList('room_types', true),null,['class'=>'form-control col-md-6 col-xs-12',"id"=>"mt_room_type", 'placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_reason_of_visit')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_reason_of_visit',getDynamicDropdownList('reason_of_visit', true),null,['class'=>'form-control col-md-6 col-xs-12',"id"=>"mt_reason_of_visit", 'placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_payment_type')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_payment_type',getDynamicDropdownList('payment_type', true),null,['class'=>'form-control col-md-6 col-xs-12',"id"=>"mt_payment_type", 'placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>

                          </div>
                          <div class="ln_solid"></div>
                          <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                              <button class="btn btn-success btn-submit-form" type="submit" id="form-submiter" disabled >{{lang_trans('btn_submit')}}</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      @endif








  {{ Form::close() }}
</div>
<div class="colne_persons_info_elem hide_elem">
  <div class="row persons_info_elem">
     <div class="col-md-2 col-sm-2 col-xs-12">
        {{Form::text('persons_info[name][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_name')])}}
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
        {{ Form::select('persons_info[gender][]',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        {{Form::number('persons_info[age][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_age", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_age'),"min"=>10])}}
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
        {{Form::textarea('persons_info[address][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
          {{ Form::select('persons_info[idcard_type][]',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
        {{Form::text('persons_info[idcard_no][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_id_number')])}}
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <button type="button" class="btn btn-danger delete-row"><i class="fa fa-minus"></i></button>
      </div>
  </div>
</div> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
{{-- require set var in js var --}}
<script>
  globalVar.page = 'room_reservation_add';
  globalVar.customerList = {!! json_encode($customer_list) !!};
  globalVar.companiesList = {!! json_encode($companies_list) !!};
</script> 
 <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script>
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <!-- <script>


        // $(document).on('change', '#type_of_ids_selector', function(e){
        //     if($(this).val() == 4 || $(this).val() == 21){
        //         $('#shower_start').show();
        //     }else{
        //         $('#shower_start').hide();
        //     }
        // })

        // $(document).ready(function() {
        //     // $('.js-example-basic-single').select2();
        //     // $('.js-example-basic-single').select2();
        // });

        $(document).on('change', '.guest_type', function(e){
            console.log("Test");
        })

        $(document).on('change', '#search_from_phone_idcard', function(e){
            console.log("testing", csrf_token);
            e.preventDefault();
            // var formData = new FormData(this);
            var search_from_phone_idcard = $("#search_from_phone_idcard").val();
            $.ajax({
                type:'GET',
                url: '{{route("search-from-customer")}}',
                data: {
                    search_from_phone_idcard  : search_from_phone_idcard,
                    category: "user",
                },
                dataType: "json",
                success:function(data){
                    // alert( "success");
                    // console.log(data.customers[0], "success");
                    var data_customer = data.customers[0]; 
                    if(data_customer.cat=="user"){
                        $('#guest_type_category').val('existing');
                        $("#surname").val(data_customer.surname);
                        $("#name").val(data_customer.name);
                        $("#middle_name").val(data_customer.namiddle_nameme);
                        $("#email").val(data_customer.email);
                        $("#mobile").val(data_customer.mobile);
                        $("#address").val(data_customer.address);
                        $("#country").val(data_customer.country);
                        $("#state").val(data_customer.state);
                        $("#city").val(data_customer.city);
                        $("#gender").val(data_customer.gender);
                        $("#dob").val(data_customer.dob);
                        $("#idcard_no").val(data_customer.id_card_no);
                        $("#selected_customer_id").val(data_customer.id);
                        $('#idcard_input_div').show();
                        $('#idcard_select_div').hide();
                        $('#mobile_input_div').show();
                        $('#mobile_select_div').hide();
                    }else{
                        $('#guest_type_category').val('existing_company');
                        $("#company_name").val(data_customer.name);
                        $("#company_gst_num").val(data_customer.company_gst_num);
                        $("#company_email").val(data_customer.email);
                        $("#company_mobile").val(data_customer.mobile);                
                        $("#company_address").val(data_customer.address);
                        $("#company_country").val(data_customer.country);
                        $("#company_state").val(data_customer.state);
                        $("#company_city").val(data_customer.city);
                        $("#selected_customer_id").val(data_customer.id);
                        $("#idcard_no").val(data_customer.id_card_no);
                        $('#idcard_input_div').show();
                        $('#idcard_select_div').hide();
                        $('#companyphone_input_div').show();
                        $('#companyphone_select_div').hide();
                        $('#companyname_select_div').hide();
                        $('#companyname_input_div').show();
             
                    }
                },
                error: function(error){
                    console.log("error", error);
                }
            });
        });



    

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
                
                // if(){

                // }else 
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
                    // else if(!check_out_date){
                    //     error = "{{lang_trans('txt_advance_payment')}}";
                    //     error_flag = true;
                    //     div_id = "advance_payment";
                    // }
                }else if(guest_type=="new"){
                    var idcard_no = $("#idcard_no").val();
                    var type_of_ids_selector = $("#type_of_ids_selector").val();
                    var gender = $("#gender").val();
                    var name = $("#name").val();
                    var surname = $("#surname").val();
                    var mobile = $("#mobile").val();
                    if(!idcard_no){
                        error = "{{lang_trans('txt_id_number')}}";
                        error_flag = true;
                        div_id = "idcard_select_div";
                    }else if(!type_of_ids_selector){
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
                    }else if(!mobile){
                        error = "{{lang_trans('txt_mobile_num')}}";
                        error_flag = true;
                        div_id = "mobile";
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
        })

        // var initSelection = function(elem, cb) {
        //         console.log(elem);
        //         return elem;
        //     }

        $(".js-example-data-ajax").select2({
            tags: true,
            ajax: {
                url: '{{route("search-from-customer")}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                            search_from_phone_idcard: params.term, 
                            category: "user",
                        };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.customers, function(obj) {
                            return { id: obj.mobile , text: obj.name+' '+obj.mobile };
                        })
                    };
                },
                // processResults: function (data, params) {
                // // parse the results into the format expected by Select2
                // // since we are using custom formatting functions we do not need to
                // // alter the remote JSON data, except to indicate that infinite
                // // scrolling can be used
                //     console.log("asdads");
                // return {
                //     results: data.customers,
                // };
                // },
                cache: true,
                // templateResult: formatRepo,
                // templateSelection: formatRepoSelection
                
            },
            placeholder: 'Search a Customer' ,
            minimumInputLength: 3,
            templateSelection: function(data){
                   return data.text;
                },
            // initSelection: function(data){
            //     console.log(data);
            // },
            });

           

        $(".js-example-data-ajax-company").select2({
            ajax: {
                url: '{{route("search-from-customer")}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                return {
                    search_from_phone_idcard: params.term, 
                    category: "company",
                };
                },
                processResults: function (data) {
                    //  if(data){
                        return {
                                results: $.map(data.customers, function(obj) {
                                return { id: obj.mobile , text: obj.name+' '+obj.mobile };
                            })
                        };
                    
                        
                   
                },  
                cache: true,
            },
            placeholder: 'Please enter name, phone number and id card number',
            minimumInputLength: 3,
            formatSelection: function(data){
                    console.log(data)
                },
            });

            $(document).on('change', '#search_from_name_phone_idcard', function(e){
            console.log("testing", csrf_token);
            $("#select2-search_from_phone_idcard-container").attr("title",csrf_token);
            
            // $(this).attr("title",$(this).val());
            e.preventDefault();
            // var formData = new FormData(this);
            var search_from_name_phone_idcard = $("#search_from_name_phone_idcard").val();
            $.ajax({
                type:'GET',
                url: '{{route("search-from-customer")}}',
                data: {
                    search_from_phone_idcard  : search_from_name_phone_idcard,
                    category: "company",
                },
                dataType: "json",
                success:function(data){
                    // alert( "success");
                    console.log(data.customers[0], "success");
                
                    var data_customer = data.customers[0]; 
                    if(data_customer){
                        

                        $('#guest_type_category').val('existing_company');
                        $("#company_name").val(data_customer.name);
                        $("#company_gst_num").val(data_customer.company_gst_num);
                        $("#company_email").val(data_customer.email);
                        $("#company_mobile").val(data_customer.mobile);                
                        $("#company_address").val(data_customer.address);
                        $("#company_country").val(data_customer.country);
                        $("#company_state").val(data_customer.state);
                        $("#company_city").val(data_customer.city);
                        $("#selected_customer_id").val(data_customer.id);
                        $("#com_idcard_no").val(data_customer.id_card_no);
                    }else{
                        $('#guest_type_category').val('');
                        $("#company_name").val('');
                        $("#company_gst_num").val('');
                        $("#company_email").val('');
                        $("#company_mobile").val('');                
                        $("#company_address").val('');
                        $("#company_country").val('');
                        $("#company_state").val('');
                        $("#company_city").val('');
                        $("#selected_customer_id").val('');
                        $("#com_idcard_no").val('');
                    }
                },
                error: function(error){
                    console.log("error", error);
                }
            });
        });


        // function checkError(){
        //     var ar = ['name', 'email'];
        //     var error = false;
        //     var ele='';
        //     for(let i = 0; i < ar.length; i++){
        //         var vl = $("input[name=" + ar[i] + "]").val();
        //         if(empty(vl)){
        //             error = true;
        //             ele = ar[i];
        //             break;
        //         }
        //     }


        //     if(error){
        //         Swal.fire({
        //                 title: ele + " can't be empty",
        //                 showCancelButton: true,
        //                 confirmButtonText: 'OK',
        //             }).then((result) => {
        //                 console.log(result);
        //             });
        //             return false;
        //     }else{
        //         return true;
        //     }

        // }


        function getData(id, val, category, guest_type){
            var div_id = $('#'+id).val();
            var htmlText='';
            // var guest_type = $('#guest_type').val();
            var data; 
            $.ajax({
                type:'GET',
                url: '{{route("search-from-customer")}}',
                data: {
                    search_from_phone_idcard  : div_id,
                    category: category,
                },
                dataType: "json",
                success:function(data){
                    // alert( "success");
                    console.log(data, "success");

                    data.customers.map(function(val){
                        console.log("ad", val);
                        htmlText +="<option value='"+ val.name +"'>";
                        $("#idcard_list").append("<option value='" + val.name + "'></option>");
                    })
                    // $("#idcard_list").html(htmlText);
                    // data = data.customers[0]; 
                    // console.log(guest_type);
                    // if(guest_type == "new"){
                    //     console.log( "success1");
                    //     setCustomerData(data, id);
                    // }else if(guest_type == "company"){
                    //     console.log( "success2");
                    //     setCompanydata(data, id);
                    // }
                    // else{
                    //     setCompanyNull();
                    //     setCustomerNull();
                    // }
                },
                error: function(error){
                    console.log("error", error);
                }
            });
        }

        //  select fields  5 2 3
        // search_idcard
        // idcard_select_div
        // idcard_input_div


        // search_phone
        // mobile_select_div
        // mobile_input_div
        $('.guest_type').on('ifChanged',function(){
           
            var type = $(this).val();
            if(type=='new'){
                $('#id_card_req').show();
                $('#type_id_card_req').show();
                $('#gender_req').show();
            } else if(type=='new_company') {
                $('#id_card_req').hide();
                $('#type_id_card_req').hide();
                $('#gender_req').hide();
            } 
        });
        $(document).on('change', '#search_idcard', function(){
            var val = $('#search_idcard').val();      
            var guest_type = $('input:radio[name="guest_type"]:checked').val();
            console.log("val",val);
            getAjaxResponse('idcard_select_div', val, 'user', guest_type, 'search_idcard');
        });

        $(document).on('change', '#search_phone', function(){
            var val = $('#search_phone').val();
            var guest_type = $('input:radio[name="guest_type"]:checked').val();
            getAjaxResponse('mobile_select_div', val, 'user', guest_type, 'search_phone');
        });

        $(document).on('change', '#search_companyname', function(){
            var val = $('#search_companyname').val();
            var guest_type = $('input:radio[name="guest_type"]:checked').val();
            console.log("val",val,guest_type);
            getAjaxResponse('companyname_select_div', val, 'company', 'new_company', 'search_companyname');
        });

        $(document).on('change', '#search_companyphone', function(){
            var val = $('#search_companyphone').val();
            var guest_type = $('input:radio[name="guest_type"]:checked').val();
            getAjaxResponse('companyphone_select_div', val, 'company', 'new_company', 'search_companyphone');
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



   //  end select fields


        $(document).on('keyup', '#idcard_no', function(){
            
            var val = $('#idcard_no').val();
            
            var guest_type = $('input[name=guest_type]').val();
            getData('idcard_no', val, 'user', guest_type);
        });

        $(document).on('keyup', '#mobile', function(){
            var val = $('#mobile').val();
            var guest_type = $('input[name=guest_type]').val();
            getData('mobile', val, 'user', guest_type);
        });

        $(document).on('keyup', '#company_idcard_no', function(){
            var val = $('#company_idcard_no').val();
            var guest_type = $('input[name=guest_type]').val();
            getData('company_idcard_no', val, 'company', guest_type);
        });

        $(document).on('keyup', '#company_mobile', function(){
            var val = $('#company_mobile').val();
            var guest_type = $('input[name=guest_type]').val();
            getData('company_mobile', val, 'company', guest_type);
        });

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
       
    </script> -->
  <!-- <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script> -->
  <!-- <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-repeater.js')}}"></script> -->
  <!-- <script>
//     (function (window, document, $) {
//   'use strict';
//   var select = $('.select2'),
//     selectIcons = $('.select2-icons'),
//     maxLength = $('.max-length'),
//     hideSearch = $('.hide-search'),
//     selectArray = $('.select2-data-array'),
//     selectAjax = $('.select2-data-ajax'),
//     selectLg = $('.select2-size-lg'),
//     selectSm = $('.select2-size-sm'),
//     selectInModal = $('.select2InModal');

//   select.each(function () {
//     var $this = $(this);
//     $this.wrap('<div class="position-relative"></div>');
//     $this.select2({
//       // the following code is used to disable x-scrollbar when click in select input and
//       // take 100% width in responsive also
//       dropdownAutoWidth: true,
//       width: '100%',
//       dropdownParent: $this.parent()
//     });
//   });

//   // Select With Icon
//   selectIcons.each(function () {
//     var $this = $(this);
//     $this.wrap('<div class="position-relative"></div>');
//     $this.select2({
//       dropdownAutoWidth: true,
//       width: '100%',
//       minimumResultsForSearch: Infinity,
//       dropdownParent: $this.parent(),
//       templateResult: iconFormat,
//       templateSelection: iconFormat,
//       escapeMarkup: function (es) {
//         return es;
//       }
//     });
//   });

//   // Format icon
//   function iconFormat(icon) {
//     var originalOption = icon.element;
//     if (!icon.id) {
//       return icon.text;
//     }

//     var $icon = feather.icons[$(icon.element).data('icon')].toSvg() + icon.text;

//     return $icon;
//   }

//   // Limiting the number of selections
//   maxLength.wrap('<div class="position-relative"></div>').select2({
//     dropdownAutoWidth: true,
//     width: '100%',
//     maximumSelectionLength: 2,
//     dropdownParent: maxLength.parent(),
//     placeholder: 'Select maximum 2 items'
//   });

//   // Hide Search Box
//   hideSearch.select2({
//     placeholder: 'Select an option',
//     minimumResultsForSearch: Infinity
//   });

//   // Loading array data
//   var data = [
//     { id: 0, text: 'enhancement' },
//     { id: 1, text: 'bug' },
//     { id: 2, text: 'duplicate' },
//     { id: 3, text: 'invalid' },
//     { id: 4, text: 'wontfix' }
//   ];

//   selectArray.wrap('<div class="position-relative"></div>').select2({
//     dropdownAutoWidth: true,
//     dropdownParent: selectArray.parent(),
//     width: '100%',
//     data: data
//   });

//   // Loading remote data
//   selectAjax.wrap('<div class="position-relative"></div>').select2({
//     dropdownAutoWidth: true,
//     dropdownParent: selectAjax.parent(),
//     width: '100%',
//     tags: true,
//     ajax: {
//       // url: 'https://api.github.com/search/repositories',
//       url: '{{route("search-from-customer")}}',
//       dataType: 'json',
//       delay: 250,
//       data: function (params) {
//         return {
//           // q: params.term, // search term
//           // page: params.page
//           search_from_phone_idcard: params.term, 
//           category: "user",
//           type: "name",
//         };
//       },
//       processResults: function (data, params) {
//         // parse the results into the format expected by Select2
//         // since we are using custom formatting functions we do not need to
//         // alter the remote JSON data, except to indicate that infinite
//         // scrolling can be used
//         // params.page = params.page || 1;

//         return {
//           // results: $.map(data.customers, function(obj) {
//           //     return { id: obj.mobile , text: obj.name+' '+obj.mobile };
//           // })
//           results: data.customers,
//           // results: data.items,
//           // pagination: {
//           //   more: params.page * 30 < data.total_count
//           // }
//         };
//       },
//       cache: true
//     },
//     placeholder: 'Search a guest',
//     escapeMarkup: function (markup) {
//       return markup;
//     }, // let our custom formatter work
//     minimumInputLength: 1,
//     templateResult: formatRepo,
//     templateSelection: formatRepoSelection
//   });

//   function formatRepo(repo) {
//     console.log("reo",repo)
//     // if (repo.loading) return repo.text;
//     if(repo.name){
//       var markup =
//       "<div class='select2-result-repository clearfix'>" +
//       // "<div class='select2-result-repository__avatar'><img src='" +
//       // repo.owner.avatar_url +
//       // "' /></div>" +
//       "<div class='select2-result-repository__meta'>" +
//       "<div class='select2-result-repository__title'>" +
//       repo.name +
//       '</div>';

//       if (repo.mobile) {
//         markup += "<div class='select2-result-repository__description'>" + repo.mobile + '</div>';
//       }
//     }else{
//       var markup =
//       "<div class='select2-result-repository clearfix'>" +
//       // "<div class='select2-result-repository__avatar'><img src='" +
//       // repo.owner.avatar_url +
//       // "' /></div>" +
//       "<div class='select2-result-repository__meta'>" +
//       "<div class='select2-result-repository__title'>" +
//       repo.text +
//       '</div>';
//     }

//     return markup;
//   }

//   function formatRepoSelection(repo) {
//     return repo.name || repo.text;
//   }

//   // Sizing options

//   // Large
//   selectLg.each(function () {
//     var $this = $(this);
//     $this.wrap('<div class="position-relative"></div>');
//     $this.select2({
//       dropdownAutoWidth: true,
//       dropdownParent: $this.parent(),
//       width: '100%',
//       containerCssClass: 'select-lg'
//     });
//   });

//   // Small
//   selectSm.each(function () {
//     var $this = $(this);
//     $this.wrap('<div class="position-relative"></div>');
//     $this.select2({
//       dropdownAutoWidth: true,
//       dropdownParent: $this.parent(),
//       width: '100%',
//       containerCssClass: 'select-sm'
//     });
//   });

//   $('#select2InModal').on('shown.bs.modal', function () {
//     selectInModal.select2({
//       placeholder: 'Select a state'
//     });
//   });
// })(window, document, jQuery);


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
      
      $('#new_company_section').hide();

    


     

</script> -->




@endsection

@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
  <!-- <script src="{{URL::asset('public/custom/js/add_reservation.js')}}"></script> -->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
  <!-- <script src="{{URL::asset('public/app-assets/js/scripts/forms/customer.js')}}"></script> -->
<!-- END: Page JS-->

<!-- 
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

</script> -->

@endsection