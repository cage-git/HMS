<div id="extend_reservation_{{$val->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close m-0" data-bs-dismiss="modal"></button>
        <h4 class="modal-title">{{lang_trans('btn_extend_reservation')}}</h4>
      </div>
      {{ Form::open(['url' => route('extend-reservation'), 'id' => 'extend-reservation-form', 'data-custom-attribute' => 'form_'. $val->id]) }}

      {{ Form::hidden('id', $val->id) }}

        <div class="modal-body">
            @php
                $date = \Carbon\Carbon::parse($val->check_out);
                $now = \Carbon\Carbon::now();
                $diff = ($date->diffInDays($now));
            @endphp




          <div>
              <label class="control-label col-sm-12">{{lang_trans('txt_days_type')}}<span class="required">*</span></label>

              <div class="row">
                <div class="col-lg-12">
                    {{Form::radio('days_type','0',true,['class'=>"".$val->id."_days_type", 'id'=>'extend_type'])}} <label>{{lang_trans('txt_extend')}}</label>
{{--                    {{Form::radio('days_type','1',false,['class'=>"".$val->id."_days_type", 'id'=>'reduce_type'])}} <label>{{lang_trans('txt_reduce')}}</label>--}}
                  </div>
              </div>
              <div class="row">
                  <label class="control-label col-lg-12">{{lang_trans('txt_no_of_days')}}<span class="required">*</span></label>
                  <div class="col-lg-12">
                    {{Form::select('days',[0,1,2,3,4,5,6,7,8,9,10],null,['class'=>"form-control", 'id'=>"".$val->id."_days_select",'required'=>true, 'style'=>'width:100%', "placeholder"=>"--Select"])}}
                  </div>
              </div>
          </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{lang_trans('btn_cancel')}}</button>
          <button type="submit" class="btn extend-submit-button btn-success" data-id="submit_{{$val->id}}">{{lang_trans('btn_submit')}}</button>
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $('[data-id="submit_{{$val->id}}"]').click(function() {
    //alert("d");
    $(this).prop('disabled', true);
    $('[data-custom-attribute="form_{{$val->id}}"]').submit();

  });
</script>
<script>
    {{--$(document).on("change",".{{$val->id}}_days_type",function () {--}}
    {{--    if($(this).val() == 0){--}}
    {{--        var limter = 10;--}}
    {{--    }else if($(this).val() == 1){--}}
    {{--        var limter = {{$diff}};--}}
    {{--    }--}}
    {{--    var optc = '';--}}
    {{--    for(var lim = 0; lim <= limter; lim++){--}}
    {{--        optc += '<option value="'+lim+'">'+lim+'</option>';--}}
    {{--    }--}}
    {{--    $("#{{$val->id}}_days_select").html(optc);--}}

    {{--})--}}
</script>
