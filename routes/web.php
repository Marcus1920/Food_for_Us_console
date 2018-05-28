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
use App\Sellers_details_tabs;
use Illuminate\Http\Request;
use App\ProductType;
use App\Packaging;

Route::resource('change_pp','PpController');
Route::get('sendNotification','MessagingController@sendNotification');


Route::post("updateprofile",function (Request $request){

   if($request->file_pic != "") {

       $newuser = NewUser::findOrFail($request->id);

       if (  $newuser->profilePicture != NULL) {unlink('img/' . $newuser->profilePicture);  }

           NewUser::where('id', $request->id)
               ->update([ 'profilePicture' =>$request->file_pic,
                   'idNumber' =>$request->idnumber,'surname'=>$request->name,'email'=>$request->email,
                   'intrest' =>$request->interest,'cellphone'=>$request->cell,'location'=>$request->location
               ]);
           return "Successfully Updated";

   }else {

       $newuser = NewUser::findOrFail($request->id);$image='';
        if($newuser->profilePicture === NULL){$image=$request->file_pic;}else{$image=$newuser->profilePicture;}
       NewUser::where('id', $request->id)
           ->update([  'profilePicture' =>$image,
               'idNumber' => $request->idnumber, 'surname' => $request->name, 'email' => $request->email,
               'intrest' => $request->interest, 'cellphone' => $request->cell, 'location' => $request->location
           ]);
       return "Successfully Updated";
   }




});

Route::get('deleteImg/{imgName}', function ($imgName){
    if(file_exists('img/'.$imgName)){
        unlink('img/'.$imgName);
    }
    return "file removed";
});

Route::get('/postlist/{num}', function ($num){
    if($num==1){$num=0;}else{$num= ($num-1) * 8;};

    $respond=array();

    $api_key   = Input::get('api_key');

    if(Input::get('api_key')==NULL)
    {
        $user  = NewUser::where('id',Auth::user()->new_user_id)->first();
    }
    else {
        $user  = NewUser::where('api_key',$api_key)->first();
    }

    if($user!=NULL)
    {


        $sellers_tabs=Sellers_details_tabs::where('new_user_id',$user->id)
            ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->join('packagings', 'sellers_details_tabs.packaging', '=', 'packagings.id')
            ->join('product_pickup_details','sellers_details_tabs.id','=','product_pickup_details.SellersPostId')
            ->select(
                \DB::raw(
                    "
                        sellers_details_tabs.id,
                        sellers_details_tabs.new_user_id,
                        sellers_details_tabs.productPicture,
                        sellers_details_tabs.location,
                        sellers_details_tabs.gps_lat,
                        sellers_details_tabs.gps_long,
                        product_types.name as productType,
                        sellers_details_tabs.quantity,
                        sellers_details_tabs.costPerKg,
                        sellers_details_tabs.description,
                        sellers_details_tabs.country,
                        sellers_details_tabs.city,
                        packagings.name as packaging,
                        sellers_details_tabs.availableHours,
                        sellers_details_tabs.paymentMethods,
                        sellers_details_tabs.transactionRating,
                        sellers_details_tabs.created_at,
                        sellers_details_tabs.updated_at,
                        product_pickup_details.sellByDate,
                        product_pickup_details.PickUpAddress as pickUpAddress,
                        product_pickup_details.MonToFridayHours as monToFridayHours,
                        product_pickup_details.SaturdayHours as saturdayHours,
                        product_pickup_details.SundayHours as sundayHours
                        
                        "
                )
            )->where('sellers_details_tabs.post_status',1)
            ->orderBy('created_at' ,'desc')->skip($num)	->take(8)->get();

        return response()->json($sellers_tabs);
    }
    else
    {
        $respond['msg']="No Api key found";

        $respond['error']=true;

        return response()->json($respond);
    }

});

Route::get("postrecent/{num}", function ($num){
    if($num==1){$num=0;}else{$num= ($num-1) * 4;};
    $sellers_posts=\DB::table('sellers_details_tabs')
        ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
        ->join('packagings', 'sellers_details_tabs.packaging', '=', 'packagings.id')
        ->join('product_pickup_details','sellers_details_tabs.id','=','product_pickup_details.SellersPostId')
        ->where('sellers_details_tabs.quantity','>',0)
        ->where('sellers_details_tabs.post_status','=',1)
        ->select(
            \DB::raw(
                "
                        sellers_details_tabs.id,
                        sellers_details_tabs.new_user_id,
                        sellers_details_tabs.productPicture,
                        sellers_details_tabs.location,
                        sellers_details_tabs.gps_lat,
                        sellers_details_tabs.gps_long,
                        product_types.name as productType,
                        product_types.id as productTypeId,
                        sellers_details_tabs.quantity,
                        sellers_details_tabs.costPerKg,
                        sellers_details_tabs.description,
                        sellers_details_tabs.country,
                        sellers_details_tabs.city,
                        packagings.name as packaging,
                        sellers_details_tabs.availableHours,
                        sellers_details_tabs.paymentMethods,
                        sellers_details_tabs.transactionRating,
                        sellers_details_tabs.created_at,
                        sellers_details_tabs.updated_at,
                        product_pickup_details.sellByDate,
                        product_pickup_details.PickUpAddress as pickUpAddress,
                        product_pickup_details.MonToFridayHours as monToFridayHours,
                        product_pickup_details.SaturdayHours as saturdayHours,
                        product_pickup_details.SundayHours as sundayHours"
            )
        )
        ->where('sellers_details_tabs.quantity','>',0)
        ->orderBy('created_at' ,'desc')->skip($num)	->take(4)->get();

    return $sellers_posts;
});

Route::get('recentPost', function () {
    $sellers_posts=\DB::table('sellers_details_tabs')
        ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
        ->join('packagings', 'sellers_details_tabs.packaging', '=', 'packagings.id')
        ->join('product_pickup_details','sellers_details_tabs.id','=','product_pickup_details.SellersPostId')
        ->where('sellers_details_tabs.quantity','>',0)
        ->where('sellers_details_tabs.post_status','=',1)
        ->select(
            \DB::raw(
                "
                        sellers_details_tabs.id,
                        sellers_details_tabs.new_user_id,
                        sellers_details_tabs.productPicture,
                        sellers_details_tabs.location,
                        sellers_details_tabs.gps_lat,
                        sellers_details_tabs.gps_long,
                        product_types.name as productType,
                        product_types.id as productTypeId,
                        sellers_details_tabs.quantity,
                        sellers_details_tabs.costPerKg,
                        sellers_details_tabs.description,
                        sellers_details_tabs.country,
                        sellers_details_tabs.city,
                        packagings.name as packaging,
                        sellers_details_tabs.availableHours,
                        sellers_details_tabs.paymentMethods,
                        sellers_details_tabs.transactionRating,
                        sellers_details_tabs.created_at,
                        sellers_details_tabs.updated_at,
                        product_pickup_details.sellByDate,
                        product_pickup_details.PickUpAddress as pickUpAddress,
                        product_pickup_details.MonToFridayHours as monToFridayHours,
                        product_pickup_details.SaturdayHours as saturdayHours,
                        product_pickup_details.SundayHours as sundayHours"
            )
        )
        ->where('sellers_details_tabs.quantity','>',0)
        ->orderBy('created_at' ,'desc')	->count();
    return view('auth.Recentpos',compact('sellers_posts'));
});

Route::get('dologin', function () {
    return view('auth.doLogin');
});

Route::get('doRegister', function () {
    $success="";
    return view('auth.registerMobile',compact('success'));
});

Route::get('lading', function () {
    return view('auth.login');
});


Route::get('userporifiles', function () {

    $new_user_id = Auth::user()->new_user_id;

    $user = NewUser::where('id',$new_user_id)->first();


    $users  = NewUser::where('api_key',$user->api_key)
        ->join('user_roles', 'new_users.intrest', '=', 'user_roles.id')
        ->select(
            \DB::raw(
                "
                        new_users.id,
                        new_users.profilePicture,
                        new_users.idNumber,
                        new_users.name,
                        new_users.surname,
                        new_users.email,
                        new_users.cellphone,
                        new_users.location,
                        new_users.descriptionOfAcces,
                        user_roles.name as interest 
                       "
            )
        )
        ->first();


    http://system.foodforus.cloud/public/img/default-user-image.png

    return view('userprofile.profile',compact('users'));
});

Route::get("getrecieptlist/{num}", function ($num){

    if($num==1){$num=0;}else{$num= ($num-1) * 4;};
    $recipes=\DB::table('public_wall')->where('deleted_at', '=', null)
        ->join('users', 'public_wall.poster', '=', 'users.id')
        ->select(
            \DB::raw(
                "
                                public_wall.id,             
                                public_wall.name,                       
                                public_wall.description,
                                public_wall.imgurl,
                                public_wall.ingredients,
                                public_wall.methods,
                                public_wall.poster,
                                public_wall.created_at as createdAt,
                                users.name as firstName,
                                users.surname as surname   
                                "
            )
        )
        ->skip($num)->take(4)->get();
    return $recipes;
});

Route::get('recieptlist', function () {

    $recipes=\DB::table('public_wall')->where('deleted_at', '=', null)
        ->join('users', 'public_wall.poster', '=', 'users.id')
        ->select(
            \DB::raw(
                "
                                public_wall.id,             
                                public_wall.name,                       
                                public_wall.description,
                                public_wall.imgurl,
                                public_wall.ingredients,
                                public_wall.methods,
                                public_wall.poster,
                                public_wall.created_at as createdAt,
                                users.name as firstName,
                                users.surname as surname   
                                "
            )
        )
        ->count();

    return view('userprofile.reciept',compact('recipes'));
});


Route::get('userReport', 'ReportsController@userReport')
    ->middleware('auth');

Route::get('mypostlist', function () {

    $respond=array();

    $api_key   = Input::get('api_key');

    if(Input::get('api_key')==NULL)
    {
        $user  = NewUser::where('id',Auth::user()->new_user_id)->first();
    }
    else {
        $user  = NewUser::where('api_key',$api_key)->first();
    }

    if($user!=NULL)
    {


        $sellers_posts=Sellers_details_tabs::where('new_user_id',$user->id)
            ->join('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->join('packagings', 'sellers_details_tabs.packaging', '=', 'packagings.id')
            ->join('product_pickup_details','sellers_details_tabs.id','=','product_pickup_details.SellersPostId')
            ->select(
                \DB::raw(
                    "
                        sellers_details_tabs.id,
                        sellers_details_tabs.new_user_id,
                        sellers_details_tabs.productPicture,
                        sellers_details_tabs.location,
                        sellers_details_tabs.gps_lat,
                        sellers_details_tabs.gps_long,
                        product_types.name as productType,
				
                        sellers_details_tabs.quantity,
                        sellers_details_tabs.costPerKg,
                        sellers_details_tabs.description,
                        sellers_details_tabs.country,
                        sellers_details_tabs.city,
                        packagings.name as packaging,
                        sellers_details_tabs.availableHours,
                        sellers_details_tabs.paymentMethods,
                        sellers_details_tabs.transactionRating,
                        sellers_details_tabs.created_at,
                        sellers_details_tabs.updated_at,
                        product_pickup_details.sellByDate,
                        product_pickup_details.PickUpAddress as pickUpAddress,
                        product_pickup_details.MonToFridayHours as monToFridayHours,
                        product_pickup_details.SaturdayHours as saturdayHours,
                        product_pickup_details.SundayHours as sundayHours
                        
                        "
                )
            )->where('sellers_details_tabs.post_status',1)
            ->orderBy('created_at' ,'desc')->count();


    }

    return view('userprofile.mypost', compact('sellers_posts','products','packaging','currentDate'));
});

Route::get('createPost', function (){

    $products = ProductType::select('name' , 'id')->orderBy('name','ASC')-> get() ;

    $packaging = Packaging::select('id','name')->get();

    $currentDate = \Carbon\Carbon::now('Africa/Johannesburg')->toDateString();

    return view('userprofile.createPost', compact('sellers_posts','products','packaging','currentDate'));
});

Route::get('createDonation', function (){

    $products = ProductType::select('name' , 'id')->orderBy('name','ASC')-> get() ;

    $packaging = Packaging::select('id','name')->get();

    $currentDate = \Carbon\Carbon::now('Africa/Johannesburg')->toDateString();

    return view('userprofile.createDonation', compact('sellers_posts','products','packaging','currentDate'));
});


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
Route::get ('removeGroup/{id}','GroupController@remove');

Route::resource('groupUser','UserGroupController');
Route::get('groupUsers/{id}','UserGroupController@index');
Route::get('addGroupUsers/{id}','UserGroupController@create');
Route::get('addGroupUsersRadius/{id}','UserGroupController@createRadius');
Route::get('removeUser/{id}/{group}','UserGroupController@destroy');
Route::post('storeRadius','UserGroupController@storeRadius');

Route::get('getUserss', 'UsersController@getUsers');

Route::get('sendToGroup/{id}','MessagingController@sendToGroup');
Route::post('msgGroup','MessagingController@groupMessageCreate');
Route::get('msgUsers','MessagingController@sendToUsers');
Route::post('usersMessageCreate','MessagingController@usersMessageCreate');
Route::post('resendNotification','MessagingController@resendNotification');

Route::get('geofence','GeoTableController@getPlaces');

Route::get('mapNotification',function (){
    return view('MessagingNotification.map');
});

Route::post('sendByRadius','MessagingController@sendByRadius');


Route::group(array('prefix' => 'api/v1'), function() {

    // Product  type
    Route::get('iphone' , function(){
        
         $respos = array() ; 
         
         $respos['mesg'] ="ok"; 
         
         return  $respos;

    });



    Route::post('conversation','ConversationController@createConversation');
    Route::get('getMyConversation','ConversationController@getMyConversation');
    Route::post('getConversation','ConversationController@getConverstation');
    Route::post('hideConversation','ConversationController@hideConversation');

    Route::post('createMessage','ChatMessageController@createMessage');
    Route::get('getMessages','ChatMessageController@getMessagesPerConvo');

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
    Route::post('registerMobile' ,  'UsersController@createMobile');
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

    $role = Auth::user()->role;

   return view('users.active',compact('role'));
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
Route::get('removePost/{id}','SellersController@deletePost');
Route::post('createConsole','SellersController@createConsole');
Route::post('createDonation','SellersController@createDonation');

Route::post('activateUser/{id}' ,'UsersController@updateUser' );

Route::post('InactivateUser/{id}' ,'UsersController@inactivateUser' );

Route::get('deleteUser/{id}' ,'UsersController@deleteUser' );

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

Route::get('editUser/{id}', 'UsersController@getUser');
Route::post('editNewUser/{id}', 'UsersController@updateNewUser');

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

Route::get('resendMessage/{id}','MessagingController@resendMessageNotification');


Route::get('conversation','ConversationController@index')
//->middleware('auth');
?>