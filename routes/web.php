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

//Route::get('/', 'SiteController@index')->name('home');
Route::post('saveContact', 'AjaxController@ContactForm')->name('ajax.contact.form');
Route::post('getProductCategory', 'AjaxController@getProductCategory')->name('ajax.getProductCategory');
Route::get('getCaptcha', 'AjaxController@getCaptcha')->name('ajax.getCaptcha'); // 驗證碼
Route::post('saveTrack', 'AjaxController@saveTrack')->name('ajax.save.track');

Route::get('static/web/scripts/default/financialData.json', 'JsonController@financialData')->name('financialData');

Route::get('tt',function(){
   dd(siteOption('financial_type'));
});
