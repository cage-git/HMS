@extends('layouts.master_backend_new')
@section('content')
@php 
      use Illuminate\Support\Facades\DB;
      use Illuminate\Support\Facades\Auth;
      $flag=0;
      $heading=lang_trans('btn_add');
      if(isset($data_row) && !empty($data_row)){
          $flag=1;
          $heading=lang_trans('btn_update');
      }
      $user = Auth::user();
      $hotels = DB::table('hotel')
                ->where([
                ['status', 1],
                ['business_id', $user->business_id]
            ])->get()->toArray();
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
                <h4 class="card-title"> {{$heading}} {{lang_trans('txt_room')}}</h4>
            </div>
            <div class="card-body">
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-room'),'id'=>"room-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-room'),'id'=>"room-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                  @endif
                        <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_room_type')}}</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::select('room_type_id',$roomtypes_list,null,['class'=>'form-select','placeholder'=>lang_trans('ph_select')]) }}    
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_name')}}</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('room_name',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"room_name", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_room_num')}}</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('room_no',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"room_no", "required"=>"required"])}}
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_floor')}}</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::select('floor',getDynamicDropdownList('room_floor'),null,['class'=>'form-select','placeholder'=>lang_trans('ph_select')]) }}    
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">Hotel</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::select('hotel',collect($hotels)->pluck('name','id'),null,['class'=>'form-select','placeholder'=>lang_trans('ph_select')]) }}    
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_order_num')}}</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::number('order_num',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"order_num", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_status')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        <!-- {{ Form::select('status',config('constants.LIST_STATUS'),1,['class'=>'form-select']) }}   -->
                                        <div class="form-check form-check-success form-switch">
                                                <input type="checkbox" <?php if(isset($data_row->status)){ if($data_row->status  == 1){ echo 'checked'; }else{ echo '';} }else{ echo 'checked'; } ?> class="form-check-input" id="switch_status" onclick="changeStatus()" />
                                                <input type="hidden" name="status" id="status_id" value="<?php if(isset($data_row->status)){ if($data_row->status  == 1){ echo '1'; }else{ echo '0';} }else{ echo '1'; } ?>"> 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_images')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::file('room_images[]',['class'=>"form-control",'id'=>'room_images','multiple'=>true])}}
                                    </div>
                                </div>

                                @if( $flag==1 && $data_row->attachments->count())
                        <div class="row">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attachments"> {{lang_trans('txt_uploaded_files')}}</label>
                          <div class="col-sm-6">
                              <table class="table table-bordered">
                                <tr>
                                  <th>{{lang_trans('txt_sno')}}.</th>
                                  <th>{{lang_trans('txt_name')}}.</th>
                                  <th>{{lang_trans('txt_action')}}</th>
                                </tr>
                                @if($data_row->attachments)
                                  @foreach($data_row->attachments as $k=>$val)
                                    @if($val->file!='')
                                      <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$val->file}}</td>
                                        <td>
                                          <a href="{{checkFile($val->file,'uploads/room_images/','blank_id.jpg')}}" data-toggle="lightbox"  data-title="{{lang_trans('txt_attachment')}}" data-footer="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> </a>
                                          <a href="{{checkFile($val->file,'uploads/room_images/','blank_id.jpg')}}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i> </a>
                                         <button type="button" class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-mediafile',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                                        </td>
                                      </tr>
                                    @endif
                                  @endforeach
                                @else
                                  <tr>
                                      <td colspan="2">{{lang_trans('txt_no_file')}}</td>
                                  </tr>
                                @endif
                              </table>
                          </div>
                          <div class="col-sm-3">&nbsp;</div>
                        </div>
                      @endif

                        </div>
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
                  <h2>{{$heading}} {{lang_trans('txt_room')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-room'),'id'=>"room-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-room'),'id'=>"room-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                  @endif
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_type_id"> {{lang_trans('txt_room_type')}}<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('room_type_id',$roomtypes_list,null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}    
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_name"> {{lang_trans('txt_name')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('room_name',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"room_name", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_no"> {{lang_trans('txt_room_num')}}<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('room_no',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"room_no", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_floor"> {{lang_trans('txt_floor')}}<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('floor',getDynamicDropdownList('room_floor'),null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}    
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order_num"> {{lang_trans('txt_order_num')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::number('order_num',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"order_num", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_status')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('status',config('constants.LIST_STATUS'),1,['class'=>'form-control']) }}    
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_images"> {{lang_trans('txt_images')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::file('room_images[]',['class'=>"form-control",'id'=>'room_images','multiple'=>true])}}
                          </div>
                      </div>
                      @if( $flag==1 && $data_row->attachments->count())
                        <div class="row">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attachments"> {{lang_trans('txt_uploaded_files')}}</label>
                          <div class="col-sm-6">
                              <table class="table table-bordered">
                                <tr>
                                  <th>{{lang_trans('txt_sno')}}.</th>
                                  <th>{{lang_trans('txt_name')}}.</th>
                                  <th>{{lang_trans('txt_action')}}</th>
                                </tr>
                                @if($data_row->attachments)
                                  @foreach($data_row->attachments as $k=>$val)
                                    @if($val->file!='')
                                      <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$val->file}}</td>
                                        <td>
                                          <a href="{{checkFile($val->file,'uploads/room_images/','blank_id.jpg')}}" data-toggle="lightbox"  data-title="{{lang_trans('txt_attachment')}}" data-footer="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> </a>
                                          <a href="{{checkFile($val->file,'uploads/room_images/','blank_id.jpg')}}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i> </a>
                                         <button type="button" class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-mediafile',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                                        </td>
                                      </tr>
                                    @endif
                                  @endforeach
                                @else
                                  <tr>
                                      <td colspan="2">{{lang_trans('txt_no_file')}}</td>
                                  </tr>
                                @endif
                              </table>
                          </div>
                          <div class="col-sm-3">&nbsp;</div>
                        </div>
                      @endif
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
        <script src="{{URL::asset('public/app-assets/js/scripts/forms/room-form-validation.js')}}"></script>
    <!-- END: Page JS-->
@endsection