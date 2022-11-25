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
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as' => 'customer.','namespace' => 'App\Http\Controllers', 'prefix' => 'customer',], function () {
    Route::get('login', 'Customer\LoginController@index')->name('login');
    Route::post('/login', 'Customer\LoginController@login')->name('login');

});

Route::group(['as' => 'user.','namespace' => 'App\Http\Controllers', 'prefix' => 'user',], function () {
    Route::get('forget-password', 'User\UserController@forgetPassword')->name('forgetPassword');
    Route::post('update-password', 'User\UserController@updatePassword')->name('updatePassword');

});


Route::get('setting', 'App\Http\Controllers\Setting\SettingController@index')->name('setting.index');
Route::put('setting/update', 'App\Http\Controllers\Setting\SettingController@update')->name('setting.update');



Route::group(['middleware' => 'auth','namespace' => 'App\Http\Controllers'], function () {
    Route::get('/dashboard','Dashboard\DashboardController@index')->name('dashboard');


    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    /*
    |--------------------------------------------------------------------------
    | User CRUD
    |--------------------------------------------------------------------------
    |
    */


    Route::resource('user', 'User\UserController');
    Route::get('user-data', 'User\UserController@getAllData')->name('user.data');
    Route::get('user/{id}/destroy', 'User\UserController@destroy')->name('destroy');
    Route::get('update-profile', 'User\UserController@profileUpdate')->name('user.profileUpdate');
    Route::post('update-profile/{id}', 'User\UserController@profileUpdateStore')->name('user.updateProfile');

    /*
    |--------------------------------------------------------------------------
    | Role CRUD
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('role', 'Role\RoleController');
    Route::get('role-data', 'Role\RoleController@getAllData')->name('role.data');
    Route::get('role/{id}/destroy', 'Role\RoleController@destroy')->name('destroy');

    /*
    |--------------------------------------------------------------------------
    | Permission CRUD
    |--------------------------------------------------------------------------
    |
    */


    Route::resource('permission', 'Permission\PermissionController');
    Route::get('permission-data', 'Permission\PermissionController@getAllData')->name('permission.data');
    Route::get('permission/{id}/destroy', 'Permission\PermissionController@destroy')->name('destroy');


    Route::get('institution-data', 'Institution\InstitutionController@getAllData')->name('institution.data');
    Route::resource('institution', 'Institution\InstitutionController');
    Route::get('institution/{id}/destroy', 'Institution\InstitutionController@destroy')->name('destroy');

    Route::group(['as'=>'common.', 'prefix'=>'common'], function(){
        Route::post('provinces', 'Common\CommonController@getProvincesByCountryId')->name('province.countryId');
        Route::post('districts', 'Common\CommonController@getDistrictsByProvinceId')->name('district.provinceId');
    });


});


Route::group(['middleware' => 'customer','namespace' => 'App\Http\Controllers'], function () {


});
