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


Auth::routes([
    'verify' => true,
]);

Route::get('/', 'IndexController@index')->name('index');

Route::group(['prefix' => '/home'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/update-profile', 'HomeController@updateProfile')->name('home.update-profile');
    Route::post('/update-password', 'HomeController@updatePassword')->name('home.update-password');
});

Route::group(['prefix' => 'status'], function () {
    Route::get('/', 'StatusController@index')->name('status');
    Route::post('/cancel', 'StatusController@cancel')->name('status.cancel');
    Route::post('/payment', 'StatusController@payment')->name('status.payment');
    Route::post('/arrive', 'StatusController@arrive')->name('status.arrive');
    Route::post('/complete', 'StatusController@complete')->name('status.complete');
});

Route::group(['prefix' => 'order'], function () {
    Route::get('/', 'OrderController@index')->name('order');
    Route::get('/pick-tpu', 'OrderController@pickTPU')->name('order.pick-tpu');
    Route::get('/{id}', 'OrderController@form')->name('order.form');
    Route::post('/{id}', 'OrderController@create')->name('order.create');
});

Route::group(['prefix' => 'applicant'], function () {
    Route::get('/', 'ApplicantController@index')->name('applicant');
    Route::get('/{id}', 'ApplicantController@detail')->name('applicant.detail');
    Route::post('/cancel/{id}', 'ApplicantController@cancel')->name('applicant.cancel');
    Route::post('/confirm/{id}', 'ApplicantController@confirm')->name('applicant.confirm');
    Route::post('/complete/{id}', 'ApplicantController@complete')->name('applicant.complete');
});

Route::group(['prefix' => 'funeral'], function () {
    Route::get('/', 'FuneralController@index')->name('funeral');
    Route::get('/create', 'FuneralController@createForm')->name('funeral.create-form');
    Route::post('/create', 'FuneralController@create')->name('funeral.create');
    Route::get('/{id}', 'FuneralController@detail')->name('funeral.detail');
    Route::post('/{id}', 'FuneralController@update')->name('funeral.update');
});


