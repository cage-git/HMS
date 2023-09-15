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
                <h4 class="card-title"> {{$heading}} {{lang_trans('heading_expense')}}</h4>
            </div>
            <div class="card-body">
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-expense'),'id'=>"expense-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-expense'),'id'=>"expense-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                  @endif
                        <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_category')}}</label> <span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{ Form::select('category_id',$category_list,null,['class'=>'form-select','placeholder'=>lang_trans('ph_select')]) }}    
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_title')}}</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('title',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"title", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_amount')}}</label><span class="required text-danger">*</span>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('amount',null,['class'=>"form-control price_val col-md-7 col-xs-12", "id"=>"amount", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_date')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::text('datetime',date('Y-m-d'),['class'=>"form-control col-md-6 col-xs-12 flatpickr-basic", "id"=>"expense_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_remark')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::textarea('remark',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"remark", "rows"=>1])}}
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-default-name">{{lang_trans('txt_uploaded_files')}}</label>
                                        <!-- <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" placeholder="John Doe" /> -->
                                        {{Form::file('attachments[]',['class'=>"form-control",'id'=>'attachments','multiple'=>true])}}
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-12">
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
                                                          <a href="{{checkFile($val->file,'uploads/expenses/','blank_id.jpg')}}" data-toggle="lightbox"  data-title="{{lang_trans('txt_attachment')}}" data-footer="" class="btn btn-sm btn-primary"  data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-feather='eye'></i> </a>
                                                          <a href="{{checkFile($val->file,'uploads/expenses/','blank_id.jpg')}}" class="btn btn-sm btn-success" download  data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i data-feather='download'></i> </a>
                                                        <button type="button" class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-mediafile',[$val->id])}}" title="{{lang_trans('btn_delete')}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i data-feather='trash'></i></button>
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
                        </div>
                        <hr>
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
                  <h2>{{$heading}} {{lang_trans('heading_expense')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-expense'),'id'=>"expense-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-expense'),'id'=>"expense-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                  @endif
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_category')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('category_id',$category_list,null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}    
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> {{lang_trans('txt_title')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('title',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"title", "required"=>"required"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"> {{lang_trans('txt_amount')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('amount',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"amount", "required"=>"required"])}}
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expense_date"> {{lang_trans('txt_date')}}<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {{Form::text('datetime',date('Y-m-d'),['class'=>"form-control col-md-6 col-xs-12 datepicker", "id"=>"expense_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                        </div>
                      </div>
                      
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="remark"> {{lang_trans('txt_remark')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::textarea('remark',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"remark", "rows"=>1])}}
                          </div>
                      </div>
                      
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attachments"> {{lang_trans('txt_attachment')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::file('attachments[]',['class'=>"form-control",'id'=>'attachments','multiple'=>true])}}
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
                                          <a href="{{checkFile($val->file,'uploads/expenses/','blank_id.jpg')}}" data-toggle="lightbox"  data-title="{{lang_trans('txt_attachment')}}" data-footer="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> </a>
                                          <a href="{{checkFile($val->file,'uploads/expenses/','blank_id.jpg')}}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i> </a>
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
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/expense-form-validation.js')}}"></script>
<!-- END: Page JS-->
@endsection
