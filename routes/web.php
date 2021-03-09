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
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/add-customer', 'CustomerController@addCustomer');
	Route::post('save-customer','CustomerController@save_customer');
	Route::get('/customer','CustomerController@customer_view');
	Route::post('/get-Customer-Data','CustomerController@getCustomersData');
	Route::delete('/delete-customer', 'CustomerController@deleteCustomer');
	Route::get('/customer-edit/{id}','CustomerController@customer_edit');

	/*Madarassa*/
	Route::get('add-madarassa','MadarassaController@addMadarassa');
	Route::post('save-madarassa','MadarassaController@save_madrasaa');
	Route::get('madrassa','MadarassaController@madrassa_view');
	Route::post('/get-madrassa-Data','MadarassaController@getMadarassaData');
	Route::get('/madrassa-edit/{id}','MadarassaController@madrassa_edit');
	Route::delete('/delete-madrassa', 'MadarassaController@deleteMadrasa');

});
