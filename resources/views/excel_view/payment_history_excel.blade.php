@php 
  $i = $j = 0; 
  $totalAmount = 0;
  $totalNetAmoun = 0;
  $totalIncomeAmount = 0;
  $totalExpenseAmount = 0;
@endphp
<table class="table table-bordered" width="100%">                            
  <thead>
    <tr>
      <th style="width:100px;"><strong>{{lang_trans('txt_sno')}}</strong></th>
      <th style="width:80px;"><strong>{{lang_trans('txt_transaction_id')}}</strong></th>
      <th style="width:100px;"><strong>{{lang_trans('txt_activity')}}</strong></th>
      <th style="width:100px;"><strong>{{lang_trans('txt_payment_mode')}}</strong></th>
      <th style="width:80px;"><strong>{{lang_trans('txt_date')}}</strong></th>
      <th style="width:80px;"><strong>{{lang_trans('txt_total_amount')}}</strong></th>
    </tr>
  </thead>
  <tbody>
    @foreach($datalist as $k=>$val)
      @if($val->is_checkout==0)
        @php 
          if($val->payment_of=='cr') {
            $totalIncomeAmount += $val->payment_amount;
          }
          else if($val->payment_of=='dr') {
            $totalExpenseAmount += $val->payment_amount;
          }
          $totalAmount += $val->payment_amount;
          $i++; 
        @endphp
      <tr>
        <td>{{$i}}</td>
        <td>{{$val->transaction_id}}</td>
        <td>{{getPaymentPurpose($val->purpose)}}</td>
        <td>{{$val->payment_type}}</td>
        <td>{{dateConvert($val->payment_date  ,'d-m-Y H:i')}}</td>
        <td class="{{($val->payment_of=='cr' ? 'text-success' : 'text-danger')}}">{{numberFormat($val->payment_amount)}}</td>
      </tr>
        @endif
      @endforeach
    </tbody>
</table>

@php
  $totalNetAmoun = $totalIncomeAmount-$totalExpenseAmount;
@endphp
<table class="table table-bordered">
    <tr>
      <th><strong>{{lang_trans('txt_total_income')}}</strong></th>
      <th>{{numberFormat($totalIncomeAmount)}}</th>
    </tr>
    <tr>
      <th><strong>{{lang_trans('txt_total_expense')}}</strong></th>
      <th>{{numberFormat($totalExpenseAmount)}}</th>
    </tr>
    <tr>
      <th><strong>{{lang_trans('txt_total_netamount')}}</strong></th>
      <th>{{numberFormat($totalNetAmoun)}}</th>
    </tr>
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <th><strong> Amount In (Currency Symbol)</strong></th>
      <th>{{getCurrencySymbol()}}</th>
    </tr>
</table>