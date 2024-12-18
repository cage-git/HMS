@extends('layouts.master_backend_new')
@section('content')



<div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{lang_trans('heading_update_profile')}}</h4>
            </div>
            <div class="card-body">
            {{ Form::model($data_row,array('url'=>route('save-profile'),'id'=>"profile-update-form", 'class'=>"form-horizontal form-label-left")) }}
            {{Form::hidden('form_type','updateDetails')}}

            <div class="row">
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_name')}}</label>
                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                        {{Form::text('name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_fullname')])}}
                    </div>
                </div>


                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_email')}}</label>
                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                        {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "readonly"=>true])}}
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_mobile_num')}}</label>
                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                        {{Form::text('mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                    </div>
                </div>


                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_gender')}}</label>
                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                        {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-select col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                    </div>
                </div>

            </div>

            <button class="btn btn-success" type="submit">{{lang_trans('btn_submit')}}</button>


            </form>

        </div>


        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{lang_trans('heading_update_password')}}</h4>
            </div>
            <div class="card-body">
            {{ Form::open(array('url'=>route('save-profile'),'id'=>"password-update-form", 'class'=>"form-horizontal form-label-left")) }}
            {{Form::hidden('form_type','updatePassword')}}

            <div class="row">
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_password_new')}}</label>
                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                        {{ Form::password('new_password',['class'=>'form-control col-md-6 col-xs-12',"id"=>'password','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password_new')]) }}
                    </div>
                </div>


                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_password_conf')}}</label>
                        {{ Form::password('conf_password',['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password_conf')]) }}
                    </div>
                </div>

            </div>    
            <button class="btn btn-success" type="submit">{{lang_trans('btn_submit')}}</button>


        </form>

        </div>

</div>



<!-- 

<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_update_profile')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                      {{ Form::model($data_row,array('url'=>route('save-profile'),'id'=>"profile-update-form", 'class'=>"form-horizontal form-label-left")) }}
                      {{Form::hidden('form_type','updateDetails')}}
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_name')}} <span class="required">*</span></label>
                        {{ Form::password('new_password',['class'=>'form-control col-md-6 col-xs-12',"id"=>'password','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password_new')]) }}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_email')}} <span class="required">*</span></label>
                        {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "readonly"=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_mobile_num')}} <span class="required">*</span></label>
                        {{Form::text('mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_gender')}} <span class="required">*</span></label>
                          {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
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
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_update_password')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                      {{ Form::open(array('url'=>route('save-profile'),'id'=>"password-update-form", 'class'=>"form-horizontal form-label-left")) }}
                      {{Form::hidden('form_type','updatePassword')}}
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label">{{lang_trans('txt_password_new')}} <span class="required">*</span></label>
                          {{ Form::password('new_password',['class'=>'form-control col-md-6 col-xs-12',"id"=>'password','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password_new')]) }}
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label">{{lang_trans('txt_password_conf')}} <span class="required">*</span> </label>
                          {{ Form::password('conf_password',['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password_conf')]) }}
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
@endsection
