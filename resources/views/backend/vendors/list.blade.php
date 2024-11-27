@extends('layouts.master_backend_new')
@section('content')

<!-- Basic table -->
<section id="basic-datatable">
                    <div class="row">
                        <div class=" col-12">
                            <div class="card p-2">
                                <div class="card-header px-0 border-bottom">
                                    <h4 class="card-title">{{lang_trans('heading_vendor_list')}}</h4>
                                    <a href="{{route('add-vendor')}}"><button class="btn btn-primary" >{{lang_trans('sidemenu_vendor_add')}}</button></a>
                                </div>
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                        <th>{{lang_trans('txt_sno')}}</th>
                                        <th>{{lang_trans('txt_category')}}</th>
                                        <th>{{lang_trans('txt_name')}}</th>
                                        <th>{{lang_trans('txt_email')}}</th>
                                        <th>{{lang_trans('txt_mobile_num')}}</th>
                                        <th>{{lang_trans('txt_country')}}</th>
                                        <th>{{lang_trans('txt_city')}}</th>
                                        <th>{{lang_trans('txt_action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($datalist as $k=>$val)
                                        <tr>
                                          <td>{{$k+1}}</td>
                                          <td>{{$val->category->name}}</td>
                                          <td>{{$val->vendor_name}}</td>
                                          <td>{{$val->vendor_email}}</td>
                                          <td>{{$val->vendor_mobile}}</td>
                                          <td>{{$val->country->name}}</td>
                                          <td>{{$val->vendor_city}}</td>
                                          <td>
                                            @isPermission('view-vendor')
                                              <a class="btn btn-sm btn-primary" href="{{route('view-vendor',[$val->id])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="view detail"><i data-feather='eye'></i></a>
                                            @endisPermission

                                            @isPermission('edit-vendor')
                                              <a class="btn btn-sm btn-info" href="{{route('edit-vendor',[$val->id])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i data-feather='edit'></i></a>
                                            @endisPermission

                                            @isPermission('delete-vendor')
                                              <a class="btn btn-danger btn-sm delete_btn" href="{{route('delete-vendor',[$val->id])}}" title="{{lang_trans('btn_delete')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i data-feather='trash-2'></i></a>
                                            @endisPermission
                                          </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </section>
                <!--/ Basic table -->

    
@endsection