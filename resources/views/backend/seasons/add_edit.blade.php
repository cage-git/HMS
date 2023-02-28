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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{$heading}} {{lang_trans('heading_season')}}</h4>
            </div>
            <div class="card-body">
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-season'),'id'=>"season-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-season'),'id'=>"season-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                  @endif
                        <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_name">{{lang_trans('txt_season_name')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('name',null,['class'=>"form-control ", "id"=>"season_name", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_start_date')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('start_date',$startDate,['class'=>"form-control flatpickr-basic", "id"=>"season_start_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="season_start_date">{{lang_trans('txt_end_date')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('end_date',$endDate,['class'=>"form-control col-md-6 col-xs-12 flatpickr-basic", "id"=>"season_end_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                                    </div>
                                </div>
                                
                                <div class="col-xl-1 col-md-1 col-1">
                                  @foreach($weekDays as $k=>$val)
                                  <div class="form-check form-check-inline">
                                      {{ Form::checkbox('week_days[]', $k, (in_array($k, $selectedWeekDays)),['class'=>"form-check-input"] ) }}
                                      <label class="form-check-label" for="inlineCheckbox2">{{$val}}</label>
                                  </div>
                                  @endforeach
                                </div>

                        </div>
                        <br />
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
                  <h2>{{$heading}} {{lang_trans('heading_season')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-season'),'id'=>"season-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-season'),'id'=>"season-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                  @endif
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="season_name"> {{lang_trans('txt_season_name')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('name',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"season_name", "required"=>"required"])}}
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="season_start_date"> {{lang_trans('txt_start_date')}}<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {{Form::text('start_date',$startDate,['class'=>"form-control col-md-6 col-xs-12 datepicker", "id"=>"season_start_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="season_end_date"> {{lang_trans('txt_end_date')}}<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {{Form::text('end_date',$endDate,['class'=>"form-control col-md-6 col-xs-12 datepicker", "id"=>"season_end_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="season_end_date"> {{lang_trans('txt_days')}}<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          @foreach($weekDays as $k=>$val)
                            <div class="checkbox">
                              <label class="">
                                {{ Form::checkbox('week_days[]', $k, (in_array($k, $selectedWeekDays)),['class'=>"disable-checkbox"] ) }}
                                {{$val}}
                              </label>
                            </div>
                          @endforeach
                        </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button class="btn btn-primary" type="reset">
                                  {{lang_trans('btn_reset')}}
                              </button>
                              <button class="btn btn-success" type="submit">
                                  {{lang_trans('btn_submit')}}
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div> -->
@endsection

@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
<!-- END: Page JS-->
@endsection