<?php

namespace App\Http\Controllers;
use  App\NewUser ;
use App\Reseachers_details_tabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class ResearchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $respond=array();

        $api_key   = Input::get('api_key');

        $user  = NewUser::where('api_key',$api_key)->first();

        if($user!=NULL)
        {
            $sellers_tabs=Reseachers_details_tabs::where('new_user_id',$user->id)->get();

            return  response()->json($sellers_tabs) ;
        }
        else
        {
            $respond['msg']="No Api key found";

            $respond['error']=true;

            return response()->json($respond);
        }
    }

    public function allResearchs()
    {
        $all_researchs=Reseachers_details_tabs::all();
        return response()->json($all_researchs);
    }

    public function researchList()
    {
        return view('Researchers.index');
    }
    public function allResearchList()
    {
        $all_research=Reseachers_details_tabs::all();
//        $all_research=\DB::table('reseachers_details_tabs')
//            ->select(
//                \DB::raw(
//                    "
//                        reseachers_details_tabs.id,
//                        reseachers_details_tabs.natureOfBusiness,
//                        reseachers_details_tabs.summaryBox,
//                        reseachers_details_tabs.researchNotes,
//                        reseachers_details_tabs.created_at,
//                        "
//                )
//            )
//            ->orderBy('created_at' ,'desc')	->get();

        return Datatables::of($all_research)
            ->make(true);
    }

    public function researchProfile($id)
    {
        $research = Reseachers_details_tabs::find($id);
        return view('Researchers.profile',compact('research'));
    }

    public function viewResearch()
    {
        $id = Input::get('id');

        $research = Reseachers_details_tabs::find($id);
        return $research;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
	///	$file=$request->file('file');
		///return $file->getClientOriginalName();
	//	;
		
		
\Log::info($file=$request->file);
        $user  = NewUser::where('api_key',$request->api_key)->first();
    
        $researcherPost = new Reseachers_details_tabs();
        $researcherPost->new_user_id = $user->id;
        $name =$user->name;
        $surname=$user->surname;
		$id=$user->id;
	
        $img=$request->file('file');
	
        $destinationFolder = "images/".$name."_".$surname."_".$id."/";

        if(!\File::exists($destinationFolder)) {
            \File::makeDirectory($destinationFolder,0777,true);
        }

        $name =    $img->getClientOriginalName();
		


         $img->move($destinationFolder,$name) ;

        $researcherPost->imageUrl = env('APP_URL').$destinationFolder.'/'.$name;

		$researcherPost->gps_long= $request->gps_long;
		$researcherPost->gps_lat= $request->gps_lat;
        $researcherPost->researchNotes=  $request->researchNotes;
		$researcherPost->summaryBox= $request->summaryBox;
		$researcherPost->natureOfBusiness = $request->natureOfBusiness;
        $researcherPost->save();
   

        return response()->json($researcherPost);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * App\Flight::where('active', 1)
    ->where('destination', 'San Diego')
    ->update(['delayed' => 1]);
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }
}
