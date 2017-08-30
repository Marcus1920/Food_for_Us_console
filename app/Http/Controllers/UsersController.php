<?php

namespace App\Http\Controllers;

use App\PublicWall;
use Illuminate\Http\Request;
use App\NewUser  ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\Null_;
use Redirect;

class UsersController extends Controller
{


    public function index()
    {

        $userList = PublicWall::all();
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
            $response["error"] = false;
            $response['name'] = $data->name;
            $response['email'] = $data->email;
            $response['intrest'] = $data->intrest;
            $response['apiKey'] = $data->api_key;
            $response['createdAt'] = $data->created_at;
			 $response['active'] =2;
			  $response["msg"] =  "ok";
           }
           else{


               $response["error"] = false;
			   $response['active'] =2;
               $response["msg"] =  "notactive";
         }
         //   \Log::info("Login Device:".$device.", User Cell:".$cell.", User Names:".$data->name);

            if ($data->active == 2) {
                $response["error"] = false;
                $response['name'] = $data->name;
                $response['email'] = $data->email;
                $response['intrest'] = $data->intrest;
                $response['apiKey'] = $data->api_key;
                $response['createdAt'] = $data->created_at;
                $response['active'] = 2;
            } else {



                $response["error"] = true;
                $response['active'] = 1;
                $response["msg"] = "your  acount  is Not Acive";
            }
            //   \Log::info("Login Device:".$device.", User Cell:".$cell.", User Names:".$data->name);

        } else {

            $response['error'] = true;
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

        \Mail::send('emails.activation', $data, function ($message) use ($userDetails) {

            $message->from('info@siyaleader.net', 'Siyaleader');
            $message->to($userDetails->email)->subject("Siyaleader Notification - Request for Case Closure: ");

        });



        return Redirect::to('/users');
	}
    public  function   create  ()   {


        $name                   =  Input::get('name') ;
        $surname                =  Input::get('surname') ;
        $email                  =  Input::get('emails') ;
        $intrest                =  Input::get('intrest') ;
        $location               =  Input::get('location') ;
        $travel_radius          =  Input::get('travel_radius') ;
        $description_of_acces   =  Input::get('description_of_acces');
        $gps_lat                =  Input::get('gps_lat');
        $gps_long                =  Input::get('gps_long');

        $NewUser    =   new   NewUser  () ;
        $NewUser->   active                 = 1;
        $NewUser->  gps_lat                 = $gps_lat ;
        $NewUser->  gps_long                = $gps_long ;

        $NewUser->  name                 = $name ;
        $NewUser->  email                = $email ;
        $NewUser->  intrest              = $intrest;
        $NewUser->  surname              = $surname ;
        $NewUser->  location             = $location;
        $NewUser->  travel_radius        =  $travel_radius ;
        $NewUser->  password             =  "1234" ;
        $NewUser->  api_key                = "xdwq213432435434bb4yyyyyyyy4";
        $NewUser->  description_of_acces  = $description_of_acces ;
        $NewUser-> save() ;

        $data = array(

            'name' => $NewUser->name,
            'passsword' => $NewUser -> password  ,
            'content' =>  $message,

        );

      \Mail::send('emails.resetpassword', $data, function ($message) use ($NewUser) {
             $message->from('info@foodorus', 'Food For us');
           $message->to($NewUser->email)->subject("Registration Notification ");
       });

        \Mail::send('emails.activation', $data, function ($message) use ($userDetails) {

            $message->from('info@siyaleader.net', 'Siyaleader');
            $message->to($userDetails->email)->subject("Siyaleader Notification - Request for Case Closure: ");

        });




        return Redirect::to('/users');
//        $user=NewUser::where('id',$id);
//        $user->name     =Input::get('name');
//        $user->surname   =Input::get('surname');
//        $user->interest  =Input::get('Interest');
//        $user->travel_radious       =Input::get('travel_radious ');
//        $user->description     =Input::get('description  ');
//        $user->location       =Input::get('location');
//        session::flash('successfull updated');
//        return view::make('users.edit')
//            ->update(['active'=>2])
//            ->with('user',$user);

    }


}
