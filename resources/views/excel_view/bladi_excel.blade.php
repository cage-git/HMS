<table class="table table-bordered">
 <thead>
        <tr>
          <th>{{lang_trans('txt_sno')}}</th>
          <th>{{lang_trans('txt_room')}}</th>
          <th>{{lang_trans('txt_guest_name')}}</th>
          <th>{{lang_trans('txt_booking')}}</th>
          <th>{{lang_trans('txt_checkin')}}</th>
          <th>{{lang_trans('txt_checkout')}}</th>
          <th>{{lang_trans('txt_room_amount')}}</th>
          <th>{{lang_trans('txt_room_type')}}</th>
          <th>{{lang_trans('txt_remark')}}</th>

        </tr>
    </thead>
    <tbody>
      @php
          $j=0;
      @endphp
    @foreach($datalist as $k=>$val)
    <?php 
                      $flag = true;
                      $checkin_datetime;
                      $checkout_datetime;  
                        if($val->duration_of_stay > 1 ){
                            $flag = true;
                            if(($report_month != date('m', strtotime($val->check_out))) && ($report_month == date('m', strtotime($val->check_in)))){
                              $checkout_datetime = date('d-m-Y', strtotime($report_year.'-'.$report_month.'-'.$days));
                              $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                        
                              }else if(($report_month != date('m', strtotime($val->check_in))) && ($report_month == date('m', strtotime($val->check_out)))){
                                $checkin_datetime = date('d-m-Y', strtotime($report_year.'-'.$report_month.'-01'));
                                $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                              }else if(($report_month != date('m', strtotime($val->check_in))) && ($report_month != date('m', strtotime($val->check_out)))){
                                $checkin_datetime = date('d-m-Y', strtotime($report_year.'-'.$report_month.'-01'));
                                $checkout_datetime = date('d-m-Y', strtotime($report_year.'-'.$report_month.'-'.$days));
                              }else{
                                $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                                $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                              }
                        }else{
                          if((date('m', strtotime($val->check_in)) != date('m', strtotime($val->check_out)))){
                            if(date('m', strtotime($val->check_in)) == $report_month){
                              $flag = false;
                            }else if(date('m', strtotime($val->check_out)) == $report_month){
                              $flag = true;
                              $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                              $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                            }
                          }else{
                            $flag = true;
                            $checkin_datetime = date('d-m-Y', strtotime($val->check_in));
                            $checkout_datetime = date('d-m-Y', strtotime($val->check_out));
                          }
                        }
                      ?>
          @if($val->is_checkout == 1)
          @if( $flag == true)
            @foreach($val->booked_rooms as $k=>$value)
            @php
                $j++;
                $roomData = getRoomById($value->room_id);
                $roomTypeData = getRoomTypeById($value->room_type_id);
            @endphp
              <tr>
                <td>{{$j}}</td>
                <td>{{($value->room_id) ?  $roomData->room_no : 'NA'}}</td>
                <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                <td>{{($val) ? $val->id : 'NA'}}</td>
                <!-- <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td> -->
                <!-- <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td> -->
                <td>{{$checkin_datetime}}</td>
                <td>{{$checkout_datetime}}</td>
                <td>{{($value->room_price) ? numberFormat($value->room_price + $value->room_cgst + $value->room_gst) : 'NA'}}</td>
                <td>{{($value->room_type_id)  ? $roomTypeData->title : 'NA'}}</td>
                <td>{{($val) ? $val->remark : 'NA'}}</td>
              </tr>
              @endforeach
          @endif
          @endif
        @endforeach
    </tbody>
  </table>