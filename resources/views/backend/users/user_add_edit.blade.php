@extends('layouts.master_backend_new')
@section('content')
@php
      $flag=0;
      $heading=lang_trans('btn_add');
      $hide = false;
      if(isset($data_row) && !empty($data_row)){
          $flag=1;
          $heading=lang_trans('btn_update');
          $hide = true;
      }
  @endphp



  <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{$heading}} {{lang_trans('txt_user')}}</h4>
            </div>
            <div class="card-body">
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-user'),'id'=>"edit-user-form", 'class'=>"form-horizontal form-label-left")) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-user'),'id'=>"add-user-form", 'class'=>"form-horizontal form-label-left")) }}
                      @php
                          $data_row['role_id'] = '';
                      @endphp
                  @endif
                        <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_user_role')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::select('role_id',$roles,null,['class'=>'form-select','placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_name')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_fullname')])}}
                                    </div>
                                </div>

                                @if($data_row['role_id'] != 6)
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_email')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                                    </div>
                                </div>
                                @endif


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_mobile_num')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_password')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::password('new_password',['class'=>'form-control col-md-6 col-xs-12',"id"=>'password','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_password_conf')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::password('conf_password',['class'=>'form-control col-md-6 col-xs-12',"id"=>'conf_password','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password_conf')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_gender')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-select col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_address')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_status')}}</label>
                                        <div class="form-check form-check-success form-switch">
                                                <input type="checkbox" <?php if(isset($data_row->status)){ if($data_row->status  == 1){ echo 'checked'; }else{ echo '';} }else{ echo 'checked'; } ?> class="form-check-input" id="switch_status" onclick="changeStatus()" />
                                                <input type="hidden" name="status" id="status_id" value="<?php if(isset($data_row->status)){ if($data_row->status  == 1){ echo '1'; }else{ echo '0';} }else{ echo '1'; } ?>"> 
                                        </div>
                                    </div>
                                </div>

                        </div>
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit">{{lang_trans('btn_submit')}}</button>
                    <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button>
                </form>
            </div>
        </div>
    </div>


<!--   
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{$heading}} {{lang_trans('txt_user')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-user'),'id'=>"edit-user-form", 'class'=>"form-horizontal form-label-left")) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-user'),'id'=>"add-user-form", 'class'=>"form-horizontal form-label-left")) }}
                      @php
                          $data_row['role_id'] = '';
                      @endphp
                  @endif
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label">{{lang_trans('txt_user_role')}} <span class="required">*</span></label>
                          {{ Form::select('role_id',$roles,null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_name')}} <span class="required">*</span></label>
                        {{Form::text('name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_fullname')])}}
                      </div>
                        @if($data_row['role_id'] != 6)
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_email')}} <span class="required">*</span></label>
                        {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                      </div>
                        @endif
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_mobile_num')}} <span class="required">*</span></label>
                        {{Form::text('mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                      </div>
                        @if($data_row['role_id'] != 6)
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label">{{lang_trans('txt_password')}} @if($flag==0) <span class="required">*</span> @endif</label>
                          <div class="value eye_icon_parent">
                            <i class="fa fa-eye eye_icon" data-id="password"></i>
                            {{ Form::password('new_password',['class'=>'form-control col-md-6 col-xs-12',"id"=>'password','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password')]) }}
                          </div>
                      </div>
                       @if($flag==0)
                       <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label">{{lang_trans('txt_password_conf')}} <span class="required">*</span> </label>
                          <div class="value eye_icon_parent">
                            <i class="fa fa-eye eye_icon" data-id="conf_password"></i>
                            {{ Form::password('conf_password',['class'=>'form-control col-md-6 col-xs-12',"id"=>'conf_password','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password_conf')]) }}
                          </div>
                      </div>
                      @endif
                        @endif
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label">{{lang_trans('txt_gender')}} <span class="required">*</span></label>
                          {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_address')}} <span class="required">*</span></label>
                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_status')}} <span class="required">*</span></label>
                       {{ Form::select('status',config('constants.LIST_STATUS'),null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}
                      </div>

                  </div>
                      <div class="ln_solid"></div>
                      <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <button class="btn btn-success" type="submit">{{lang_trans('btn_submit')}}</button>
                      </div>
                  {{Form::close()}}
              </div>
          </div>
      </div>
  </div>
</div> -->

<script>

    function changeStatus(){
        
        console.log($('#switch_status').prop('checked'));
        var swtichData = $('#switch_status').prop('checked');
        if(swtichData){
            $("#status_id").val(1);
        }else{
            $("#status_id").val(0);
        }
    }
</script>
@endsection
@section('scripts')

    <!-- BEGIN: Page JS-->
        <script src="{{URL::asset('public/app-assets/js/scripts/forms/user-form-validation.js')}}"></script>
    <!-- END: Page JS-->
@endsection