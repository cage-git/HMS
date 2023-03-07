@extends('layouts.master_backend_new')
@section('content')


<section id="basic-datatable">
    <div class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('txt_list_amenities')}}</h4>
                    <a href="{{route('add-amenities')}}"><button class="btn btn-primary" >{{lang_trans('sidemenu_amenities_add')}} </button></a>
                </div>
                  @php
                    $totalAmount = 0;
                  @endphp
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_amenities')}}</th>
                        <th>{{lang_trans('txt_status')}}</th>
                        <th>{{lang_trans('txt_action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($datalist as $k=>$val)
                        <tr>
                          <td>{{$k+1}}</td>
                          <td>{{$val->name}}</td>
                          <td>{!! getStatusBtn($val->status) !!}</td>
                          <td>
                            <a class="btn btn-sm btn-info" href="{{route('edit-amenities',[$val->id])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i data-feather='edit'></i></a>
                            <button id="confirm-text" class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-amenities',[$val->id])}}" title="{{lang_trans('btn_delete')}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i data-feather='trash'></i></button>
                          </td>
                        </tr>
                      @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</section>

<!-- 
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_list_amenities')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_amenities')}}</th>
                      <th>{{lang_trans('txt_status')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->name}}</td>
                        <td>{!! getStatusBtn($val->status) !!}</td>
                        <td>
                          <a class="btn btn-sm btn-info" href="{{route('edit-amenities',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-amenities',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>         -->
@endsection
@section('scripts')
<!-- BEGIN: Page JS-->
  <!-- <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script> -->
  <script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
<!-- END: Page JS-->



@endsection