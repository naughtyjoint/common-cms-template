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

Route::get('/', 'HomeController@index');
Route::post('/order', 'HomeController@order');


// Admin related routes
Route::group([
    'prefix' =>'admin',
    'namespace' => 'Admin'
], function () {
    Route::name('admin.')->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('/login', 'LoginController@showLoginForm')->name('login');
            Route::post('/login', 'LoginController@login');
            Route::get('/register', 'RegisteredUserController@create')->name('register');
            Route::post('/register', 'RegisteredUserController@store');
        });

        Route::middleware('auth')->group(function () {
            Route::match(['get', 'post'], '/', 'DashboardController@index')->name('dashboard');
            Route::post('/option/update', 'DashboardController@updateOption')->name('option.update');
            Route::post('/option/discount/update', 'DashboardController@updateGlobalDiscount')->name('option.discount.update');
            Route::post('/logout', 'LoginController@destroy')->name('logout');
            Route::name('item.')->group(function () {
                Route::prefix('item')->group(function () {
                    Route::get('/create', 'ItemController@create')->name('create');
                    Route::post('/create', 'ItemController@store')->name('create');
                    Route::get('/open/{id}', 'ItemController@update')->name('open');
                    Route::get('/close/{id}', 'ItemController@update')->name('close');
                    Route::get('/delete/{id}', 'ItemController@destroy')->name('delete');
                    Route::post('/batch/open', 'ItemController@batchOpen')->name('batch_open');
                    Route::post('/batch/close', 'ItemController@batchClose')->name('batch_close');
                    Route::post('/sort/update', 'ItemController@updateSort')->name('sort.update');
                });
            });
            Route::name('type.')->group(function () {
                Route::prefix('type')->group(function () {
                    Route::get('/create', 'TypeController@create')->name('create');
                    Route::post('/create', 'TypeController@store')->name('create');
                    Route::get('/edit/{id}', 'TypeController@edit')->name('edit');
                    Route::post('/edit/{id}', 'TypeController@update')->name('edit');
                    Route::get('/delete/{id}', 'TypeController@destroy')->name('delete');
                });
            });
            Route::name('payment.')->group(function () {
                Route::prefix('payment')->group(function () {
                    Route::get('/create', 'PaymentController@create')->name('create');
                    Route::post('/create', 'PaymentController@store')->name('create');
                    Route::get('/edit/{id}', 'PaymentController@edit')->name('edit');
                    Route::post('/edit/{id}', 'PaymentController@update')->name('edit');
                    Route::get('/open/{id}', 'PaymentController@update')->name('open');
                    Route::get('/close/{id}', 'PaymentController@update')->name('close');
                    Route::get('/delete/{id}', 'PaymentController@destroy')->name('delete');
                });
            });
            Route::name('discount.')->group(function () {
                Route::prefix('discount')->group(function () {
                    Route::get('/create', 'DiscountController@create')->name('create');
                    Route::post('/create', 'DiscountController@store')->name('create');
                    Route::get('/edit/{id}', 'DiscountController@edit')->name('edit');
                    Route::post('/edit/{id}', 'DiscountController@update')->name('edit');
                    Route::get('/open/{id}', 'DiscountController@update')->name('open');
                    Route::get('/close/{id}', 'DiscountController@update')->name('close');
                    Route::get('/delete/{id}', 'DiscountController@destroy')->name('delete');
                });
            });
            Route::name('order.')->group(function () {
                Route::prefix('order')->group(function () {
                    Route::get('/export/{type}', 'OrderController@export')->name('export');
                    Route::get('/delete/{id}', 'OrderController@destroy')->name('delete');
                });
            });
        });
    });
});
