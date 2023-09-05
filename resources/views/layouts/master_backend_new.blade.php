<!DOCTYPE html>
<html class="<?php if(getSettings('site_theme') == 'dark'){ echo 'dark-layout'; } ?> loading" lang="en" data-textdirection="ltr">

<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>{{getSettings('site_page_title')}}</title>
    <link rel="apple-touch-icon" href="{{URL::asset('public/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('public/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <?php if(getSettings('site_language') == 'en'){   ?>
        <!-- ltr  -->
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/calendars/fullcalendar.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/charts/apexcharts.css')}}">
        <!-- <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/extensions/toastr.min.css')}}"> -->
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Vendor CSS-->
            <!-- <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/vendors.min.css')}}"> -->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/forms/select/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">

        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/themes/bordered-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/themes/semi-dark-layout.css')}}">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/forms/form-quill-editor.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/charts/chart-apex.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
        <!-- END: Page CSS-->


          <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/pages/app-invoice.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/forms/pickers/form-pickadate.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/pages/app-calendar.css')}}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/style.css')}}">
        <!-- END: Custom CSS-->
        <!-- ltr ended -->
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/forms/form-validation.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">

        <!-- END: Page CSS-->
    <?php }else if(getSettings('site_language') == 'ar'){   ?>
        <!-- rtl -->

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/vendors-rtl.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/calendars/fullcalendar.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/forms/select/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/charts/apexcharts.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/extensions/toastr.min.css')}}">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/themes/bordered-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/themes/semi-dark-layout.css')}}">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/forms/form-quill-editor.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/plugins/charts/chart-apex.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/plugins/extensions/ext-component-toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/pages/app-calendar.css')}}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/custom-rtl.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/assets/css/style-rtl.css')}}">
        <!-- END: Custom CSS-->

        <!-- rtl ended -->
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/forms/form-validation.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">

        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">

    <!-- END: Page CSS-->
    <?php } ?>
    <script type="text/javascript" src="{{URL::asset('public/js/init.js?v='.rand(1111,9999).'')}}"></script>
    <script type="text/javascript" src="{{URL::asset('public/assets/moment/min/moment.min.js?v='.rand(1111,9999).'')}}"></script>

    @yield('styles')

    <?php if(getSettings('site_theme') == 'dark'){   ?>
        <style>
            .navbar-floating .header-navbar-shadow{
                background: none;
            }
        </style>
     <?php }else{ ?>
        <style>
             div > span,a, h1, h2, h3, h4, h5, tr, td, p, label, div, option, select, input{
                color: #1b1b1c !important;
            }
        </style>
    <?php } ?>
    <style>
    /* Preloader
-------------------------------------------------------*/

.loader-mask {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ffffffb5;
    z-index: 9999;
    backdrop-filter: blur(4px);
}

.loader {
    position: absolute;
    left: 50%;
    top: 50%;
    width: 50px;
    height: 50px;
    font-size: 0;
    color: #00c9d0;
    display: inline-block;
    margin: -25px 0 0 -25px;
    text-indent: -9999em;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
}
.lead{
  font-size:13px;
}
.loader div {
    background-color: #7367f0;
    display: inline-block;
    float: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 50px;
    height: 50px;
    opacity: .5;
    border-radius: 50%;
    -webkit-animation: ballPulseDouble 2s ease-in-out infinite;
    animation: ballPulseDouble 2s ease-in-out infinite;
}

.loader div:last-child {
    -webkit-animation-delay: -1s;
    animation-delay: -1s;
}

@-webkit-keyframes ballPulseDouble {
    0%,
    100% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    50% {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}

@keyframes ballPulseDouble {
    0%,
    100% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    50% {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}
    </style>
</head>
<!-- END: Head-->
    <body
    class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- Preloader -->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
<!-- Preloader -->



         @include('layouts.navbar_backend_new')
         @include('layouts.sidebar_backend_new')

            <!-- BEGIN: Content-->
            <div class="app-content content ">
                <div class="content-overlay"></div>
                <div class="header-navbar-shadow"></div>
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">

                        @yield('content')

                    </div>
                </div>
            </div>

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        @include('layouts.footer_backend_new')
        @include('layouts.script_backend')
        <script type="text/javascript">
        window.addEventListener('load', function () {
           var loader = document.querySelector('.loader-mask');
            // if (loader) {
            //     setTimeout(function () {
            //     loader.style.display = 'none'; 
            //     }, 1500);
            // }
            loader.style.display = 'none';
        });
        document.querySelector('.nav-link-style').addEventListener('click', function(event) {
                event.preventDefault();
                var currentHref = this.getAttribute('href');
                var loader = document.querySelector('.loader-mask');

                if (loader) {
                    loader.style.display = 'block';
                }
                setTimeout(function() {
                    window.location.href = currentHref;
                });
                // window.location.href = currentHref;
            });

            
        document.querySelector('.cs_clik').addEventListener('click', function(event) {
           var targetDiv = document.getElementById("sidbar_nav");
           targetDiv.classList.remove("expanded");
        });
        </script>
    </body>
</html>
