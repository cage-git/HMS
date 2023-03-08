@extends('layouts.master_backend_new')
@section('content')



<section id="basic-datatable">

      <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{lang_trans('heading_filter_company')}}</h4>
              </div>
              <div class="card-body">
                    {{ Form::model($search_data,array('url'=>route('search-company'),'id'=>"search-company", 'class'=>"form-horizontal form-label-left")) }}
                      <div class="row">  
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="category">{{lang_trans('txt_category')}}</label>
                              
                                {{Form::text('company_id',null,['class'=>"form-control", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_from">{{lang_trans('txt_mobile_num')}}</label>
                              
                                {{Form::text('mobile_num',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_date_to')}}</label>
                              
                                {{Form::text('city',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_city')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_date_to')}}</label>
                              
                                {{Form::text('state',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_state')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_date_to')}}</label>
                              
                                {{Form::text('country',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_country')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                            <br>
                            <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button>
                            </div>
                        </div>
                       
                      </div>
                  </form>
              </div>
            </div>
        </div>
      </div>

    <div class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('txt_list_companys')}}</h4>
                    <a href="{{route('add-company')}}"><button class="btn btn-primary" >{{lang_trans('sidemenu_company_add')}} </button></a>
                </div>
                  @php
                    $totalAmount = 0;
                  @endphp
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_company_name')}}</th>
                        <th>{{lang_trans('txt_company_gst_num')}}</th>
                        <th>{{lang_trans('txt_company_mobile_num')}}</th>
                        <th>{{lang_trans('txt_company_email')}}</th>
                        <th>{{lang_trans('txt_company_address')}}</th>
                        <th>{{lang_trans('txt_company_country')}}</th>
                     
                        <th>{{lang_trans('txt_action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datalist as $k=>$val)
                      @php
                        $totalAmount = $totalAmount+$val->amount;
                      @endphp
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{$val->company_gst_num}}</td>
                        <td>{{$val->mobile}}</td>
                        <td>{{$val->email}}</td>
                        <td>{{$val->address}}</td>
                        <td>{{$val->country}}</td>
                     
                        <td>
                          <a class="btn btn-sm btn-info" href="{{route('edit-company',[$val->id])}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i data-feather='edit'></i></a>
                         
                        </td>
                      </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</section>







<!-- <div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2>{{lang_trans('heading_filter_company')}}</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
              {{ Form::model($search_data,array('url'=>route('search-company'),'id'=>"search-company", 'class'=>"form-horizontal form-label-left")) }}
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_fullname')}}</label>
                  {{Form::text('company_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_mobile_num')}}</label>
                  {{Form::text('mobile_num',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_city')}}</label>
                  {{Form::text('city',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_city')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_state')}}</label>
                  {{Form::text('state',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_state')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_country')}}</label>
                  {{Form::text('country',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_country')])}}
                </div>
                <div class="form-group col-sm-2">
                  <br/>
                   <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                   <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                </div>
              {{ Form::close() }}
          </div>
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_list_companys')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_company_name')}}</th>
                      <th>{{lang_trans('txt_company_gst_num')}}</th>
                      <th>{{lang_trans('txt_company_mobile_num')}}</th>
                      <th>{{lang_trans('txt_company_email')}}</th>
                      <th>{{lang_trans('txt_company_address')}}</th>
                      <th>{{lang_trans('txt_company_country')}}</th>
                      <th>{{lang_trans('txt_company_state')}}</th>
                      <th>{{lang_trans('txt_company_city')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{$val->company_gst_num}}</td>
                        <td>{{$val->mobile}}</td>
                        <td>{{$val->email}}</td>
                        <td>{{$val->address}}</td>
                        <td>{{$val->country}}</td>
                        <td>{{$val->state}}</td>
                        <td>{{$val->city}}</td>
                        <td>
                          <a class="btn btn-sm btn-info" href="{{route('edit-company',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div> -->
<script>
  globalVar.customerList = {!! json_encode($customer_list) !!};
</script>
@endsection

@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
<!-- END: Page JS-->
@endsection