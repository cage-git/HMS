@extends('layouts.master_backend_new')
@section('content')
    @php
        $lang = getSettings('site_language');
    @endphp
 @if(!empty($datalist))
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
                                                    <?php
                                                        $dv = $v['dropdown_value_' .''.(($lang==='en') ? 'en': 'ar').''];
                                                        if($dv){
                                                            $input_val = $dv;
                                                        }else{
                                                            $input_val = $v->dropdown_value;
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            {{Form::text($v->dropdown_name.'['.$v->id.']',$input_val,['class'=>"form-control col-md-7 col-xs-12", "id"=>"room_no", "required"=>"required"])}}
                                                        </td>
                                                        <td class="text-center">
                                                            @if($v->is_deletable == 1)
                                                                <button type="button" class="btn btn-danger delete-dropdown"><i data-feather="minus"></i></button>
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
                                                        <button type="button" class="btn btn-success add-dropdown" data-tbody="{{$val['dropdown_name']}}"><i data-feather="plus"></i></button>
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
        {{ Form::close() }}
    </div>
    @else
    <div class="text-center">Permission denied</div>
    @endif
        {{-- require set var in js var --}}
        <script>
            globalVar.page = 'list_dynamic_dropdowns';
        </script>
        <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script>

@endsection
        @section('scripts')
            <!-- BEGIN: Page JS-->
            <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
            <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
            <!-- END: Page JS-->
@endsection
