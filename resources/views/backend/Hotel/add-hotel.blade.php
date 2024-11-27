@extends('layouts.master_backend_new')
@php 
      $heading=lang_trans('btn_add');
  @endphp 
@section('content')          
<div class="col-md-12 col-12">  
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{$heading}} Hotels</h4>
            </div>

            <div class="card-body">
                      {{ Form::open(array('url'=>route('save-hotel'),'id'=>"add-hotel-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                        <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="hotel_name">Hotel Name</label><span class="text-danger">*</span>
                                        {{Form::text('hotel_name',null,['class'=>"form-control ",'placeholder'=>lang_trans('Hotel name'), "id"=>"hotel_name", "required"=>"required"])}}
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="location_id">Location Id</label><span class="text-danger">*</span>
                                        {{Form::text('location_id',null,['class'=>"form-control", 'placeholder'=>lang_trans('Enter location id')])}}
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="landmark">Landmark</label><span class="text-danger">*</span>{{Form::text('landmark',null,['class'=>"form-control ",'placeholder'=>lang_trans('Enter landmark'), "id"=>"landmark", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                         <label for="zipcode" class="form-label">Zip code</label><span class="text-danger">*</span>
                                        {{Form::text('zipcode',null,['class'=>"form-control ",'placeholder'=>lang_trans('Enter zipcode'), "id"=>"zipcode", "required"=>"required"])}}
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="control-label" for="address"> {{lang_trans('txt_address')}} </label>
                                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"hotel_address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_status')}}</label>
                                       <div class="form-check form-check-success form-switch">
                                                <input type="checkbox" class="form-check-input" id="switch_status" onclick="changeStatus()" />
                                                <input type="hidden" name="status" id="status_id" value=""> 
                                        </div>
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
<script>

    function changeStatus(){
        var swtichData = $('#switch_status').prop('checked');
        if(swtichData){
            $("#status_id").val(1);
        }else{
            $("#status_id").val(0);
        }
    }
      
</script>
<script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
<!-- END: Page JS-->
@endsection