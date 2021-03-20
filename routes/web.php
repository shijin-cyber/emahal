<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']],function(){
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/add-customer', 'CustomerController@addCustomer');
	Route::post('save-customer','CustomerController@save_customer');
	Route::get('/customer','CustomerController@customer_view');
	Route::post('/get-Customer-Data','CustomerController@getCustomersData');
	Route::delete('/delete-customer', 'CustomerController@deleteCustomer');
	Route::get('/customer-edit/{id}','CustomerController@customer_edit');
	Route::post('/save-payment','CustomerController@save_payment');

	/*Madarassa*/
	Route::get('add-madarassa','MadarassaController@addMadarassa');
	Route::post('save-madarassa','MadarassaController@save_madrasaa');
	Route::get('madrassa','MadarassaController@madrassa_view');
	Route::post('/get-madrassa-Data','MadarassaController@getMadarassaData');
	Route::get('/madrassa-edit/{id}','MadarassaController@madrassa_edit');
	Route::delete('/delete-madrassa', 'MadarassaController@deleteMadrasa');
	// Customer nikah
	Route::group(['middleware' => ['role:customer,admin']], function(){
		Route::get('/nikah-registration/{id}','NikahController@nikah_registration');
		Route::get('/settings', 'SettingsController@index');
		Route::post('/save-staff-designation', 'SettingsController@saveDesignation');
		Route::post('/save-payment-type', 'SettingsController@savePaymentType');
		Route::post('/get-payment-type', 'SettingsController@getPaymentTypes');
		Route::post('/get-staff-designation', 'SettingsController@getStaffDesignations');
		Route::delete('/delete-payment-type', 'SettingsController@deletePaymentType');
		Route::delete('/delete-staff-designation', 'SettingsController@deleteStaffDesignation');
		Route::post('/get-single-staff-designation', 'SettingsController@getSingleStaffDesignation');
		Route::post('/get-single-payment-type', 'SettingsController@getSinglePaymentType');

		Route::get('/events', 'EventsController@index');
		Route::get('/add-event', 'EventsController@addEvent');
		Route::post('/save-event', 'EventsController@saveEvent');
		Route::get('/edit-event/{id}', 'EventsController@editEvent');
		Route::delete('/delete-event', 'EventsController@deleteEvent');

		Route::get('/notices', 'NoticeController@index');
		Route::get('/notices', 'NoticeController@index');
		Route::get('/add-notice', 'NoticeController@addNotice');
		Route::post('/save-notice', 'NoticeController@saveNotice');
		Route::get('/edit-notice/{id}', 'NoticeController@editNotice');
		Route::delete('/delete-notice', 'NoticeController@deleteNotice');

		Route::get('/scholarships', 'ScholarshipController@index');
		Route::get('/add-scholarship', 'ScholarshipController@addScholarship');
		Route::post('/save-scholarship', 'ScholarshipController@saveScholarship');
		Route::get('/edit-notice/{id}', 'ScholarshipController@editScholarship');
		Route::delete('/delete-notice', 'ScholarshipController@deleteScholarship');

		Route::get('/add-customer', 'CustomerController@addCustomer');
		Route::post('save-customer','CustomerController@save_customer');
		Route::get('/customer','CustomerController@customer_view');
		Route::post('/get-Customer-Data','CustomerController@getCustomersData');
		Route::delete('/delete-customer', 'CustomerController@deleteCustomer');
		Route::get('/customer-edit/{id}','CustomerController@customer_edit');


	});


});
