@extends('layouts.master_backend_new')
@section('content')

<section>
  <!-- <div class="row"> -->
  {{Form::model($data_row,['route'=>'update-contact-page','id'=>'contact-page-form','files'=>true, 'class'=>'row'])}}
      <div class=" col-6">
          <div class="card">
              <div class="card-header border-bottom">
                  <h4 class="card-title">Banner Image</h4>
              </div>
              <div class="card-body">

                  <div class="">
                      <label>Image</label>
                      <input type="file" name="banner_image" class="form-control">
                    </div>
                    @if($data_row->banner_image!='' && $data_row->banner_image!=null)
                      <img height="150" width="50%" src="{{checkFile($data_row->banner_image,'uploads/banners/','no-img.png')}}"/>
                    @endif
              </div>
          </div>
      </div>
      <div class=" col-6">
          <div class="card">
              <div class="card-header border-bottom">
                  <h4 class="card-title">Contact Us</h4>
              </div>
              <div class="card-body">
                     <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-name">Tagline</label>
                                
                                {{ Form::text('tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-name">Heading</label>
                                
                                {{ Form::text('heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-name">Facebook Link</label>
                                {{ Form::text('facebook_link',null,['class'=>'form-control', 'placeholder'=>'Enter Facebook Link']) }}
                                
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-name">Twitter Link</label>
                                {{ Form::text('twitter_link',null,['class'=>'form-control', 'placeholder'=>'Enter Twitter Link']) }}
                                
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-name">Instagram Link</label>
                                {{ Form::text('instagram_link',null,['class'=>'form-control', 'placeholder'=>'Enter Instagram Link']) }}
                                
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="basic-default-name">Linkedin Link</label>
                                {{ Form::text('linkedin_link',null,['class'=>'form-control', 'placeholder'=>'Enter Linkedin Link']) }}
                                
                            </div>
                        </div>
                        

                      </div>
                      <div class="col-xl-4 col-md-6 col-12">
                          <button type="submit" class="btn btn-primary" name="submit" value="Submit">{{lang_trans('btn_submit')}}</button>
                        </div>
              </div>
          </div>
      </div>
      {{ Form::close() }}
  <!-- </div> -->

</section>


<!--
      <div class="row">
        {{Form::model($data_row,['route'=>'update-contact-page','id'=>'contact-page-form','files'=>true])}}
        <div class="col-md-6">

          <div class="x_panel">
            <div class="x_title">
              <h3 class="box-title">Banner Image</h3>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="form-group">
                  <label>Image</label>
                  <input type="file" name="banner_image">
                </div>
                @if($data_row->banner_image!='' && $data_row->banner_image!=null)
                <img height="150" width="50%" src="{{checkFile($data_row->banner_image,'uploads/banners/','no-img.png')}}"/>
                @endif
              </div>
          </div>

        </div>

        <div class="col-md-6">
          <! -- ==========* Start Services Section *========== -- >
          <div class="x_panel">
            <div class="x_title">
              <h3 class="box-title">Contact Us</h3>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="form-group">
                  <label>Tagline</label>
                  {{ Form::text('tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                </div>
                <div class="form-group">
                  <label>Heading</label>
                  {{ Form::text('heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                </div>
                 <div class="col-lg-12">
                    <div class="form-group row">
                      <div class="col-sm-6"><label>Facebook Link</label>{{ Form::text('facebook_link',null,['class'=>'form-control', 'placeholder'=>'Enter Facebook Link']) }}</div>
                      <div class="col-sm-6"><label>Twitter Link</label>{{ Form::text('twitter_link',null,['class'=>'form-control', 'placeholder'=>'Enter Twitter Link']) }}</div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group row">
                      <div class="col-sm-6"><label>Instagram Link</label>{{ Form::text('instagram_link',null,['class'=>'form-control', 'placeholder'=>'Enter Instagram Link']) }}</div>
                      <div class="col-sm-6"><label>Linkedin Link</label>{{ Form::text('linkedin_link',null,['class'=>'form-control', 'placeholder'=>'Enter Linkedin Link']) }}</div>
                    </div>
                  </div>
              </div>
          </div>
          < !-- ==========* End Services Section *========== -- >
        </div>
        
        <div class="col-md-12 text-right">
          <input type="submit" value="Submit" class="btn btn-primary"/>
        </div>
        {{ Form::close() }}
      </div>
-->
@endsection