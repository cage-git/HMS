@php
  $itemId = null;
  $sentQty = null;
  $rcvQty = null;
  $price = null;
  if(isset($item)){
    $itemId = $item->item_id;
    $sentQty = $item->sent_item_qty;
    $rcvQty = $item->rcv_item_qty;
    $price = $item->item_price;
  }
  if(isset($blank_form)){
    $itemId = null;
    $sentQty = null;
    $rcvQty = null;
    $price = null;
  }
@endphp


<div class="row">
        <!-- Invoice repeater -->
        <div class="col-12">
            <div class="card">
                <!-- <div class="card-header">
                    <h4 class="card-title">Invoice</h4>
                </div> -->
                <div class="card-body item-repeater">
                    <!-- <form action="" class="invoice-repeater"> -->
                        <div data-repeater-list="item">
                            <div data-repeater-item>
                                <div class="row d-flex align-items-end">
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label  for="itemname" class="form-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_laundry_item')}} </label>
                                            {{ Form::select('item[ids][]',$item_list,$itemId,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                                            <!-- <input type="text" class="form-control" id="itemname" aria-describedby="itemname" placeholder="Vuexy Admin Template" /> -->
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12">
                                        <div class="mb-1">
                                            <label for="itemcost" class="form-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_qty')}} </label>
                                            {{Form::number('item[sent_qty][]',$sentQty,['class'=>"form-control col-md-7 col-xs-12 per_item_sent_qty", "id"=>"sent_qty", "min"=>1, "step"=>1, "required"=>"required"])}}
                                            <!-- <input type="number" class="form-control" id="itemcost" aria-describedby="itemcost" placeholder="32" /> -->
                                        </div>
                                    </div>
                                    @if($isShowFinalStepElem)

                                    <div class="col-md-2 col-12">
                                        <div class="mb-1">
                                            <label for="itemquantity" class="form-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_rcv_qty')}} </label>
                                              {{Form::number('item[rcv_qty][]',$rcvQty,['class'=>"form-control col-md-7 col-xs-12 per_item_rcv_qty", "id"=>"rcv_qty", "min"=>1, "step"=>1, "required"=>"required"])}}
                                        </div>
                                    </div>

                                    @endif

                                    <div class="col-md-2 col-12">
                                        <div class="mb-1">
                                            <label for="staticprice" class="form-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_price')}} </label>
                                            {{Form::text('item[price][]',$price,['class'=>"form-control col-md-7 col-xs-12 per_item_price", "id"=>"price", "required"=>"required"])}}
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-12 mb-50">
                                        <div class="mb-1">
                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                <i data-feather="x" class="me-25"></i>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            
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
                    <!-- </form> -->
                </div>
            </div>
        </div>
        <!-- /Invoice repeater -->
    </div>
<!--                     
<div class="row laundry_item_elem per_item_elem">
  <div class="col-md-2 col-sm-2 col-xs-12">
    <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_laundry_item')}} </label>
    {{ Form::select('item[ids][]',$item_list,$itemId,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
  </div>
  <div class="col-md-2 col-sm-2 col-xs-12">
    <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_qty')}} </label>
    {{Form::number('item[sent_qty][]',$sentQty,['class'=>"form-control col-md-7 col-xs-12 per_item_sent_qty", "id"=>"sent_qty", "min"=>1, "step"=>1, "required"=>"required"])}}
  </div>
  @if($isShowFinalStepElem)
    <div class="col-md-2 col-sm-2 col-xs-12">
      <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_rcv_qty')}} </label>
      {{Form::number('item[rcv_qty][]',$rcvQty,['class'=>"form-control col-md-7 col-xs-12 per_item_rcv_qty", "id"=>"rcv_qty", "min"=>1, "step"=>1, "required"=>"required"])}}
    </div>
    <div class="col-md-2 col-sm-2 col-xs-12">
      <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> {{lang_trans('txt_price')}} </label>
      {{Form::text('item[price][]',$price,['class'=>"form-control col-md-7 col-xs-12 per_item_price", "id"=>"price", "required"=>"required"])}}
    </div>
  @endif
  <div class="col-md-2 col-sm-2 col-xs-12"> 
    @if($show_plus_btn)
      <label class="control-label {{$show_label ? '' : 'hide_elem'}}"> &nbsp;</label><br/>
      <button type="button" class="btn btn-success add-row"><i data-feather='plus'></i></button>
    @else
      <button type="button" class="btn btn-danger delete-row"><i data-feather='plus'></i></button>
    @endif
  </div>
  <br/>
</div>  -->


