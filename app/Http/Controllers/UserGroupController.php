<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use App\UserGroup;
use App\NewUser;

class UserGroupController extends Controller
{
    public function index($id)
    {
        $users = \DB::table('user_groups')
            ->where('user_groups.group_id','=',$id)
            ->join('groups', 'groups.id', '=', 'user_groups.group_id')
            ->join('new_users', 'new_users.id', '=', 'user_groups.new_user_id')
            ->select(
                \DB::raw("
                                            DISTINCT(new_users.id),
                                            new_users.name,
                                            new_users.surname,
                                            user_groups.active
                                        ")
            )
            ->where('user_groups.active','=',1)
            ->orderBy('new_users.name','asc')
            ->get();

        $group = Group::where('id',$id)->first();

        return view('UserGroup.index',compact('users','group'));
    }
    public function create($id)
    {
        $group = Group::where('id',$id)->first();

        return view('UserGroup.create',compact('group'));
    }
    public function store(Request $request)
    {
        $Users=explode(",",$request->user_id);

        for($i=0 ; $i < count($Users) ; $i++)
        {
            $userExist = UserGroup::where('new_user_id',$Users[$i])
                ->where('group_id',$request->group_id)
                ->first();

            if($userExist!=Null)
            {
                UserGroup::where('new_user_id',$Users[$i])
                    ->where('group_id',$request->group_id)
                    ->update(['active'=>1]);
            }
            else
            {
                $groupUser = new UserGroup();
                $groupUser->group_id = $request->group_id;
                $groupUser->new_user_id = ($Users[$i]);
                $groupUser->save();
            }
        };
        \Session::flash('success', 'well done! '.count($Users).' Users successfully added to the group!');
        return Redirect('/groupUsers/'.$request->group_id);
    }
    public function destroy($id,$group_id)
    {
         $users = UserGroup::where('new_user_id',$id)
             ->where('group_id',$group_id)
             ->get();

        $oneUser = NewUser::where('id',$id)->first();

        $num = count($users);

        for($i=0 ; $i < $num ; $i++)
        {
            UserGroup::where('new_user_id',$id)
                ->where('group_id',$group_id)
                ->update(['active'=>0]);
        }
        \Session::flash('success', 'well done! '.$oneUser->name.' '.$oneUser->surname.' successfully removed from the group!');
        return Redirect('/groupUsers/'.$group_id);
    }
    public function createRadius($id)
    {
        $group = Group::where('id',$id)->first();

        return view('UserGroup.createRadius',compact('group'));
    }
    public function storeRadius(Request $request)
    {
        $lng = $request->lng;
        $lat = $request->lat;
        $radius = $request->radius;

        if($radius==0)
        {
            $Users = \DB::table('new_users')
                ->select(
                    \DB::raw(
                        "
                    id,
                    playerID,
                    name,
                    surname,
                    gps_lat,
                    gps_long,
                    ( 3959 * acos ( cos ( radians(" . $lat . ") ) * cos( radians( gps_lat ) ) * cos( radians( gps_long ) - radians(" . $lng . ") ) + sin ( radians(" . $lat . ") ) * sin( radians( gps_lat ) ) ) ) AS distance
                    "
                    )
                )
                ->get();

            for ($i = 0; $i < count($Users); $i++)
            {
                $userExist = UserGroup::where('new_user_id',$Users[$i]->id)
                    ->where('group_id',$request->group_id)
                    ->first();

                if($userExist!=Null)
                {
                    UserGroup::where('new_user_id',$Users[$i]->id)
                        ->where('group_id',$request->group_id)
                        ->update(['active'=>1]);
                }
                else
                {
                    $groupUser = new UserGroup();
                    $groupUser->group_id = $request->group_id;
                    $groupUser->new_user_id = ($Users[$i]->id);
                    $groupUser->save();
                }
            }
            \Session::flash('success', 'well done! Users successfully added to the group!');
            return Redirect('/groupUsers/'.$request->group_id);
        }
        else
            {
                $Users = \DB::table('new_users')
                    ->select(
                        \DB::raw(
                            "
                    id,
                    playerID,
                    name,
                    surname,
                    gps_lat,
                    gps_long,
                    ( 3959 * acos ( cos ( radians(" . $lat . ") ) * cos( radians( gps_lat ) ) * cos( radians( gps_long ) - radians(" . $lng . ") ) + sin ( radians(" . $lat . ") ) * sin( radians( gps_lat ) ) ) ) AS distance
                    "
                        )
                    )
                    ->having('distance', '<', $radius)
                    ->get();

                for ($i = 0; $i < count($Users); $i++)
                {
                    $userExist = UserGroup::where('new_user_id',$Users[$i]->id)
                        ->where('group_id',$request->group_id)
                        ->first();

                    if($userExist!=Null)
                    {
                        UserGroup::where('new_user_id',$Users[$i]->id)
                            ->where('group_id',$request->group_id)
                            ->update(['active'=>1]);
                    }
                    else
                    {
                        $groupUser = new UserGroup();
                        $groupUser->group_id = $request->group_id;
                        $groupUser->new_user_id = ($Users[$i]->id);
                        $groupUser->save();
                    }
                }
                \Session::flash('success', 'well done! Users successfully added to the group!');
                return Redirect('/groupUsers/'.$request->group_id);
        }
    }
}
