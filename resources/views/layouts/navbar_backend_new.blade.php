@php
    $notificationsData = getNotifications();
@endphp
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
              
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">

            
                <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(getSettings('site_language') == 'en')
                        <i class="flag-icon flag-icon-us"></i>
                        <span class="selected-language">English</span>
                    @elseif(getSettings('site_language') == 'ar')
                        <i class="flag-icon flag-icon-sa"></i>
                        <span class="selected-language">Saudi Arab</span>
                    @endif
                   </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                        <a class="dropdown-item" href="{{route('change-setting',['en'])}}" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a>
                        <a class="dropdown-item" href="{{route('change-setting',['ar'])}}" data-language="sa"><i class="flag-icon flag-icon-sa"></i> Saudi Arab</a>
                    </div>
                </li>
 
                <li class="nav-item d-none d-lg-block">
                @if(getSettings('site_theme') == 'light')
                    <a class="nav-link nav-link-style" href="{{route('change-setting',['dark'])}}" ><i class="ficon" data-feather="moon"></i></a>
                @elseif(getSettings('site_theme') == 'dark')
                    <a class="nav-link nav-link-style" href="{{route('change-setting',['light'])}}" ><i class="ficon" data-feather="sun"></i></a>
                @endif
                </li>
           
                <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i>
                @if($notificationsData['totalUnread'])
                    <span class="badge rounded-pill bg-danger badge-up">{{$notificationsData['totalUnread']}}</span>
                @endif
                </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                                @if($notificationsData['totalUnread'])
                                    <div class="badge rounded-pill badge-light-primary">{{$notificationsData['totalUnread']}} New</div>
                                @endif
                            </div>
                        </li>

                            @if($notificationsData['datalist']->count())
                                @foreach($notificationsData['datalist'] as $val)
                                    <li class="scrollable-container media-list">
                                
                                        <a class="d-flex" href="#">
                                            <div class="list-item d-flex align-items-start">
                                                <div class="me-1">
                                                    <div class="avatar"><img src="{{url('public/images/user_img.png')}}" alt="Profile Image" width="32" height="32"></div>
                                                </div>
                                                <div class="list-item-body flex-grow-1">
                                                    <p class="media-heading"><span class="fw-bolder">{{$val['from_user']['name']}} - </span>{{timeAgo($val['notifi_datetime'])}}</p>
                                                    <small class="notification-text">  {{limit_text($val['notifi_msg'], 100)}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li class="scrollable-container media-list">
                                        <a class="d-flex">
                                            <div class="list-item d-flex align-items-start">
                                                <div class="me-1">
                                                </div>
                                                <div class="list-item-body flex-grow-1">
                                                    <small class="notification-text">{{lang_trans('txt_no_notifi')}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                            @endif
                            <!-- <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar"><img src="../../../app-assets/images/portrait/small/avatar-s-3.jpg" alt="avatar" width="32" height="32"></div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-danger">
                                            <div class="avatar-content">MD</div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                                    </div>
                                </div>
                            </a>
                            <div class="list-item d-flex align-items-center">
                                <h6 class="fw-bolder me-auto mb-0">System Notifications</h6>
                                <div class="form-check form-check-primary form-switch">
                                    <input class="form-check-input" id="systemNotification" type="checkbox" checked="">
                                    <label class="form-check-label" for="systemNotification"></label>
                                </div>
                            </div><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-danger">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Server down</span>&nbsp;registered</p><small class="notification-text"> USA Server is down due to high CPU usage</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-success">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Sales report</span>&nbsp;generated</p><small class="notification-text"> Last month sales report generated</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-warning">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">High memory</span>&nbsp;usage</p><small class="notification-text"> BLR Server using high memory</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Read all notifications</a></li> -->
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{ (Auth::user()) ? Auth::user()->name : 'NA' }}</span><!--<span class="user-status">Admin</span>--></div><span class="avatar"><img class="round" src="{{url('public/images/user_img.png')}}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{route('profile')}}"><i class="me-50" data-feather="user"></i>{{lang_trans('txt_profile')}}</a>
                        <!-- <a class="dropdown-item" href="app-email.html"><i class="me-50" data-feather="mail"></i> Inbox</a>
                        <a class="dropdown-item" href="app-todo.html"><i class="me-50" data-feather="check-square"></i> Task</a>
                        <a class="dropdown-item" href="app-chat.html"><i class="me-50" data-feather="message-square"></i> Chats</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="page-account-settings-account.html"><i class="me-50" data-feather="settings"></i> Settings</a>
                        <a class="dropdown-item" href="page-pricing.html"><i class="me-50" data-feather="credit-card"></i> Pricing</a>
                        <a class="dropdown-item" href="page-faq.html"><i class="me-50" data-feather="help-circle"></i> FAQ</a> -->
                        <a class="dropdown-item" href="{{route('logout')}}"><i class="me-50" data-feather="power"></i>{{lang_trans('txt_logout')}}</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>