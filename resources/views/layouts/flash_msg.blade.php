@if(session('success'))
    @if(session('reservation_id'))
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        {{session('success')}}
                    </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <a class="btn form-control btn-info" href="{{route('invoice',[session('reservation_id'),1,'inv_type'=>'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{session('success')}}
        </div>
    @endif
@elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{session('error')}}
    </div>
@elseif(session('info'))
    <div class="alert alert-warning alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{session('info')}}
    </div>
@endif
