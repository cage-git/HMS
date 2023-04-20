@extends('layouts.master_backend_new')
@section('content')
  <!-- <link rel="stylesheet" href="{{URL::asset('public/assets/fullcalendar/main.css')}}"> -->
  <!-- <link rel="stylesheet" href="{{URL::asset('public/assets/fullcalendar/style_backend.css')}}"> -->
  <!-- <script type="text/javascript" src="{{URL::asset('public/assets/fullcalendar/main.js?v='.rand(1111,9999).'')}}"></script> -->
  <!-- <script type="text/javascript" src="{{URL::asset('public/assets/fullcalendar/locales-all.min.js?v='.rand(1111,9999).'')}}"></script> -->
  <!-- <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/charts/apexcharts.css')}}">  -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/pages/app-calendar.css')}}"> 

        <?php if(getSettings('site_theme') == 'dark'){   ?> 
            <style>
                .fc .fc-day-today{
                    background: none !important;
                    background-color: none !important;
                }
            </style>
        <?php } ?>

        <style>
                .showTable{
                    display:block;
                }

                .hideTable{
                    display:none;
                }
            </style>

    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <!-- Medal Card -->
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                    <div class="card-body">
                        <h5>Congratulations 🎉 John!</h5>
                        <p class="card-text font-small-3">You have won gold medal</p>
                        <h3 class="mb-75 mt-2 pt-50">
                            <a href="#">$48.9k</a>
                        </h3>
                        <button type="button" class="btn btn-primary">View Sales</button>
                        <img src="../../../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />
                    </div>
                </div>
            </div>
            <!--/ Medal Card -->

            <!-- Statistics Card -->
            <div class="col-xl-8 col-md-6 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Statistics</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{$counts[0]->today_check_ins}}</h4>
                                        <p class="card-text font-small-3 mb-0">{{lang_trans('txt_today_checkin')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-info me-2">
                                        <div class="avatar-content">
                                            <i data-feather="user" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{$counts[0]->today_check_outs}}</h4>
                                        <p class="card-text font-small-3 mb-0">{{lang_trans('txt_today_checkout')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            <i data-feather="box" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{ number_format((float)$counts[0]->user_count_two, 2, '.', '')}}</h4>
                                        <p class="card-text font-small-3 mb-0">{{lang_trans('txt_today_orders')}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-sm-6 col-12">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-success me-2">
                                        <div class="avatar-content">
                                            <i data-feather="dollar-sign" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">$9745</h4>
                                        <p class="card-text font-small-3 mb-0">Revenue</p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>

        <div class="row match-height">
            <div class="col-lg-4 col-12">
                <div class="row match-height">
                    <!-- Bar Chart - Orders -->
                    <div class="col-lg-6 col-md-3 col-6">
                        <div class="card">
                            <div class="card-body pb-50">
                                <h6>Orders</h6>
                                <h2 class="fw-bolder mb-1">2,76k</h2>
                                <div id="statistics-order-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ Bar Chart - Orders -->

                    <!-- Line Chart - Profit -->
                    <div class="col-lg-6 col-md-3 col-6">
                        <div class="card card-tiny-line-stats">
                            <div class="card-body pb-50">
                                <h6>Profit</h6>
                                <h2 class="fw-bolder mb-1">6,24k</h2>
                                <div id="statistics-profit-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ Line Chart - Profit -->

                    <!-- Earnings Card -->
                    <div class="col-lg-12 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title mb-1">Earnings</h4>
                                        <div class="font-small-2">This Month</div>
                                        <h5 class="mb-1">$4055.56</h5>
                                        <p class="card-text text-muted font-small-2">
                                            <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <div id="earnings-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Earnings Card -->
                </div>
            </div>

            <!-- Revenue Report Card -->
            <div class="col-lg-8 col-12">
                <div class="card card-revenue-budget">
                    <div class="row mx-0">
                        <div class="col-md-8 col-12 revenue-report-wrapper">
                            <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-50 mb-sm-0">Revenue Report</h4>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center me-2">
                                        <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
                                        <span>Earning</span>
                                    </div>
                                    <div class="d-flex align-items-center ms-75">
                                        <span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                                        <span>Expense</span>
                                    </div>
                                </div>
                            </div>
                            <div id="revenue-report-chart"></div>
                        </div>
                        <div class="col-md-4 col-12 budget-wrapper">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    2020
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">2020</a>
                                    <a class="dropdown-item" href="#">2019</a>
                                    <a class="dropdown-item" href="#">2018</a>
                                </div>
                            </div>
                            <h2 class="mb-25">$25,852</h2>
                            <div class="d-flex justify-content-center">
                                <span class="fw-bolder me-25">Budget:</span>
                                <span>56,800</span>
                            </div>
                            <div id="budget-chart"></div>
                            <button type="button" class="btn btn-primary">Increase Budget</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Revenue Report Card -->
        </div>


        <div class="row">
            <div class="col-6">
                    <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">{{lang_trans('txt_latest_orders')}}</h4>
                            </div>
                            <div class="card-body feature-repeater">
                                <div class="row">
                                @foreach($orders as $k=>$val)
                                    @php
                                        $totalAmount = 0.00;
                                    @endphp
                                    @if($val->order_history)
                                        @foreach($val->order_history as $key_OH=>$val_OH)
                                            @if($val_OH->orders_items)
                                                @foreach($val_OH->orders_items as $key_OI=>$val_OI)
                                                    @php
                                                        $price = $val_OI->item_price*$val_OI->item_qty;
                                                        $totalAmount = $totalAmount+$price;
                                                        $totalAmmountsArr[$val->id] = $totalAmount;
                                                    @endphp
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                <table class="datatables-basic table">
                                <thead>
                                    <tr>
                                    <th>{{lang_trans('txt_sno')}}</th>
                                    <th>{{lang_trans('txt_customer_name')}}</th>
                                    <th>{{lang_trans('txt_table_num')}}</th>
                                    <th>{{lang_trans('txt_order_amount')}}</th>
                                    <th>{{lang_trans('txt_action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $k=>$val)
                                        <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->table_num}}</td>
                                        <td>{{getCurrencySymbol()}} {{@$totalAmmountsArr[$val->id]}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-success" href="{{route('food-order-table',[$val->id])}}">{{lang_trans('btn_repeat_order')}}</i></a>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".view_modal_{{$k}}">{{lang_trans('btn_view_order')}}</button>
                                            <a class="btn btn-sm btn-warning" href="{{route('food-order-final',[$val->id])}}" target="_blank">{{lang_trans('btn_pay')}}</i></a>

                                            <div class="modal fade view_modal_{{$k}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">{{lang_trans('txt_order_details')}}: ({{lang_trans('txt_table_num')}}- #{{$val->table_num}})</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                        <table  class="table table-striped table-bordered">
                                                                <tr>
                                                                    <th>{{lang_trans('txt_sno')}}</th>
                                                                    <th>{{lang_trans('txt_datetime')}}</th>
                                                                    <th>{{lang_trans('txt_orderitem_qty')}}</th>
                                                                </tr>
                                                                @if($val->order_history)
                                                                    @foreach($val->order_history as $key_OH=>$val_OH)
                                                                        <tr>
                                                                        <td>{{$key_OH+1}}</td>
                                                                        <td>{{$val_OH->created_at}}</td>
                                                                        <td>
                                                                            @if($val_OH->orders_items)
                                                                                <table class="table table-bordered">
                                                                                    @foreach($val_OH->orders_items as $key_OI=>$val_OI)
                                                                                        @php
                                                                                            $price = $val_OI->item_price*$val_OI->item_qty;
                                                                                            $totalAmount = $totalAmount+$price;
                                                                                        @endphp
                                                                                        <tr>
                                                                                            <td>{{$val_OI->item_name}}</td>
                                                                                            <td>{{$val_OI->item_qty}}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </table>
                                                                            @endif
                                                                        </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                                </table>

                                </div>
                            </div>
                    </div>
            </div>

            <div class="col-6">
                    <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">{{lang_trans('txt_product_stocks')}}</h4>
                            </div>
                            <div class="card-body feature-repeater">
                                <div class="row">
                                <table class="datatables-basic table" id="example">
                                <thead>
                                    <tr>
                                        <th>{{lang_trans('txt_sno')}}</th>
                                        <th>{{lang_trans('txt_product')}}</th>
                                        <th>{{lang_trans('txt_current_stocks')}}</th>
                                        <th>{{lang_trans('txt_unit')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $k=>$val)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td>{{$val->name}}</td>
                                            <td class="{{stockInfoColor($val->stock_qty)}}">{{$val->stock_qty}}</td>
                                            <td>{{getDynamicDropdownById($val->measurement, 'dropdown_value')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>

                                </div>
                            </div>
                    </div>
            </div>

            <div class="col-12">
                    <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">{{lang_trans('txt_room')}}</h4>
                            </div>
                            <div class="card-body feature-repeater">
                                <div class="row">
                                <table class="datatables-basic table">
                                <thead>
                                    <tr>
                                        <th>{{lang_trans('txt_sno')}}</th>
                                        <th>{{lang_trans('txt_title')}}</th>
                                        <th>{{lang_trans('txt_capacity')}}</th>
                                        <th>{{lang_trans('txt_base_price')}}</th>
                                        <th>{{lang_trans('txt_room')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($room_types as $key=>$val)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$val->title}}</td>
                                        <td>{{lang_trans('txt_adults')}}: {{$val->adult_capacity}} &nbsp; {{lang_trans('txt_kids')}}: {{$val->kids_capacity}} </td>
                                        <td>{{getCurrencySymbol()}} {{$val->base_price}}</td>
                                        <td>
                                            <button class="btn btn-primary" id="button_room_table_<?php echo $key; ?>" onclick='showHideTableContent("room_table_<?php echo $key; ?>")'>Show
                                            </button>
                                            @if($val->rooms->count())
                                                <table id="room_table_<?php echo $key; ?>" class="table table-striped table-bordered hideTable">
                                                <thead>
                                                    <tr>
                                                        <th>{{lang_trans('txt_sno')}}</th>
                                                        <th>{{lang_trans('txt_room_num')}}</th>
                                                        <th>{{lang_trans('txt_floor')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($val->rooms as $k=>$v)
                                                    <tr>
                                                        <td>{{$k+1}}</td>
                                                        <td>{{$v->room_no}}</td>
                                                        <td>{{getDynamicDropdownById($v->floor, 'dropdown_value')}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                </table>
                                            @else
                                            {{lang_trans('txt_no_rooms')}}
                                            <a class="btn btn-xs btn-success" href="{{route('add-room')}}">{{lang_trans('txt_add_new_rooms')}}</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>

                                </div>
                            </div>
                    </div>
            </div>
        </div>

        <!-- Calendar -->
        <!-- <div class="col-12">
            <div class="card">
                <div class="col position-relative">
                    <div class="card shadow-none border-0 mb-0 rounded-0">
                        <div class="card-body pb-0">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- /Calendar -->

        <div class="row g-0">
                            <!-- Sidebar -->
                            <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
                                <div class="sidebar-wrapper">
                                    <div class="card-body d-flex justify-content-center">
                                        <button class="btn btn-primary btn-toggle-sidebar w-100" data-bs-toggle="modal" data-bs-target="#add-new-sidebar">
                                            <span class="align-middle">Add Event</span>
                                        </button>
                                    </div>
                                    <div class="card-body pb-0">
                                        <h5 class="section-label mb-1">
                                            <span class="align-middle">Filter</span>
                                        </h5>
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input select-all" id="select-all" checked />
                                            <label class="form-check-label" for="select-all">View All</label>
                                        </div>
                                        <div class="calendar-events-filter">
                                            <div class="form-check form-check-danger mb-1">
                                                <input type="checkbox" class="form-check-input input-filter" id="personal" data-value="personal" checked />
                                                <label class="form-check-label" for="personal">Personal</label>
                                            </div>
                                            <div class="form-check form-check-primary mb-1">
                                                <input type="checkbox" class="form-check-input input-filter" id="business" data-value="business" checked />
                                                <label class="form-check-label" for="business">Business</label>
                                            </div>
                                            <div class="form-check form-check-warning mb-1">
                                                <input type="checkbox" class="form-check-input input-filter" id="family" data-value="family" checked />
                                                <label class="form-check-label" for="family">Family</label>
                                            </div>
                                            <div class="form-check form-check-success mb-1">
                                                <input type="checkbox" class="form-check-input input-filter" id="holiday" data-value="holiday" checked />
                                                <label class="form-check-label" for="holiday">Holiday</label>
                                            </div>
                                            <div class="form-check form-check-info">
                                                <input type="checkbox" class="form-check-input input-filter" id="etc" data-value="etc" checked />
                                                <label class="form-check-label" for="etc">ETC</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <img src="../../../app-assets/images/pages/calendar-illustration.png" alt="Calendar illustration" class="img-fluid" />
                                </div>
                            </div>
                            <!-- /Sidebar -->

                            <!-- Calendar -->
                            <div class="col position-relative">
                                <div class="card shadow-none border-0 mb-0 rounded-0">
                                    <div class="card-body pb-0">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Calendar -->
                            <div class="body-content-overlay"></div>
                        </div>

    </section>
    <!-- Dashboard Ecommerce ends -->

<!-- 

  <div class="">
     @section('rightColContent')
         <div class="row top_tiles">
            <a href="{{route('list-reservation')}}">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 firstTile">
                    <div class="tile-stats">
                        <div class="icon">
                            <i class="fa fa-caret-square-o-right"></i>
                        </div>
                        <div class="count">{{$counts[0]->today_check_ins}}</div>
                        <h3 class="white-font">{{lang_trans('txt_today_checkin')}}</h3>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </a>
            <a href="{{route('list-check-outs')}}">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 secondTile">
                    <div class="tile-stats">
                        <div class="icon">
                            <i class="fa fa-comments-o"></i>
                        </div>
                        <div class="count">{{$counts[0]->today_check_outs}}</div>
                        <h3 class="white-font">{{lang_trans('txt_today_checkout')}}</h3>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </a>
{{--                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 thirdTile">--}}
{{--                    <div class="tile-stats">--}}
{{--                        <div class="icon">--}}
{{--                            <i class="fa fa-sort-amount-desc"></i>--}}
{{--                        </div>--}}
{{--                        <div class="count">{{$counts[0]->today_orders}}</div>--}}
{{--                        <h3 ><a href="{{route('orders-list')}}">{{lang_trans('txt_today_orders')}}</a></h3>--}}
{{--                        <p>&nbsp;</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
            <a href="{{route('orders-list')}}">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 thirdTile">
                    <div class="tile-stats">
                        <div class="icon">
                            <i class="fa fa-sort-amount-desc"></i>
                        </div>
                        <div class="count">{{ number_format((float)$counts[0]->user_count_two, 2, '.', '')}}</div>
                        <h3 class="white-font">{{lang_trans('txt_today_orders')}}</h3>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </a>
            </div> 


      @endsection
    <! -- <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
                   <div id='calendar'></div>
              </div>
          </div>
      </div>
    </div> -->

    <!-- Calendar -->
    <!-- <div class="col position-relative">
        <div class="card shadow-none border-0 mb-0 rounded-0">
            <div class="card-body pb-0">
                <div id="calendar"></div>
            </div>
        </div>
    </div> -->
    <!-- /Calendar -->

    <!-- <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-sm-12">
                                <div class="col-sm-4 p-left-0">
                                    <h2>{{lang_trans('txt_latest_orders')}}</h2>
                                </div>
                                <div class="col-sm-8 text-right">
                                    <a href="{{route('food-order')}}" class="btn btn-success">{{lang_trans('txt_add_new_orders')}}</a>
                                    <a href="{{route('orders-list')}}" class="btn btn-info">{{lang_trans('btn_view_all')}}</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @foreach($orders as $k=>$val)
                                @php
                                     $totalAmount = 0.00;
                                @endphp
                                @if($val->order_history)
                                    @foreach($val->order_history as $key_OH=>$val_OH)
                                        @if($val_OH->orders_items)
                                            @foreach($val_OH->orders_items as $key_OI=>$val_OI)
                                                @php
                                                    $price = $val_OI->item_price*$val_OI->item_qty;
                                                    $totalAmount = $totalAmount+$price;
                                                    $totalAmmountsArr[$val->id] = $totalAmount;
                                                @endphp
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <table  class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>{{lang_trans('txt_sno')}}</th>
                              <th>{{lang_trans('txt_customer_name')}}</th>
                              <th>{{lang_trans('txt_table_num')}}</th>
                              <th>{{lang_trans('txt_order_amount')}}</th>
                              <th>{{lang_trans('txt_action')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($orders as $k=>$val)
                                <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$val->name}}</td>
                                <td>{{$val->table_num}}</td>
                                <td>{{getCurrencySymbol()}} {{@$totalAmmountsArr[$val->id]}}</td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="{{route('food-order-table',[$val->id])}}">{{lang_trans('btn_repeat_order')}}</i></a>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".view_modal_{{$k}}">{{lang_trans('btn_view_order')}}</button>
                                    <a class="btn btn-sm btn-warning" href="{{route('food-order-final',[$val->id])}}" target="_blank">{{lang_trans('btn_pay')}}</i></a>

                                    <div class="modal fade view_modal_{{$k}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">{{lang_trans('txt_order_details')}}: ({{lang_trans('txt_table_num')}}- #{{$val->table_num}})</h4>
                                                </div>
                                                <div class="modal-body">
                                                   <table  class="table table-striped table-bordered">
                                                        <tr>
                                                            <th>{{lang_trans('txt_sno')}}</th>
                                                            <th>{{lang_trans('txt_datetime')}}</th>
                                                            <th>{{lang_trans('txt_orderitem_qty')}}</th>
                                                        </tr>
                                                        @if($val->order_history)
                                                            @foreach($val->order_history as $key_OH=>$val_OH)
                                                                <tr>
                                                                  <td>{{$key_OH+1}}</td>
                                                                  <td>{{$val_OH->created_at}}</td>
                                                                  <td>
                                                                    @if($val_OH->orders_items)
                                                                        <table class="table table-bordered">
                                                                            @foreach($val_OH->orders_items as $key_OI=>$val_OI)
                                                                                @php
                                                                                    $price = $val_OI->item_price*$val_OI->item_qty;
                                                                                    $totalAmount = $totalAmount+$price;
                                                                                @endphp
                                                                                <tr>
                                                                                    <td>{{$val_OI->item_name}}</td>
                                                                                    <td>{{$val_OI->item_qty}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </table>
                                                                    @endif
                                                                  </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                      </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                              </tr>

                            @endforeach
                          </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{lang_trans('txt_room')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable_" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>{{lang_trans('txt_sno')}}</th>
                                  <th>{{lang_trans('txt_title')}}</th>
                                  <th>{{lang_trans('txt_capacity')}}</th>
                                  <th>{{lang_trans('txt_base_price')}}</th>
                                  <th>{{lang_trans('txt_room')}}</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($room_types as $key=>$val)
                                  <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$val->title}}</td>
                                    <td>{{lang_trans('txt_adults')}}: {{$val->adult_capacity}} &nbsp; {{lang_trans('txt_kids')}}: {{$val->kids_capacity}} </td>
                                    <td>{{getCurrencySymbol()}} {{$val->base_price}}</td>
                                    <td>
                                        @if($val->rooms->count())
                                            <table class="table table-striped table-bordered">
                                              <thead>
                                                <tr>
                                                    <th>{{lang_trans('txt_sno')}}</th>
                                                    <th>{{lang_trans('txt_room_num')}}</th>
                                                    <th>{{lang_trans('txt_floor')}}</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($val->rooms as $k=>$v)
                                                  <tr>
                                                    <td>{{$k+1}}</td>
                                                    <td>{{$v->room_no}}</td>
                                                    <td>{{getDynamicDropdownById($v->floor, 'dropdown_value')}}</td>
                                                  </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                        @else
                                           {{lang_trans('txt_no_rooms')}}
                                           <a class="btn btn-xs btn-success" href="{{route('add-room')}}">{{lang_trans('txt_add_new_rooms')}}</a>
                                        @endif
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">

                            <div class="col-sm-8 p-left-0">
                                <h2>{{lang_trans('txt_product_stocks')}}</h2>
                            </div>
                            <div class="col-sm-4 text-right">
                                <a href="{{route('list-product')}}" class="btn btn-info">{{lang_trans('btn_view_all')}}</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable_" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>{{lang_trans('txt_sno')}}</th>
                              <th>{{lang_trans('txt_product')}}</th>
                              <th>{{lang_trans('txt_current_stocks')}}</th>
                              <th>{{lang_trans('txt_unit')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($products as $k=>$val)
                              <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$val->name}}</td>
                                <td class="{{stockInfoColor($val->stock_qty)}}">{{$val->stock_qty}}</td>
                                <td>{{getDynamicDropdownById($val->measurement, 'dropdown_value')}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div> -->
{{-- require set var in js var --}}
  <script>
    globalVar.page = 'dashboard_page';
    var db_event = <?php echo $events; ?>;
    console.log("event",db_event); 

    function showHideTableContent(id){
        console.log(id);
        var hideTable = $("#"+id).hasClass("hideTable")
        if(hideTable){
            console.log(id, hideTable, "#"+id);
            $("#"+id).removeClass("hideTable");
            $("#button_"+id).html("Hide");
        }else{
            console.log(id, hideTable, "#"+id);
            $("#"+id).addClass("hideTable");
            $("#button_"+id).html("Show");
        }
        
    }

    </script>

<!-- <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script> -->
@endsection
@section('scripts')

<script src="{{URL::asset('public/app-assets/vendors/js/calendar/fullcalendar.min.js')}}"></script>
<script src="{{URL::asset('public/app-assets/js/scripts/pages/app-calendar-events.js')}}"></script>
<script src="{{URL::asset('public/app-assets/js/scripts/pages/app-calendar.js')}}"></script>

<script>
//     $(document).ready(function() {
//     $('#example').DataTable( {
//         select: true,
//         language: {
//             select: {
//                 rows: {
//                     _: "You have selected %d rows",
//                     0: "Click a row to select it",
//                     1: "Only 1 row selected"
//                 }
//             }
//         }
//     } );
// } );
</script>
@endsection
