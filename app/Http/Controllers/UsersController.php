<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewUser  ;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\Null_;

class UsersController extends Controller
{


    public  function  index () {

        $userList  =  NewUser::all () ;
        return  response()->json($userList) ;
    }


    public  function   login  ()   {

        $response = array();
          $email       =      Input::get('emails') ;
          $password    =      Input::get('password') ;


           if(Input::get('emails')  == Null || Input::get('password') == null   )

           {

               return   $response['msg']   = "wrong  user name or  password" ;
           }

        $data =   NewUser::where('email', $email)
                 ->where('password', $password)

                 ->first();


        if (sizeof($data) > 0 ) {

            $key = $data->api_key;


        }
        else {

            $key = "no key";
        }


        if (sizeof($data) > 0 ) {

            if ($data->active == 1)
            {
            $response["error"] = false;
            $response['name'] = $data->name;
            $response['email'] = $data->email;
            $response['intrest'] = $data->intrest;
            $response['apiKey'] = $data->api_key;
            $response['createdAt'] = $data->created_at;
           }
           else{


               $response["error"] = false;
               $response["msg"] =  "your  acount  is Not Acive";
         }
         //   \Log::info("Login Device:".$device.", User Cell:".$cell.", User Names:".$data->name);

        }
        else {

            $response['error']   = true;
            $response['message'] = 'Login failed. Incorrect credentials';


        }

        return \Response::json($response);








    }




    public  function   create  ()   {


        $name                   =  Input::get('name') ;
        $surname                =  Input::get('surname') ;
        $email                  =  Input::get('emails') ;
        $intrest                =  Input::get('intrest') ;
        $location               =  Input::get('location') ;
        $travel_radius          =  Input::get('travel_radius') ;
        $description_of_acces   =  Input::get('description_of_acces');

        $NewUser    =   new   NewUser  () ;
        $NewUser->   active                 = 1;

        $NewUser->  name                 = $name ;
        $NewUser->  email                = $email ;
        $NewUser->  intrest              = $intrest;
        $NewUser->  surname              = $surname ;
        $NewUser->  location             = $location;
        $NewUser->  travel_radius        =  $travel_radius ;
        $NewUser->  password        =   "1234" ;
        $NewUser->  description_of_acces  = $description_of_acces ;
        $NewUser-> save() ;

         $respose =  array() ;
         $respose['mesg']   =  "successfully registered  wait  for  approval " ;
        return  response()->json($respose);



    }
}
