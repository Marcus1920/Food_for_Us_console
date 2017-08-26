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


Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('create' , 'SellersController@create') ;
Route::get('all' , 'SellersController@index') ;
Route::get('up' , 'SellersController@update') ;
Route::get('del' , 'SellersController@destroy') ;
Route::group(array('prefix' => 'api/v1'), function() {

    Route::get('userList' ,  'UsersController@index');
    Route::post('register' ,  'UsersController@create');
    Route::post('login' ,  'UsersController@login');
    Route::post('resetpassword' ,'UsersController@forgot' );


});



Route::get('/userEdit/{id}' , 'Auth\RegisterController@edit')->name('userEdit');
Route::get('/master' , 'HomeController@show')->name('master') ;
Route::get('/users' , 'HomeController@users')->name('users') ;
Route::get('/register' , 'HomeController@register')->name('register');
Route::post('/createUser' , 'Auth\RegisterController@create')->name('createUser');


Route::get('/editUsers/{id}', function($id)
{
    $user =NewUser::where('id','=',$id)->first();
    return view('users.edit',compact('user'));
});

Route::get('/createUser', function()
{
    return view('users.edit',compact('user'));
});

Route::post('addAdmin', 'MyRegisterController@createAdmin');
Route::get('adminUser', 'MyRegisterController@adminUsers');


Route::get('postslist', 'PostViewController@index');
Route::get('postview/{id}', 'PostViewController@show');

//Route::post('activateUser/{id}',function ($id){
//
//    return $id;
//});


Route::post('activateUser/{id}' ,'UsersController@updateUser' );


