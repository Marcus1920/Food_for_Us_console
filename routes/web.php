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


Route::get('sendNotification','MessagingController@sendNotification');


Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('create' , 'SellersController@create')
                ->middleware('auth');
Route::get('all' , 'SellersController@index')
                       ->middleware('auth');
Route::get('up' , 'SellersController@update') ;

Route::get('/' , 'HomeController@index') ;
Route::get('del' , 'SellersController@destroy');

Route::resource('group','GroupController');
Route::post ('updateGroup/{id}','GroupController@update');

Route::resource('groupUser','UserGroupController');
Route::get('groupUsers/{id}','UserGroupController@index');
Route::get('addGroupUsers/{id}','UserGroupController@create');
Route::get('removeUser/{id}/{group}','UserGroupController@destroy');

Route::get('getUserss', 'UsersController@getUsers');

Route::get('sendToGroup/{id}','MessagingController@sendToGroup');
Route::post('msgGroup','MessagingController@groupMessageCreate');
Route::get('msgUsers','MessagingController@sendToUsers');
Route::post('usersMessageCreate','MessagingController@usersMessageCreate');
Route::post('resendNotification','MessagingController@resendNotification');


Route::group(array('prefix' => 'api/v1'), function() {

    // Product  type
    Route::get('iphone' , function(){
        
         $respos = array() ; 
         
         $respos['mesg'] ="ok"; 
         
         return  $respos;

    });
    Route::resource('notification','NotificationsController');
    Route::post('removeNotification','NotificationsController@removeNotification');

     Route::get ('packagingList' , 'packagingListController@index');
     Route::get ('producttype' , 'ProductTypeController@index');

     Route::post ('productInterest','UsersController@updateInterest');
     Route::get('getProductInterest','ProductInterestController@index');
     Route::post('deactivateInterest','ProductInterestController@deactivate');
     Route::post('activateInterest','ProductInterestController@activate');

    //Researchers
    Route::get('myResearchs','ResearchersController@index');
    Route::post('createResearch','ResearchersController@create');
    Route::get('allResearchs','ResearchersController@allResearchs');
    Route::get('viewResearch','ResearchersController@viewResearch');

    //Sellers
    Route::post('created' , 'SellersController@created') ;
    Route::post('updateSeller' , 'SellersController@update') ;
    Route::get('all' , 'SellersController@index') ;
    Route::get('allSellersPost' , 'SellersController@allSellersPosts') ;
    Route::post('deletePost' , 'SellersController@destroy') ;
    Route::get('sellerTransaction/{id}','TransactionController@sellerTransaction');
    Route::post('changeDefaultLocation','SellersController@changeDefaultLocation');
    Route::get('getPost','SellersController@getPost');


    //Users
    Route::get('userList' ,  'UsersController@index');
    Route::post('register' ,  'UsersController@create');
    Route::post('updatePlayeId','UsersController@updatePlayeId');



    Route::post('login' ,  'UsersController@login');
    Route::post('resetpassword' ,'UsersController@forgot');
    Route::get('myProfile', 'UsersController@myProfile');
    Route::post('updateProfile', 'UsersController@updateProfile');
    Route::get('myProfile','UsersController@myProfile');
    Route::post('updateProfilePic','UsersController@updateAppUserProfile');
    Route::post('changepassword' ,'UsersController@changePassword');

    //Transaction
    Route::post('buy','TransactionController@store');
    Route::get('show','TransactionController@show');
    Route::get('transactionDetails','TransactionController@transactionDetails');
    Route::post('approveTransaction','TransactionController@approveTransaction');
    Route::post('transactionRating','TransactionController@transactionRating');
    Route::get('transactionStatuses','TransactionController@transactionStatuses');
    Route::post('deleteTransaction','TransactionController@deleteTransaction');
    Route::get('test','TransactionController@sellerTransactionDetails');

    // Cart
    Route::post('addToCart','TransactionController@addToCart');
    Route::get('getCartItem','TransactionController@getCartItem');
    Route::post('removeFromCart','TransactionController@removeFromCart');

    //Recipes
    Route::get('getRecipes','PublicWallController@getRecipes');
    Route::get('viewRecipe','PublicWallController@viewRecipe');
    Route::get('distance','SellersController@getDistance');
    Route::get('country', 'CountryCodeController@index');

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

//BACKEND ROUTING

// Transaction Routing
Route::get('transactionList','TransactionController@UsersTransacionList');
Route::get('transactionHistory','TransactionController@transactionHistory');
Route::get('viewUserTransaction/{id}/{idNumber}','TransactionController@viewUserTransaction');
Route::get('/userTransaction' ,'TransactionController@userTransactionsActivity')
    ->name('user.transactions')
    ->middleware('auth');


//Country Routing
Route::get('countrylist','CountryCodeController@allCountries4Console');
Route::get('countrylistView','CountryCodeController@countryView');
Route::get('editCountryCode/{id}','CountryCodeController@editCountry')
    ->name('editCountryCode/{id}');
Route::post('updateCountry','CountryCodeController@update');
Route::get('getCountries', ['middleware' => 'auth', 'uses' => 'CountryCodeController@getCountries']);

//Admin User Routing
Route::get('/userEdit/{id}' , 'Auth\RegisterController@edit')
               ->name('userEdit')
               ->middleware('auth');
Route::get('/master' , 'MapController@getUsers')
             ->name('master') ;

Route::get('/users' , 'HomeController@show')

          //->name('users');
          ->middleware('auth')


          ->name('users');

Route::get('/register' , 'HomeController@register')
          ->name('register')
          ->middleware('auth');
Route::post('/createUser' , 'Auth\RegisterController@create');
Route::get('/editUsers/{id}',['middleware'=>'auth', function($id)
{
    $user = NewUser::where('id','=',$id)->first();
    return view('users.edit',compact('user'));
}]);
Route::get('/inactivateUsers/{id}',['middleware'=>'auth', function($id)
{
    $user = NewUser::where('id','=',$id)->first();
    return view('users.inactivateUsers',compact('user'));
}]);

Route::get('activeUsers',['middleware'=>'auth', function (){
   return view('users.active');
}]);
Route::get('inactiveUsers',['middleware'=>'auth', function (){
    return view('users.inactive');
}]);
Route::get('inactive' , 'HomeController@InactiveusersLis')
              ->name('inactive')
               ->middleware('auth');
Route::get('deactivated' ,'HomeController@deactivatedusersList')
                ->name('inactive')
                ->middleware('auth');
Route::get('deactivatedUser' ,['middleware'=>'auth', function ()
{
    return view('users.deactivated');
}]) ;
Route::get('active' , 'HomeController@activeusersLis')
        ->name('active')
        ->middleware('auth');
Route::get('/createUser',['middleware'=>'auth', function()
{
    return view('users.edit',compact('user'));
}]);

Route::get('/activation',['middleware'=>'auth' ,function()
{
    return view('emails.activation',compact('activation'));
}]);

Route::get('/registration',['middleware'=>'auth', function()
{
    return view('emails.registration',compact('registration'));
}]);

Route::get('/inactivation',function()
{
    return view('emails.inactivation',compact('inactivation'));
});

Route::get('/transaction',['middleware'=>'auth', function ()
{
    return view('emails.transaction',compact('transaction'));
}]);
Route::get('/changePassword',['middleware'=>'auth' ,function ()
{
    return view('emails.changePassword',compact('changePassword'));
}]);

Route::post('addAdmin', 'MyRegisterController@createAdmin');
Route::get('adminUser', 'MyRegisterController@adminUsers')
                 ->name('adminUser')
                 ->middleware('auth');
Route::get('getAdminUsers','MyRegisterController@getAdminUsers');

Route::get('postslist', 'PostViewController@showList')
                 ->name('postslist')
                 ->middleware('auth') ;
Route::get('sellersPostList', 'PostViewController@index')
                ->name('sellersPostList')
                ->middleware('auth');
Route::get('postview/{id}', 'PostViewController@show')
    ->name('postview/{id}')
    ->middleware('auth');

Route::post('activateUser/{id}' ,'UsersController@updateUser' );

Route::post('InactivateUser/{id}' ,'UsersController@inactivateUser' );



Route::get('researchList','ResearchersController@researchList')
            ->name('researchList')
            ->middleware('auth');
Route::get('getResearchList','ResearchersController@allResearchList')
            ->name('getResearchList')
            ->middleware('auth');
Route::get('researchProfile/{id}','ResearchersController@researchProfile')
                  ->name('researchProfile/{id}')
                  ->middleware('auth');
Route::get('getPosts','MapController@GetSellersPosts');
Route::get('getUsers','MapController@GetUsers');
Route::post('searchUserByType','MapController@GetUsersByType');
Route::post('searchByProductType','MapController@searchByProductType');

Route::get('CreateProduct','ProductTypeController@create')
    ->name('CreateProduct')
    ->middleware('auth');
Route::post('AddProduct','ProductTypeController@store');


Route::get('productlist', 'ProductsController@index')
       ->name('productlist')
       ->middleware('auth');
Route::get('editproduct/{id}','ProductsController@retriveProduct')
       ->name('editproduct/{id}')
       ->middleware('auth');
Route::post('editproduct/updateproduct','ProductsController@update')
    ->name('editproduct/updateproduct')
    ->middleware('auth') ;

Route::get('deleteProduct/{id}','ProductsController@delete')
    ->name('deleteProduct/{id}')
    ->middleware('auth')   ;

Route::get('allProduct',['middleware'=>'auth', function ()
{
    return view('Products.index');

}]);

Route::get('packaginglist', 'PackagingController@index')
    ->name('packaginglist')
    ->middleware('auth');
Route::get('getPackagingList','PackagingController@getPackagingList');
Route::get('createPackaging', 'PackagingController@create')
            ->name('createPackaging')
             ->middleware('auth') ;
Route::post('storePackaging', 'PackagingController@store');
Route::get('editPackaging/{id}','PackagingController@retrivePackaging')
    ->name('editPackaging/{id}')
    ->middleware('auth') ;

Route::post('editPackaging/updatepackaging','PackagingController@update')
    ->name('editPackaging/updateproduct')
    ->middleware('auth') ;

//User Role
Route::get('userroleslist', 'UserRolesController@index')
    ->name('userroleslist')
    ->middleware('auth');
Route::get('addUserRole',['middleware'=>'auth', function (){

    return view('UserRoles.add');
}]);
Route::post('storeUserRole','UserRolesController@store');

Route::get('allUserRole','UserRolesController@getAllUserRoles')
    ->name('allUserRole')
    ->middleware('auth');
Route::get('getUsersPerGroup/{id}','UserRolesController@getUsersView')
           ->name('getUsersPerGroup/{id}')
           ->middleware('auth');
Route::get('allUsersByRole/{id}','UserRolesController@getUserByUserRole')
    ->name('allUsersByRole/{id}')
    ->middleware('auth')  ;

Route::get('allUserRole','UserRolesController@getAllUserRoles');
Route::get('getUsersPerGroup/{id}','UserRolesController@getUsersView');
Route::get('allUsersByRole/{id}','UserRolesController@getUserByUserRole');
Route::get('editUserRole/{id}','UserRolesController@editUserRole');
Route::post('editUserRole/updateUserRole','UserRolesController@update');

Route::get('viewAdmin/{id}', 'UsersController@viewAdmin')
         ->name('viewAdmin/{id}')
         ->middleware('auth');

Route::post('editAdmin/{id}', 'UsersController@updateAdmin');
Route::get('userProfile/{id}', 'UsersController@userProfile');

//End User role
Route::get('reports','ReportsController@index')
      ->name('reports')
      ->middleware('auth');

//Public Wall
Route::get('addRecipe',['middleware'=>'auth',function (){

   return view('PublicWall.create');
}]);

Route::get('publicWall','PublicWallController@index')
            ->name('publicWall')
            ->middleware('auth');
Route::get('allRecipes','PublicWallController@getAllRecipes')
            ->name('allRecipes')
            ->middleware('auth');
Route::get('RecipeProfile/{id}','PublicWallController@RecipeProfile')
            ->name('RecipeProfile/{id}')
            ->middleware('auth');
Route::post('createRecipe','PublicWallController@createRecipe');
Route::post('editRecipe','PublicWallController@editRecipe');
Route::get('deleteRecipe/{id}','PublicWallController@deleteRecipe');

Route::get('test','TransactionController@OverDue');

//manage logins
Route::get('logins/{id}','UsersController@viewLogins');

Route::get('allNotification','NotificationsController@getAllNotification');

Route::get('resendNotification/{id}','NotificationsController@resendNotification');

Route::get('getGroup','GroupController@getGroup');

Route::get('messageNotification','MessagingController@AllmessageNotification');

Route::get('resendMessage/{id}','MessagingController@resendMessageNotification')

?>