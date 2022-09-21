<?php

namespace App\Providers;

use App\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view)
        {
            $segment = ['list-check-ins'];

            if(Auth::guard('web')->check() && in_array(Request::segment(2), $segment)){
                $today_startDate = getNextSecondPrevDate('0');
                $tommorow_startDate = getNextSecondPrevDate('1');


                $this->data['today_datalist']= Reservation::with('booked_rooms')
                    ->whereDate('check_out', '>=', $today_startDate." 00:00:00")
                    ->whereDate('check_out', '<', $tommorow_startDate." 00:00:00")
                    ->whereStatus(1)
                    ->whereIsDeleted(0)
                    ->whereIsCheckout(0)
                    ->orderBy('created_at','DESC')
                    ->get();
                $this->data['tommorow_datalist']= Reservation::with('booked_rooms')
                    ->whereDate('check_out', '>=', $tommorow_startDate." 00:00:00")
                    ->whereStatus(1)
                    ->whereIsDeleted(0)
                    ->whereIsCheckout(0)
                    ->orderBy('created_at','DESC')
                    ->get();

                $this->data['roomtypes_list']=getRoomTypesList();
                $this->data['customer_list']=getCustomerList('get');

                $view->with('alert_for_booking', $this->data );
            }else{
                $view->with('alert_for_booking', null );
            }
        });

    }
}
