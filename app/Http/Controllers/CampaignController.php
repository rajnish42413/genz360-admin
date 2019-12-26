<?php

namespace App\Http\Controllers;

use App\Campaign;
use DataTables;
use App\Influencer;
use App\InfluncerInvolved;
use App\Location;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
             $data = Campaign::get();
             return Datatables::of($data)
                     ->addIndexColumn()
                     ->addColumn('action', function($row){
                         $btn = '<a href="campaigns/'.$row['campaign_id'].'/influencers" class="edit btn btn-primary btn-sm">View Influencers</a>';
                             return $btn;
                       })
                     ->rawColumns(['action'])
                     ->make(true);
               }
             
         return view('campaign');
    }
    public function influencer(Request $request,$camp)
    {
        $campaign = Campaign::find($camp);



        if (!$campaign) {
            abort(404);
        }

        $data = InfluncerInvolved::where('campaign_id',$camp);

        $data = $data->paginate(100);
 
        return view('camp-influencer',compact('data','campaign'));
    }
}
