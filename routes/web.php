<?php
use App\Room, App\RoomType, App\BookedRoom;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
	//return redirect()->route('login');
});

Route::group(['prefix' => 'install'], function() {
	Route::get('/', ['uses' => 'InstallController@index'])->name('checklist');
	Route::get('set-database', ['uses' => 'InstallController@databaseView'])->name('set-database');
	Route::post('save-database', ['uses' => 'InstallController@databaseSave'])->name('save-database');

	Route::get('set-siteconfig', ['uses' => 'InstallController@siteconfigView'])->name('set-siteconfig');
	Route::post('save-siteconfig', ['uses' => 'InstallController@siteconfigSave'])->name('save-siteconfig');

	Route::get('done', ['uses' => 'InstallController@doneView'])->name('done');
});

//front routes
Route::get('sign-in', 'HomeController@signIn')->name('sign-in');
Route::post('do-sign-in', 'HomeController@doSignIn')->name('do-sign-in');
Route::get('sign-up', 'HomeController@signUp')->name('sign-up');
Route::post('do-sign-up', 'HomeController@doSignUp')->name('do-sign-up');
Route::get('logout', ['uses' => 'UserController@logout'])->name('user-logout');

Route::get('/', ['uses' => 'HomeController@index'])->name('home');
Route::get('/room-details/{id}', ['uses' => 'HomeController@roomDetails'])->name('room-details');
Route::get('advance-slip/{id}', ['uses' => 'HomeController@advanceRoomSlip'])->name('advance-slip');
Route::get('contact-us', ['uses' => 'HomeController@contactUs'])->name('contact-us');
Route::post('save-contact-message', 'HomeController@contactUsMessage')->name('save-contact-message');
Route::get('about-us', 'HomeController@aboutUs')->name('about-us');
Route::get('privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');
Route::post('terms-conditions', 'HomeController@termsConditions')->name('terms-conditions');
Route::post('subscribe-notifivations', 'HomeController@subscribeNotifications')->name('subscribe-notifivations');
Route::get('search-rooms', 'HomeController@searchRooms')->name('search-rooms');


//user routes
Route::group(['prefix' => 'user', 'middleware'=>['isCustomer']], function() {
	Route::get('dashboard', ['uses' => 'UserController@dashboard'])->name('user-dashboard');
	Route::post('book-rooms', ['uses' => 'UserController@bookRooms'])->name('book-rooms');

	Route::get('profile-details', ['uses' => 'UserController@profileDetails'])->name('user-profile');
	Route::post('update-profile-details', ['uses' => 'UserController@updateProfileDetails'])->name('update-profile-details');

	Route::get('change-password', ['uses' => 'UserController@changePassword'])->name('change-password');
	Route::post('update-password', ['uses' => 'UserController@updatePassword'])->name('update-password');
});

//admin routes
Route::group(['prefix' => 'admin'], function() {
//	Route::get('/get_next_reservation_id', function(){
//        echo getNextInvoiceNo('testing');
//    });
//    Route::get('/apply_booked_rooms', function(){
//    	$settings = getSettings();
//    	$gstPerc = $settings['gst'];
//        $cgstPerc = $settings['cgst'];
//
//    	$booked_room = BookedRoom::query()
//    ->update( [
//						    'room_gst' => DB::raw( '(room_price/100) * '.$gstPerc.'' ),
//						    'room_cgst' => DB::raw( '(room_price/100) * '.$cgstPerc.'' ),
//						]);
// 		// select(
//   //              'id',
//   //              'reservation_id',
//   //              'room_id',
//   //              'room_type_id',
//   //              'room_price',
//   //              'room_gst',
//   //              'room_cgst',
//   //              'check_in',
//   //              'check_out',
//   //              'swapped_from_room',
//   //              'is_checkout',
//   //              'updated_at',
//   //              'created_at',
//   //              DB::raw('(room_price/100) * '.$gstPerc.' AS gst_price'),
//   //              DB::raw('(room_price/100) * '.$cgstPerc.' AS cgst_price')
//   //      )->
//
//
//   //  	get();
//
//       dd($booked_room);
//    });
	Route::get('/', ['uses' => 'LoginController@adminLogin'])->name('login');
	Route::post('do-login', ['uses' => 'LoginController@doLogin'])->name('do-login');
	Route::get('logout', ['uses' => 'LoginController@logout'])->name('logout');
    Route::get('view_log_curl', function (){
        $data = \App\CurlRequest::get();
        foreach($data as $d){
            $nd = $d->toArray();
            $nd['post_data'] = (array) json_decode($nd['post_data']);
            $nd['response_data'] = (array) json_decode($nd['response_data']);
            dump($nd);
        }
    });
	Route::group(['middleware'=>['auth','permission','userlogs']], function() {
		Route::get('dashboard', ['uses' => 'AdminController@index'])->name('dashboard');


		Route::get('profile', ['uses' => 'AdminController@editLoggedUserProfile'])->name('profile');
		Route::post('save-profile', ['uses' => 'AdminController@saveProfile'])->name('save-profile');
		Route::get('add-user', ['uses' => 'AdminController@addUser'])->name('add-user');
		Route::get('edit-user/{id}', ['uses' => 'AdminController@editUser'])->name('edit-user');
		Route::post('save-user', ['uses' => 'AdminController@saveUser'])->name('save-user');
		Route::get('list-user', ['uses' => 'AdminController@listUser'])->name('list-user');
		Route::get('delete-user/{id}', ['uses' => 'AdminController@deleteUser'])->name('delete-user');

		Route::get('add-customer', ['uses' => 'CustomerController@addCustomer'])->name('add-customer');
		Route::get('edit-customer/{id}', ['uses' => 'CustomerController@editCustomer'])->name('edit-customer');
		Route::post('save-customer', ['uses' => 'CustomerController@saveCustomer'])->name('save-customer');
		Route::get('list-customer', ['uses' => 'CustomerController@listCustomer'])->name('list-customer');
		Route::get('delete-customer/{id}', ['uses' => 'CustomerController@deleteCustomer'])->name('delete-customer');

		Route::get('add-room', ['uses' => 'AdminController@addRoom'])->name('add-room');
		Route::get('edit-room/{id}', ['uses' => 'AdminController@editRoom'])->name('edit-room');
		Route::post('save-room', ['uses' => 'AdminController@saveRoom'])->name('save-room');
		Route::get('list-room', ['uses' => 'AdminController@listRoom'])->name('list-room');
		Route::get('delete-room/{id}', ['uses' => 'AdminController@deleteRoom'])->name('delete-room');

		Route::get('add-room-types', ['uses' => 'AdminController@addRoomType'])->name('add-room-types');
		Route::get('edit-room-types/{id}', ['uses' => 'AdminController@editRoomType'])->name('edit-room-types');
		Route::post('save-room-types', ['uses' => 'AdminController@saveRoomType'])->name('save-room-types');
		Route::get('list-room-types', ['uses' => 'AdminController@listRoomType'])->name('list-room-types');
		Route::get('delete-room-types/{id}', ['uses' => 'AdminController@deleteRoomType'])->name('delete-room-types');

		Route::get('add-amenities', ['uses' => 'AdminController@addAmenities'])->name('add-amenities');
		Route::get('edit-amenities/{id}', ['uses' => 'AdminController@editAmenities'])->name('edit-amenities');
		Route::post('save-amenities', ['uses' => 'AdminController@saveAmenities'])->name('save-amenities');
		Route::get('list-amenities', ['uses' => 'AdminController@listAmenities'])->name('list-amenities');
		Route::get('delete-amenities/{id}', ['uses' => 'AdminController@deleteAmenities'])->name('delete-amenities');

//		Route::get('quick-check-in', ['uses' => 'AdminController@roomReservation'])->name('quick-check-in');
		Route::get('check-in', ['uses' => 'AdminController@roomReservation'])->name('room-reservation');
		Route::post('save-reservation', ['uses' => 'AdminController@saveReservation'])->name('save-reservation');
		Route::get('check-out/{id}', ['uses' => 'AdminController@checkOut'])->name('check-out-room');
		Route::post('check-out', ['uses' => 'AdminController@saveCheckOutData'])->name('check-out');
		Route::get('list-check-ins', ['uses' => 'AdminController@listReservation'])->name('list-reservation');
		Route::get('list-check-outs', ['uses' => 'AdminController@listCheckOuts'])->name('list-check-outs');
		Route::get('edit-reservation_/{id}', ['uses' => 'AdminController@editReservation'])->name('edit-reservation_');
		Route::get('view-reservation/{id}', ['uses' => 'AdminController@viewReservation'])->name('view-reservation');
		Route::get('cancel-reservation/{id}', ['uses' => 'AdminController@cancelReservation'])->name('cancel-reservation');
		Route::get('changeto-checkin-reservation/{id}', ['uses' => 'AdminController@changetoCheckinReservation'])->name('changeto-checkin-reservation');
		Route::get('delete-reservation/{id}', ['uses' => 'AdminController@deleteReservation'])->name('delete-reservation');
		Route::get('invoice/{id}/{type}/{inv_type?}', ['uses' => 'AdminController@invoice'])->name('invoice');
		Route::post('advance-pay', ['uses' => 'AdminController@advancePay'])->name('advance-pay');
		Route::post('extend-reservation', ['uses' => 'AdminController@extendDays'])->name('extend-reservation');
		Route::get('swap-room/{id}', ['uses' => 'AdminController@swapRoom'])->name('swap-room');
		Route::post('save-swap-room', ['uses' => 'AdminController@saveSwapRoom'])->name('save-swap-room');
		Route::get('delete-mediafile/{id}', ['uses' => 'AdminController@deleteMediaFile'])->name('delete-mediafile');
		Route::get('mark-as-paid/{id}', ['uses' => 'AdminController@markAsPaid'])->name('mark-as-paid');

		Route::get('add-food-category', ['uses' => 'AdminController@addFoodCategory'])->name('add-food-category');
		Route::get('edit-food-category/{id}', ['uses' => 'AdminController@editFoodCategory'])->name('edit-food-category');
		Route::post('save-food-category', ['uses' => 'AdminController@saveFoodCategory'])->name('save-food-category');
		Route::get('list-food-category', ['uses' => 'AdminController@listFoodCategory'])->name('list-food-category');
		Route::get('delete-food-category/{id}', ['uses' => 'AdminController@deleteFoodCategory'])->name('delete-food-category');

		Route::get('add-food-item', ['uses' => 'AdminController@addFoodItem'])->name('add-food-item');
		Route::get('edit-food-item/{id}', ['uses' => 'AdminController@editFoodItem'])->name('edit-food-item');
		Route::post('save-food-item', ['uses' => 'AdminController@saveFoodItem'])->name('save-food-item');
		Route::get('list-food-item', ['uses' => 'AdminController@listFoodItem'])->name('list-food-item');
		Route::get('delete-food-item/{id}', ['uses' => 'AdminController@deleteFoodItem'])->name('delete-food-item');

		Route::get('add-expense-category', ['uses' => 'AdminController@addExpenseCategory'])->name('add-expense-category');
		Route::get('edit-expense-category/{id}', ['uses' => 'AdminController@editExpenseCategory'])->name('edit-expense-category');
		Route::post('save-expense-category', ['uses' => 'AdminController@saveExpenseCategory'])->name('save-expense-category');
		Route::get('list-expense-category', ['uses' => 'AdminController@listExpenseCategory'])->name('list-expense-category');
		Route::get('delete-expense-category/{id}', ['uses' => 'AdminController@deleteExpenseCategory'])->name('delete-expense-category');

		Route::get('add-expense', ['uses' => 'AdminController@addExpense'])->name('add-expense');
		Route::get('edit-expense/{id}', ['uses' => 'AdminController@editExpense'])->name('edit-expense');
		Route::post('save-expense', ['uses' => 'AdminController@saveExpense'])->name('save-expense');
		Route::get('list-expense', ['uses' => 'AdminController@listExpense'])->name('list-expense');
		Route::get('delete-expense/{id}', ['uses' => 'AdminController@deleteExpense'])->name('delete-expense');

		Route::get('food-order/{reservation_id?}', ['uses' => 'AdminController@FoodOrder'])->name('food-order');
		Route::get('food-order-table/{order_id}', ['uses' => 'AdminController@FoodOrderTable'])->name('food-order-table');
		Route::get('food-order-final/{order_id}', ['uses' => 'AdminController@FoodOrderFinal'])->name('food-order-final');
		Route::post('save-food-order', ['uses' => 'AdminController@saveFoodOrder'])->name('save-food-order');

		Route::get('orders-list', ['uses' => 'AdminController@listOrders'])->name('orders-list');
		Route::get('order-invoice/{id}', ['uses' => 'AdminController@orderInvoice'])->name('order-invoice');
		Route::get('order-invoice-final/{order_id}', ['uses' => 'AdminController@orderInvoiceFinal'])->name('order-invoice-final');
		Route::get('kitchen-invoice/{order_id}/{order_type}', ['uses' => 'AdminController@kitchenInvoice'])->name('kitchen-invoice');
		Route::get('delete-order-item/{id}', ['uses' => 'AdminController@deleteOrderItem'])->name('delete-order-item');

		Route::get('add-product', ['uses' => 'AdminController@addProduct'])->name('add-product');
		Route::get('edit-product/{id}', ['uses' => 'AdminController@editProduct'])->name('edit-product');
		Route::post('save-product', ['uses' => 'AdminController@saveProduct'])->name('save-product');
		Route::get('list-product', ['uses' => 'AdminController@listProduct'])->name('list-product');
		Route::get('delete-product/{id}', ['uses' => 'AdminController@deleteProduct'])->name('delete-product');

		Route::get('io-stock', ['uses' => 'AdminController@inOutStock'])->name('io-stock');
		Route::post('save-stock', ['uses' => 'AdminController@saveStock'])->name('save-stock');
		Route::get('stock-history', ['uses' => 'AdminController@stockHistory'])->name('stock-history');

		Route::get('settings', 'AdminController@settingsForm')->name('settings');
    	Route::post('/save-settings', 'AdminController@saveSettings')->name('save-settings');

		Route::get('sms-settings', 'AdminController@settingsSms')->name('sms-settings');
    	Route::post('/save-settings', 'AdminController@saveSettings')->name('save-settings');

		Route::get('permissions-list', 'AdminController@listPermission')->name('permissions-list');
    	Route::post('/save-permissions', 'AdminController@savePermission')->name('save-permissions');

    	Route::get('dynamic-dropdown-list', 'AdminController@listDynamicDropdowns')->name('dynamic-dropdown-list');
    	Route::post('/save-dynamic-dropdowns', 'AdminController@saveDynamicDropdowns')->name('save-dynamic-dropdowns');

    	Route::get('/reports', 'ReportController@index')->name('reports');

    	Route::post('/search-orders', 'ReportController@searchOrders')->name('search-orders');
    	Route::post('/export-orders', 'ReportController@exportOrders')->name('export-orders');

    	Route::post('/search-stocks', 'ReportController@searchStockHistory')->name('search-stocks');
    	Route::post('/export-stocks', 'ReportController@exportStockHistory')->name('export-stocks');

    	Route::post('/search-checkins', 'ReportController@searchCheckins')->name('search-checkins');
    	Route::post('/export-checkins', 'ReportController@searchCheckins')->name('export-checkins');

    	Route::post('/search-checkouts', 'ReportController@searchCheckouts')->name('search-checkouts');
    	Route::post('/export-checkouts', 'ReportController@searchCheckouts')->name('export-checkouts');

    	Route::post('/search-expenses', 'ReportController@searchExpense')->name('search-expenses');
    	Route::post('/export-expenses', 'ReportController@searchExpense')->name('export-expenses');

    	Route::post('/search-customer', 'ReportController@searchCustomer')->name('search-customer');
    	Route::post('/export-customer', 'ReportController@searchCustomer')->name('export-customer');

    	Route::post('/search-payment-history', 'ReportController@searchPaymentHistory')->name('search-payment-history');
    	Route::post('/export-payment-history', 'ReportController@searchPaymentHistory')->name('export-payment-history');

    	//website pages
    	Route::get('home-page', 'WebsitePagesController@homePage')->name('home-page');
		Route::post('update-home-page', 'WebsitePagesController@updateHomePage')->name('update-home-page');

		Route::get('contact-page', 'WebsitePagesController@contactPage')->name('contact-page');
		Route::post('update-contact-data', 'WebsitePagesController@updateContactPage')->name('update-contact-page');

		Route::get('about-page', 'WebsitePagesController@aboutPage')->name('about-page');
		Route::post('update-about-data', 'WebsitePagesController@updateAboutPage')->name('update-about-page');
	});
});

Route::get('access-denied',function() {
		return view('page_403');
})->name('access-denied');

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Re-optimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Re-optimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//DB migrate
Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate');
    return '<h1>Data tables import success</h1>';
});
