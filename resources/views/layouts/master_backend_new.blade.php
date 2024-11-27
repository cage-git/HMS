<!DOCTYPE html>
<html class="<?php if(getSettings('site_theme') == 'dark'){ echo 'dark-layout'; } ?> loading" lang="en" data-textdirection="ltr">
@php
$logo_Lang= getSettings('site_language') == 'ar'? config('constants.logo_Lang_AR'): config('constants.logo_Lang_EN');
@endphp

<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>{{$logo_Lang}}</title>
    <link rel="apple-touch-icon" href="{{asset('public/images/logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/images/logo.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap-extended.css')}}">
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
    <style type="text/css">
  .tooltip-inner{color: #fff !important;}
  label#vendor_country-error {
    order: 3;
}
.error{
    color:red !important;
}
.list_usr_space table.dataTable>thead>tr>th:not(.sorting_disabled){
    padding-right: 20px;
}
.package-datatable td{
    word-break: break-all;
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
        document.querySelector('.cs_clik').addEventListener('click', function(event) {
           var targetDiv = document.getElementById("sidbar_nav");
           targetDiv.classList.remove("expanded");
        });
          document.addEventListener('DOMContentLoaded', function() {
                var rstBtns = document.querySelectorAll('.reset_btn');

                rstBtns.forEach(function(rstBtn) {
                    rstBtn.addEventListener('click', function(event) {
                        event.preventDefault();                        
                        var form = rstBtn.closest('form');
                        var inputsAndSelects = form.querySelectorAll('input[type="text"], select,textarea,input[type="number"],input[type="email"],input[type="number"],input[type="date"],input[type="checkbox"]');
                        
                        inputsAndSelects.forEach(function(element) {
                            element.value = '';
                            element.checked = false;
                        });
                    });
                });
            });
           document.addEventListener('input', function (event) {
                var priceInputs = document.querySelectorAll('.price_val');

                priceInputs.forEach(function(priceInput) {
                    var inputValue = priceInput.value.replace(/[^0-9]/g, '');
                    priceInput.value = inputValue;
                });
            });
        </script>
    </body>
</html>
