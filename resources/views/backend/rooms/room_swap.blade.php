@extends('layouts.master_backend_new')
@section('content')
@php
  $allBookedRooms = getAllBookedRooms();
@endphp
<style type="text/css">
  #alertContainer .alert {
    position: absolute;
    right: 50px;
    bottom: 57px;
}
</style>

{{ Form::open(array('url'=>route('save-swap-room'),'id'=>"swap-room-form", 'class'=>"form-horizontal form-label-left")) }}
{{Form::hidden('id',$reservation_id,['id'=>'base_price'])}}

<!-- Basic Radio Button start -->
<!-- <section id="basic-radio">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{lang_trans('txt_heading_booked_rooms')}}</h4>
                </div>
                <div class="card-body">
                    <div class="demo-inline-spacing">

                        @if($booked_rooms)
                          @foreach($booked_rooms as $key=>$roomId)
                            @php
                              $roomInfo = getRoomById($roomId);
                              $radioBtnValue = $roomInfo->room_type_id.'~'.$roomId;
                            @endphp

                            <div class="form-check form-check-inline">
                                  {{Form::radio('old_room',$radioBtnValue,false,['class'=>"form-check-input", "id"=>"old_room_".$roomId])}}
                                  <label class="form-check-label" for="inlineRadio1">{{$roomInfo->room_no}}</label>
                              </div>
                          @endforeach
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Basic Radio Button end -->



<!-- Basic Radio Button start -->
<section id="basic-radio">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{lang_trans('txt_heading_select_room_for_swap')}}</h4>
                </div>
                <div class="card-body">
                    <div class="demo-inline-spacing">

                        @if($booked_rooms)
                          @foreach($booked_rooms as $key=>$roomId)
                            @php
                              $roomInfo = getRoomById($roomId);
                              $radioBtnValue = $roomInfo->room_type_id.'~'.$roomId;
                            @endphp

                            <div class="form-check form-check-inline">
                                  {{Form::radio('old_room',$radioBtnValue,false,['class'=>"form-check-input", "id"=>"old_room_".$roomId,"checked"=>"true"])}}
                                  <label class="form-check-label" for="inlineRadio1">{{$roomInfo->room_no}}</label>
                              </div>
                          @endforeach
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Radio Button end -->

<!-- 
<div class="row hide_elem" id="room_list_section">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                @foreach($roomtypes_list as $k=>$val)
                    @php
                        $change_value = explode('||',$val);
                    @endphp
                    <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h4 class="row panel-title">
                            <i class="fa fa-list"></i>
                            <a class="room_type_by_rooms col-xl-3 col-md-6 col-sm-12" data-roomtypeid="{{$k}}" data-toggle="collapse" href="#collapse{{$k}}">
                            {!! $val !!}
                            </a>
                            <div class="col-xl-4 col-md-6 col-12">
                                {{Form::number('roomtype_'.$k,rtrim($change_value[1], ')'),[ "data-original"=>rtrim($change_value[1], ')'),"class"=>"room_price calculate_total_amount form-control","required"=>"required"])}}
                            </div>
                        </h4>
                        </div>
                        <div id="collapse{{$k}}" class="panel-collapse collapse">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>{{lang_trans('txt_sno')}}</th>
                                <th>{{lang_trans('txt_select')}}</th>
                                <th>{{lang_trans('txt_room_num')}}</th>
                                <th>{{lang_trans('txt_status')}}</th>
                            </tr>
                            </thead>
                            <tbody class="rooms_list">

                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div> -->


  <!-- <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_heading_select_room_for_swap')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content"> -->

  <section id="basic-radio">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{lang_trans('txt_heading_select_room_for_swap')}}</h4>
                </div>
                <div class="card-body">

    
                <div class="row">
                  @php
                    $collapseInFirstCat = 'no';
                  @endphp
                  @foreach($roomtypes_list as $k=>$roomType)

                    @php
                        $change_value = explode('||',$roomType->title);
                    @endphp
                    @php
                      $i = 0;
                      if($collapseInFirstCat == 'yes'){
                        $collapseInFirstCat = '';
                      }
                      if($roomType->rooms && $roomType->rooms->count() && $collapseInFirstCat == 'no'){
                        foreach($roomType->rooms as $key=>$room){
                          if(!in_array($room->id, $allBookedRooms)){
                            $collapseInFirstCat = 'yes';
                          }
                        }
                      }
                    @endphp
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading py-1">
                          <h4 class="row m-0 panel-title">
                            <i class="fa fa-list"></i>
                            <a class="room_type_by_rooms col-xl-3 col-md-6 col-sm-12" data-roomtypeid="{{$roomType->id}}" data-toggle="collapse" 
                            href="#collapse{{$roomType->id}}"
                            >
                            <!-- href="#collapse{{$k}}" -->
                              {{$roomType->title}}
                            </a>
                            <div class="col-xl-4 col-md-6 col-12">
                              {{Form::number('roomtype_'.$roomType->id,rtrim($change_value[1], ')'),[ "data-original"=>rtrim($change_value[1], ')'),"class"=>"room_price calculate_total_amount form-control","required"=>"required"])}}
                            </div>
                          </h4>
                        </div>
                        <div 
                          id="collapse{{$roomType->id}}"
                          class="panel-collapse "
                        >
                        <!-- id="collapse{{$k}}"  -->
                        <!-- class="panel-collapse collapse {{ ($collapseInFirstCat == 'yes') ? 'in' : "" }}" -->
                          <table class="table table-striped table-bordered">
                            @if($roomType->rooms && $roomType->rooms->count())
                              <thead>
                                <tr>
                                  <th class="text-center">{{lang_trans('txt_sno')}}</th>
                                  <th class="text-center">{{lang_trans('txt_select')}}</th>
                                  <th>{{lang_trans('txt_room_num')}}</th>
                                </tr>
                              </thead>
                              <tbody class="rooms_list">
                                   @foreach($roomType->rooms as $key=>$room)
                                    @if(!in_array($room->id, $allBookedRooms))
                                      @php
                                        $i++;
                                        $radioBtnValue = $room->room_type_id.'~'.$room->id;
                                      @endphp
                                      <tr>
                                        <td class="text-center" width="5%">{{$i}}</td>
                                        <td class="text-center" width="15%">{{Form::radio('new_room',$radioBtnValue,false,['class'=>"form-check-input", "id"=>"new_room_".$room->id,"required"=>"true"])}} </td>
                                        <td>{{$room->room_no}}</td>
                                      </tr>
                                    @endif
                                   @endforeach
                              </tbody>
                            @else
                              <tr>
                                <td>{{lang_trans('txt_no_rooms')}}</td>
                              </tr>
                            @endif
                          </table>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
                <br />
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                      <button id="submitButton" class="btn btn-success btn-submit-form" type="submit">{{lang_trans('btn_submit')}}</button>
                    </div>
                  </div>
              </div>
              
                
          </div>
      </div>
  </div>
<div id="alertContainer"></div>
</section>


  <!-- <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">

                   <div class="ln_solid"></div>
                  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                      <button class="btn btn-success btn-submit-form" type="submit">{{lang_trans('btn_submit')}}</button>
                  </div>
              </div>
          </div>
      </div>
  </div> -->


  {{ Form::close() }}
<!-- </div> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#submitButton').click(function(e) {
        e.preventDefault();
        
        if ($('input[name="new_room"]:checked').length === 0) {
           var alertMessage = '<div class="alert p-1 m-0 alert-danger" role="alert">Please select room for swap.</div>';
            $('#alertContainer').html(alertMessage);
        } else {
            $('#swap-room-form').submit();
        }
    });
});
</script>

<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script>
@endsection
