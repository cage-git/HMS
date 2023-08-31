@extends('layouts.master_backend_new')
@section('content')


<!-- Basic table -->
<section id="basic-datatable">
    <div class="row">
        <div class=" col-12">
            <div class="card p-2">
                <div class="card-header px-0 border-bottom">
                    <h4 class="card-title">{{lang_trans('heading_season_list')}}</h4>
                    <a href="{{route('add-season')}}"><button class="btn btn-primary" >{{lang_trans('sidemenu_season_add')}}</button></a>
                </div>
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_season_name')}}</th>
                        <th>{{lang_trans('txt_start_date')}}</th>
                        <th>{{lang_trans('txt_end_date')}}</th>
                        <th>{{lang_trans('txt_days')}}</th>
                        <th>{{lang_trans('txt_action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datalist as $k=>$val)
                          <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{dateConvert($val->start_date, 'Y-m-d')}}</td>
                            <td>{{dateConvert($val->end_date, 'Y-m-d')}}</td>
                            <td>
                              @php
                                $weekDays = splitText($val->days);
                              @endphp
                              @foreach($weekDays as $v)
                                <span class="badge bg-primary">{{lang_trans('txt_day_full_'.$v)}}</span>
                              @endforeach
                            </td>
                            <td>
                              @isPermission('edit-season')
                                <a class="btn btn-sm btn-info" href="{{route('edit-season',[$val->id])}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i data-feather='edit'></i></a>
                              @endisPermission

                              @isPermission('delete-season')
                                <a class="btn btn-danger btn-sm delete_btn" href="{{route('delete-season',[$val->id])}}" title="{{lang_trans('btn_delete')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i data-feather='trash-2'></i></a>
                              @endisPermission
                            </td>
                          </tr>
                        @endforeach
                        
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</section>
<!--/ Basic table -->



<!-- <div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_season_list')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_season_name')}}</th>
                      <th>{{lang_trans('txt_start_date')}}</th>
                      <th>{{lang_trans('txt_end_date')}}</th>
                      <th>{{lang_trans('txt_days')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{dateConvert($val->start_date, 'Y-m-d')}}</td>
                        <td>{{dateConvert($val->end_date, 'Y-m-d')}}</td>
                        <td>
                          @php
                            $weekDays = splitText($val->days);
                          @endphp
                          @foreach($weekDays as $v)
                            <span class="label label-primary label-fontsize-1">{{lang_trans('txt_day_full_'.$v)}}</span>
                          @endforeach
                        </td>
                        <td>
                          @isPermission('edit-season')
                            <a class="btn btn-sm btn-info" href="{{route('edit-season',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                          @endisPermission

                          @isPermission('delete-season')
                            <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-season',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                          @endisPermission
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>           -->
@endsection