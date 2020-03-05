<?php

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
Auth::routes();
Route::get('/', 'LoginController@showLoginForm')->name('login');


Route::get('login/logout', array(
    'as' => 'logout-user',
    'uses' => 'LoginController@logout'
));

Route::post('login/user', 'LoginController@loginUser')->name('login_submit');
Route::get('/logins', 'LoginController@showLoginForm')->name('login.user');


Route::group(['middleware' => 'auth:user'], function(){

	Route::get('home', 'HomeController@index');
	Route::post('detaillogin', 'HomeController@detaillogin')->name('DetailLogins');
	Route::post('home/getclockin', 'HomeController@getclockin')->name('getclockin');

	Route::get('typeptc', 'typePTCController@index');
	Route::get('typeptc/getdata', 'typePTCController@GetData')->name('gettypeptc');

	Route::get('jabatan', 'JabatanController@index');
	Route::get('jabatan/getdata', 'JabatanController@GetData')->name('getjabatan');

	Route::get('company', 'CompanyController@index');
	Route::get('company/getdata', 'CompanyController@GetData')->name('getcompany');

	Route::get('unitkerja', 'UnitKerjaController@index');
	Route::get('unitkerja/getdata', 'UnitKerjaController@GetData')->name('getunitkerja');

	Route::get('wilayah', 'WilayahController@index');
	Route::get('wilayah/getdata', 'WilayahController@GetData')->name('getwilayah');

	Route::get('documents', 'DocumentController@index');
	Route::get('documents/getdata', 'DocumentController@GetData')->name('getdocuments');

	Route::get('trainings', 'TrainingController@index');
	Route::get('trainings/getdata', 'TrainingController@GetData')->name('gettrainings');

	Route::get('detailptc', 'DetailPTCController@index');
	Route::get('detailptc/getdata', 'DetailPTCController@GetData')->name('getdetailptc');

	Route::get('reportptc', 'ReportController@ptc');
	Route::post('reportptc/detailptc', 'ReportController@viewdetailptc')->name('ViewDetailPTC');
	Route::post('reportptc/getdata', 'ReportController@getptc')->name('getptc');
	Route::get('reportptc/printexcel', 'ReportController@ptcprintexcel')->name('ptcprintexcel');

	Route::get('reportptcbermasalah', 'ReportController@ptcbermasalah');
	Route::post('reportptcbermasalah/getdata', 'ReportController@getptcbermasalah')->name('getptcbermasalah');
	Route::get('reportptcbermasalah/printexcel', 'ReportController@ptcbermasalahprintexcel')->name('ptcbermasalahprintexcel');

	Route::get('reportdcu', 'ReportController@dcu');
	Route::post('reportdcu/getdata', 'ReportController@getdcu')->name('getdcu');
	Route::get('reportdcu/printexcel', 'ReportController@dcuprintexcel')->name('dcuprintexcel');

	Route::get('reportclockinout', 'ReportController@clockinout');
	Route::post('reportclockinout/getdata', 'ReportController@getclockinout')->name('getclockinout');
	Route::get('reportclockinout/printexcel', 'ReportController@clocksprintexcel')->name('clocksprintexcel');

	Route::get('maps', 'MapsController@index');

	Route::get('drivers', 'UserController@drivers');
	Route::get('drivers/getdata', 'UserController@getdrivers')->name('getdrivers');
	Route::post('drivers/reset', 'UserController@resetpassword')->name('resetpassword');
	Route::post('drivers/ambilwilayah', 'UserController@ambilwilayah')->name('ambilwilayah');
	Route::get('drivers/ambilunit', 'UserController@ambilunit')->name('ambilunit');
	Route::post('drivers/simpanunit', 'UserController@simpanunit')->name('simpanunit');

});