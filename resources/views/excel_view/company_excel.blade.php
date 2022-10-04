<table class="table table-bordered">
  <thead>
    <tr>
        <th>{{lang_trans('txt_sno')}}</th>
        <th>{{lang_trans('txt_company_name')}}</th>
        <th>{{lang_trans('txt_company_gst_num')}}</th>
        <th>{{lang_trans('txt_company_mobile_num')}}</th>
        <th>{{lang_trans('txt_company_email')}}</th>
        <th>{{lang_trans('txt_company_address')}}</th>
        <th>{{lang_trans('txt_company_country')}}</th>
        <th>{{lang_trans('txt_company_state')}}</th>
        <th>{{lang_trans('txt_company_city')}}</th>
    </tr>
  </thead>
  <tbody>
    @if($datalist->count()>0)
    @foreach($datalist as $k=>$val)
        <tr>
            <td>{{$k+1}}</td>
            <td>{{$val->name}}</td>
            <td>{{$val->company_gst_num}}</td>
            <td>{{$val->mobile}}</td>
            <td>{{$val->email}}</td>
            <td>{{$val->address}}</td>
            <td>{{$val->country}}</td>
            <td>{{$val->state}}</td>
            <td>{{$val->city}}</td>

        </tr>
    @endforeach
    @endif
  </tbody>
</table>
