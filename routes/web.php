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

Route::redirect('/', 'tasks');

Route::group(['namespace' => 'Auth'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', 'LoginController@showLoginForm')
            ->name('login');

        Route::post('login', 'LoginController@login');

        Route::get('register', 'RegisterController@showRegistrationForm')
            ->name('register');

        Route::post('register', 'RegisterController@register');
    });

    Route::post('logout', 'LoginController@logout')
        ->name('logout');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')
        ->name('password.request');

    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')
        ->name('password.email');

    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')
        ->name('password.reset');

    Route::post('password/reset', 'ResetPasswordController@reset')
        ->name('password.update');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')
            ->name('password.confirm');

        Route::post('password/confirm', 'ConfirmPasswordController@confirm');
    });
});

Route::group(['prefix' => 'tasks', 'as' => 'tasks.', 'middleware' => 'auth'], function () {
    Route::get('/', 'TaskController@index')
        ->name('index');

    Route::get('create', 'TaskController@create')
        ->name('create');

    Route::post('/', 'TaskController@store')
        ->name('store');

    Route::get('{id}', 'TaskController@show')
        ->name('show');

    Route::get('{id}/edit', 'TaskController@edit')
        ->name('edit');

    Route::put('{id}', 'TaskController@update')
        ->name('update');

    Route::delete('{id}', 'TaskController@destroy')
        ->name('destroy');

    Route::post('{id}', 'TaskController@check')
        ->name('check');
});
