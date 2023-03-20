@extends('layouts.master_backend_new')
@section('content')
  @php
    $countTestimonials = count($testimonials_rows);

    $countCTA = ($data_row->cta_section_json!=null) ? 1 : 0;
    $ctaDecodeJson = json_decode($data_row->cta_section_json);

    $countCounter = ($data_row->counter_section_json!=null) ? 1 : 0;
    $counterDecodeJson = json_decode($data_row->counter_section_json);

    $countFeatures = ($data_row->intro_section_features!=null) ? 1 : 0;
    $featuresDecodeJson = json_decode($data_row->intro_section_features);

  @endphp

<!--  -->

<section>
    <div class="row">
      {{Form::model($data_row,['route'=>'update-home-page','id'=>'home-page-form','files'=>true, 'class' => 'row'])}}
          <div class="col-6">
                <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Banner</h4>
                        </div>
                        <div class="card-body">

                                <div class="row banner-repeater">

                                      <div class="col-xl-12 col-md-6 col-12">
                                          <div class="mb-1">
                                              <label class="form-label" for="basic-default-name">Tagline</label>
                                              
                                              {{ Form::text('banner_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                                          </div>
                                      </div>

                                      <div class="col-xl-12 col-md-6 col-12">
                                          <div class="mb-1">
                                              <label class="form-label" for="basic-default-name">Heading</label>
                                              
                                              {{ Form::text('banner_section_heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                                          </div>
                                      </div>

                                      <div  data-repeater-list="banner">
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-9 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Banner Image</label>
                                                            <input type="file" class="form-control" name="banner_images[]"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-12 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>
                                        </div>
                                </div>
                          </div>
                  </div>
          </div>

            <div class=" col-6">
                  <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Counter</h4>
                        </div>
                        <div class="card-body counter-repeater">
                              <div class="row">
                                        <div data-repeater-list="counter">
                                            <div>
                                            @if($countCounter==1)
                                              @foreach($counterDecodeJson as $key=>$counter_data)
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-12 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Title</label>
                                                            {{ Form::text('counter_section[title][]',$counter_data->title,['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Number</label>
                                                            {{ Form::text('counter_section[number][]',$counter_data->number,['class'=>'form-control', 'placeholder'=>'Enter Value']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Prefix Text</label>
                                                            {{ Form::text('counter_section[prefix][]',$counter_data->prefix,['class'=>'form-control', 'placeholder'=>'Enter Prefix']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-12 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                              @endforeach
                                            @endif
                                            </div>
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-12 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Title</label>
                                                            {{ Form::text('counter_section[title][]','',['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Number</label>
                                                            {{ Form::text('counter_section[number][]','',['class'=>'form-control', 'placeholder'=>'Enter Value']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Prefix Text</label>
                                                            {{ Form::text('counter_section[prefix][]','',['class'=>'form-control', 'placeholder'=>'Enter Prefix']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-12 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>

                                        <!-- {{ Form::checkbox('intro_section_publish',null,checkboxTickOrNot($data_row->intro_section_publish,'view')) }} Show this Section -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    {{ Form::checkbox('intro_section_publish',null,checkboxTickOrNot($data_row->intro_section_publish,'view'), ['class'=>"form-check-input"]) }}
                                                    <label class="form-check-label" for="inlineCheckbox1">Show this Section</label>
                                                </div>
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>
                                        </div>
                              </div>
                        </div>
                  </div>
            </div>

            <div class=" col-6">
                  <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Features</h4>
                        </div>
                        <div class="card-body feature-repeater">
                              <div class="row">
                                        <div data-repeater-list="counter">
                                            <div>
                                            @if($countFeatures==1)
                                              @foreach($featuresDecodeJson as $key=>$features_data)
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Icon</label>
                                                            {{ Form::select('intro_sect_features[icon][]',config('constants.THEME_ICONS'),$features_data->icon,['class'=>'form-control', 'placeholder'=>'--Select--']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Title</label>{{ Form::text('intro_sect_features[title][]',$features_data->title,['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-9 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Short Description</label>{{ Form::textarea('intro_sect_features[short_desc][]',$features_data->short_desc,['class'=>'form-control', 'placeholder'=>'Enter Short Description','rows'=>2]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-9 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                              @endforeach
                                            @endif
                                            </div>
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-6 c6ol-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Icon</label>
                                                            {{ Form::select('intro_sect_features[icon][]',config('constants.THEME_ICONS'),'',['class'=>'form-control', 'placeholder'=>'--Select--']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Title</label>{{ Form::text('intro_sect_features[title][]','',['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-9 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Short Description</label>{{ Form::textarea('intro_sect_features[short_desc][]','',['class'=>'form-control', 'placeholder'=>'Enter Short Description','rows'=>2]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-12 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>

                                        <!-- {{ Form::checkbox('intro_section_publish',null,checkboxTickOrNot($data_row->intro_section_publish,'view')) }} Show this Section -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <!-- {{ Form::checkbox('intro_section_publish',null,checkboxTickOrNot($data_row->intro_section_publish,'view'), ['class'=>"form-check-input"]) }} -->
                                                    {{ Form::checkbox('intro_section_publish',null,checkboxTickOrNot($data_row->intro_section_publish,'view'), ['class'=>"form-check-input"]) }}
                                                    <label class="form-check-label" for="inlineCheckbox1">Show this Section</label>
                                                </div>
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>
                                        </div>
                              </div>
                        </div>
                  </div>
            </div>

            <div class=" col-6">
                  <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Room Section</h4>
                        </div>
                        <div class="card-body feature-repeater">
                              <div class="row">
                                        <div data-repeater-list="counter">
                                            <div data-repeater-item>
                                          
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Tagline</label>{{ Form::text('room_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Heading</label>{{ Form::text('room_section_heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-9 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                              
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                   
                                                    {{ Form::checkbox('room_section_publish',null,checkboxTickOrNot($data_row->room_section_publish,'view'), ['class'=>"form-check-input"]) }}
                                                    <label class="form-check-label" for="inlineCheckbox1">Show this Section</label>
                                                </div>
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>
                                        </div>
                              </div>
                        </div>
                  </div>
            </div>

            <div class=" col-6">
                  <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Client Testimonials</h4>
                        </div>
                        <div class="card-body feature-repeater">
                              <div class="row">
                                        <div data-repeater-list="counter">
                                            <div>
                                             <div class="row d-flex align-items-end">
                                                  <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Tagline</label>{{ Form::text('testimonial_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                                                        </div>
                                                  </div>

                                                  <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Icon</label>
                                                            {{ Form::select('intro_sect_features[icon][]',config('constants.THEME_ICONS'),$features_data->icon,['class'=>'form-control', 'placeholder'=>'--Select--']) }}
                                                        </div>
                                                  </div>
                                                  @if($countTestimonials>0)
                                                    @foreach($testimonials_rows as $testimonial)
                                                
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"><label>Client Name</label>{{ Form::text('testimonial_section[client_name][]',$testimonial->client_name,['class'=>'form-control', 'placeholder'=>'Enter Client Name']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Client Position</label>{{ Form::text('testimonial_section[client_position][]',$testimonial->client_position,['class'=>'form-control', 'placeholder'=>'Enter Client Position']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-9 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Client Comment</label>{{ Form::textarea('testimonial_section[client_comment][]',$testimonial->client_comment,['class'=>'form-control', 'placeholder'=>'Enter Client Comment','rows'=>2]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Client Image</label><input type="file" class="form-control" name="testimonial_section[image][]">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="mb-1">
                                                        <img width="100" src="{{checkFile($testimonial->client_image,'uploads/client_images/','no-img.png')}}"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-9 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                               
                                              @endforeach
                                            @endif
                                            </div>
                                            <hr />
                                            </div>
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname"><label>Client Name</label>{{ Form::text('testimonial_section[client_name][]','',['class'=>'form-control', 'placeholder'=>'Enter Client Name']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Client Position</label>{{ Form::text('testimonial_section[client_position][]','',['class'=>'form-control', 'placeholder'=>'Enter Client Position']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Client Comment</label>{{ Form::textarea('testimonial_section[client_comment][]','',['class'=>'form-control', 'placeholder'=>'Enter Client Comment','rows'=>2]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Client Image</label><input type="file" class="form-control" name="testimonial_section[image][]">
                                                        </div>
                                                    </div>

                                

                                                    <div class="col-md-1 col-12 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>

                                        <!-- {{ Form::checkbox('intro_section_publish',null,checkboxTickOrNot($data_row->intro_section_publish,'view')) }} Show this Section -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    {{ Form::checkbox('testimonial_section_publish',null,checkboxTickOrNot($data_row->testimonial_section_publish,'view'), ['class'=>"form-check-input"]) }}
                                                    <label class="form-check-label" for="inlineCheckbox1">Show this Section</label>
                                                </div>
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>
                                        </div>
                              </div>
                        </div>
                  </div>
            </div>

            <div class=" col-6">
                  <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Room Category Section</h4>
                        </div>
                        <div class="card-body feature-repeater">
                              <div class="row">
                                        <div data-repeater-list="counter">
                                            <div data-repeater-item>
                                          
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Tagline</label>{{ Form::text('room_category_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Heading</label>{{ Form::text('testimonial_section_heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-9 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                              
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                   
                                                    {{ Form::checkbox('footer_cta_section_publish',null,checkboxTickOrNot($data_row->footer_cta_section_publish,'view'), ['class'=>"form-check-input"]) }}
                                                    <label class="form-check-label" for="inlineCheckbox1">Show this Section</label>
                                                </div>
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>
                                        </div>
                              </div>
                        </div>
                  </div>
            </div>



    {{ Form::close() }}
  </div>

</section>

<!-- OLD UI -->


      <!-- <div class="row"> -->
        <!-- {{Form::model($data_row,['route'=>'update-home-page','id'=>'home-page-form','files'=>true])}} -->
        <!-- <div class="col-md-6"> -->
          <!-- ==========* Start Banner Section *========== -->
          <!-- <div class="x_panel">
            <div class="x_title">
              <h2>Banner</h2>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="form-group">
                  <label>Tagline</label>
                  {{ Form::text('banner_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                </div>
                <div class="form-group">
                  <label>Heading</label>
                  {{ Form::text('banner_section_heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                </div>
                <div class="form-group border-btm"></div>
                <div class="form-group row banner-img-parent">
                  <div class="banner-img-child">
                    <div class="col-sm-10">
                      <label>Banner Image</label>
                      <input type="file" name="banner_images[]"/>
                    </div>
                    <div class="col-sm-2">

                    </div>
                  </div>

                </div>
                 <div class="form-group">
                    <button type="button" class="btn btn-success btn-xs add-banner-img-elem"><i class="fa fa-plus"></i></button>
                </div>
                 <div class="form-group">
                  @if($banner_images)
                    <table class="table table-bordered">
                      <tr>
                        <th class="text-center">S.No.</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Action</th>
                      </tr>
                      @foreach($banner_images as $k=>$img)
                      {{ Form::checkbox('selected_banner_ids[]',$img->id,false,['id'=>'img_'.$img->id, 'class'=>'img_checkbox', 'style'=>'display:none']) }}
                      <tr dataI="{{$k}}">
                        <td class="text-center" width="5%">{{$k+1}}.</td>
                        <td class="text-center"><img width="100" src="{{checkFile($img->file,'uploads/banners/','no-img.png')}}"/></td>
                        <td class="text-center" width="20%">
                          <button type="button" class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-mediafile',[$img->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                          {{-- <button type="button" class="btn btn-sm btn-danger rmvBanner" data-id="img_{{$img->id}}"> <i class="fa fa-minus"></i> </button> --}}
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  @endif
                  <div class="form-group border-btm"></div>
                </div>
              </div>
          </div> -->
          <!-- ==========* End Banner Section *========== -->

          <!-- ==========* Start Introduction Section *========== -->
          <!-- <div class="x_panel">
            <div class="x_title">
              <h2>Features</h2>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="features-elem">
                  @if($countFeatures==1)
                    @foreach($featuresDecodeJson as $key=>$features_data)
                      <div class="row features-row border-btm pad-top-10">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Icon</label>{{ Form::select('intro_sect_features[icon][]',config('constants.THEME_ICONS'),$features_data->icon,['class'=>'form-control', 'placeholder'=>'--Select--']) }}
                          </div>
                        </div>
                         <div class="col-lg-6">
                          <div class="form-group">
                            <label>Title</label>{{ Form::text('intro_sect_features[title][]',$features_data->title,['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
                          </div>
                        </div>
                         <div class="col-lg-12">
                          <div class="form-group">
                            <label>Short Description</label>{{ Form::textarea('intro_sect_features[short_desc][]',$features_data->short_desc,['class'=>'form-control', 'placeholder'=>'Enter Short Description','rows'=>2]) }}
                          </div>
                        </div>
                        <div class="col-lg-12 text-right">
                          <button type="button" class="btn btn-danger delete-row"><i class="fa fa-minus"></i></button><br/>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>

                <br/>
                <div class="row">
                  <div class="col-lg-12 text-right">
                    <button type="button" class="btn btn-success add-new-row"><i class="fa fa-plus"></i></button>
                  </div>
               </div>
                <div class="checkbox">
                  <label>
                    {{ Form::checkbox('intro_section_publish',null,checkboxTickOrNot($data_row->intro_section_publish,'view')) }} Show this Section
                  </label>
                </div>
              </div>
          </div> -->
          <!-- ==========* End Introduction Section *========== -->

          <!-- ==========* Start Testimonial Section *========== -->
          <!-- <div class="x_panel">
            <div class="x_title">
              <h2>Client Testimonials</h2>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Tagline</label>
                        {{ Form::text('testimonial_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Heading</label>
                        {{ Form::text('testimonial_section_heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                      </div>
                    </div>
                  </div>
                  <div class="testimonial-sect-elem">
                    @if($countTestimonials>0)
                      @foreach($testimonials_rows as $testimonial)
                        <div class="row testimonial-sect-row border-btm pad-top-10">
                          {{ Form::hidden('testimonial_section[ids][]',$testimonial->id) }}
                          {{ Form::hidden('testimonial_section[prv_img][]',$testimonial->client_image) }}
                          <div class="col-lg-12">
                            <div class="form-group row">
                              <div class="col-sm-8"><label>Client Name</label>{{ Form::text('testimonial_section[client_name][]',$testimonial->client_name,['class'=>'form-control', 'placeholder'=>'Enter Client Name']) }}</div>
                              <div class="col-sm-4"><label>Client Position</label>{{ Form::text('testimonial_section[client_position][]',$testimonial->client_position,['class'=>'form-control', 'placeholder'=>'Enter Client Position']) }}</div>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="form-group">
                            <label>Client Comment</label>
                            {{ Form::textarea('testimonial_section[client_comment][]',$testimonial->client_comment,['class'=>'form-control', 'placeholder'=>'Enter Client Comment','rows'=>2]) }}
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label>Client Image</label>
                              <input type="file" name="testimonial_section[image][]">
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="form-group">
                              <img width="100" src="{{checkFile($testimonial->client_image,'uploads/client_images/','no-img.png')}}"/>
                            </div>
                          </div>
                          <div class="col-lg-12 text-right">
                            <button type="button" class="btn btn-danger delete-row-testimonial"><i class="fa fa-minus"></i></button><br/>
                          </div>
                        </div>
                      @endforeach
                    @endif
                  </div>

                <br/>
                <div class="row">
                  <div class="col-lg-12 text-right">
                    <button type="button" class="btn btn-success add-new-row-testimonial"><i class="fa fa-plus"></i></button>
                  </div>
               </div>
               <div class="checkbox">
                      <label>{{ Form::checkbox('testimonial_section_publish',null,checkboxTickOrNot($data_row->testimonial_section_publish,'view')) }} Show this Section</label>
                    </div>
              </div>
          </div> -->
          <!-- ==========* End Testimonial Section *========== -->

        <!-- </div>

        <div class="col-md-6"> -->

          <!-- ==========* Start Counter Section *========== -->
          <!-- <div class="x_panel">
            <div class="x_title">
              <h2>Counter</h2>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="counter-sect-elem">
                  @if($countCounter==1)
                    @foreach($counterDecodeJson as $key=>$counter_data)
                      <div class="row counter-sect-row border-btm pad-top-10">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label>Title</label>
                            {{ Form::text('counter_section[title][]',$counter_data->title,['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group row">
                            <div class="col-sm-8"><label>Number</label>{{ Form::text('counter_section[number][]',$counter_data->number,['class'=>'form-control', 'placeholder'=>'Enter Value']) }}</div>
                            <div class="col-sm-4"><label>Prefix Text</label>{{ Form::text('counter_section[prefix][]',$counter_data->prefix,['class'=>'form-control', 'placeholder'=>'Enter Prefix']) }}</div>
                          </div>
                        </div>
                        <div class="col-lg-12 text-right">
                          <button type="button" class="btn btn-danger delete-row-counter"><i class="fa fa-minus"></i></button><br/>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
                <br/>
                <div class="row">
                  <div class="col-lg-12 text-right">
                    <button type="button" class="btn btn-success add-new-row-counter"><i class="fa fa-plus"></i></button>
                  </div>
               </div>
               <div class="checkbox">
                      <label>{{ Form::checkbox('counter_section_publish',null,checkboxTickOrNot($data_row->counter_section_publish,'view')) }} Show this Section</label>
                    </div>
              </div>
          </div> -->
          <!-- ==========* End Counter Section *========== -->


          <!-- ==========* Start footer Section *========== -->
          {{-- 
            <!-- <div class="x_panel">
            <div class="x_title">
              <h2>Footer CTA</h2>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="form-group">
                  <label>Tagline</label>
                  {{ Form::text('footer_cta_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                </div>
                <div class="form-group">
                  <label>Heading</label>
                  {{ Form::text('footer_cta_section_heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                </div>
                <div class="checkbox">
                  <label>{{ Form::checkbox('footer_cta_section_publish',null,checkboxTickOrNot($data_row->footer_cta_section_publish,'view')) }} Show this Section</label>
                </div>
              </div>
          </div> -->
           --}}
          <!-- ==========* End footer Section *========== -->

          <!-- ==========* Start RoomSection Section *========== -->
          <!-- <div class="x_panel">
            <div class="x_title">
              <h2>Room Section</h2>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="form-group">
                  <label>Tagline</label>
                  {{ Form::text('room_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                </div>
                <div class="form-group">
                  <label>Heading</label>
                  {{ Form::text('room_section_heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                </div>
                <div class="checkbox">
                  <label>{{ Form::checkbox('room_section_publish',null,checkboxTickOrNot($data_row->room_section_publish,'view')) }} Show this Section</label>
                </div>
              </div>
          </div> -->
          <!-- ==========* End RoomSection Section *========== -->

          <!-- ==========* Start RoomCategory Section Section *========== -->
          <!-- <div class="x_panel">
            <div class="x_title">
              <h2>Room Category Section</h2>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="form-group">
                  <label>Tagline</label>
                  {{ Form::text('room_category_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                </div>
                <div class="form-group">
                  <label>Heading</label>
                  {{ Form::text('room_category_section_heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                </div>
                <div class="checkbox">
                  <label>{{ Form::checkbox('room_category_section_publish',null,checkboxTickOrNot($data_row->room_category_section_publish,'view')) }} Show this Section</label>
                </div>
              </div>
          </div> -->
          <!-- ==========* End RoomCategory Section Section *========== -->

        </div>

        <div class="col-md-12 text-right">
          <input type="submit" value="Submit" class="btn btn-primary"/>
        </div>
        <!-- {{ Form::close() }} -->
      </div>

<!-- ==========* Start Clone Elements Section *========== -->
  <div class="clone_banner_image_elem hide_elem" style="display:none;">
    <div class="banner-img-child">
      <div class="col-sm-10">
        <label class="pad-top-10">Banner Image</label>
        <input type="file" name="banner_images[]"/>
      </div>
      <div class="col-sm-2">
        <br/>
          <button type="button" class="btn btn-danger btn-xs delete-banner-img-elem"><i class="fa fa-minus"></i></button>
      </div>
    </div>
  </div>

  <div class="clone_features_elem hide_elem">
    <div class="row features-row border-btm pad-top-10">
      <div class="col-lg-6">
        <div class="form-group">
          <label>Icon</label>
          {{ Form::select('intro_sect_features[icon][]',config('constants.THEME_ICONS'),null,['class'=>'form-control', 'placeholder'=>'--Select--']) }}
        </div>
      </div>
       <div class="col-lg-6">
        <div class="form-group">
          <label>Title</label>
          {{ Form::text('intro_sect_features[title][]',null,['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
        </div>
      </div>
       <div class="col-lg-12">
        <div class="form-group">
          <label>Short Description</label>
          {{ Form::textarea('intro_sect_features[short_desc][]',null,['class'=>'form-control', 'placeholder'=>'Enter Short Description','rows'=>2]) }}
        </div>
      </div>
      <div class="col-lg-12 text-right">
        <button type="button" class="btn btn-danger delete-row"><i class="fa fa-minus"></i></button><br/>
      </div>
    </div>
  </div>

  <div class="clone_counter_elem hide_elem">
    <div class="row counter-sect-row border-btm pad-top-10">
      <div class="col-lg-12">
        <div class="form-group">
          <label>Title</label>
          {{ Form::text('counter_section[title][]',null,['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group row">
          <div class="col-sm-8"><label>Number</label>{{ Form::text('counter_section[number][]',null,['class'=>'form-control', 'placeholder'=>'Enter Value']) }}</div>
          <div class="col-sm-4"><label>Prefix Text</label>{{ Form::text('counter_section[prefix][]',null,['class'=>'form-control', 'placeholder'=>'Enter Prefix']) }}</div>
        </div>
      </div>
      <div class="col-lg-12 text-right">
        <button type="button" class="btn btn-danger delete-row-counter"><i class="fa fa-minus"></i></button><br/>
      </div>
    </div>
  </div>

  <div class="clone_testimonial_elem hide_elem">
    <div class="row testimonial-sect-row border-btm pad-top-10">
      {{ Form::hidden('testimonial_section[ids][]',0) }}
      {{ Form::hidden('testimonial_section[prv_img][]','') }}
      <div class="col-lg-12">
        <div class="form-group row">
          <div class="col-sm-8"><label>Client Name</label>{{ Form::text('testimonial_section[client_name][]',null,['class'=>'form-control', 'placeholder'=>'Enter Client Name']) }}</div>
          <div class="col-sm-4"><label>Client Position</label>{{ Form::text('testimonial_section[client_position][]',null,['class'=>'form-control', 'placeholder'=>'Enter Client Position']) }}</div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
        <label>Client Comment</label>
        {{ Form::textarea('testimonial_section[client_comment][]',null,['class'=>'form-control', 'placeholder'=>'Enter Client Comment','rows'=>2]) }}
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <label>Client Image</label>
          <input type="file" name="testimonial_section[image][]">
        </div>
      </div>
    <div class="col-lg-12 text-right">
      <button type="button" class="btn btn-danger delete-row-testimonial"><i class="fa fa-minus"></i></button><br/>
    </div>
    </div>
  </div>

  <div class="clone_cta_elem hide_elem">
    <div class="row cta-sect-row border-btm pad-top-10">
        {{ Form::hidden('cta_section[ids][]',0) }}
        <div class="col-lg-12">
          <div class="form-group">
            <label>Tagline</label>
            {{ Form::text('cta_section[tagline][]',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label>Heading</label>
            {{ Form::text('cta_section[heading][]',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
          <label>Short Description</label>
          {{ Form::textarea('cta_section[shortdesc][]',null,['class'=>'form-control', 'placeholder'=>'Enter Short Description','rows'=>2]) }}
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group row">
            <div class="col-sm-8"><label>Mobile Number</label>{{ Form::text('cta_section[mobile][]',null,['class'=>'form-control', 'placeholder'=>'Enter Mobile Number']) }}</div>
            <div class="col-sm-4"><label>Icon</label>{{ Form::select('cta_section[icon][]',config('constants.THEME_ICONS'),null,['class'=>'form-control', 'placeholder'=>'--Select--']) }}</div>
          </div>
        </div>
      <div class="col-lg-12 text-right">
        <button type="button" class="btn btn-danger delete-row-cta"><i class="fa fa-minus"></i></button><br/>
      </div>
    </div>
  </div>
<!-- ==========* End Clone Elements Section *========== -->
{{-- require set var in js var --}}
  <!-- <script>
    // globalVar.page = 'website_home_page';
    // globalVar.testimonialCount = {{$countTestimonials}};
    // globalVar.counterCount = {{$countCounter}};
    // globalVar.featuresCount = {{$countFeatures}};
  </script> 
  <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js?v='.rand(1111,9999).'')}}"></script> -->
@endsection
@section('scripts')
<!-- BEGIN: Page JS-->
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
<!-- END: Page JS-->
@endsection
