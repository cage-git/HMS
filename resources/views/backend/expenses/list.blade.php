@extends('layouts.master_backend_new')
@section('content')

<!-- 
<section id="basic-datatable">
    <div class="row">
        <div class="row col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('heading_filter_expense')}}</h4>

                    {{ Form::model($search_data,array('url'=>route('search-expenses'),'id'=>"search-expense", 'class'=>"form-horizontal form-label-left")) }}
                  
                        <div class="mb-1">
                            <label class="form-label" for="basic-default-name">{{lang_trans('txt_category')}}</label>
                            {{Form::select('category_id',$category_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-default-name">{{lang_trans('txt_category')}}</label>
                            {{Form::select('category_id',$category_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-default-name">{{lang_trans('txt_category')}}</label>
                            {{Form::select('category_id',$category_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                        </div>
                    
                      <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                      <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                    </div>
                  {{ Form::close() }}
                    <a href="{{route('add-vendor-category')}}"><button class="btn btn-primary" >{{lang_trans('sidemenu_vendorcat_add')}} </button></a>
                </div>
            </div>
        </div>
    </div>
</section> -->


<section id="basic-datatable">
    <div class="row">
        <div class="row col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{lang_trans('heading_expense_list')}}</h4>
                    <a href="{{route('add-expense')}}"><button class="btn btn-primary" >{{lang_trans('sidemenu_expense_add')}} </button></a>
                </div>
                  @php
                    $totalAmount = 0;
                  @endphp
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_category')}}</th>
                        <th>{{lang_trans('txt_title')}}</th>
                        <th>{{lang_trans('txt_amount')}}</th>
                        <th>{{lang_trans('txt_date')}}</th>
                        <th>{{lang_trans('txt_remark')}}</th>
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
                        <td>{{$val->category->name}}</td>
                        <td>{{$val->title}}</td>
                        <td>{{getCurrencySymbol()}} {{$val->amount}}</td>
                        <td>{{dateConvert($val->datetime,'d-m-Y')}}</td>
                        <td>{{$val->remark}}</td>
                        <td>
                          <a class="btn btn-sm btn-info" href="{{route('edit-expense',[$val->id])}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i data-feather='edit'></i></a>
                          <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-expense',[$val->id])}}" title="{{lang_trans('btn_delete')}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i data-feather='trash'></i></button>
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
            <h2>{{lang_trans('heading_filter_expense')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            {{ Form::model($search_data,array('url'=>route('search-expenses'),'id'=>"search-expense", 'class'=>"form-horizontal form-label-left")) }}
              <div class="form-group col-sm-3">
                <label class="control-label"> {{lang_trans('txt_category')}}</label>
                {{Form::select('category_id',$category_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
              </div>
              <div class="form-group col-sm-2">
                <label class="control-label"> {{lang_trans('txt_date_from')}}</label>
                {{Form::text('date_from',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_from')])}}
              </div>
              <div class="form-group col-sm-2">
                <label class="control-label"> {{lang_trans('txt_date_to')}}</label>
                {{Form::text('date_to',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_to')])}}
              </div>
              <div class="form-group col-sm-3">
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
                  <h2>{{lang_trans('heading_expense_list')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @php
                    $totalAmount = 0;
                  @endphp
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_category')}}</th>
                      <th>{{lang_trans('txt_title')}}</th>
                      <th>{{lang_trans('txt_amount')}}</th>
                      <th>{{lang_trans('txt_date')}}</th>
                      <th>{{lang_trans('txt_remark')}}</th>
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
                        <td>{{$val->category->name}}</td>
                        <td>{{$val->title}}</td>
                        <td>{{getCurrencySymbol()}} {{$val->amount}}</td>
                        <td>{{dateConvert($val->datetime,'d-m-Y')}}</td>
                        <td>{{$val->remark}}</td>
                        <td>
                          <a class="btn btn-sm btn-info" href="{{route('edit-expense',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-expense',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <tr>
                      <th class="text-right" width="50%">{{lang_trans('txt_grand_total')}}</th>
                      <th width="50%"><b>{{getCurrencySymbol()}} {{numberFormat($totalAmount)}}</b></th>
                    </tr>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>           -->
@endsection