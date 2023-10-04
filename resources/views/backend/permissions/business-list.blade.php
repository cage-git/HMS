@extends('layouts.master_backend_new')
@section('content')

<style>
input[type='checkbox']:checked {
    background-size: 65%;
}
</style>

<section id="basic-datatable">  
  <div class="row">
        <div class=" col-12">
            <div class="card p-2">
            {{Form::open(array('url'=>route('save-business-permissions')))}}
                <div class="card-header px-0 border-bottom">
                    <h4 class="card-title">{{lang_trans('heading_list_permission')}}</h4>
                    <input type="submit" value="{{lang_trans('btn_update')}}" class="btn btn-primary"/>
                </div>
                  @php
                    $totalAmount = 0;
                  @endphp
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                          <th class="text-center">{{lang_trans('txt_sno')}}</th>
                          <th>{{lang_trans('txt_permission')}}</th>
                          <th class="text-center">{{lang_trans('txt_admin')}}</th>
                          <th class="text-center">{{lang_trans('txt_receptionist')}}</th>
                          <th class="text-center">{{lang_trans('txt_store_manager')}}</th>
                          <th class="text-center">{{lang_trans('txt_financial_manager')}}</th>                     
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($datalist as $k=>$val)
                          <tr>
                            <td class="text-center" width="10%">{{$k+1}}</td>
                            <td><span class="f-15">{{$val->description}}</span> <br/>
                                <span class="color-9e9">{{lang_trans('txt_type')}}: {{ucfirst($val->permission_type)}}</span>
                              </td>
                            <td class="text-center" width="10%">
                                 {{Form::hidden('ids[]',$val->id)}}
                                {{ Form::checkbox('admin['.$val->id.']',null, ($val->admin==1) ? true: false , ['class'=> "form-check-input checkbox" ]) }}</td>
                            <td class="text-center" width="10%">{{ Form::checkbox('receptionist['.$val->id.']',null, ($val->receptionist==1) ? true: false, ['class'=>"form-check-input checkbox"] ) }}</td>
                            <td class="text-center" width="10%">{{ Form::checkbox('store_manager['.$val->id.']',null, ($val->store_manager==1) ? true: false, ['class'=>"form-check-input checkbox"] ) }}</td>
                            <td class="text-center" width="10%">{{ Form::checkbox('financial_manager['.$val->id.']',null, ($val->financial_manager==1) ? true: false, ['class'=>"form-check-input checkbox"] ) }}</td>
                          </tr>
                        @endforeach
                    
                    </tbody>
                </table>
              {{ Form::close() }}
            </div>
        </div>
    </div>
</section>

@endsection