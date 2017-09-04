<?php

namespace App\Http\Controllers;

use App\PublicWall;
use App\User;
use Illuminate\Http\Request;
use App\NewUser  ;
use App\UserRoles;
use App\UserTravelRadius;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\Null_;
use Redirect;

class UsersController extends Controller
{


    public function index()
    {

        $userList = NewUser::with('UserStatuses')->with('UserRole')->with('UserTravelRadius')->get();

        return response()->json($userList);
    }



    public function myProfile()
    {
        $api_key   = Input::get('api_key');

        $user  = NewUser::where('api_key',$api_key)->first();

        return response()->json($user);
    }


    public function forgot()
    {

        $response = array();
        $email = Input::get('emails');

        $userNew = NewUser::where('email', '=', $email)->first();


        if (sizeof($userNew) > 0) {

            $userNew->password = "newpassword";
            $userNew->save();
            $message = "your  new  password  is  ";
            $response["error"] = false;
            $data = array(

                'name' => $userNew->name,
                'passsword' => $userNew->password,
                'content' => $message

            );


            \Mail::send('emails.resetpassword', $data, function ($message) use ($userNew) {
                $message->from('info@foodorus', 'Food For us');
                $message->to($userNew->email)->subject("Food  for  us ");

            });

            $response["message"] = "You have successfully changed your password check  your  email";


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
                $response["msg"]    = "your  acount  is Not Acive";
            }
            //   \Log::info("Login Device:".$device.", User Cell:".$cell.", User Names:".$data->name);

        } else {


            $response['error']   = true;
            $response['error'] = true;
            $response['msg'] = "faild";
            $response['message'] = 'Login failed. Incorrect credentials';


        }

        return \Response::json($response);
    }
/*
    public function create()
    {


        $name = Input::get('name');
        $surname = Input::get('surname');
        $email = Input::get('emails');
        $intrest = Input::get('intrest');
        $location = Input::get('location');
        $travel_radius = Input::get('travel_radius');
        $description_of_acces = Input::get('description_of_acces');
        $gps_lat = Input::get('gps_lat');
        $gps_long = Input::get('gps_long');

        $NewUser = new   NewUser  ();
        $NewUser->active = 1;
        $NewUser->gps_lat = $gps_lat;
        $NewUser->gps_long = $gps_long;

        $NewUser->name = $name;
        $NewUser->email = $email;
        $NewUser->intrest = $intrest;
        $NewUser->surname = $surname;
        $NewUser->location = $location;
        $NewUser->travel_radius = $travel_radius;
        $NewUser->password = "1234";
        $NewUser->api_key = "xdwq213432435434bb4yyyyyyyy4";
        $NewUser->description_of_acces = $description_of_acces;
        $NewUser->save();

        $response["error"] = false;
        $message = "you  been  registered Sucfully ";
        $data = array(

            'name' => $NewUser->name,
            'passsword' => $NewUser->password,
            'content' => $message

        );


//        \Mail::send('emails.resetpassword', $data, function ($message) use ($NewUser) {
//            $message->from('info@foodorus', 'Food For us');
//            $message->to($NewUser->email)->subject("Registration Notification ");
//
//        });

        $respose = array();
        $respose['error'] = false;
        $respose['mesg'] = "successfully registered  please  wait  for  approval ";
        return response()->json($respose);


    }*/

    public function updateUser($id)
    {
		
		
         $user = NewUser::where('id',$id)
              ->update(['active'=>2]);

         $userDetails = NewUser::find($id);

          $data=array(
           'name' =>$userDetails->name,
           'message' =>"",
           //'sender' =>\Auth::user()->name. ' '. \Auth::user()->surname,
                    );

        \Mail::send('emails.transactions', $data, function ($message) use ($userDetails) {

            $message->from('info@siyaleader.net', 'Siyaleader');
            $message->to($userDetails->email)->subject("Siyaleader Notification - Request for Case Closure: ");

        });



        return Redirect::to('/users');
	}


    public function inactivateUser($id)
    {
        $user = NewUser::where('id',$id)
            ->update(['active'=>1]);

        $userDetails = NewUser::find($id);

        $data=array(
            'name' =>$userDetails->name,
            'message' =>"",
            //'sender' =>\Auth::user()->name. ' '. \Auth::user()->surname,
                 );

        \Mail::send('emails.activation', $data, function ($message) use ($userDetails) {

            $message->from('info@siyaleader.net', 'Siyaleader');
            $message->to($userDetails->email)->subject("Siyaleader Notification - Request for Case Closure: ");

                   });
        return Redirect::to('/users');
    }

    public  function   create  ()   {

	
	

    
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

        $NewUser    =   new   NewUser  () ;
        $NewUser->   active                 = 1;
        $NewUser->  gps_lat                 = $gps_lat ;
        $NewUser->  gps_long                = $gps_long ;
        $NewUser->profilePicture           ="http://154.0.164.72:8080/Foods/images/default.jpg";
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
        $message= "Food For us";
        $data = array(

            'name'      =>      $NewUser->name,
            'passsword' =>      $NewUser->password,
            'content'   =>      $message,
                     );

      \Mail::send('emails.resetpassword', $data, function ($message) use ($NewUser) {
             $message->from('info@foodorus', 'Food For us');
           $message->to($NewUser->email)->subject("Registration Notification ");
       });

      

        $respose = array();
        $respose['error'] ="ok";
        $respose['mesg'] = "successfully registered  please  wait  for  approval ";
        return response()->json($respose);


    }

//    public function getTravelRadius()
//    {
//
//        $radius     = UserTravelRadius::select('','kilometres')->get();
//        return response()->json($radius);
//    }

        public function viewAdmin($id)
        {
            $admin  = User::where('id',$id)->first();



       return view('admin.editAdmin', compact('admin'));

        }

    public function updateAdmin($id)
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

        return view('admin.editAdmin', compact('admin'));

    }


}
