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
    return view('welcome');
});

Route::get('/ajax', function () {
    return view('ajax');
});
Route::post('/validation', 'FormValidationController@FormValidation')->name('validation');

Route::post('/get-user', 'FormValidationController@GetUser')->name('get-user');

Route::get('/delete-user-show', 'FormValidationController@ShowDelete')->name('delete-user-show');

Route::post('/delete-user-process', 'FormValidationController@DeleteUser')->name('delete-user');

Route::get('/form_update', 'FormValidationController@UpdatePage')->name('form_update');

Route::get('/ajax_update', 'AjaxValidationController@UpdatePage')->name('ajax_update');

Route::post('/validation-ajax', 'AjaxValidationController@FormAjaxValidation')->name('ajax-validation');

Route::post('/get_ajax_user', 'AjaxValidationController@GetUser')->name('get_user_ajax');

Route::post('/ajax-delete', 'AjaxValidationController@DeleteUser')->name('ajax-delete');

Route::get('/ajax-delete-user', 'AjaxValidationController@ShowDelete')->name('ajax-delete-user');
