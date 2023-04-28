@extends('layouts.master_backend_new')
@section('content')


<section>

    {{Form::open(array('url'=>route('save-dynamic-dropdowns'), 'class' => ' row'))}}
        @foreach($datalist as $key=>$val)
            <div class="col-6">
                    <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">{{$val['title']}}</h4>
                            </div>
                            <div class="card-body <?= str_replace(" ","_",$val['title']); ?>-repeater">

                                    <div class="row">
                                          <div class="col-xl-9 col-md-6 col-12">
                                              <div class="mb-1">
                                                  <label class="form-label" for="basic-default-name">{{lang_trans('txt_dropdown_values')}}</label>
                                              </div>
                                          </div>
                                          <div class="col-xl-1 col-md-6 col-12">
                                              <div class="mb-1">
                                                  <label class="form-label" for="basic-default-name">{{lang_trans('txt_action')}}</label>
                                              </div>
                                          </div>
                                    </div>
                
                        <!-- repeater -->

                                    <div data-repeater-list="<?= $val['title']; ?>">
                                      <div>
                                        @if(count($val['values']) > 0)
                                          @foreach($val['values'] as $k=>$v)
                                          <?php //print_r($k." ".$v->dropdown_name." ".$v->id."   ".$v->dropdown_name.'['.$v->id.']'); ?>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-4 col-12">
                                                    <div class="mb-1">
                                                      {{Form::text($v->dropdown_name.'['.$v->id.']',$v->dropdown_value,['class'=>"form-control col-md-12 col-xs-12", "id"=>"room_no"])}}
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-4 col-12">
                                                    <div class="mb-1">
                                                      {{Form::text($v->dropdown_name.'['.$v->id.']_ar',$v->dropdown_value_ar,['class'=>"form-control col-md-12 col-xs-12", "id"=>"room_no_ar"])}}
                                                    </div>
                                                </div> 

                                                <div class="col-md-4 col-12">
                                                    <div class="mb-1">
                                                      {{Form::text('arabic',$v->dropdown_value_ar,['class'=>"form-control col-md-12 col-xs-12", "id"=>"room_no_ar"])}}
                                                    </div>
                                                </div> 
                                              
                                              -->
                                                <div class="col-md-4 col-12">
                                                    <div class="mb-1">
                                                      {{Form::text($v->dropdown_name.'['.$v->id.'_ar]',$v->dropdown_value_ar,['class'=>"form-control col-md-12 col-xs-12", "id"=>"room_no_ar"])}}
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-12 mb-50">
                                                    <div class="mb-1">
                                                      @if($v->is_deletable == 1)
                                                        <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                            <i data-feather="x" class="me-25"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                      @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                          @endforeach
                                        @endif
                                      </div>
                                        <div data-repeater-item>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-4 col-12">
                                                    <div class="mb-1">
                                                    {{Form::text($v->dropdown_name,$v->dropdown_value,['class'=>"form-control col-md-12 col-xs-12", "id"=>"room_no"])}}
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="mb-1">
                                                    {{Form::text($v->dropdown_name,$v->dropdown_value_ar,['class'=>"form-control col-md-12 col-xs-12", "id"=>"room_no_ar"])}}
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-12 mb-50">
                                                    <div class="mb-1">
                                                        <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                            <i data-feather="x" class="me-25"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                        </div>
                                  </div>

                                 

                                  <div class="row">
                                      <div class="col-12">
                                          <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                              <i data-feather="plus" class="me-25"></i>
                                              <span>Add New</span>
                                          </button>
                                      </div>
                                  </div>
                                 
                        <!-- end repeater -->
                            </div>
                      </div>
              </div>
        @endforeach
        <input type="submit" value="{{lang_trans('btn_update')}}" class="btn btn-primary"/>
    {{ Form::close() }}
    
</section>


<!-- 

<div class="">
  {{Form::open(array('url'=>route('save-dynamic-dropdowns')))}}
    <div class="row">
      @foreach($datalist as $key=>$val)
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-sm-12">
                                <div class="col-sm-8 p-left-0">
                                    <h2>{{$val['title']}}</h2>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <table  class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center">{{lang_trans('txt_dropdown_values')}}</th>
                              <th class="text-center">{{lang_trans('txt_action')}}</th>
                            </tr>
                          </thead>
                          <tbody class="{{$val['dropdown_name']}}">
                            @if(count($val['values']) > 0)
                              @foreach($val['values'] as $k=>$v)
                                <tr>
                                  <td>
                                    {{Form::text($v->dropdown_name.'['.$v->id.']',$v->dropdown_value,['class'=>"form-control col-md-7 col-xs-12", "id"=>"room_no", "required"=>"required"])}}
                                  </td>
                                  <td class="text-center">
                                    @if($v->is_deletable == 1)
                                      <button type="button" class="btn btn-danger delete-dropdown"><i class="fa fa-minus"></i></button>
                                    @endif
                                  </td>
                                </tr>
                              @endforeach
                            @endif
                          </tbody>
                              @if(
                                    $v->dropdown_name != 'reason_of_visit' &&
                                    $v->dropdown_name != 'gender' &&
                                    $v->dropdown_name != 'customer_types' &&
                                    $v->dropdown_name != 'room_types' &&
                                    $v->dropdown_name != 'room_rent_type' &&
                                    $v->dropdown_name != 'transaction_type_id' &&
                                    $v->dropdown_name != 'nationalities' &&
                                    $v->dropdown_name != 'payment_type'
                                )
                                  <tfoot>
                                    <tr>
                                      <td></td>
                                      <td class="text-center">
                                        <button type="button" class="btn btn-success add-dropdown" data-tbody="{{$val['dropdown_name']}}"><i class="fa fa-plus"></i></button>
                                      </td>
                                    </tr>
                                  </tfoot>
                              @endif
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <div class="col-md-12 text-right p-right-0">
                <input type="submit" value="{{lang_trans('btn_update')}}" class="btn btn-primary"/>
              </div>
            </div>
          </div>
      </div>
  </div>
  {{ Form::close() }} -->
  {{-- require set var in js var --}}
  <!-- <script>
    globalVar.page = 'list_dynamic_dropdowns';
  </script>
  <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script> -->
@endsection
@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
<!-- END: Page JS-->
@endsection
