@extends('layouts.master_backend')
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
                            {{Form::radio('guest_type','existing',false,['class'=>"flat guest_type", 'id'=>'existing_guest'])}} <label for="existing_guest">{{lang_trans('txt_existing_guest')}}</label>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_reservation_type')}} <span class="required">*</span></label>
                        {{ Form::select('reservation_type',config('constants.RESERVATION_TYPE'),null,['class'=>'form-control']) }}
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
                    <label class="control-label"> {{lang_trans('txt_surname')}} </label>
                    {{Form::text('surname',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_surname')])}}
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label class="control-label"> {{lang_trans('txt_firstname')}} <span class="required">*</span></label>
                    {{Form::text('name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_firstname')])}}
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label class="control-label"> {{lang_trans('txt_middlename')}} </label>
                    {{Form::text('middle_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_middlename')])}}
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label class="control-label"> {{lang_trans('txt_email')}} </label>
                    {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label class="control-label"> {{lang_trans('txt_mobile_num')}} <span class="required">*</span></label>
                    {{Form::text('mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label class="control-label"> {{lang_trans('txt_address')}} <span class="required">*</span></label>
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
                  <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_gender')}} <span class="required">*</span></label>
                      {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                  </div>
                  @if(!$quickCheckIn)
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_age')}} </label>
                      {{Form::number('age',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"age", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_age'),"min"=>10])}}
                    </div>
                  @endif
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
{{--                      <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                          <label class="control-label"> {{lang_trans('txt_purpose_of_the_visiting')}} <span class="required">*</span></label>--}}
{{--                          {{Form::text('purpose_of_the_visiting',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"purpose_of_the_visiting", "placeholder"=>lang_trans('txt_purpose_of_the_visiting')])}}--}}
{{--                      </div>--}}
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

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_company_name')}}</label>
                        {{Form::text('company_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_name')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_company_gst_num')}}</label>
                        {{Form::text('company_gst_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_gst_num", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_company_gst_num')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_room_plan')}} <span class="required">*</span></label>
                        {{ Form::select('room_plan',config('constants.ROOM_PLANS'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                      </div>
                      @if(!$quickCheckIn)
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_booked_by')}}</label>
                          {{Form::text('booked_by',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"booked_by", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_booked_by')])}}
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_vehicle_number')}}</label>
                          {{Form::text('vehicle_number',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"vehicle_number", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_vehicle_number')])}}
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label class="control-label"> {{lang_trans('txt_referred_by')}}<span class="required">*</span></label>
                            {{ Form::select('referred_by',config('constants.REFERRED_BY'),null,['class'=>'form-control',"id"=>"referred_by"]) }}
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_referred_by_name')}}</label>
                          {{Form::text('referred_by_name','WALK-IN',['class'=>"form-control col-md-6 col-xs-12", "id"=>"referred_by_name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_referred_by_name')])}}
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label class="control-label"> {{lang_trans('txt_remark_amount')}} </label>
                            {{Form::number('remark_amount',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"Remark Amount","placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark_amount'),"min"=>0])}}
                        </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="control-label"> {{lang_trans('txt_reason_of_visit')}} <span class="required">*</span></label>
                              {{Form::textarea('reason_visit_stay',null,['class'=>"form-control h34 col-md-6 col-xs-12", "id"=>"reason_visit_stay", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_reason_of_visit'),"rows"=>1])}}
                          </div>
                      @endif

                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_remark')}}</label>
                        {{Form::textarea('remark',null,['class'=>"form-control h34 col-md-6 col-xs-12", "id"=>"remark", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark'),"rows"=>1])}}
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  @if(!$quickCheckIn)
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
                                  <label class="control-label">{{lang_trans('txt_type_id')}} <span class="required">*</span></label>
                                  {{ Form::select('idcard_type',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_id_number')}} <span class="required">*</span></label>
                                  {{Form::text('idcard_no',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_id_number')])}}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_upload_idcard')}} <sup class="color-ff4">{{lang_trans('txt_multiple')}}</sup> </label>
                                  {{Form::file('id_image[]',['class'=>"form-control",'id'=>'idcard_image','multiple'=>true])}}
                              </div>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
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
                            {{ Form::select('persons_info[idcard_type][]',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
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



      @if(env('APP_NT_ENABLE'))

          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                      <div class="x_title">
                          <h2>{{lang_trans('ministory_of_tourism_section')}}</h2>
                          <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                          <div class="row">
{{--                              <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                                  <label class="control-label"> {{lang_trans('txt_total_number_of_guest')}} <span class="required">*</span></label>--}}
{{--                                  {{ Form::number('mt_total_number_of_guest',1,['class'=>'form-control col-md-6 col-xs-12', 'required'=>'required']) }}--}}
{{--                                  {{ Form::hidden('mt_iscreate',1,['class'=>'form-control col-md-6 col-xs-12', 'required'=>'required']) }}--}}
{{--                              </div>--}}
{{--                              <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                                  <label class="control-label"> {{lang_trans('txt_date_of_birth')}} <span class="required">*</span></label>--}}
{{--                                  {{ Form::date('mt_date_of_birth','',['class'=>'form-control col-md-6 col-xs-12', 'required'=>'required']) }}--}}
{{--                              </div>--}}
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_nationality')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_nationality',getDynamicDropdownList('nationalities', true),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_room_rent_type')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_room_rent_type',getDynamicDropdownList('room_rent_type', true),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>
{{--                              <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                                  <label class="control-label"> {{lang_trans('txt_gender')}} <span class="required">*</span></label>--}}
{{--                                  {{ Form::select('mt_gender',getDynamicDropdownList('gender', true),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}--}}
{{--                              </div>--}}
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_customer_types')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_customer_types',getDynamicDropdownList('customer_types', true),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_room_type')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_room_type',getDynamicDropdownList('room_types', true),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_reason_of_visit')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_reason_of_visit',getDynamicDropdownList('reason_of_visit', true),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <label class="control-label"> {{lang_trans('txt_payment_type')}} <span class="required">*</span></label>
                                  {{ Form::select('mt_payment_type',getDynamicDropdownList('payment_type', true),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select'), 'required'=>'required']) }}
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
</div>

{{-- require set var in js var --}}
<script>
  globalVar.page = 'room_reservation_add';
  globalVar.customerList = {!! json_encode($customer_list) !!};
</script>
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('submit', '#add-reservation-form', function(e){
            e.preventDefault();
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
                        confirmButtonText: 'View Invoice',
                    }).then((result) => {
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
    </script>
@endsection
