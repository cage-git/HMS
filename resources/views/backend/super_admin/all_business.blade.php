@extends('layouts.master_backend_new')
@section('content')
 @php 
      $flag=0;
      $heading=lang_trans('btn_add');
      $startDate = date('Y-m-d');
      $endDate = date('Y-m-d');
      $selectedWeekDays = [];
      if(isset($data_row) && !empty($data_row)){
          $flag=1;
          $heading=lang_trans('btn_update');
          $startDate = dateConvert($data_row->start_date);
          $endDate = dateConvert($data_row->end_date);
          $selectedWeekDays = splitText($data_row->days);
      }
      $weekDays = getWeekDaysList(['type'=>1, 'is_name'=>'full']);
  @endphp 
<div class="col-md-12 col-12">
	<section>
        <div class="row">
            <div class="col-12">
                <div class="card p-0">
                    <div class="card-header">
                        <div class="d-flex justify-content-between col-12">
                            <div class="d-flex justify-content-start align-items-center" style="width:100%; gap:10px;">
                                <a href="{{ route('all-business') }}">
                                    <button class="btn btn-primary">{{lang_trans('all_business')}}</button>
                                </a>
                                <a href="{{ route('all-packages') }}">
                                    <button class="btn btn-primary">{{lang_trans('all_package')}}</button>
                                </a>
                            </div>
                            
                            <div class="d-flex justify-content-end align-items-center" style="width:100%; gap:10px;">
                                <a href="{{ route('add-package') }}">
                                    <button class="btn btn-success"><i data-feather="plus"></i> {{lang_trans('package')}}</button>
                                </a>
                                <a href="{{route('add-business')}}">
                                    <button class="btn btn-success"><i data-feather="plus"></i> {{lang_trans('business')}}</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="card p-2">
        <div class="card-header px-0">
            <h4 class="card-title">{{lang_trans('all_business')}}</h4>
        </div>
        <table class="table table-bordered text-center business-datatable">
            <thead>
                <tr>
                  <th scope="col">Start Date</th>
                  <th scope="col">Business Name</th>
                  <th scope="col">Owner</th>
                  <th scope="col">Mobile</th>
                  <th scope="col">Address</th>
                  <th scope="col">Current Subscription</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
  <script type="text/javascript">
     $(document).ready(function () {
            $('.business-datatable').DataTable({
                "processing": true,
                "serverSide": false,
                 "searching": true,
                 "paging": true,
                "ajax":{url : "{{ route('all-business-data') }}",
                     type: "GET",
                     dataType: "JSON",},
                "columns": [
                    { "data": "start_date" },  
                    { "data": "business_name" },
                    { "data": "name" },
                    { "data": "mobile" }, 
                    { "data": "address" },
                    {
                        "data": null, 
                        "render": function (data, type, row) {
                        var subscription = row.package + ' <br> ' + row.start_date + ' - ' + row.end_date;
                            return '<div class="text-center">' + subscription + '</div>';
                        },
                        "orderable": true
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<button class="btn btn-info btn-sm edit-button" data-id="' + row.id + '"><a class="text-white" href="{{ route("edit-business","") }}/' + row.id + '">edit</a></button><button id="confirm-text" class="btn btn-danger btn-sm delete_btn" data-id="' + row.id + '">delete</button>';
                        },
                        "orderable": false
                    }
                ]
            });
        });
        $('.business-datatable').on('click', '.delete_btn', function () {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete-business', ['id' => ':id']) }}".replace(':id', id),
                        type: 'get',
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the record.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

       $('.business-datatable').on('click', '.edit-button', function () {
        var id = $(this).data('id');            
        $.ajax({
            url: "{{ url('edit-business') }}/" + id,
            type: 'get',
            success: function (response) {
                dataTable.ajax.reload();
                window.location.href = "{{ route('all-business') }}";
            },
            error: function (xhr, status, error) {
                console.error('Error updating record:', error);
            }
        });
    });


  </script>
<!-- END: Page JS-->
<script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
@endsection