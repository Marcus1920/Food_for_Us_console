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
use  App\NewUser  ;


//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/' , 'HomeController@index') ;




Route::group(array('prefix' => 'api/v1'), function() {

    Route::get('userList' ,  'UsersController@index');
    Route::post('register' ,  'UsersController@create');
    Route::post('login' ,  'UsersController@login');


});