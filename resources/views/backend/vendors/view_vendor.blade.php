@extends('layouts.master_backend_new')
@section('content')


  <div class="card">
      <div class="card-header">
          <h4 class="card-title mb-50">{{lang_trans('heading_vendor_info')}}</h4>
      </div>
      <hr/>
      <div class="card-body">
          <div class="row">
              <div class="col-xl-7 col-12">
                  <dl class="row mb-0">
                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_category')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->category->name}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_email')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->vendor_email}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_mobile_num')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->vendor_mobile}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_contact_person_name')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->contact_person_name}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_contact_person_mobile')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->contact_person_mobile}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_address')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->vendor_address}}, {{$data_row->vendor_city}}, {{$data_row->vendor_state}}, {{$data_row->country->name}}</dd>
                  </dl>
              </div>
              <div class="col-xl-5 col-12">
                  <dl class="row mb-0">

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_name')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->vendor_name}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_phone_num')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->vendor_phone}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_gst_num')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->vendor_gst_num}}</dd>

                      <dt class="col-sm-4 fw-bolder mb-1">{{lang_trans('txt_contact_person_email')}}:</dt>
                      <dd class="col-sm-8 mb-1">{{$data_row->contact_person_email}}</dd>

                      
                  </dl>
              </div>
          </div>
      </div>
  </div>




<!-- 

  <div class="">
        <div class="row" id="new_guest_section">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_vendor_info')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                  <div class="row"> 
                    <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-bordered">
                              <tr>
                                  <th>{{lang_trans('txt_category')}}</th>
                                  <td>{{$data_row->category->name}}</td>
                                  <th>{{lang_trans('txt_name')}}</th>
                                  <td>{{$data_row->vendor_name}}</td>
                              </tr>
                              <tr>
                                <th>{{lang_trans('txt_email')}}</th>
                                <td>{{$data_row->vendor_email}}</td>
                                <th>{{lang_trans('txt_mobile_num')}}</th>
                                <td>{{$data_row->vendor_mobile}}</td>
                              </tr>
                              <tr>
                                <th>{{lang_trans('txt_phone_num')}}</th>
                                <td>{{$data_row->vendor_phone}}</td>
                                <th>{{lang_trans('txt_gst_num')}}</th>
                                <td>{{$data_row->vendor_gst_num}}</td>
                              </tr>
                              <tr>
                                <th>{{lang_trans('txt_contact_person_name')}}</th>
                                <td>{{$data_row->contact_person_name}}</td>
                                <th>{{lang_trans('txt_contact_person_email')}}</th>
                                <td>{{$data_row->contact_person_email}}</td>
                              </tr>
                              <tr>
                                <th>{{lang_trans('txt_contact_person_mobile')}}</th>
                                <td>{{$data_row->contact_person_mobile}}</td>
                                <th></th>
                                <td></td>
                              </tr>
                              <tr>
                                <th>{{lang_trans('txt_address')}}</th>
                                <td colspan="3">{{$data_row->vendor_address}}, {{$data_row->vendor_city}}, {{$data_row->vendor_state}}, {{$data_row->country->name}}</td>
                              </tr>
                            
                            </tbody>
                          </table>
                        </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    
  </div>    -->
@endsection