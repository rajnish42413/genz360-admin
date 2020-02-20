<?php

namespace App\Http\Controllers;

use App\Campaign;
use DataTables;
use App\Notifications\PushNotification;
use App\Influencer;
use App\InfluncerInvolved;
use App\Location;
use App\Brand;
use GuzzleHttp\Client;
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


    public function payout(Request $request,$influncerInvolved)
    {
        $InfluncerInvolved = InfluncerInvolved::where('inf_inv_id',$influncerInvolved)->first();

        $campaign = Campaign::where('campaign_id',$InfluncerInvolved->campaign_id)->first();

        if (!$InfluncerInvolved && !$campaign ) {
            abort(404);
        }


        $InfluncerInvolved->active_status = 3;
        $InfluncerInvolved->paid_status = 1;
        $InfluncerInvolved->amount_to_be_paid= $campaign->payout_influencers1 ?? $campaign->payout_influencers2;
        $InfluncerInvolved->save();


        $influencer = $InfluncerInvolved->influencer;
        $influencer->i_wallet = $influencer->i_wallet + $InfluncerInvolved->amount_to_be_paid;
        $influencer->save();

        $message = "Genz360 ! send {$InfluncerInvolved->amount_to_be_paid} credit for {$campaign->name} to your wallet.";
        
        $influencer->notify(new PushNotification($message,"Payout for campaign"));    

        return back()->with('success', "Successfully Payout");
        
    }

    public function create()
    {
        $brands =Brand::all();
        return view('campaign.create',compact('brands'));
    }
}
