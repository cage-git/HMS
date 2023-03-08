@extends('layouts.master_backend_new')
@section('content')



<!-- Basic table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('txt_list_users')}}</h4>
                    <a href="{{route('add-user')}}"><button class="btn btn-primary" >{{lang_trans('sidemenu_user_add')}}</button></a>
                </div>
                <div class="card-datatable">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_name')}}</th>
                        <th>{{lang_trans('txt_role')}}</th>
                        <th>{{lang_trans('txt_email')}}</th>
                        <th>{{lang_trans('txt_mobile_num')}}</th>
                        <th>{{lang_trans('txt_gender')}}</th>
                        <th>{{lang_trans('txt_address')}}</th>
                        <th>{{lang_trans('txt_status')}}</th>
                        <th>{{lang_trans('txt_action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($datalist as $k=>$val)
                        @if($val->email != 'admin@divllo.com')
                          <tr>
                            <td>{{$k}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->user_role->role}}</td>
                            <td>{{$val->email}}</td>
                            <td>{{$val->mobile}}</td>
                            <td>{{$val->gender}}</td>
                            <td>{{$val->address}}</td>
                            <td>{!! getStatusBtn($val->status) !!}</td>
                            <td>
                              @isPermission('edit-user')
                                <a class="btn btn-sm btn-info" href="{{route('edit-user',[$val->id])}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i data-feather='edit'></i></a>
                              @endisPermission

                              @isPermission('delete-user')
                                <button id="confirm-text" class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-user',[$val->id])}}" title="{{lang_trans('btn_delete')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i data-feather='trash-2'></i></button>
                              @endisPermission
                            </td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    
</section>
<!--/ Basic table -->


<!-- 
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_list_users')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_name')}}</th>
                      <th>{{lang_trans('txt_role')}}</th>
                      <th>{{lang_trans('txt_email')}}</th>
                      <th>{{lang_trans('txt_mobile_num')}}</th>
                      <th>{{lang_trans('txt_gender')}}</th>
                      <th>{{lang_trans('txt_address')}}</th>
                      <th>{{lang_trans('txt_status')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                      @if($val->email != 'admin@divllo.com')
                        <tr>
                          <td>{{$k}}</td>
                          <td>{{$val->name}}</td>
                          <td>{{$val->user_role->role}}</td>
                          <td>{{$val->email}}</td>
                          <td>{{$val->mobile}}</td>
                          <td>{{$val->gender}}</td>
                          <td>{{$val->address}}</td>
                          <td>{!! getStatusBtn($val->status) !!}</td>
                          <td>
                            @isPermission('edit-user')
                              <a class="btn btn-sm btn-info" href="{{route('edit-user',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                            @endisPermission

                            @isPermission('delete-user')
                              <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-user',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                            @endisPermission
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div> -->
@endsection
@section('scripts')
<!-- BEGIN: Page JS-->
  <!-- <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script> -->
  <script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
<!-- END: Page JS-->
@endsection
