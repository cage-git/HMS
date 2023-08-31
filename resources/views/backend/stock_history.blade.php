@extends('layouts.master_backend_new')
@section('content')


<!-- Basic table -->
<section id="basic-datatable">

    <div class="row">
        <div class=" col-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{lang_trans('heading_filter_stock_history')}}</h4>
              </div>
              <div class="card-body">
                {{ Form::model($search_data,array('url'=>route('search-stocks'),'id'=>"search-stocks", 'class'=>"form-horizontal form-label-left")) }}
                      <div class="row">  
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="product_name">{{lang_trans('txt_product')}}</label>
                              
                                {{Form::select('product_id',$products,null,['class'=>"form-select",'placeholder'=>lang_trans('ph_select')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="product_name">{{lang_trans('txt_stock')}}</label>
                              
                                {{Form::select('is_stock',['add'=>'Add','subtract'=>'Subtract'],null,['class'=>"form-select",'placeholder'=>lang_trans('ph_select')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="product_name">{{lang_trans('txt_date_from')}}</label>
                              
                                {{Form::text('date_from',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_date_from')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="product_name">{{lang_trans('txt_date_to')}}</label>
                              
                                {{Form::text('date_to',null,['class'=>"form-control  flatpickr-basic", 'placeholder'=>lang_trans('ph_date_to')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
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
            <div class="card p-2">
                <div class="card-header border-bottom px-0">
                    <h4 class="card-title">{{lang_trans('heading_stock_history')}}</h4>
                </div>
                <table class="datatables-basic table">

                <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_product')}}</th>
                      <th>{{lang_trans('txt_price')}}</th>
                      <th>{{lang_trans('txt_qty')}}</th>
                      <th>{{lang_trans('txt_stock')}}</th>
                      <th>{{lang_trans('txt_by')}}</th>
                      <th>{{lang_trans('txt_date')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($datalist->count()>0)
                    @foreach($datalist as $k=>$val)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->product->name}}</td>
                        <td>@if($val->price>0) {{getCurrencySymbol()}} {{$val->price}} @endif</td>
                        <td>{{$val->qty}}</td>
                        <td>{{ucfirst($val->stock_is)}}</td>
                        <td><?php if($val->user){ echo ucfirst($val->user->name); }else{ echo "";} ?> </td>
                        <td>{{dateConvert($val->created_at,'d-m-Y h:i')}}</td>
                      </tr>
                     
                    @endforeach
                    @endif
                  </tbody>

                </tbody>
                </table>
            </div>
        </div>
    </div>
    
</section>
<!--/ Basic table -->


@endsection


@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
<!-- END: Page JS-->
@endsection