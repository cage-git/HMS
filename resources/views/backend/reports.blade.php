@extends('layouts.master_backend_new')
@section('content')
@php
  $i = $j = 0;
  $totalAmount = 0;
  $totalNetAmoun = 0;
  $totalIncomeAmount = 0;
  $totalExpenseAmount = 0;
@endphp
<div class="">
   @if($report_of == 'transactions')

    <!-- start new ui of report -->
  <section id="basic-datatable">
    <div class="row">
        <div class=" col-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{lang_trans('txt_transactions_report')}}</h4>
              </div>
              <div class="card-body">
                  {{ Form::model($search_data,array('url'=>route('search-payment-history'),'id'=>"search-payment-history", 'class'=>"form-horizontal form-label-left")) }}
                      <div class="row">  
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="category">{{lang_trans('txt_guest')}}</label>
                              
                                {{Form::text('customer_name',null,['class'=>"form-control", "id"=>"customers", "placeholder"=>lang_trans('txt_fullname')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_from">{{lang_trans('txt_date_from')}}</label>
                              
                                {{Form::text('date_from',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_date_from')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_date_to')}}</label>
                              
                                {{Form::text('date_to',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_date_to')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_payment_mode')}}</label>
                                @php
                                  $available_pyment = \App\PaymentHistory::select('payment_type')->groupBy('payment_type')->get();
                                  $constants_pm = [];
                                  foreach($available_pyment as $a){
                                      $constants_pm[$a['payment_type']] = $a['payment_type'];
                                  }
                                @endphp
                                {{Form::select('payment_type',$constants_pm,null,['class'=>"form-select",  "placeholder"=>"--Select"])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                            <br>
                            <!-- <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button> -->
                            <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                            <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
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
                    <h4 class="card-title">{{lang_trans('txt_transactions_report')}}</h4>
                </div>
                  @php
                    $totalAmount = 0;
                  @endphp
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_user_name')}}</th>
                        <th>{{lang_trans('txt_room_num')}}</th>
                        <th>{{lang_trans('txt_transaction_id')}}</th>
                        <th>{{lang_trans('txt_activity')}}</th>
                        <th>{{lang_trans('txt_payment_mode')}}</th>
                        <th>{{lang_trans('txt_date')}}</th>
                        <th>{{lang_trans('txt_total_amount')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datalist as $k=>$val)
                        @if($val->is_checkout==0)
                          @php
                            if($val->payment_of=='cr') {
                              $totalIncomeAmount += $val->payment_amount;
                            }
                            else if($val->payment_of=='dr') {
                              $totalExpenseAmount += $val->payment_amount;
                            }
                            $totalAmount += $val->payment_amount;
                            $i++;
                          @endphp
                        <tr>
                          <td>{{$i}}</td>
                            <td>{{($val->user) ? $val->user->name : ''}}</td>
                            <td>
                                @if($val->tbl_name == 'reservations' && $val->reservation)
                                    @php
                                        $room_numbers = '';
                                    @endphp
                                    @foreach($val->reservation->booked_rooms as $br)
                                        @php
                                            $room_numbers .= $br->room->room_no.', ';
                                        @endphp
                                    @endforeach
                                    {{rtrim($room_numbers, ', ')}}
                                @endif
                            </td>
                          <td>{{$val->transaction_id}}</td>
                          <td>{{getPaymentPurpose($val->purpose)}}</td>
                          <td>{{$val->payment_type}}</td>
                          <td>{{dateConvert($val->payment_date  ,'d-m-Y H:i')}}</td>
                          <td class="{{($val->payment_of=='cr' ? 'text-success' : 'text-danger')}}">{{getCurrencySymbol()}} {{numberFormat($val->payment_amount)}}</td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>


                @php
                    $totalNetAmoun = $totalIncomeAmount-$totalExpenseAmount;
                  @endphp
                  <table class="table table-striped table-bordered">
                      <tr>
                        <th class="text-right" width="20%">{{lang_trans('txt_total_income')}}</th>
                        <th width="70%" class=""><b>{{getCurrencySymbol()}} {{numberFormat($totalIncomeAmount)}}</b></th>
                      </tr>
                      <tr>
                        <th class="text-right" width="20%">{{lang_trans('txt_total_expense')}}</th>
                        <th width="70%" class=""><b>{{getCurrencySymbol()}} {{numberFormat($totalExpenseAmount)}}</b></th>
                      </tr>
                      <tr>
                        <th class="text-right" width="20%">{{lang_trans('txt_total_netamount')}}</th>
                        <th width="70%" class="{{($totalNetAmoun > 0 ? 'text-success' : 'text-danger')}}"><b>{{getCurrencySymbol()}} {{numberFormat($totalNetAmoun)}}</b></th>
                      </tr>
                  </table>
            </div>
        </div>
    </div>





    <!-- end new ui of report -->
<!-- 
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel"> -->
              <!-- <div class="x_title">
                  <h2>{{lang_trans('txt_transactions_report')}}</h2>
                  <div class="clearfix"></div>
              </div> -->
              <!-- <div class="x_content">
                  <br/>
                {{ Form::model($search_data,array('url'=>route('search-payment-history'),'id'=>"search-payment-history", 'class'=>"form-horizontal form-label-left")) }}
                  {{-- <div class="form-group col-sm-3">
                    <label class="control-label">{{lang_trans('txt_guest')}}</label>
                    {{Form::text('customer_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                  </div> --}}
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_date_from')}}</label>
                    {{Form::text('date_from',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_from')])}}
                  </div>
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_date_to')}}</label>
                    {{Form::text('date_to',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_to')])}}
                  </div>
                  <div class="form-group col-sm-2">
                      @php
                        $available_pyment = \App\PaymentHistory::select('payment_type')->groupBy('payment_type')->get();
                        $constants_pm = [];
                        foreach($available_pyment as $a){
                            $constants_pm[$a['payment_type']] = $a['payment_type'];
                        }
                      @endphp
                      <label class="control-label">{{lang_trans('txt_payment_mode')}}</label>
                      {{Form::select('payment_type',$constants_pm,null,['class'=>"form-control",  "placeholder"=>"--Select"])}}
                  </div>
                  <div class="form-group col-sm-3">
                    <br/>
                    <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                    <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                  </div>
                {{ Form::close() }}
              </div> -->
              <!-- <div class="x_content">
                    <br/>
                    <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                          <th>{{lang_trans('txt_user_name')}}</th>
                          <th>{{lang_trans('txt_room_num')}}</th>
          {{--          <th>{{lang_trans('txt_room_no')}}</th>--}}
                        <th>{{lang_trans('txt_transaction_id')}}</th>
                        <th>{{lang_trans('txt_activity')}}</th>
                        <th>{{lang_trans('txt_payment_mode')}}</th>
                        <th>{{lang_trans('txt_date')}}</th>
                        <th>{{lang_trans('txt_total_amount')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($datalist as $k=>$val)
                        @if($val->is_checkout==0)
                          @php
                            if($val->payment_of=='cr') {
                              $totalIncomeAmount += $val->payment_amount;
                            }
                            else if($val->payment_of=='dr') {
                              $totalExpenseAmount += $val->payment_amount;
                            }
                            $totalAmount += $val->payment_amount;
                            $i++;
                          @endphp
                        <tr>
                          <td>{{$i}}</td>
                            <td>{{($val->user) ? $val->user->name : ''}}</td>
{{--                            <td>{{($val->customer) ? $val->customer->name : ''}}</td>--}}
                            <td>
                                @if($val->tbl_name == 'reservations' && $val->reservation)
                                    @php
                                        $room_numbers = '';
                                    @endphp
                                    @foreach($val->reservation->booked_rooms as $br)
                                        @php
                                            $room_numbers .= $br->room->room_no.', ';
                                        @endphp
                                    @endforeach
                                    {{rtrim($room_numbers, ', ')}}
                                @endif
                            </td>
                          <td>{{$val->transaction_id}}</td>
                          <td>{{getPaymentPurpose($val->purpose)}}</td>
                          <td>{{$val->payment_type}}</td>
                          <td>{{dateConvert($val->payment_date  ,'d-m-Y H:i')}}</td>
                          <td class="{{($val->payment_of=='cr' ? 'text-success' : 'text-danger')}}">{{getCurrencySymbol()}} {{numberFormat($val->payment_amount)}}</td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                  @php
                    $totalNetAmoun = $totalIncomeAmount-$totalExpenseAmount;
                  @endphp
                  <table class="table table-striped table-bordered">
                      <tr>
                        <th class="text-right" width="20%">{{lang_trans('txt_total_income')}}</th>
                        <th width="70%" class=""><b>{{getCurrencySymbol()}} {{numberFormat($totalIncomeAmount)}}</b></th>
                      </tr>
                      <tr>
                        <th class="text-right" width="20%">{{lang_trans('txt_total_expense')}}</th>
                        <th width="70%" class=""><b>{{getCurrencySymbol()}} {{numberFormat($totalExpenseAmount)}}</b></th>
                      </tr>
                      <tr>
                        <th class="text-right" width="20%">{{lang_trans('txt_total_netamount')}}</th>
                        <th width="70%" class="{{($totalNetAmoun > 0 ? 'text-success' : 'text-danger')}}"><b>{{getCurrencySymbol()}} {{numberFormat($totalNetAmoun)}}</b></th>
                      </tr>
                  </table>
                </div>
          </div>
      </div>
    </div> -->


  </section>
  @endif

  @if($report_of == 'checkouts')

   <!-- start new ui of report -->
   <section id="basic-datatable">
    <div class="row">
        <div class=" col-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{lang_trans('txt_checkout_report')}}</h4>
              </div>
              <div class="card-body">
                  {{ Form::model($search_data,array('url'=>route('search-checkouts'),'id'=>"search-checkouts", 'class'=>"form-horizontal form-label-left")) }}
                      <div class="row">  
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="category">{{lang_trans('txt_guest')}}</label>
                              
                                {{Form::text('customer_name',null,['class'=>"form-control", "id"=>"customers", "placeholder"=>lang_trans('txt_fullname')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_from">{{lang_trans('txt_room_type')}}</label>
                              
                                {{Form::select('room_type_id',$roomtypes_list,null,['class'=>"form-select",'placeholder'=>lang_trans('ph_select')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_payment_status')}}</label>
                              
                                {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-select",'placeholder'=>lang_trans('ph_select')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_date_from')}}</label>
                                {{Form::text('date_from',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_date_from')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_to">{{lang_trans('txt_date_to')}}</label>
                                {{Form::text('date_to',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_date_to')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                            <br>
                            <!-- <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button> -->
                            <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                            <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                            </div>
                        </div>
                       
                      </div>
                  </form>
              </div>
            </div>
        </div>
      </div>
    </section>
   <!-- end new ui of report -->
<!-- 
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('txt_checkout_report')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                     {{ Form::model($search_data,array('url'=>route('search-checkouts'),'id'=>"search-checkouts", 'class'=>"form-horizontal form-label-left")) }}
                  <div class="form-group col-sm-3">
                    <label class="control-label">{{lang_trans('txt_guest')}}</label>
                    {{Form::text('customer_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                  </div>
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_room_type')}}</label>
                    {{Form::select('room_type_id',$roomtypes_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                  </div>
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_payment_status')}}</label>
                    {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                  </div>
                  <div class="form-group col-sm-1">
                    <label class="control-label">{{lang_trans('txt_date_from')}}</label>
                    {{Form::text('date_from',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_from')])}}
                  </div>
                  <div class="form-group col-sm-1">
                    <label class="control-label">{{lang_trans('txt_date_to')}}</label>
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
    </div> -->
  @endif


  @if($report_of == 'bladi_report')



   <!-- start new ui of report -->
   <section id="basic-datatable">
    <div class="row">
        <div class=" col-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{lang_trans('txt_checkout_report')}}</h4>
              </div>
              <div class="card-body">
              {{ Form::model($search_data,array('url'=>route('search-bladi'),'id'=>"search-bladi", 'class'=>"form-horizontal form-label-left")) }}
                      <div class="row">  
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="category">{{lang_trans('txt_year')}}</label>
                              
                                <select name="report_year"  class="form-select" placeholder="{{lang_trans('ph_select')}}">
                                      
                                    <?php 
                                      foreach($search_data['checkout_years'] as $val)
                                      {
                                          echo '<option value='.$val->year.'>'.$val->year.'</option>';
                                      } ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_from">{{lang_trans('txt_Month')}}</label>
                              
                                <select name="report_month"  class="form-select" placeholder="{{lang_trans('ph_select')}}">
                                  <option value="01">{{lang_trans('txt_Jan')}}</option>
                                  <option value="02">{{lang_trans('txt_Feb')}}</option>
                                  <option value="03">{{lang_trans('txt_Mar')}}</option>
                                  <option value="04">{{lang_trans('txt_Apr')}}</option>
                                  <option value="05">{{lang_trans('txt_May')}}</option>
                                  <option value="06">{{lang_trans('txt_Jun')}}</option>
                                  <option value="07">{{lang_trans('txt_Jul')}}</option>
                                  <option value="08">{{lang_trans('txt_Aug')}}</option>
                                  <option value="09">{{lang_trans('txt_Sep')}}</option>
                                  <option value="10">{{lang_trans('txt_Oct')}}</option>
                                  <option value="11">{{lang_trans('txt_Nov')}}</option>
                                  <option value="12">{{lang_trans('txt_Dec')}}</option>
                                </select>
                            </div>
                        </div>
                        

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                            <br>
                            <!-- <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button> -->

                            <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                            <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                            </div>
                        </div>
                       
                      </div>
                  </form>
              </div>
            </div>
        </div>
      </div>
    </section>
   <!-- end new ui of report -->
<!-- 
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('txt_bladi_report')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                     {{ Form::model($search_data,array('url'=>route('search-bladi'),'id'=>"search-bladi", 'class'=>"form-horizontal form-label-left")) }}
                < !-- These are the filter of customer, payment and room types  -- >
                  < !-- <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_guest')}}</label>
                    {{Form::text('customer_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                  </div>
                   <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_room_type')}}</label>
                    {{Form::select('room_type_id',$roomtypes_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                  </div> 
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_payment_status')}}</label>
                    {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                  </div> -- >
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_year')}}</label>
                    <select name="report_year"  class="form-control" placeholder="{{lang_trans('ph_select')}}">
                      
                    <?php 
                      // foreach($search_data['checkout_years'] as $val)
                      // {
                          // echo '<option value='.$val->year.'>'.$val->year.'</option>';
                      // } 
                      ?>
                    </select>
                    < !-- {{Form::text('date_from',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_from')])}} -- >
                  </div>
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_Month')}}</label>
                    < !-- {{Form::text('date_to',null,['class'=>"form-control datepicker", 'data-date-format' => "yyyy", 'placeholder'=>lang_trans('ph_date_to')])}} -- >
                    <select name="report_month"  class="form-control" placeholder="{{lang_trans('ph_select')}}">
                      <option value="01">{{lang_trans('txt_Jan')}}</option>
                      <option value="02">{{lang_trans('txt_Feb')}}</option>
                      <option value="03">{{lang_trans('txt_Mar')}}</option>
                      <option value="04">{{lang_trans('txt_Apr')}}</option>
                      <option value="05">{{lang_trans('txt_May')}}</option>
                      <option value="06">{{lang_trans('txt_Jun')}}</option>
                      <option value="07">{{lang_trans('txt_Jul')}}</option>
                      <option value="08">{{lang_trans('txt_Aug')}}</option>
                      <option value="09">{{lang_trans('txt_Sep')}}</option>
                      <option value="10">{{lang_trans('txt_Oct')}}</option>
                      <option value="11">{{lang_trans('txt_Nov')}}</option>
                      <option value="12">{{lang_trans('txt_Dec')}}</option>
                    </select>
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
    </div> -->



  @endif

  @if($report_of == 'expense')


   <!-- start new ui of report -->
   <section id="basic-datatable">
    <div class="row">
        <div class=" col-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{lang_trans('txt_expense_report')}}</h4>
              </div>
              <div class="card-body">
              {{ Form::model($search_data,array('url'=>route('search-expenses'),'id'=>"search-expense", 'class'=>"form-horizontal form-label-left")) }}
                      <div class="row">  
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="category">{{lang_trans('txt_category')}}</label>
                                {{Form::select('category_id',$category_list,null,['class'=>"form-select",'placeholder'=>lang_trans('ph_select')])}}
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_from">{{lang_trans('txt_date_from')}}</label>
                                {{Form::text('date_from',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_date_from')])}}
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="date_from">{{lang_trans('txt_date_to')}}</label>
                                {{Form::text('date_to',null,['class'=>"form-control flatpickr-basic", 'placeholder'=>lang_trans('ph_date_to')])}}
                            </div>
                        </div>
                        

                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="mb-1">
                            <br>
                            <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                            <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                            <!-- <button type="submit" class="btn btn-primary">{{lang_trans('btn_submit')}}</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">{{lang_trans('btn_reset')}}</button> -->
                            </div>
                        </div>
                       
                      </div>

                  {{ Form::close() }}
                  <!-- </form> -->
              </div>
            </div>
        </div>
      </div>
    </section>
<!-- 
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2>{{lang_trans('txt_expense_report')}}</h2>
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
                    <a class="btn btn-success search-btn" href="{{route('list-expense')}}">{{lang_trans('btn_search')}}</a>
                   <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
    </div> -->
  @endif

</div>
<script>
      globalVar.customerList = {!! json_encode($customer_list) !!};

      
    </script>
@endsection
@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
  <!-- <script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script> -->
  <!-- <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script> -->
<!-- END: Page JS-->
@endsection
