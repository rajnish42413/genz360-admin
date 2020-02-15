<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Influencer;
use App\Campaign;
use App\InfluencerPost;
use App\InfluncerInvolved;
use DataTables;
use Illuminate\Http\Request;

class CampaignController extends Controller
{


   public function index(Request $request)
   {
       $campaign = Campaign::orderBy("campaign_id",'desc');
        if ($request->status) {
            $campaign->where("status",$request->status);
        }
        $campaign = $campaign->get();
        return $campaign;
   }

    public function show(Request $request,$campaign)
    {
        if (!$campaign) {
             return response()->json([
                 'error' => 'campaign not found'
             ], 404);
        }

        return Campaign::with('post')->find($campaign);
    }


    public function dailyTaskDetail(Request $request,$id)
    {
       if (!$id) {
             return response()->json([
                 'error' => 'post id is missing'
             ], 404);
        }
        $post = InfluencerPost::find($id);
        $involve = InfluncerInvolved::find($post->inf_inv_id)->with("campaign")->first(); 
        return [
          "post" => $post,
          "involve" => $involve 
        ];
    }


    public function dailyTask(Request $request,$token)
    {
        $influencer = Influencer::where("c_tokken",$token)->first();
        if ($influencer) {
          return $influencer->involves()->with("post")->with(['campaign' => function ($query) {
              $query->where('status', 1);
           }])->get();
        }
    }
}
