<!-- BEGIN: Main Menu-->
@php
    $permissionsArr = getRoutePermission();
    $logo_Lang= getSettings('site_language') == 'ar'? config('constants.logo_Lang_AR'): config('constants.logo_Lang_EN');

@endphp   
<div id="sidbar_nav" class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html"><span class="brand-logo">
                    <img class="img-fluid" src="{{asset('public/images/logo.png')}}" alt="logo",height= "150" , width="150" />
                            </span>
                        <h2 class="brand-text">{{ $logo_Lang }}</h2>
                    </a></li>
                <li class="nav-item nav-toggle d-xl-none"><a id="tgl_cls" class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if($permissionsArr['dashboard'])<li class=" nav-item {{ request()->url() === url('admin/dashboard') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('dashboard')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">{{lang_trans('sidemenu_dashboard')}}</span></a></li>@endif

            @if($permissionsArr['room-reservation'])<li class=" nav-item {{ request()->url() === url('admin/check-in') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('room-reservation')}}"><i data-feather='plus-square'></i><span class="menu-title text-truncate" data-i18n="Dashboards">{{lang_trans('sidemenu_checkin_add')}}</span></a></li>@endif
            <li class=" nav-item {{ request()->url() === url('admin/super-admin') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('all-business')}}"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Dashboards">Super Admin</span></a></li>
            
            @if($permissionsArr['room-reservation']  && ($permissionsArr['quick-check-in'] || $permissionsArr['room-reservation'] || $permissionsArr['list-reservation'] || $permissionsArr['list-check-outs']) )
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='dollar-sign'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_checkin')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['list-reservation'])<li class="{{ request()->url() === url('admin/list-check-ins') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-reservation')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_checkin_all')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-check-outs'])<li class="{{ request()->url() === url('admin/list-check-outs') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-check-outs')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_checkout_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif

            @if($permissionsArr['add-housekeeping-item'] || $permissionsArr['list-housekeeping-item'] || $permissionsArr['add-housekeeping-order'] || $permissionsArr['list-housekeeping-order'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='wind'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_housekeeping')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['list-housekeeping-item'])<li class="{{ request()->url() === url('admin/list-housekeeping-item') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-housekeeping-item')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_item_all')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-housekeeping-order'])<li class="{{ request()->url() === url('admin/list-housekeeping-order') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-housekeeping-order')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_order_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif
            
            @if($permissionsArr['add-laundry-item'] || $permissionsArr['list-laundry-item'] || $permissionsArr['add-laundry-order'] || $permissionsArr['list-laundry-order'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='droplet'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_laundry')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['list-laundry-item'])<li class="{{ request()->url() === url('admin/list-laundry-item') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-laundry-item')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_item_all')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-laundry-order'])<li class="{{ request()->url() === url('admin/list-laundry-order') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-laundry-order')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_order_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif


            @if($permissionsArr['reports'] || $permissionsArr['stock-history'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='file'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_reports')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['reports'])<li class="{{ request()->url() === url('admin/reports') && request()->has('type') && request()->get('type') === 'transactions' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('reports', ['type'=>'transactions'])}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_transactions_report')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['reports'])<li class="{{ request()->url() === url('admin/reports') && request()->has('type') && request()->get('type') === 'checkouts' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('reports', ['type'=>'checkouts'])}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_checkout_report')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['reports'])<li class="{{ request()->url() === url('admin/reports') && request()->has('type') && request()->get('type') === 'bladi_report' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('reports', ['type'=>'bladi_report'])}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_bladi_report')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['reports'])<li class="{{ request()->url() === url('admin/reports') && request()->has('type') && request()->get('type') === 'expense' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('reports', ['type'=>'expense'])}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_expense_report')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['reports'])<li class="{{ request()->url() === url('admin/reports') && request()->has('type') && request()->get('type') === 'stock-history' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('stock-history')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_stock_report')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif
            
            @if($permissionsArr['add-companys'] || $permissionsArr['list-companys'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_companys')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['add-companys'])<li class="{{ request()->url() === url('admin/add-company') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-company')}}"><i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_company_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-companys'])<li class="{{ request()->url() === url('admin/list-company') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-company')}}"><i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_company_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif

            @if($permissionsArr['add-customer'] || $permissionsArr['list-customer'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_customers')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['add-customer'])<li class="{{ request()->url() === url('admin/add-customer') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-customer')}}"><i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_customer_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-customer'])<li class="{{ request()->url() === url('admin/list-customer') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-customer')}}"><i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_customer_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif

            @if($permissionsArr['add-user'] || $permissionsArr['list-user'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_users')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['add-user'])<li class="{{ request()->url() === url('admin/add-user') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-user')}}"><i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_user_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-user'])<li class="{{ request()->url() === url('admin/list-user') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-user')}}"><i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_user_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif

            @if($permissionsArr['add-food-category'] || $permissionsArr['list-food-category'] || $permissionsArr['add-food-item'] || $permissionsArr['list-food-item'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='coffee'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_fooditems')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['add-food-category']) <li class="{{ request()->url() === url('admin/add-food-category') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-food-category')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_foodcat_add')}}</span></a></li>
                        @endif
                        @if($permissionsArr['list-food-category']) <li class="{{ request()->url() === url('admin/list-food-category') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-food-category')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_foodcat_all')}}</span></a></li>
                        @endif
                        @if($permissionsArr['add-food-item']) <li class="{{ request()->url() === url('admin/add-food-item') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-food-item')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_fooditem_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-food-item']) <li class="{{ request()->url() === url('admin/list-food-item') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-food-item')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_fooditem_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif

            @if($permissionsArr['add-product'] || $permissionsArr['list-product'] || $permissionsArr['io-stock'] || $permissionsArr['stock-history'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shopping-cart'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_stocks')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['add-product']) <li class="{{ request()->url() === url('admin/add-product') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-product')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_product_add')}}</span></a></li>
                        @endif
                        @if($permissionsArr['list-product']) <li class="{{ request()->url() === url('admin/list-product') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-product')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_product_all')}}</span></a></li>
                        @endif
                        @if($permissionsArr['io-stock']) <li class="{{ request()->url() === url('admin/io-stock') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('io-stock')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_stock_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['stock-history']) <li class="{{ request()->url() === url('admin/stock-history') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('stock-history')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_stock_history')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif

            @if($permissionsArr['add-room'] || $permissionsArr['list-room'] || $permissionsArr['add-room-types'] || $permissionsArr['list-room-types'] || $permissionsArr['add-amenities'] || $permissionsArr['list-amenities'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='home'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_rooms')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['add-room']) <li class="{{ request()->url() === url('admin/add-room') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-room')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_room_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-room']) <li class="{{ request()->url() === url('admin/list-room') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-room')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_room_all')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['add-room-types']) <li class="{{ request()->url() === url('admin/add-room-types') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-room-types')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_roomtype_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-room-types']) <li class="{{ request()->url() === url('admin/list-room-types') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-room-types')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_roomtype_all')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['add-amenities']) <li class="{{ request()->url() === url('admin/add-amenities') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-amenities')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_amenities_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-amenities']) <li class="{{ request()->url() === url('admin/list-amenities') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-amenities')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_amenities_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif

            @if($permissionsArr['add-expense-category'] || $permissionsArr['list-expense-category'] || $permissionsArr['add-expense'] || $permissionsArr['list-expense'])
              <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='bar-chart-2'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_expense')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['add-expense-category']) <li class="{{ request()->url() === url('admin/add-expense-category') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-expense-category')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_expensecat_add')}}</span></a></li>
                        @endif
                        @if($permissionsArr['list-expense-category']) <li class="{{ request()->url() === url('admin/list-expense-category') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-expense-category')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_expensecat_all')}}</span></a></li>
                        @endif
                        @if($permissionsArr['add-expense']) <li class="{{ request()->url() === url('admin/add-expense') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-expense')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_expense_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-expense']) <li class="{{ request()->url() === url('admin/list-expense') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-expense')}}"><i data-feather='align-justify'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_expense_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif

            @if($permissionsArr['add-vendor-category'] || $permissionsArr['list-vendor-category'] || $permissionsArr['add-vendor'] || $permissionsArr['list-vendor'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_vendor')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['add-vendor-category'])<li class="{{ request()->url() === url('admin/add-vendor-category') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-vendor-category')}}"><i data-feather="menu"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_vendorcat_add')}}</span></a></li>
                        @endif
                        @if($permissionsArr['list-vendor-category'])<li class="{{ request()->url() === url('admin/list-vendor-category') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-vendor-category')}}"><i data-feather="menu"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_vendorcat_all')}}</span></a></li>
                        @endif
                        @if($permissionsArr['add-vendor'])<li class="{{ request()->url() === url('admin/add-vendor') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-vendor')}}"><i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_vendor_add')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['list-vendor'])<li class="{{ request()->url() === url('admin/list-vendor') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-vendor')}}"><i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_vendor_all')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif

            @if($permissionsArr['add-season'] || $permissionsArr['list-season'])
                <li class=" nav-item {{ request()->url() === url('admin/add-season') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('add-season')}}"><i data-feather='cloud'></i><span class="menu-title text-truncate" data-i18n="season">{{lang_trans('sidemenu_season_add')}}</span></a>
                </li>
                <li class=" nav-item {{ request()->url() === url('admin/list-season') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('list-season')}}"><i data-feather='cloud'></i><span class="menu-title text-truncate" data-i18n="season">{{lang_trans('sidemenu_season_all')}}</span></a>
                </li>
            @endif


            @if($permissionsArr['settings'] || $permissionsArr['dynamic-dropdown-list'] || $permissionsArr['permissions-list'] || $permissionsArr['language-translations'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_settings')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['settings'])<li class="{{ request()->url() === url('admin/settings') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('settings')}}"><i data-feather="menu"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_general_settings')}}</span></a></li>
                        @endif
                        @if($permissionsArr['permissions-list'])<li class="{{ request()->url() === url('admin/permissions-list') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('permissions-list')}}"><i data-feather="menu"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_permissions_settings')}}</span></a></li>
                        @endif
                        @if($permissionsArr['language-translations'])<li class="{{ request()->url() === url('admin/language-translations') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('language-translations')}}"><i data-feather='menu'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_lang_settings')}} </span></a></li>       
                        @endif
                        @if($permissionsArr['dynamic-dropdown-list'])<li class="{{ request()->url() === url('admin/dynamic-dropdown-list') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('dynamic-dropdown-list')}}"><i data-feather='menu'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_dynamic_dropdowns')}} </span></a></li>       
                        @endif
                    </ul>
                </li>
            @endif


            @if($permissionsArr['home-page'] || $permissionsArr['about-page'] || $permissionsArr['contact-page'])
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{lang_trans('sidemenu_website')}}</span></a>
                    <ul class="menu-content">
                        @if($permissionsArr['home-page'])<li class="{{ request()->url() === url('admin/home-page') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('home-page')}}"><i data-feather="menu"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_home_page')}}</span></a></li>
                        @endif
                        @if($permissionsArr['about-page'])<li class="{{ request()->url() === url('admin/about-page') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('about-page')}}"><i data-feather="menu"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_aboutus_page')}}</span></a></li>
                        @endif
                        @if($permissionsArr['contact-page'])<li class="{{ request()->url() === url('admin/contact-page') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('contact-page')}}"><i data-feather='menu'></i><span class="menu-item text-truncate" data-i18n="Second Level">{{lang_trans('sidemenu_contactus_page')}} </span></a></li>       
                        @endif
                       
                    </ul>
                </li>
            @endif

            

                    <!-- <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="dashboard-analytics.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Analytics</span></a>
                        </li>
                        <li class="active"><a class="d-flex align-items-center" href="dashboard-ecommerce.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">eCommerce</span></a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="app-email.html"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Email</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="app-chat.html"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="app-todo.html"><i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Todo">Todo</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="app-calendar.html"><i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Calendar">Calendar</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="app-kanban.html"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Kanban">Kanban</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Invoice</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="app-invoice-list.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-invoice-preview.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Preview</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-invoice-edit.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Edit">Edit</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-invoice-add.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="app-file-manager.html"><i data-feather="save"></i><span class="menu-title text-truncate" data-i18n="File Manager">File Manager</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shield"></i><span class="menu-title text-truncate" data-i18n="Roles &amp; Permission">Roles &amp; Permission</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="app-access-roles.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Roles">Roles</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-access-permission.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Permission">Permission</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">eCommerce</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="app-ecommerce-shop.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Shop</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-ecommerce-details.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Details">Details</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-ecommerce-wishlist.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Wish List">Wish List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-ecommerce-checkout.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Checkout">Checkout</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="app-user-list.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="View">View</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="app-user-view-account.html"><span class="menu-item text-truncate" data-i18n="Account">Account</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="app-user-view-security.html"><span class="menu-item text-truncate" data-i18n="Security">Security</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="app-user-view-billing.html"><span class="menu-item text-truncate" data-i18n="Billing &amp; Plans">Billing &amp; Plans</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="app-user-view-notifications.html"><span class="menu-item text-truncate" data-i18n="Notifications">Notifications</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="app-user-view-connections.html"><span class="menu-item text-truncate" data-i18n="Connections">Connections</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Pages">Pages</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Account Settings">Account Settings</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="page-account-settings-account.html"><span class="menu-item text-truncate" data-i18n="Account">Account</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="page-account-settings-security.html"><span class="menu-item text-truncate" data-i18n="Security">Security</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="page-account-settings-billing.html"><span class="menu-item text-truncate" data-i18n="Billings &amp; Plans">Billings &amp; Plans</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="page-account-settings-notifications.html"><span class="menu-item text-truncate" data-i18n="Notifications">Notifications</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="page-account-settings-connections.html"><span class="menu-item text-truncate" data-i18n="Connections">Connections</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="d-flex align-items-center" href="page-profile.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Profile">Profile</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="page-faq.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="FAQ">FAQ</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="page-knowledge-base.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Knowledge Base">Knowledge Base</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="page-pricing.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Pricing">Pricing</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="page-license.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="License">License</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="page-api-key.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="API Key">API Key</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Blog">Blog</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="page-blog-list.html"><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="page-blog-detail.html"><span class="menu-item text-truncate" data-i18n="Detail">Detail</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="page-blog-edit.html"><span class="menu-item text-truncate" data-i18n="Edit">Edit</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Mail Template">Mail Template</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-welcome.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Welcome">Welcome</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-reset-password.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Reset Password">Reset Password</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-verify-email.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Verify Email">Verify Email</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-deactivate-account.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Deactivate Account">Deactivate Account</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-invoice.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Invoice">Invoice</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-promotional.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Promotional">Promotional</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Miscellaneous">Miscellaneous</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="page-misc-coming-soon.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Coming Soon">Coming Soon</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="page-misc-not-authorized.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Not Authorized">Not Authorized</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="page-misc-under-maintenance.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Maintenance">Maintenance</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="page-misc-error.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Error">Error</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user-check"></i><span class="menu-title text-truncate" data-i18n="Authentication">Authentication</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Login">Login</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="auth-login-basic.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Basic">Basic</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="auth-login-cover.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Cover">Cover</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Register">Register</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="auth-register-basic.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Basic">Basic</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="auth-register-cover.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Cover">Cover</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="auth-register-multisteps.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Multi-Steps">Multi-Steps</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Forgot Password">Forgot Password</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="auth-forgot-password-basic.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Basic">Basic</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="auth-forgot-password-cover.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Cover">Cover</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Reset Password">Reset Password</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="auth-reset-password-basic.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Basic">Basic</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="auth-reset-password-cover.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Cover">Cover</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Verify Email">Verify Email</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="auth-verify-email-basic.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Basic">Basic</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="auth-verify-email-cover.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Cover">Cover</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Two Steps">Two Steps</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="auth-two-steps-basic.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Basic">Basic</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="auth-two-steps-cover.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Cover">Cover</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="modal-examples.html"><i data-feather="square"></i><span class="menu-title text-truncate" data-i18n="Modal Examples">Modal Examples</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="User Interface">User Interface</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="ui-typography.html"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Typography</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="ui-feather.html"><i data-feather="eye"></i><span class="menu-title text-truncate" data-i18n="Feather">Feather</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="Card">Card</span><span class="badge badge-light-success rounded-pill ms-auto me-1">New</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="card-basic.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Basic</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="card-advance.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Advance">Advance</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="card-statistics.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Statistics">Statistics</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="card-analytics.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Analytics</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="card-actions.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Card Actions">Card Actions</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span class="menu-title text-truncate" data-i18n="Components">Components</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="component-accordion.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Accordion">Accordion</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-alerts.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Alerts">Alerts</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-avatar.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Avatar">Avatar</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-badges.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Badges">Badges</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-breadcrumbs.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Breadcrumbs">Breadcrumbs</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-buttons.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Buttons">Buttons</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-carousel.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Carousel">Carousel</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-collapse.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapse">Collapse</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-divider.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Divider">Divider</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-dropdowns.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Dropdowns">Dropdowns</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-list-group.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List Group">List Group</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-modals.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Modals">Modals</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-navs-component.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Navs Component">Navs Component</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-offcanvas.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Offcanvas">Offcanvas</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-pagination.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Pagination">Pagination</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-pill-badges.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Pill Badges">Pill Badges</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-pills-component.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Pills Component">Pills Component</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-popovers.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Popovers">Popovers</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-progress.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Progress">Progress</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-spinner.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Spinner">Spinner</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-tabs-component.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Tabs Component">Tabs Component</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-timeline.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Timeline">Timeline</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-bs-toast.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Toasts">Toasts</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="component-tooltips.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Tooltips">Tooltips</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="box"></i><span class="menu-title text-truncate" data-i18n="Extensions">Extensions</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="ext-component-sweet-alerts.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Sweet Alert">Sweet Alert</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-blockui.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Block UI">BlockUI</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-toastr.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Toastr">Toastr</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-sliders.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Sliders">Sliders</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-drag-drop.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Drag &amp; Drop">Drag &amp; Drop</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-tour.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Tour">Tour</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-clipboard.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Clipboard">Clipboard</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-media-player.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Media player">Media Player</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-context-menu.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Context Menu">Context Menu</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-swiper.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="swiper">Swiper</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-tree.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Tree">Tree</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-ratings.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Ratings">Ratings</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="ext-component-i18n.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="l18n">l18n</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Page Layouts</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="layout-collapsed-menu.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Collapsed Menu</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="layout-full.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Layout Full</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="layout-without-menu.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Without Menu</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="layout-empty.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Empty">Layout Empty</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="layout-blank.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Blank">Layout Blank</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Forms &amp; Tables</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="Form Elements">Form Elements</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="form-input.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Input">Input</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-input-groups.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Input Groups">Input Groups</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-input-mask.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Input Mask">Input Mask</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-textarea.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Textarea">Textarea</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-checkbox.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Checkbox">Checkbox</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-radio.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Radio">Radio</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-custom-options.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Custom Options">Custom Options</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-switch.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Switch">Switch</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-select.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Select">Select</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-number-input.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Number Input">Number Input</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-file-uploader.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="File Uploader">File Uploader</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-quill-editor.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Quill Editor">Quill Editor</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="form-date-time-picker.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Date &amp; Time Picker">Date &amp; Time Picker</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="form-layout.html"><i data-feather="box"></i><span class="menu-title text-truncate" data-i18n="Form Layout">Form Layout</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="form-wizard.html"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Form Wizard">Form Wizard</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="form-validation.html"><i data-feather="check-circle"></i><span class="menu-title text-truncate" data-i18n="Form Validation">Form Validation</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="form-repeater.html"><i data-feather="rotate-cw"></i><span class="menu-title text-truncate" data-i18n="Form Repeater">Form Repeater</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="table-bootstrap.html"><i data-feather="server"></i><span class="menu-title text-truncate" data-i18n="Table">Table</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Datatable">Datatable</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="table-datatable-basic.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Basic</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="table-datatable-advanced.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Advanced">Advanced</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Charts &amp; Maps">Charts &amp; Maps</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="pie-chart"></i><span class="menu-title text-truncate" data-i18n="Charts">Charts</span><span class="badge badge-light-danger rounded-pill ms-auto me-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="chart-apex.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Apex">Apex</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="chart-chartjs.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Chartjs">Chartjs</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="maps-leaflet.html"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Leaflet Maps">Leaflet Maps</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Misc">Misc</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="menu"></i><span class="menu-title text-truncate" data-i18n="Menu Levels">Menu Levels</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Second Level 2.1</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Second Level 2.2</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="#"><span class="menu-item text-truncate" data-i18n="Third Level">Third Level 3.1</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="#"><span class="menu-item text-truncate" data-i18n="Third Level">Third Level 3.2</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="disabled nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="eye-off"></i><span class="menu-title text-truncate" data-i18n="Disabled Menu">Disabled Menu</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation" target="_blank"><i data-feather="folder"></i><span class="menu-title text-truncate" data-i18n="Documentation">Documentation</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="https://pixinvent.ticksy.com/" target="_blank"><i data-feather="life-buoy"></i><span class="menu-title text-truncate" data-i18n="Raise Support">Raise Support</span></a>
                </li>
            </ul> -->
        </div>
    </div>
    <!-- END: Main Menu-->
    <script type="text/javascript">
        var addClassButton = document.getElementById('tgl_cls');
        var targetElement = document.getElementById('sidbar_nav');
        addClassButton.addEventListener('click', function() {
            targetElement.classList.toggle('closed_mnu');
        });
        var targetElement = document.getElementById('sidbar_nav');
        targetElement.addEventListener('mouseenter', function() {
            targetElement.classList.add('new_closed_mnu');
        });
        targetElement.addEventListener('mouseleave', function() {
            // Remove the class when mouse leaves
            targetElement.classList.remove('new_closed_mnu');
        });

    </script>