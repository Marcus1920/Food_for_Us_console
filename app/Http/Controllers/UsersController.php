<?php

namespace App\Http\Controllers;

use App\PublicWall;
use App\Sellers_details_tabs;
use App\User;
use App\UserDefaultLocation;
//use Dotenv\Validator;
use Validator;
use Illuminate\Http\Request;
use App\NewUser  ;
use App\UserRoles;
use App\UserTravelRadius;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use phpDocumentor\Reflection\Types\Null_;
use Psr\Log\NullLogger;
use Redirect;
use App\ProductType;
use App\ProductInterest;

use Illuminate\Pagination\Paginator;
use App\ManageLogin;
use App\Http\Requests\EditAdminRequest;

class UsersController extends Controller
{

    public function index()
    {
        $userList = NewUser::with('UserStatuses')->with('UserRole')->with('UserTravelRadius');

        return response()->json($userList);
    }
    public function myProfile()
    {
        $user  = NewUser::where('api_key',Input::get('api_key'))
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
        return response()->json($user);
    }
    public function changePassword()
    {
        $api_key   = Input::get('api_key');

        $user  = NewUser::where('api_key',$api_key)->first();

        if($user->password==Input::get('OldPassword'))
        {
            if(Input::get('NewPassword')==Input::get('CornfirmPasswod'))
            {
                $user  = NewUser::where('api_key',$api_key)
                    ->update(['password'=>Input::get('CornfirmPasswod')]);

                $userUpdated =NewUser::find($user);
                $message = "your  new  password  is  ";

                //email
                $data = array(

                    'name' => $userUpdated->name,
                    'email'=>$userUpdated->email,
                    'password' => $userUpdated->password,
                    'content' => $message

                );


                \Mail::send('emails.changePassword', $data, function ($message) use ($userUpdated) {
                    $message->from('Info@FoodForUs.cloud', 'Food For us');
                    $message->to($userUpdated->email)->subject("Food  for  us Notification! ");

                });

                return "Password successfuly changed ";
            }
            else
            {
                return "New passwords didn't match";
            }
        }
        else
        {
            return "Incorrect old password";
        }
    }
    public function forgot()
    {

        $response = array();
        $email = Input::get('emails');

        $userNew = NewUser::where('email', '=', $email)->first();

      ///  $userNew->password = rand(1,9999);
       // $userNew->save();
        if (sizeof($userNew) > 0) {

           
            $message = "your  new  password  is  ";
            $response["error"] = false;
            $data = array(

                'name' => $userNew->name,
                'passsword' => $userNew->password,
                'content' => $message

            );


            \Mail::send('emails.resetpassword', $data, function ($message) use ($userNew) {
                $message->from('Info@FoodForUs.cloud', 'Food For us');
                $message->to($userNew->email)->subject("Food  for  us Notification! ");

            });

            $response["message"] = "You have successfully resetted your password check  your  email for a new password";


        } else {
            $response["error"] = true;
            $response["message"] = "Sorry, you have not registered yet";
        }

        return \Response::json($response);
    }
    public function login()
    {

        $response = array();
        $email = Input::get('emails');
        $password = Input::get('password');
           

        if (Input::get('emails') == Null || Input::get('password') == null) {


            return $response['msg'] = "wrong  user name or  password";
        }

        $data = NewUser::where('email', $email)
            ->where('password', $password)
            ->first();

        $exist = User::where('new_user_id',$data->id)
            ->first();

        if($exist==NULL)
        {
            $adminUsers                 = new User();
            $adminUsers->name           = $data->name;
            $adminUsers->new_user_id    = $data->id;
            $adminUsers->surname        = $data->surname;
            $adminUsers->gender         = "none";
            $adminUsers->cellphone      = $data->cellphone;
            $adminUsers->email          = $data->email;
            $adminUsers->password       = bcrypt($data->password);
            $adminUsers->role           = "mobile-user";
            $adminUsers->created_by     = $data->name . ' ' . $data->surname  ;
            $adminUsers->save();
        }

        if (sizeof($data) > 0) {

            $key = $data->api_key;


        } else {

            $key = "no key";
        }

        if (sizeof($data) > 0) {

            if ($data->active == 2)
            {
              $response["error"]       = false;
              $response['name']        = $data->name;
              $response['email']       = $data->email;
              $response['intrest']     = $data->intrest;
              $response['apiKey']      = $data->api_key;
              $response['createdAt']   = $data->created_at;
			  $response['active']      = 2;
			  $response["msg"]         = "ok";

                NewUser::where('id',$data->id)
                    ->update(['last_login'=>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);

			  $addLogin = new ManageLogin();
			  $addLogin->new_user_id = $data->id;
			  $addLogin->save();
           }
           else{


               $response["error"]    = false;
			   $response['active']   = 2;
               $response["msg"]      ="notactive";
         }
         //   \Log::info("Login Device:".$device.", User Cell:".$cell.", User Names:".$data->name);

            if ($data->active == 2) {
                $response["error"] = false;
                $response['name'] = $data->name;
                $response['email'] = $data->email;

                $interest=UserRoles::where('id',$data->intrest)->first();

                $response['intrest'] = $interest->name;
                $response['apiKey'] = $data->api_key;
                $response['createdAt'] = $data->created_at;
                $response['active'] = 2;
            } else {



                $response["error"]  = true;
                $response['active'] = 1;
                $response["msg"]    = "your  account  is Not Acive";
            }
            //   \Log::info("Login Device:".$device.", User Cell:".$cell.", User Names:".$data->name);

        } else {


            $response['error']   = true;
            $response['error'] = true;
            $response['msg'] = "failed";
            $response['message'] = 'Login failed. Incorrect credentials';


        }

        return \Response::json($response);
    }
    public function updateUser($id)
    {
		

		$user = NewUser::with('UserStatuses')->with('UserRole')->with('UserTravelRadius')->where('id',$id)
              ->update(['active'=>1]);

		$user = NewUser::with('UserStatuses')
                                ->with('UserRole')
                                ->with('UserTravelRadius')
                                ->where('id',$id)
                                ->update(['active'=>2]);


         $userDetails = NewUser::find($id);

          $data=array(
           'name' =>$userDetails->name,
           'email' =>$userDetails->email,
                 );

        \Mail::send('emails.activation', $data, function ($message) use ($userDetails) {


            $message->from('Info@FoodForUs.cloud', 'Food  For Us ');
            $message->to($userDetails->email)->subject( " Food  For Us Notification ");


        });



        return Redirect::to('/users');
	}
    public function inactivateUser($id)
    {
        $user = NewUser::where('id',$id)
            ->update(['active'=>3]);

        $userDetails = NewUser::find($id);
 
            
        $message= "Food For us";
        $data = array(

            'name'      =>      $userDetails->name,
            'passsword' =>      $userDetails->password,
            'content'   =>      $message,
                     );

        \Mail::send('emails.inactivation', $data, function ($message) use ($userDetails) {



            $message->from('Info@FoodForUs.cloud', 'Food For Us');
            $message->to($userDetails->email)->subject("Food For Us Notification !");

//
//            $message->from('info@Food  For  Us  ',  'Food  For  Us');
//            $message->to($userDetails->email)->subject("Food  For  Us   Notification ");
                            });
        return Redirect::to('/users');
    }

    public function deleteUser($id)
    {
        $user = NewUser::where('id',$id)
            ->update(['active'=>4]);

        \Session::flash('success', 'well done! Successfully deleted the user!');
        return Redirect('/deactivatedUser');
    }

    public  function  create  ()   {


        $validator=Validator::make(
            array(
                'name'          =>Input::get('name'),
                'surname'       =>Input::get('surname'),
                'emails'        =>Input::get('emails'),
                'cell'          =>Input::get('cell'),
                'intrest'       =>Input::get('intrest'),
                'IdNumber'      =>Input::get('IdNumber'),
                'location'      =>Input::get('location'),
                'travel_radius' =>Input::get('travel_radius'),
                'description_of_acces'=> Input::get('description_of_acces'),
            ),

            array(
                'name'          =>array('required','alpha','min:3'),
                'surname'       =>array('required','alpha','min:3'),
                'emails'        =>array('required','email','unique:new_users,email'),
                'intrest'       =>array('required','alpha'),
                'cell'          =>array('required','unique:new_users,cellphone'),
                'IdNumber'      =>array('required','unique:new_users,idNumber'),
                'location'      =>array('required'),
                'travel_radius' =>array('required'),
                'description_of_acces'=>array('required'),
            ),array(

                'name.required'         =>'The Name field is required',
                'surname.required'      =>'The Surname field is required',
                'intrest.required'      =>'Please select group',
                'cell.required'         =>'The Phone Number field is required',
                'cell.unique'           =>'This Phone Number is allready taken',
                'emails.required'       =>'The Email field is required',
                'emails.unique'         =>'This Email is allready taken',
                'travel_radius.required'=>'Please select Notification Radius',
                'IdNumber.required'     =>'The Identity Number field is required',
                'IdNumber.unique'       =>'This Identity Number is allready taken',
                'description_of_acces.required'=>'Please select mode of transport',

            )
        );


        if ( $validator->fails() ) {
   $resposse = array();

            $errors=$validator->messages();

            foreach ( $errors->all() as $error ) {
               $resposse["Erro"] =  $error;
                return response()->json($resposse);
            }

        }


//        if ( ! empty( $errors ) ) {
//
//        }

        function generateRandomString($length = 24) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
        $name                   =  Input::get('name') ;
        $surname                =  Input::get('surname') ;
        $email                  =  Input::get('emails') ;

        $userRoleId             = UserRoles::where('name',Input::get('intrest'))->first();
        $intrest                =  $userRoleId['id'] ;

          
        $cellphone              = Input::get('cell');
        $idNumber               = Input::get('IdNumber');
        $location               =  Input::get('location') ;

        $userTravelRadId        = UserTravelRadius::where('kilometres',Input::get('travel_radius'))->first();
        $travel_radius          =  $userTravelRadId['id'] ;

        $description_of_acces   =  Input::get('description_of_acces');
        $gps_lat                =  Input::get('gps_lat');
        $gps_long               =  Input::get('gps_long');
		$lat   = null  ; 
		$long  =null ; 
	    if ($gps_lat==null)
		{
		 $lat   = "-937538943";
		}
		else 
		{
			
		$lat = Input::get('gps_lat'); 	
		}	
		
		if ($gps_long==null)
		{
			$long = "937538943";
			
		}
		else 
			
			{
				$long  = Input::get('gps_long');
				
			}

        $NewUser    =   new   NewUser  () ;
        $NewUser->   active                 = 1;
        $NewUser->  gps_lat                 = $lat ;
        $NewUser->  gps_long                = $long;
        $NewUser->profilePicture           ="http://system.foodforus.cloud/public/img/default-user-image.png";
        $NewUser->  name                 = $name ;
        $NewUser->  email                = $email ;
        $NewUser->  intrest              = $intrest;
        $NewUser->  surname              = $surname ;
        $NewUser-> cellphone             = $cellphone;
        $NewUser->idNumber               = $idNumber;
        $NewUser->  location             = $location;

      
        $NewUser->  descriptionOfAcces = $description_of_acces ;

        $NewUser->  travelRadius        =  $travel_radius ;
        $NewUser->  password             =  rand(1,9999);
        $NewUser->  api_key                =  generateRandomString() ;
        $NewUser->  descriptionOfAcces  = $description_of_acces ;

        $NewUser-> save() ;

        $defaultLocation               = new UserDefaultLocation();
        $defaultLocation->userId       = $NewUser->id;
        $defaultLocation->gps_lat      = $lat;
        $defaultLocation->gps_long     = $long;
        $defaultLocation->save();

        $adminUsers                 = new User();
        $adminUsers->name           = $name;
        $adminUsers->new_user_id    = $NewUser->id;
        $adminUsers->surname        = $surname;
        $adminUsers->gender         = "none";
        $adminUsers->cellphone      = $cellphone;
        $adminUsers->email          = $email;
        $adminUsers->password       = bcrypt($NewUser->password);
        $adminUsers->role           = "mobile-user";
        $adminUsers->created_by     = $name . ' ' . $surname  ;
        $adminUsers->save();

        $message= "Food For us";
        $data = array(

            'name'      =>      $NewUser->name,
			'surname'   =>      $NewUser->surname,
			'email'     =>      $NewUser->email,
            'password' =>       $NewUser->password,
			'surname' =>        $NewUser->surname,
            'content'   =>      $message 
                     );

      \Mail::send('emails.registration', $data, function ($message) use ($NewUser) {

             $message->from('Info@FoodForUs.cloud', 'Food For us');
           $message->to($NewUser->email)->subject("Registration Notification ");
       });

        \Mail::send('emails.adminRegNotification', $data, function ($message) use ($NewUser) {

            $message->from('Info@FoodForUs.cloud', 'Food For us');
            $message->to("mozaamisi93@gmail.com")->subject("Registration Notification ");
        });

        $respose = array();
        $respose ['mesg']="Ok";
        //$respose['mesg'] = "successfully registered  please  wait   or  approval ";
        return response()->json($respose);


    }

    public  function  createMobile  ()   {



        $validator=Validator::make(
            array(
                'name'          =>Input::get('name'),
                'surname'       =>Input::get('surname'),
                'emails'        =>Input::get('emails'),
                'cell'          =>Input::get('cell'),
                'intrest'       =>Input::get('intrest'),
                'IdNumber'      =>Input::get('IdNumber'),
                'location'      =>Input::get('location'),
                'travel_radius' =>Input::get('travel_radius'),
                'description_of_acces'=> Input::get('description_of_acces'),
            ),

            array(
                'name'          =>array('required','alpha','min:3'),
                'surname'       =>array('required','alpha','min:3'),
                'emails'        =>array('required','email','unique:new_users,email'),
                'intrest'       =>array('required','alpha'),
                'cell'          =>array('required','unique:new_users,cellphone','regex:/^[0-9]+$/','max:10','min:10'),
                'IdNumber'      =>array('required','unique:new_users,idNumber','regex:/^[0-9]+$/','max:13','min:13'),
                'location'      =>array('required'),
                'travel_radius' =>array('required'),
                'description_of_acces'=>array('required'),
            ),

            array(

                'name.required'         =>'The Name field is required',
                'surname.required'      =>'The Surname field is required',
                'intrest.required'      =>'Please select group',
                'cell.required'         =>'The Phone Number field is required',
                'cell.unique'           =>'This Phone Number is allready taken',
                'emails.required'       =>'The Email field is required',
                'emails.unique'         =>'This Email is allready taken',
                'travel_radius.required'=>'Please select Notification Radius',
                'IdNumber.required'     =>'The Identity Number field is required',
                'IdNumber.unique'       =>'This Identity Number is allready taken',
                'description_of_acces.required'=>'Please select mode of transport',

            )


        );


//        if ( $validator->fails() ) {
//            $resposse = array();
//
//            $errors=$validator->messages();
//
//            foreach ( $errors->all() as $error ) {
//                $resposse["Erro"] =  $error;
//                return response()->json($resposse);
//            }
//
//        }

        if ($validator->fails()) {
            return redirect('doRegister')
                ->withErrors($validator)
                ->withInput();
        }


//        if ( ! empty( $errors ) ) {
//
//        }

        function generateRandomString($length = 24) {
            return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        }
        $name                   =  Input::get('name') ;
        $surname                =  Input::get('surname') ;
        $email                  =  Input::get('emails') ;

        $userRoleId             = UserRoles::where('name',Input::get('intrest'))->first();
        $intrest                =  $userRoleId['id'] ;


        $cellphone              = Input::get('cell');
        $idNumber               = Input::get('IdNumber');
        $location               =  Input::get('location') ;

        $userTravelRadId        = UserTravelRadius::where('kilometres',Input::get('travel_radius'))->first();
        $travel_radius          =  $userTravelRadId['id'] ;

        $description_of_acces   =  Input::get('description_of_acces');
        $gps_lat                =  Input::get('gps_lat');
        $gps_long               =  Input::get('gps_long');
        $lat   = null  ;
        $long  =null ;
        if ($gps_lat==null)
        {
            $lat   = "-937538943";
        }
        else
        {

            $lat = Input::get('gps_lat');
        }

        if ($gps_long==null)
        {
            $long = "937538943";

        }
        else

        {
            $long  = Input::get('gps_long');

        }

        $NewUser    =   new   NewUser  () ;
        $NewUser->   active                 = 1;
        $NewUser->  gps_lat                 = $lat ;
        $NewUser->  gps_long                = $long;
        $NewUser->profilePicture           ="http://system.foodforus.cloud/public/img/default-user-image.png";
        $NewUser->  name                 = $name ;
        $NewUser->  email                = $email ;
        $NewUser->  intrest              = $intrest;
        $NewUser->  surname              = $surname ;
        $NewUser-> cellphone             = $cellphone;
        $NewUser->idNumber               = $idNumber;
        $NewUser->  location             = $location;


        $NewUser->  descriptionOfAcces = $description_of_acces ;

        $NewUser->  travelRadius        =  $travel_radius ;
        $NewUser->  password             =  rand(1,9999);
        $NewUser->  api_key                =  generateRandomString() ;
        $NewUser->  descriptionOfAcces  = $description_of_acces ;

        $NewUser-> save() ;

        $defaultLocation               = new UserDefaultLocation();
        $defaultLocation->userId       = $NewUser->id;
        $defaultLocation->gps_lat      = $lat;
        $defaultLocation->gps_long     = $long;
        $defaultLocation->save();

        $adminUsers                 = new User();
        $adminUsers->name           = $name;
        $adminUsers->new_user_id    = $NewUser->id;
        $adminUsers->surname        = $surname;
        $adminUsers->gender         = "none";
        $adminUsers->cellphone      = $cellphone;
        $adminUsers->email          = $email;
        $adminUsers->password       = bcrypt($NewUser->password);
        $adminUsers->role           = "mobile-user";
        $adminUsers->created_by     = $name . ' ' . $surname  ;
        $adminUsers->save();

        $message= "Food For us";
        $data = array(

            'name'      =>      $NewUser->name,
            'surname'   =>      $NewUser->surname,
            'email'     =>      $NewUser->email,
            'password' =>       $NewUser->password,
            'surname' =>        $NewUser->surname,
            'content'   =>      $message
        );

        \Mail::send('emails.registration', $data, function ($message) use ($NewUser) {

            $message->from('Info@FoodForUs.cloud', 'Food For us');
            $message->to($NewUser->email)->subject("Registration Notification ");
        });

        \Mail::send('emails.adminRegNotification', $data, function ($message) use ($NewUser) {

            $message->from('Info@FoodForUs.cloud', 'Food For us');
            $message->to("mozaamisi93@gmail.com")->subject("Registration Notification ");
        });

        \Session::flash('success', 'well done! Registered successfully, Check your email for login credentials');

        $success="Thanks for filling out form your account successfully created please";
        return Redirect('/dologin',compact('success'));

//        $respose = array();
//        $respose ['mesg']="Ok";
        //$respose['mesg'] = "successfully registered  please  wait   or  approval ";
//        return response()->json($respose);


    }

    public function getUser($id)
    {

        $user     = NewUser::where('id',$id)->first();
        return view('users.editUser', compact('user'));
    }

    public function updateNewUser($id,Request $request)
    {
        NewUser::where('id',$id)
            ->update(['name'=>$request['name'],
                'surname'=>$request['surname'],
                'email'=>$request['email'],
                'cellphone'=>$request['cellphone'],
                'updated_at'=>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);

        if($request['lat']!=NULL)
        {
            NewUser::where('id',$id)
                ->update(['gps_lat'=>$request['lat'],
                    'gps_long'=>$request['lng'],
                    'location'=>$request['address'],
                    'updated_at'=>\Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString()]);
        }

        return Redirect('/users');

    }

    public function viewAdmin($id)
        {
            $admin  = User::where('id',$id)->first();
            return view('admin.editAdmin', compact('admin'));

        }
    public function updateAdmin(EditAdminRequest $id)
    {
        $user                              = User::where('id',$id)->first();
//        $user                              = User::where('id',$request['userID'])->first();
        $admin                             = User::where('id',$user->id)->first();
        $admin->name                        =Input::get('name');
        $admin->surname                     = Input::get('surname');
        $admin->email                       =Input::get('email');
        $admin->cellphone                   = Input::get('cellphone');
        $admin->updated_at                  = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
        $admin->save();
        
        return Redirect('/adminUser');

    }
    public function updateProfile(Request $request)
      {

          $input           =  $request->all();
          $user            =  NewUser::where('api_key',$input['api_key'])->first();

          if($request->email == NULL)
          {
              $email = $user->email;
          }
          else{
              $email = $request->email;
          }

          if($request->cellphone == NULL)
          {
              $cellphone = $user->cellphone;
          }
          else{
              $cellphone = $request->cellphone;
          }

          if($request->idNumber == NULL)
          {
              $idNumber = $user->idNumber;
          }
          else{
              $idNumber = $request->idNumber;
          }

          if($request->hasFile('profilePicture'))
          {
              $img                =  $request->file('profilePicture');
              $destinationFolder  = 'profilePictures/'.$user['name'].'_'.$user['surname'].'_'.$user['id'];

              if(!\File::exists($destinationFolder))
              {
                  \File::makeDirectory($destinationFolder,0777,true);
              }

              $name      = $img->getClientOriginalName();
                           $img->move($destinationFolder,$name);

              $newProPicture  =  env('APP_URL').$destinationFolder.'/'.$name;
              $user->update(['profilePicture'=>$newProPicture,
                  'email'=>$email,
                  'cellphone'=>$cellphone,
                  'idNumber'=>$idNumber]);
          }
          return $user;
      }

    public function updateInterest()
    {
        $response = array();

        $api_key = Input::get('api_key');

        $user   =  NewUser::where('api_key',$api_key)->first();

        $productsInterest = array(Input::get('productInterest1'),Input::get('productInterest2'),Input::get('productInterest3'));

        for($i=0 ; $i < count($productsInterest) ; $i++)
        {
            if($productsInterest[$i]!=null)
            {
                $productID = ProductType::where('name',$productsInterest[$i])->first();

                $exist = ProductInterest::where('new_user_id',$user->id)
                    ->where('ProductInterestID',$productID->id)->first();

                if($exist==null)
                {
                    $newProductInterest=new ProductInterest();
                    $newProductInterest->new_user_id = $user->id;
                    $newProductInterest->ProductInterestID = $productID->id;
                    $newProductInterest->active = 1;
                    $newProductInterest->save();
                }
            }
        }

        $response['message'] = "Successfully updated product interest";

        return response()->json($response);
    }

      public function updatePlayeId()
      {
          $response = array();

          $api_key = Input::get('api_key');

          $PlayeId = Input::get('playerID');

          $user  = NewUser::where('api_key',$api_key)
              ->update(['playerID'=>$PlayeId]);

          $response['message'] = "Successfully updated player ID";

          return response()->json($response);
      }

    public function updateAppUserProfile()
    {

        $api_key = Input::get('api_key');

        $user  = NewUser::where('api_key',$api_key)->first();

        $file = Input::file('file');


        $destinationFolder = "images/".$user->name."_".$user->surname."_".$user->id."/";

        if(!\File::exists($destinationFolder))
        {
            \File::makeDirectory($destinationFolder,0777,true);
        }

        $nameor=$file->getClientOriginalName();
        $name=str_replace(' ','_',$nameor);

        $file->move($destinationFolder,$name) ;

            $user = NewUser::where('api_key', $api_key)
                ->update(['profilePicture' => env('APP_URL').$destinationFolder.'/'.$name,
                    'updated_at' => \Carbon\Carbon::now('Africa/Johannesburg')
                        ->toDateTimeString()]);

        $userPost = NewUser::where('api_key', $api_key)->first();
        return  response()->json($userPost);

    }
    public function viewLogins($id)
    {
        $allLogins = ManageLogin::where('new_user_id',$id)->with('User')->orderBy('created_at','ASC')->get();

        if($allLogins->count()==0)
        {
            $user = NewUser::find($id);

            return view('ManageLogins.loginsNotFound', compact('user'));
//            return "not found";
        }
        else {
            $showLogins = ManageLogin::with('User')->where('new_user_id', $id)->get()->last();
            $user = NewUser::find($showLogins->new_user_id);

            return view('ManageLogins.viewLogins', compact('allLogins', 'showLogins', 'user'));
        }
    }

    public function userProfile($id)
    {
        $user = NewUser::find($id);

        return view('users.userProfile', compact('user'));
    }

    public function getUsers() {
        $searchString = \Input::get('q');
        $users        = \DB::table('new_users')
            ->whereRaw(
                "CONCAT(`new_users`.`name`, ' ', `new_users`.`surname`) LIKE '%{$searchString}%'")
            ->select(
                array
                (
                    'new_users.id as id',
                    'new_users.name as name',
                    'new_users.surname as surname',
                )
            )
            ->get();
        $data = array();
        foreach ($users as $user) {
            $data[] = array(
                "name" => "{$user->name} > {$user->surname}",
                "id"   => "{$user->id}",
            );
        }
        return $data;
    }


}





