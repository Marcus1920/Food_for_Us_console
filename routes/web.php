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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/' , 'HomeController@index') ;
Route::get('del' , 'SellersController@destroy');

Route::group(array('prefix' => 'api/v1'), function() {

// Produrct  type   
 Route::get ('packagingList' , 'packagingListController@index');
 Route::get ('producttype' , 'ProductTypeController@index');

    //Researchers
    Route::get('myResearchs','ResearchersController@index');
    Route::post('createResearch','ResearchersController@create');
    Route::get('allResearchs','ResearchersController@allResearchs');

    //Sellers
    Route::post('created' , 'SellersController@created') ;
    Route::post('updateSeller' , 'SellersController@update') ;
    Route::get('all' , 'SellersController@index') ;
    Route::get('allSellersPost' , 'SellersController@allSellersPosts') ;

    Route::post('deletePost' , 'SellersController@destroy') ;
    Route::get('sellerTransaction/{id}','TransactionController@sellerTransaction');






    //Users
    Route::get('userList' ,  'UsersController@index');
    Route::post('register' ,  'UsersController@create');
    Route::post('login' ,  'UsersController@login');
    Route::post('resetpassword' ,'UsersController@forgot');
    Route::get('myProfile','UsersController@myProfile');
    //Transaction
    Route::post('buy','TransactionController@store');
    Route::get('show','TransactionController@show');
    Route::get('transactionDetails','TransactionController@transactionDetails');
    Route::get('sellerTransaction','TransactionController@sellerTransaction');


    // Cart
    Route::post('addToCart','TransactionController@addToCart');
    Route::get('getCartItem','TransactionController@getCartItem');
    Route::post('removeFromCart','TransactionController@removeFromCart');

    //Recipes
    Route::get('getRecipes','PublicWallController@getRecipes');
    Route::post('createRecipe','PublicWallController@createRecipe');
    Route::get('viewRecipe','PublicWallController@viewRecipe');
    Route::post('editRecipe','PublicWallController@editRecipe');
    Route::get('deleteRecipe','PublicWallController@deleteRecipe');
/*
    //User Roles
    Route::get('getUserRoles','UserRolesController@getUserRoles');

    //Travel Radius
    Route::get('getTravelRadius','UserTravelRadiusController@getTravelRadius');

    //Packaging
    Route::get('getPackaging','PackagingController@getPackaging');

    //Packaging
    Route::get('getProductType','ProductsController@getProductType');

    //Transport
    Route::get('getTransportType','TransportController@getTransportType');
*/

});



Route::get('/userEdit/{id}' , 'Auth\RegisterController@edit')->name('userEdit');

Route::get('/master' , 'MapController@getUsers')->name('master') ;
Route::get('/users' , 'HomeController@users')->name('users') ;

Route::get('/users' , 'HomeController@show')->name('master') ;
//Route::get('/users' , 'HomeController@users')->name('users') ;

Route::get('/register' , 'HomeController@register')->name('register');
Route::post('/createUser' , 'Auth\RegisterController@create')->name('createUser');


Route::get('/editUsers/{id}', function($id)
{
    $user = NewUser::where('id','=',$id)->first();
    return view('users.edit',compact('user'));
});

Route::get('/inactivateUsers/{id}', function($id)
{
    $user = NewUser::where('id','=',$id)->first();
    return view('users.inactivateUsers',compact('user'));
});

Route::get('/createUser', function()
{
    return view('users.edit',compact('user'));
});




Route::get('/activation', function()
{
    return view('emails.activation',compact('activation'));
});


Route::get('/registration', function ()
{
    return view('emails.registration',compact('registration'));
});



Route::post('addAdmin', 'MyRegisterController@createAdmin');
Route::get('adminUser', 'MyRegisterController@adminUsers');

Route::get('postslist', 'PostViewController@index');
Route::get('postview/{id}', 'PostViewController@show');
Route::post('activateUser/{id}' ,'UsersController@updateUser' );
Route::post('InactivateUser/{id}' ,'UsersController@inactivateUser' );
Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');





Route::get('password/reset', 'Auth\ResetPasswordController@getReset');
Route::get('getPosts','MapController@GetSellersPosts');
Route::get('getUsers','MapController@GetUsers');
Route::post('searchUserByType','MapController@GetUsersByType');
Route::post('searchByProductType','MapController@searchByProductType');

Route::get('CreateProduct','ProductTypeController@create');
Route::post('AddProduct','ProductTypeController@store');


Route::get('productlist', 'ProductsController@index');

Route::get('packaginglist', 'PackagingController@index');
Route::get('createPackaging', 'PackagingController@create');
Route::post('storePackaging', 'PackagingController@store');

//User Role
Route::get('userroleslist', 'UserRolesController@index');
Route::get('addUserRole', function (){

    return view('UserRoles.add');
});
Route::post('storeUserRole','UserRolesController@store');

Route::get('viewAdmin/{id}', 'UsersController@viewAdmin');

Route::post('editAdmin/{id}', 'UsersController@updateAdmin');


//End User role

?>