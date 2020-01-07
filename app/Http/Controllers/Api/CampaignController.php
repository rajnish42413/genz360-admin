<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Influencer;
use App\Campaign;
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

        return Campaign::find($campaign);
    }
}
