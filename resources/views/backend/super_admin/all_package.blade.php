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
            <h4 class="card-title">{{lang_trans('all_package')}}</h4>
        </div>
        <table class="table table-bordered text-center package-datatable">
            <thead>
                <tr>
                  <th scope="col">Sr. No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Number Of User</th>
                  <th scope="col">Number Of Hotels</th>
                  <th scope="col">Number Of Invoices</th>
                  <th scope="col">Services</th>
                  <th scope="col">Action</th>
                  <!-- <th scope="col">Action</th> -->
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
<script type="text/javascript">
     $(document).ready(function () {
            $('.package-datatable').DataTable({
                "processing": true,
                "serverSide": false,
                 "searching": true,
                 "paging": true,
                "ajax":{url : "{{ route('all-package-data') }}",
                     type: "GET",
                     dataType: "JSON"},
                "columns": [
                    {
                        "data": null,
                        "render": function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        "orderable": true
                    },
                    { "data": "name" },  
                    { "data": "num_user" },
                    { "data": "num_hotels" },
                    { "data": "num_invoices" }, 
                    { "data": "services" },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<button class="btn btn-info btn-sm edit-button mb-1" data-id="' + row.id + '"><a class="text-white" href="{{ route("edit-package","") }}/' + row.id + '"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a></button><button id="confirm-text" class="btn btn-danger btn-sm delete_btn" data-id="' + row.id + '"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                        },
                        "orderable": false
                    }
                ]
            });
        });
        $('.package-datatable').on('click', '.delete_btn', function () {
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
                        url: "{{ route('delete-package', ['id' => ':id']) }}".replace(':id', id),
                        type: 'get',
                        success: function (response) {
                        if (response.message === 'Cannot delete the package because it is associated with a business') {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            } else {
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                         }
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

       $('.package-datatable').on('click', '.edit-button', function () {
        var id = $(this).data('id');            
        $.ajax({
            url: "{{ url('edit-package') }}/" + id,
            type: 'get',
            success: function (response) {
                dataTable.ajax.reload();
                window.location.href = "{{ route('all-packages') }}";
            },
            error: function (xhr, status, error) {
                console.error('Error updating record:', error);
            }
        });
    });


  </script>
  <script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
<!-- END: Page JS-->
@endsection