@extends('layouts.master_backend_new')
@section('content')
@php 
      $flag=0;
      $heading=lang_trans('btn_add');
      if(isset($data_row) && !empty($data_row)){
          $flag=1;
          $heading=lang_trans('btn_update');
      }
  @endphp
  <div class="col-md-12 col-12">
         @if(session('success'))
            <div class="alert p-2 alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert p-2 alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{$heading}} {{lang_trans('txt_housekeeping_item')}}</h4>
            </div>
            <div class="card-body">
                 @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-housekeeping-item'),'id'=>"housekeeping-item-form", 'class'=>"form-horizontal form-label-left")) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-housekeeping-item'),'id'=>"housekeeping-item-form", 'class'=>"form-horizontal form-label-left")) }}
                  @endif

                        <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_name')}}</label><span class="required text-danger">*</span>
                                        {{Form::text('name',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"cat_name", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_status')}}</label>
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
                  <h2>{{$heading}} {{lang_trans('txt_housekeeping_item')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-housekeeping-item'),'id'=>"housekeeping-item-form", 'class'=>"form-horizontal form-label-left")) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-housekeeping-item'),'id'=>"housekeeping-item-form", 'class'=>"form-horizontal form-label-left")) }}
                  @endif
                  
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_name"> {{lang_trans('txt_name')}}<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('name',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"cat_name", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_status')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('status',config('constants.LIST_STATUS'),1,['class'=>'form-control']) }}    
                          </div>
                      </div>
                     
                      <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button class="btn btn-primary" type="reset">{{lang_trans('btn_reset')}}</button>
                              <button class="btn btn-success" type="submit">{{lang_trans('btn_submit')}}</button>
                          </div>
                      </div>
                  </form>
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
        <script src="{{URL::asset('public/app-assets/js/scripts/forms/housekeeping-form-validation.js')}}"></script>
    <!-- END: Page JS-->
@endsection