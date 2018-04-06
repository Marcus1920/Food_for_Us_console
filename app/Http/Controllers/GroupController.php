<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::select('id','name')
            ->where('status',1)
            ->orderBy('id','DESC')->get();
        return view('Group.index', compact('groups'));
    }

    public function create()
    {
        return view('Group.create');
    }

    public function store(Request $request)
    {
        $newGroup = new Group();
        $newGroup->name = $request->name;
        $newGroup->save();

        \Session::flash('success', 'well done! Successfully created '.$request->name.' group!');
        return Redirect('/group');
    }

    public function edit($id)
    {
        $group = Group::where('id',$id)->first();
        return view('Group.edit',compact('group'));
    }

    public function update($id,Request $request)
    {
        Group::where('id',$id)
            ->update(['name'=>$request['name']]);

        return Redirect('/group');
    }

    public function remove($id)
    {
        $groupName = Group::where('id',$id)
            ->first();

        Group::where('id',$id)
            ->update(['status'=>0]);

        \Session::flash('success', 'well done! Successfully removed '.$groupName->name.' group!');
        return Redirect('/group');
    }

    public function getGroup()
    {
        $searchString = \Input::get('q');
        $users        = \DB::table('groups')
            ->whereRaw(
                "CONCAT(`groups`.`name`) LIKE '%{$searchString}%'")
            ->select(
                array
                (
                    'groups.id as id',
                    'groups.name as name',
                )
            )
            ->get();
        $data = array();
        foreach ($users as $user) {
            $data[] = array(
                "name" => "{$user->name}",
                "id"   => "{$user->id}",
            );
        }
        return $data;
    }

}
