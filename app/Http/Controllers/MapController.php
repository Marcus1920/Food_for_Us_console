<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use App\Sellers_details_tabs;
use App\NewUser;

class MapController extends Controller
{
    public  function   GetSellersPosts()
    {
        $latitude=-29;
        $longitude=24;

        $map = Mapper::map($latitude, $longitude,['clusters' => ['size' => 2, 'center' => true, 'zoom' => 20],'zoom'=>6,'marker' => false]);

        $sellersPosts=Sellers_details_tabs::with('Packaging')->get();

        $productTypes=ProductType::all();

        foreach ($sellersPosts as $sellersPost) {

            $content = "<div style='color:black'>
                      <tr>
                      <td><b>Post Number</b>&nbsp; : </td><td>$sellersPost->id</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><img src=$sellersPost->product_picture style='height: 250px;width: 300px;'></td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Cost Per Kg :</b>&nbsp; </td><td>R $sellersPost->cost_per_kg</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Description : </b></td><td>$sellersPost->description</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Packaging :</b>&nbsp; </td><td>{$sellersPost->Packaging->name}</td>
                      </tr>
                      <br/>
                       <tr>
                      <td><b>Location :</b>&nbsp; </td><td>$sellersPost->location</td>
                      </tr>
                      </div>";

            $images='img/Markers/'.$sellersPost->productType.'.png';

            $map->informationWindow($sellersPost->gps_lat, $sellersPost->gps_long, $content, ['animation' => 'DROP','draggable'=>'true','icon'=>$images]);
        }

        return   view  ('map.map1',compact('latitude','longitude','productTypes'));
    }

    public  function   searchByProductType(Request $request)
    {
        $latitude=-29;
        $longitude=24;

        $map = Mapper::map($latitude, $longitude,['clusters' => ['size' => 2, 'center' => true, 'zoom' => 20],'zoom'=>6,'marker' => false]);

        $sellersPosts=Sellers_details_tabs::where('productType',$request['productTypeId'])->get();

        $productTypes=ProductType::all();

        foreach ($sellersPosts as $sellersPost) {

            $content = "<div style='color:black'>
                      <tr>
                      <td><b>Post Number</b>&nbsp; : </td><td>$sellersPost->id</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><img src=$sellersPost->productPicture style='height: 250px;width: 300px;'></td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Cost Per Kg :</b>&nbsp; </td><td>R $sellersPost->costPerKg</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Description : </b></td><td>$sellersPost->description</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Packaging :</b>&nbsp; </td><td>$sellersPost->packaging</td>
                      </tr>
                      </div>";

            $images='img/Markers/'.$sellersPost->productType.'.png';

            $map->informationWindow($sellersPost->gps_lat, $sellersPost->gps_long, $content, ['animation' => 'DROP','draggable'=>'true','icon'=>$images]);
        }

        return   view  ('map.map1',compact('latitude','longitude','productTypes'));
    }

    public  function   GetUsers()
    {
        $latitude=-29;
        $longitude=24;

        $map = Mapper::map($latitude, $longitude,['clusters' => ['size' => 2, 'center' => true, 'zoom' => 20],'zoom'=>6,'marker' => false]);

        $users=NewUser::all();

        $suppliers=NewUser::where('intrest','Supplier')->get();
        $sellers=NewUser::where('intrest','Seller')->get();
        $buyers=NewUser::where('intrest','Buyers')->get();
        $reseachers=NewUser::where('intrest','Researcher')->get();

        foreach ($users as $user) {

            $content = "<div style='color:black'>
                      <tr>
                      <td><img src=$user->profilePicture style='height: 250px;width: 300px;'></td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Name</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </td><td>$user->name</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Surname</b> : </td><td>$user->surname</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Email</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </td><td>$user->email</td>
                      </tr>
                      <br/>
                      <td><b>Location </b>:</td><td>$user->location</td>
                      </div>";

            if($user->intrest==1)
            {
                $images='img/Markers/27.png';
            }
            else if($user->intrest==2)
            {
                $images='img/Markers/28.png';
            }
            else if($user->intrest==3)
            {
                $images='img/Markers/29.png';
            }
            else if($user->intrest==4)
            {
                $images='img/Markers/30.png';
            }

            $map->informationWindow($user->gps_lat, $user->gps_long, $content, ['animation' => 'DROP','draggable'=>'true','icon'=>$images]);
        }

        return   view  ('map.map',compact('latitude','longitude','suppliers','sellers','buyers','reseachers'));
    }

    public  function   GetUsersByType(Request $request)
    {
        $latitude=-29;
        $longitude=24;

        $map = Mapper::map($latitude, $longitude,['clusters' => ['size' => 2, 'center' => true, 'zoom' => 20],'zoom'=>6,'marker' => false]);

        $users=NewUser::where('intrest',$request['intrest'])->get();

        $suppliers=NewUser::where('intrest',1)->get();
        $sellers=NewUser::where('intrest',2)->get();
        $buyers=NewUser::where('intrest',3)->get();
        $reseachers=NewUser::where('intrest',4)->get();

        foreach ($users as $user) {

            $content = "<div style='color:black'>
                      <tr>
                      <td><b>Name</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </td><td>$user->name</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Surname</b> : </td><td>$user->surname</td>
                      </tr>
                      <br/>
                      <tr>
                      <td><b>Email</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </td><td>$user->email</td>
                      </tr>
                      <br/>
                      <td><b>Location </b>:</td><td>$user->location</td>
                      </div>";

            if($user->intrest==1)
            {
                $images='img/Markers/27.png';
            }
            else if($user->intrest==2)
            {
                $images='img/Markers/28.png';
            }
            else if($user->intrest==3)
            {
                $images='img/Markers/29.png';
            }
            else if($user->intrest==4)
            {
                $images='img/Markers/30.png';
            }

            $map->informationWindow($user->gps_lat, $user->gps_long, $content, ['animation' => 'DROP','draggable'=>'true','icon'=>$images]);
        }

        return   view  ('map.map',compact('latitude','longitude','suppliers','sellers','buyers','reseachers'));
    }

}
