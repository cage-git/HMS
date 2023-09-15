@extends('layouts.master_backend_new')
@section('content')
@php 
      $flag=0;
      $heading=lang_trans('heading_add_product');
      if(isset($data_row) && !empty($data_row)){
          $flag=1;
          $heading=lang_trans('heading_update_product');
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
                <h4 class="card-title"> {{$heading}} {{lang_trans('heading_season')}}</h4>
            </div>
            <div class="card-body">
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-product'),'id'=>"update-product-form", 'class'=>"form-horizontal form-label-left")) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-product'),'id'=>"add-product-form", 'class'=>"form-horizontal form-label-left")) }}
                  @endif
                        <div class="row">
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_product_name')}}</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('name',null,['class'=>"form-control ", "id"=>"product_name", "required"=>"required"])}}
                                    </div>
                                </div>
                           

                              @if($flag==0)
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="qty">{{lang_trans('txt_qty')}}</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::number('stock_qty',null,['class'=>"form-control col-xl-4 col-md-6 col-12", "id"=>"prod_quantity", "required"=>"required"])}}
                                        </div>
                                    </div>
                               

                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_Measurement')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::select('measurement',getUnits(),null,['class'=>'form-select col-xl-4 col-md-6 col-12','placeholder'=>lang_trans('ph_select')]) }}    
                                    </div>
                                </div>
                              @else
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="qty">{{lang_trans('txt_qty')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::number('stock_qty',null,['class'=>"form-control col-xl-4 col-md-6 col-12", "id"=>"prod_quantity", "required"=>"required"])}}
                                        </div>
                                    </div>
                               

                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_Measurement')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::select('measurement',getUnits(),null,['class'=>'form-select col-xl-4 col-md-6 col-12','placeholder'=>lang_trans('ph_select')]) }}    
                                    </div>
                                </div>
                              @endif

                              <div class="col-xl-3 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_status')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        <!-- {{ Form::select('status',config('constants.LIST_STATUS'),1,['class'=>'form-control']) }}     -->
                                        <div class="form-check form-check-success form-switch">
                                                <input type="checkbox" <?php if(isset($data_row->status)){ if($data_row->status  == 1){ echo 'checked'; }else{ echo '';} }else{ echo 'checked'; } ?> class="form-check-input" id="switch_status" onclick="changeStatus()" />
                                                <input type="hidden" name="status" id="status_id" value="<?php if(isset($data_row->status)){ if($data_row->status  == 1){ echo '1'; }else{ echo '0';} }else{ echo '1'; } ?>"> 
                                            </div>
                                    </div>
                                </div>
                        </div>
                        <br />
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit">{{lang_trans('btn_submit')}}</button>
                    <button type="reset" class="btn reset_btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button>
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
                  <h2>{{$heading}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-product'),'id'=>"update-product-form", 'class'=>"form-horizontal form-label-left")) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-product'),'id'=>"add-product-form", 'class'=>"form-horizontal form-label-left")) }}
                  @endif
                  
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_name"> {{lang_trans('txt_product_name')}}<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('name',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"product_name", "required"=>"required"])}}
                          </div>
                      </div>
                      @if($flag==0)
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prod_quantity"> {{lang_trans('txt_qty')}}<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                {{Form::number('stock_qty',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"prod_quantity", "required"=>"required"])}}
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                {{ Form::select('measurement',getUnits(),null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}    
                              </div>
                            </div>
                        </div>
                      @else
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prod_quantity"> {{lang_trans('txt_unit')}}<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::select('measurement',getUnits(),$data_row->measurement,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}   
                            </div>
                          </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prod_quantity"> {{lang_trans('txt_curr_stock')}}<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{Form::number('curr_stock',$data_row->stock_qty,['class'=>"form-control col-md-7 col-xs-12", "id"=>"prod_quantity", "readonly"=>"readonly"])}}
                            </div>
                          </div>
                      @endif
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
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/product-form-validation.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/add-product-form-validation.js')}}"></script>
<!-- END: Page JS-->
@endsection