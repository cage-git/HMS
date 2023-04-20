  <!-- BEGIN: Vendor JS-->
  <script src="{{URL::asset('public/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{URL::asset('public/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <!-- <script src="{{URL::asset('public/app-assets/vendors/js/extensions/toastr.min.js')}}"></script> -->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{URL::asset('public/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!--  -->
    <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <!-- <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script> -->
    <!-- <script src="{{URL::asset('public/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script> -->
    <!--  -->
    <!-- BEGIN: Page Vendor JS-->

    <script src="{{URL::asset('public/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <!-- <script src="{{URL::asset('public/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script> -->
    <!-- <script src="{{URL::asset('public/app-assets/vendors/js/extensions/toastr.min.js')}}"></script> -->
    <!-- END: Page Vendor JS-->

    {{-- this inline script is required: set global access var --}}
        <script>
          var base_url="{{url('/').'/'}}";
          var csrf_token="{{ csrf_token() }}";
          var currency_symbol="{{getCurrencySymbol()}}";
          var current_segment = "";
        </script>

    <!-- BEGIN: Page JS-->
    <!-- <script src="{{URL::asset('public/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script> -->
    <!-- END: Page JS-->


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{URL::asset('public/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

     <!-- BEGIN: Page Vendor JS-->
    <script src="{{URL::asset('public/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{URL::asset('public/app-assets/js/core/app-menu.js')}}"></script>
    <!-- <script src="{{URL::asset('public/app-assets/js/core/app.js')}}"></script> -->
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-validation.js')}}"></script> -->
    <!-- END: Page JS-->


    <script src="{{URL::asset('public/app-assets/js/scripts/tables/table-datatables-basic.js')}}"></script>
    <!-- <script src="{{URL::asset('public/app-assets/js/scripts/tables/table-datatables-basic.js')}}"></script> -->
    <!-- <script src="{{URL::asset('public/app-assets/js/custom.js?v='.rand(1111,9999).'')}}"></script> -->
    <script src="{{URL::asset('public/js/ajax_call.js?v='.rand(1111,9999).'')}}"></script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    @yield('scripts')
