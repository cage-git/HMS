@extends('layouts.master_backend_new')
@section('content')

<style>

.margin-button{
  margin-top: 5px;
  margin-bottom: 5px;
}
.dtble_wdth table.dataTable>thead>tr>th:not(.sorting_disabled), .dtble_wdth table.dataTable>thead>tr>td:not(.sorting_disabled){
  padding-right: 23px;
}
</style>

<!-- Basic table -->
<section id="basic-datatable">
  <div class="row">
      <div class=" col-12 dtble_wdth">
          <div class="card p-2">
              <div class="card-header px-0 border-bottom">
                  <h4 class="card-title">{{lang_trans('txt_order_list')}}</h4>
                  <a href="{{route('add-housekeeping-order')}}"><button class="btn btn-primary" >{{lang_trans('sidemenu_order_add')}} </button></a>
              </div>
              <table class="datatables-basic table">
                  <thead>
                      <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_housekeeping_item')}}</th>
                      <th>{{lang_trans('txt_room')}}</th>
                      <th>{{lang_trans('txt_housekeeping_status')}}</th>
                      <th>{{lang_trans('txt_assigned_to')}}</th>
                      <th>{{lang_trans('txt_order_date')}}</th>
                      <th>{{lang_trans('txt_complete_date')}}</th>
                      <th>{{lang_trans('txt_status')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($datalist as $k=>$val)
                      @php
                        $btnText = null;
                        if($val->order_status==0){
                          $btnText = lang_trans('btn_set_inprogress');
                        } elseif ($val->order_status==1) {
                          $btnText = lang_trans('btn_set_complete');
                        }
                      @endphp
                      <tr>
                        <td>{{$datalist->firstItem() + $k}}</td>
                        <td>{{$val->housekeeping_items}}</td>
                        <td>{{$val->room_info->room_no}} | {{$val->room_info->room_name}}</td>
                        <td>{{$val->housekeeping_status->dropdown_value}}</td>
                        <td>{{$val->housekeeper->name}}</td>
                        <td>{{dateConvert($val->created_at, 'Y-m-d')}}</td>
                        <td>{{dateConvert($val->completed_date, 'Y-m-d')}}</td>
                        <td>{!!getStatusBtn($val->order_status, 3)!!}</td>
                       
                        <td>
                          @if(isPermission('edit-housekeeping-order') && $val->order_status !=2)
                            <a class="btn btn-sm btn-info" href="{{route('edit-housekeeping-order',[$val->id])}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i data-feather='edit'></i></a>
                          @endif
                          @if(isPermission('delete-housekeeping-order') && $val->order_status !=2)
                            <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-housekeeping-order',[$val->id])}}" title="{{lang_trans('btn_delete')}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i data-feather='trash-2'></i></button>
                          @endif
                          @if(isPermission('update-housekeeping-order-status') && $btnText)
                            <button class="btn btn-warning btn-sm confirm_btn housekeeping_order_status_btn margin-button" data-url="{{route('update-housekeeping-order-status',['order_id'=>$val->id, 'status'=>$val->order_status])}}" title="{{$btnText}}">{{$btnText}}</button>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
      
  </section>
  <!-- / Basic table -->


<!-- <div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_order_list')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable_" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_housekeeping_item')}}</th>
                      <th>{{lang_trans('txt_room')}}</th>
                      <th>{{lang_trans('txt_housekeeping_status')}}</th>
                      <th>{{lang_trans('txt_assigned_to')}}</th>
                      <th>{{lang_trans('txt_order_date')}}</th>
                      <th>{{lang_trans('txt_complete_date')}}</th>
                      <th>{{lang_trans('txt_status')}}</th>
                      <th>{{lang_trans('txt_remark')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                      @php
                        $btnText = null;
                        if($val->order_status==0){
                          $btnText = lang_trans('btn_set_inprogress');
                        } elseif ($val->order_status==1) {
                          $btnText = lang_trans('btn_set_complete');
                        }
                      @endphp
                 
                      <tr>
                        <td>{{$datalist->firstItem() + $k}}</td>
                        <td>{{$val->housekeeping_items}}</td>
                        <td>{{$val->room_info->room_no}} | {{$val->room_info->room_name}}</td>
                        <td>{{$val->housekeeping_status->dropdown_value}}</td>
                        <td>{{$val->housekeeper->name}}</td>
                        <td>{{dateConvert($val->created_at, 'Y-m-d')}}</td>
                        <td>{{dateConvert($val->completed_date, 'Y-m-d')}}</td>
                        <td>{!!getStatusBtn($val->order_status, 3)!!}</td>
                        <td>{!!$val->remark!!}</td>
                        <td>
                          @if(isPermission('edit-housekeeping-order') && $val->order_status !=2)
                            <a class="btn btn-sm btn-info" href="{{route('edit-housekeeping-order',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                          @endif
                          @if(isPermission('delete-housekeeping-order') && $val->order_status !=2)
                            <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-housekeeping-order',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                          @endif
                          @if(isPermission('update-housekeeping-order-status') && $btnText)
                            <button class="btn btn-warning btn-sm confirm_btn housekeeping_order_status_btn" data-url="{{route('update-housekeeping-order-status',['order_id'=>$val->id, 'status'=>$val->order_status])}}" title="{{$btnText}}">{{$btnText}}</button>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                  {{$datalist->links()}}
                </div>
              </div>
          </div>
      </div>
  </div>
</div>       -->
@endsection
@section('scripts')
<!-- BEGIN: Page JS-->
  <!-- <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script> -->
  <script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
<!-- END: Page JS-->
@endsection