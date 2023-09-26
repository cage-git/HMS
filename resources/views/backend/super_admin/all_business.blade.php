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
            <h4 class="card-title">{{lang_trans('all_business')}}</h4>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
<!-- END: Page JS-->
@endsection