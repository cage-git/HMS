@extends('layouts.master_backend_new')
@section('content')

<div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{lang_trans('heading_manage_inventory')}}</h4>
            </div>
            <div class="card-body">
                    {{ Form::open(array('url'=>route('save-stock'),'id'=>"stock-form", 'class'=>"form-horizontal form-label-left")) }}
                        <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_product')}}</label>
                                     
                                        {{ Form::select('product_id',$product_list,null,['class'=>'form-select','placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_stock')}}</label>
                                     
                                        {{ Form::select('stock_is',['add'=>'Add','subtract'=>'Subtract'],1,['class'=>'form-select','id'=>'stock_is','placeholder'=>lang_trans('ph_select')]) }}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_qty')}}</label>
                                       
                                        {{Form::number('qty',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"qty", "required"=>"required"])}}
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_name">{{lang_trans('txt_price')}}</label>
                                       
                                        {{Form::text('price',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"price"])}}
                                    </div>
                                </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button>
            </div>
        </div>
</div>

<!-- 
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_manage_inventory')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  {{ Form::open(array('url'=>route('save-stock'),'id'=>"stock-form", 'class'=>"form-horizontal form-label-left")) }}
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_product')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('product_id',$product_list,null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_stock')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('stock_is',['add'=>'Add','subtract'=>'Subtract'],1,['class'=>'form-control','id'=>'stock_is','placeholder'=>lang_trans('ph_select')]) }}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">{{lang_trans('txt_qty')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::number('qty',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"qty", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group hide_elem" id="price_section">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">{{lang_trans('txt_price')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('price',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"price"])}}
                          </div>
                      </div>

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
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script>
@endsection
