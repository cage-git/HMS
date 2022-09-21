@php
$permissionsArr = getMenuPermission();
@endphp
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      @if($permissionsArr['dashboard']==1) <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> {{lang_trans('sidemenu_dashboard')}} </a></li> @endif

{{--      @if($permissionsArr['check-in']==1 && $permissionsArr['quick-check-in']) <li><a href="{{route('quick-check-in')}}"><i class="fa fa-check-square-o"></i> {{lang_trans('sidemenu_quick_checkin')}} </a></li> @endif--}}
      @if($permissionsArr['check-in']==1) <li><a href="{{route('room-reservation')}}"><i class="fa fa-check-square-o"></i> {{lang_trans('sidemenu_checkin_add')}} </a></li> @endif

      @if($permissionsArr['check-in']==1 && ($permissionsArr['quick-check-in'] || $permissionsArr['add-check-in'] || $permissionsArr['list-check-in'] || $permissionsArr['list-check-outs']) )
        <li><a><i class="fa fa-money"></i>{{lang_trans('sidemenu_checkin')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
{{--            @if($permissionsArr['quick-check-in']==1) <li><a href="{{route('quick-check-in')}}">{{lang_trans('sidemenu_quick_checkin')}} </a></li> @endif--}}
{{--            @if($permissionsArr['add-check-in']==1) <li><a href="{{route('room-reservation')}}">{{lang_trans('sidemenu_checkin_add')}} </a></li> @endif--}}
            @if($permissionsArr['list-check-in']==1) <li><a href="{{route('list-reservation')}}">{{lang_trans('sidemenu_checkin_all')}} </a></li> @endif
            @if($permissionsArr['list-check-outs']==1) <li><a href="{{route('list-check-outs')}}">{{lang_trans('sidemenu_checkout_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['reports']==1)
        <li><a><i class="fa fa-money"></i>{{lang_trans('sidemenu_reports')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['reports']==1) <li><a href="{{route('reports', ['type'=>'transactions'])}}">{{lang_trans('sidemenu_transactions_report')}} </a></li> @endif
            @if($permissionsArr['reports']==1) <li><a href="{{route('reports', ['type'=>'checkouts'])}}">{{lang_trans('sidemenu_checkout_report')}} </a></li> @endif
            @if($permissionsArr['reports']==1) <li><a href="{{route('reports', ['type'=>'expense'])}}">{{lang_trans('sidemenu_expense_report')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['users']==1 && ($permissionsArr['add-users'] || $permissionsArr['list-users']) )
        <li><a><i class="fa fa-user"></i>{{lang_trans('sidemenu_users')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
             @if($permissionsArr['add-users']==1) <li><a href="{{route('add-user')}}">{{lang_trans('sidemenu_user_add')}} </a></li> @endif
             @if($permissionsArr['list-users']==1) <li><a href="{{route('list-user')}}">{{lang_trans('sidemenu_user_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['customers']==1 && ($permissionsArr['add-customers'] || $permissionsArr['list-customers']) )
        <li><a><i class="fa fa-user"></i>{{lang_trans('sidemenu_customers')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
             @if($permissionsArr['add-customers']==1) <li><a href="{{route('add-customer')}}">{{lang_trans('sidemenu_customer_add')}} </a></li> @endif
             @if($permissionsArr['list-customers']==1) <li><a href="{{route('list-customer')}}">{{lang_trans('sidemenu_customer_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['food-category']==1 || $permissionsArr['food-item']==1)
        <li><a><i class="fa fa-cutlery"></i>{{lang_trans('sidemenu_fooditems')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-food-category']==1) <li><a href="{{route('add-food-category')}}">{{lang_trans('sidemenu_foodcat_add')}} </a></li> @endif
            @if($permissionsArr['list-food-category']==1) <li><a href="{{route('list-food-category')}}">{{lang_trans('sidemenu_foodcat_all')}} </a></li> @endif
            @if($permissionsArr['add-food-item']==1) <li><a href="{{route('add-food-item')}}">{{lang_trans('sidemenu_fooditem_add')}} </a></li> @endif
            @if($permissionsArr['list-food-item']==1) <li><a href="{{route('list-food-item')}}">{{lang_trans('sidemenu_fooditem_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['stocks']==1)
        <li><a><i class="fa fa-cart-plus"></i>{{lang_trans('sidemenu_stocks')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-product']==1) <li><a href="{{route('add-product')}}">{{lang_trans('sidemenu_product_add')}} </a></li> @endif
            @if($permissionsArr['list-product']==1) <li><a href="{{route('list-product')}}">{{lang_trans('sidemenu_product_all')}} </a></li> @endif
            @if($permissionsArr['add-stock']==1) <li><a href="{{route('io-stock')}}">{{lang_trans('sidemenu_stock_add')}} </a></li> @endif
            @if($permissionsArr['history-stock']==1) <li><a href="{{route('stock-history')}}">{{lang_trans('sidemenu_stock_history')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['room-type']==1)
        <li><a><i class="fa fa-home"></i>{{lang_trans('sidemenu_roomtypes')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-room-type']==1) <li class="sub_menu"><a href="{{route('add-room-types')}}">{{lang_trans('sidemenu_roomtype_add')}} </a></li> @endif
            @if($permissionsArr['list-room-type']==1) <li class="sub_menu"><a href="{{route('list-room-types')}}">{{lang_trans('sidemenu_roomtype_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['rooms']==1)
      <li><a><i class="fa fa-home"></i>{{lang_trans('sidemenu_rooms')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-room']==1) <li class="sub_menu"><a href="{{route('add-room')}}">{{lang_trans('sidemenu_room_add')}} </a></li> @endif
            @if($permissionsArr['list-room']==1) <li class="sub_menu"><a href="{{route('list-room')}}">{{lang_trans('sidemenu_room_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['amenities']==1)
        <li><a><i class="fa fa-tag"></i>{{lang_trans('sidemenu_amenities')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-amenities']==1) <li class="sub_menu"><a href="{{route('add-amenities')}}">{{lang_trans('sidemenu_amenities_add')}} </a></li> @endif
            @if($permissionsArr['list-amenities']==1) <li class="sub_menu"><a href="{{route('list-amenities')}}">{{lang_trans('sidemenu_amenities_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['expense-categories']==1 || $permissionsArr['expenses']==1)
        <li><a><i class="fa fa-hourglass-start"></i>{{lang_trans('sidemenu_expense')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-expense-category']==1) <li><a href="{{route('add-expense-category')}}">{{lang_trans('sidemenu_expensecat_add')}} </a></li> @endif
            @if($permissionsArr['list-expense-category']==1) <li><a href="{{route('list-expense-category')}}">{{lang_trans('sidemenu_expensecat_all')}} </a></li> @endif
            @if($permissionsArr['add-expenses']==1) <li><a href="{{route('add-expense')}}">{{lang_trans('sidemenu_expense_add')}} </a></li> @endif
            @if($permissionsArr['list-expenses']==1) <li><a href="{{route('list-expense')}}">{{lang_trans('sidemenu_expense_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['settings']==1) <li><a href="{{route('settings')}}"><i class="fa fa-cog"></i>{{lang_trans('sidemenu_settings')}} </a></li> @endif
      @if($permissionsArr['dynamic-dropdowns']==1) <li><a href="{{route('dynamic-dropdown-list')}}"><i class="fa fa-caret-square-o-down"></i>{{lang_trans('sidemenu_dynamic_dropdowns')}} </a></li> @endif
      @if($permissionsArr['permissions']==1) <li><a href="{{route('permissions-list')}}"><i class="fa fa-universal-access"></i>{{lang_trans('sidemenu_permissions')}} </a></li> @endif
      @if($permissionsArr['website-pages']==1)
        <li><a><i class="fa fa-globe"></i>Website<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('home-page')}}">Home Page</a></li>
            <li><a href="{{route('about-page')}}">About Us Page</a></li>
            <li><a href="{{route('contact-page')}}">Contact Us Page</a></li>
          </ul>
        </li>
      @endif
    </ul>
  </div>
</div>
