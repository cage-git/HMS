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
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> {{$heading}} {{lang_trans('new_package')}}</h4>
        </div>
    
    <div class="card-body">
        <form method="POST" action="{{ route('save-package') }}" id="package-form" class="form-horizontal form-label-left" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <input type="hidden" name="hidden" value="<?php echo $data_row->id; ?>">
            <div class="col-xl-4 col-md-6 col-12">
                <div class="mb-1">
                    <label class="form-label" for="package_name">{{lang_trans('name')}}</label><span class="text-danger">*</span>
                    {{Form::text('package_name',$data_row->name,['class'=>"form-control ", "id"=>"package_name", "required"=>"required"])}}
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-12">
                <div class="mb-1">
                    <label class="form-label" for="number_of_users">{{lang_trans('num_user')}}</label><span class="text-danger">*</span>
                    {{Form::text('number_of_users',$data_row->num_user,['class'=>"form-control ", "id"=>"number_of_users", "required"=>"required"])}}
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-12">
                <div class="mb-1">
                    <label class="form-label" for="number_of_hotels">{{lang_trans('num_hotels')}}</label><span class="text-danger">*</span>
                     {{Form::text('number_of_hotels',$data_row->num_hotels,['class'=>"form-control ", "id"=>"number_of_hotels", "required"=>"required"])}}
                </div>
            </div>
            
            <div class="col-xl-4 col-md-6 col-12">
                <div class="mb-1">
                    <label class="form-label" for="number_of_invoices">{{lang_trans('num_invoices')}}</label><span class="text-danger">*</span>{{Form::text('number_of_invoices',$data_row->num_invoices,['class'=>"form-control ", "id"=>"number_of_invoices", "required"=>"required"])}}
                </div>
            </div>
            <hr>
            @php 
            $service = $data_row->services;
             $selectedServices = explode(',', $service);
            @endphp
            <div class="col-xl-12 col-md-12 col-12 pb-2">
              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="expenses"<?php 
                  if (in_array('expenses', $selectedServices)) {
                    echo "checked";
                }
                 ?>
                  >
                  <label class="form-check-label" for="services">Expenses</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="pos" <?php 
                  if (in_array('pos', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">POS</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="website"<?php 
                  if (in_array('website', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">Web site</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="laundry"<?php 
                  if (in_array('laundry', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">Laundry</label>
              </div>

              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="housekeeping"<?php 
                  if (in_array('housekeeping', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">Housekeeping</label>
              </div>

              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="reports"<?php 
                  if (in_array('reports', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">Reports</label>
              </div>

              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="companies"<?php 
                  if (in_array('companies', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">Companies</label>
              </div>

              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="food_item"<?php 
                  if (in_array('food_item', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">Food Item</label>
              </div>

              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="stocks"<?php 
                  if (in_array('stocks', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">Stocks</label>
              </div>

              <div class="form-check form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="vendors"<?php 
                  if (in_array('vendors', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">Vendors</label>
              </div>

              <div class="form-check pt-1 form-check-inline">
                  <input class="form-check-input" name="services[]" type="checkbox" value="season"<?php 
                  if (in_array('season', $selectedServices)) {
                    echo "checked";
                }
                 ?>>
                  <label class="form-check-label" for="services">Season</label>
              </div>
              <hr>
              <div class="form-check form-check-inline pt-1">
                  {{ Form::checkbox('nt_enable', 1, $data_row->nt_enable == 1, ['class' => 'form-check-input', 'id' => 'nt_enable']) }}
                  <label class="form-check-label" for="nt_enable">NTMP</label>
              </div>
            </div>
            <div class="col-xl-5 col-md-5 col-5 pb-2">
                <button type="submit" class="btn btn-info" name="submit" value="Submit">{{lang_trans('btn_submit')}}</button>
            </div>           

        </form>
        </div>
    </div>
    </div>

    
</div>
@endsection

@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/package-add-validation.js')}}"></script>
<!-- END: Page JS-->
@endsection