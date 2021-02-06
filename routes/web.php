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

use App\Http\Enums\UserRole;

Route::get('excel', 'Admin\Product\PartController@import');

Auth::routes(['register' => false]);

Route::get('/', 'Site\HomeController@home')->name('site.home');
Route::get('home', 'Site\HomeController@home');


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'role:' . UserRole::of(UserRole::ROLE_ADMIN)],
    'namespace' => 'Admin',
], function () {

    Route::get('/', 'HomeController@home')->name('home');
    Route::get('home', 'HomeController@home');

    Route::resource('customers', 'CustomerController');
    Route::resource('suppliers', 'SupplierController');
    Route::resource('admins', 'AdminController');

    Route::resource('parts', 'Product\PartController');
    Route::resource('used-parts', 'Product\UsedPartController');
    Route::resource('accessories', 'Product\AccessoryController');

    Route::get('json/brand-models', 'Setting\CarBrandModelController@jsonBrandModels')
        ->name('json.brand-models');

    Route::resource('app-intro-slides', 'AppIntroSlideController');
    Route::get('app-intro-slides/{slide}/move-up', 'AppIntroSlideController@moveUp')->name('app-intro-slides.up');
    Route::get('app-intro-slides/{slide}/move-down', 'AppIntroSlideController@moveDown')->name('app-intro-slides.down');

    Route::resource('countries', 'Setting\CountryController');
    Route::resource('countries/{country}/cities', 'Setting\CityController');

    Route::get('json/cities', 'Setting\CityController@jsonCities')
        ->name('json.cities');

});


Route::group([
    'prefix' => 'supplier',
    'as' => 'supplier.',
    'middleware' => ['auth', 'role:' . UserRole::of(UserRole::ROLE_SUPPLIER)],
    'namespace' => 'Supplier',
], function () {

    Route::get('/', 'HomeController@home')->name('home');
    Route::get('home', 'HomeController@home');
});
