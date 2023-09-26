@extends('layouts.master_backend_new')
@section('content')
 @php 
      $flag=0;
      $heading=lang_trans('btn_add');
      $startDate = date('Y-m-d');
      $endDate = date('Y-m-d');
      $selectedWeekDays = [];
      if(isset($data_row) && !empty($data_row)){
          $flag=1;
          $heading=lang_trans('btn_update');
          $startDate = dateConvert($data_row->start_date);
          $endDate = dateConvert($data_row->end_date);
          $selectedWeekDays = splitText($data_row->days);
      }
      $weekDays = getWeekDaysList(['type'=>1, 'is_name'=>'full']);
  @endphp 
          
  <div class="col-md-12 col-12">

        <section>
            <div class="row">
                <div class="col-12">
                    <div class="card p-0">
                        <div class="card-header">
                            <div class="d-flex justify-content-between col-12">
                                <div class="d-flex justify-content-start align-items-center" style="width:100%; gap:10px;">
                                    <a href="{{ route('all-business') }}">
                                        <button class="btn btn-primary">{{lang_trans('all_business')}}</button>
                                    </a>
                                    <a href="{{ route('all-packages') }}">
                                        <button class="btn btn-primary">{{lang_trans('all_package')}}</button>
                                    </a>
                                </div>
                                
                                <div class="d-flex justify-content-end align-items-center" style="width:100%; gap:10px;">
                                    <a href="{{ route('add-package') }}">
                                        <button class="btn btn-success"><i data-feather="plus"></i> {{lang_trans('package')}}</button>
                                    </a>
                                    <a href="{{route('add-business')}}">
                                        <button class="btn btn-success"><i data-feather="plus"></i> {{lang_trans('business')}}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
  
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{$heading}} {{lang_trans('new_business')}}</h4>
            </div>

            <div class="card-body">
                   @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-business'),'id'=>"edit-business-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-business'),'id'=>"add-business-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                  @endif 
                        <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="business_name">{{lang_trans('business_name')}}</label>
                                        {{Form::text('business_name',null,['class'=>"form-control ", "id"=>"business_name", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="business_start_date">{{lang_trans('txt_start_date')}}</label>
                                        {{Form::text('start_date',$startDate,['class'=>"form-control flatpickr-basic", "id"=>"business_start_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="business_end_date">{{lang_trans('txt_end_date')}}</label>
                                        {{Form::text('end_date',$startDate,['class'=>"form-control flatpickr-basic", "id"=>"business_end_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="mobile_num">{{lang_trans('txt_mobile_num')}}</label>
                                        {{Form::text('mobile_num',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="country">{{lang_trans('txt_country')}}</label>{{Form::text('country',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_country')])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                         <label for="business_logo" class="form-label">Logo</label>
                                        <input class="form-control" name="business_logo" type="file" id="business_logo">
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="control-label"> {{lang_trans('txt_address')}} </label>
                                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"business_address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="business_username">User name</label>
                                        {{Form::text('business_username',null,['class'=>"form-control ", "id"=>"business_username", "required"=>"required"])}}
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="business_password">Password</label>
                                       {{ Form::password('business_password', ['class' => 'form-control', 'id' => 'business_password', 'required' => 'required']) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="package_name">{{lang_trans('package')}}</label>
                                        {{Form::text('package_name',null,['class'=>"form-control ", "id"=>"package_name", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="name">Name</label>
                                        {{Form::text('name',null,['class'=>"form-control ", "id"=>"name", "required"=>"required"])}}
                                    </div>
                                </div>

                        </div>
                        <br />
                    <button type="submit" class="btn btn-info" name="submit" value="Submit">{{lang_trans('btn_submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
<!-- END: Page JS-->
@endsection