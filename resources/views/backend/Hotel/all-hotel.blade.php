@extends('layouts.master_backend_new')
@section('content')
 @php 
      $heading=lang_trans('btn_add');
  @endphp 
<style>
    .location_btn{
        margin:0px !important;
    }
    
</style>
<?php 
// $data
// echo "<pre>";print_r($data_row);die("hi"); ?>
<!-- Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit_modal_label">Edit Location</h5>
        <button type="button" class="btn-close location_btn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="edit-hotel-form" class="form-horizontal form-label-left" >
                <div class="row">
                    @csrf
                        <div class="col-xl-12 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="hotel_name">Hotel Name</label><span class="text-danger">*</span>
                                <input class="form-control " placeholder="Hotel name" id="hotel_name" required="required" name="name" type="text">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="location_id">Location Id</label><span class="text-danger">*</span>
                                <input class="form-control" placeholder="Enter location id" name="location_id" id="location_id" type="text">
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="landmark">Landmark</label><span class="text-danger">*</span><input class="form-control " placeholder="Enter landmark" id="landmark" required="required" name="landmark" type="text">
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12">
                            <div class="mb-1">
                                 <label for="zipcode" class="form-label">Zip code</label><span class="text-danger">*</span>
                                <input class="form-control " placeholder="Enter zipcode" id="zipcode" required="required" name="zipcode" type="text">
                            </div>
                        </div>
                        
                        <div class="col-xl-12 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="control-label" for="address"> Address </label>
                                <textarea class="form-control col-md-6 col-xs-12" id="hotel_address" placeholder="Enter Address" rows="1" name="address" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="product_name">Status</label>
                               <div class="form-check form-check-success form-switch">
                                        <input type="checkbox" class="form-check-input" id="switch_status" onclick="changeStatus()" />
                                        <input type="hidden" name="status" id="status_id" value=""> 
                                </div>
                            </div>
                        </div>
                </div>
                <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info waves-effect waves-float waves-light" name="submit" value="Submit">{{lang_trans('btn_submit')}}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12 col-12">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center" style="width:100%; gap:10px;">
                        <a href="{{ route('add-hotels') }}">
                            <button class="btn btn-success"><i data-feather="plus"></i> Add Hotels</button>
                        </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-2">
        <div class="card-header px-0">
            <h4 class="card-title">All Hotels</h4>
        </div>
        <table class="table table-bordered text-center hotel-datatable">
            <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Location Id</th>
                  <th scope="col">Landmark</th>
                  <th scope="col">Zipcode</th>
                  <th scope="col">Address</th>
                  <th scope="col">Status</th>
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
<!-- END: Page JS-->
<script src="{{URL::asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript">
     $(document).ready(function () {
            $('.hotel-datatable').DataTable({
                "processing": true,
                "serverSide": true,
                 "searching": true,
                 "paging": true,
                "ajax":{url : "{{ route('all-hotel-data') }}",
                     type: "GET",
                     dataType: "JSON",},
                "columns": [
                    { "data": "name" },  
                    { "data": "location_id" },
                    { "data": "landmark" },
                    { "data": "zipcode" }, 
                    { "data": "address" },
                    { "data": "status",
                    "render": function(data,type,row){
                        return data===1 ? '<span class="badge bg-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Enabled</font></font></span>': '<span class=" badge bg-secondary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Not enabled</font></font></span>';
                      }
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<div class="dropdown"> <button type="button" class="btn btn-sm hotel_drop py-0" data-bs-toggle="dropdown"><i data-feather="more-vertical"></i></button><div class="hms_dropdown-menu dropdown-menu dropdown-menu-end px-1" style="z-index:9999 ;"><button type="button" class="btn btn-sm btn-success dropdown-item w-100 waves-effect waves-float mb-1 waves-light edit-button text-center" data-id="' + row.id + '">Edit</button><button class="btn  btn-sm btn-info dropdown-item  text-center deactivate_btn w-100 waves-effect waves-float waves-light" data-id="' + row.id + '">Deactivate</button></div></div>';
                        },
                        "orderable": false
                    }
                ]
            });
        });

       $('.hotel-datatable').on('click', '.edit-button', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('edit-hotel') }}/" + id,
                type: 'get',
                success: function (response) {
                    // console.log(response.data_row.status);
                    $('#hotel_name').val(response.data_row.name);
                    $('#location_id').val(response.data_row.location_id);
                    $('#landmark').val(response.data_row.landmark);
                    $('#zipcode').val(response.data_row.zipcode);
                    $('#hotel_address').val(response.data_row.address);

                    if (response.data_row.status == 1) {
                        $('#switch_status').prop('checked', true);
                    } else {
                        $('#switch_status').prop('checked', false);
                    }
                    $('#edit-hotel-form').attr('action', "{{ route('update-hotel', ['id' => ':id']) }}".replace(':id', response.data_row.id));
                    $('#status_id').val(response.data_row.status);
                    $('#edit_modal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error('Error updating record:', error);
                }
            });
        });
        function changeStatus(){
        var swtichData = $('#switch_status').prop('checked');
        if(swtichData){
            $("#status_id").val(1);
        }else{
            $("#status_id").val(0);
        }
    }
    $('.hotel-datatable').on('click', '.deactivate_btn', function () {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, deactivate it!',
                cancelButtonText: 'No, cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('deactivate-hotel', ['id' => ':id']) }}".replace(':id', id),
                        type: 'get',
                        success: function (response) {
                            Swal.fire(
                                'Deactivate!',
                                'Hotel has been Deactivated.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'There was an error deactivating the record.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
  </script>
  <script src="{{URL::asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
@endsection