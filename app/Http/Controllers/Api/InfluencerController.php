<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Influencer;
use DataTables;
use Illuminate\Http\Request;

class InfluencerController extends Controller
{ 

    public function index()
    {
        return Influencer::take(10)->get();
    }

    public function show($token)
    {
        
        return  Influencer::where("c_tokken",$token)->first();
    }


    public function applied(Request $request)
    {
         $influencer = Influencer::where("not_token",$request->tokken)->first();
         // $influencer = Influencer::where("mobile_no",8808100876)->first();

         if (!$influencer) {
            return [
                "message" => "Influencer not found",
                "status" => "fail"
            ];
        }

       return $influencer->involves()->with("post","campaign")->get();
    }



    public function update(Request $request)
    {
        if (!$request->token) {
            return response()->json([
                'error' => 'Influencer not found'
            ], 404);
        }

        $influencer = Influencer::where('c_tokken',$request->token)->first();
        $influencer->not_token = $request->device_token;
        $influencer->save();
        return response()->json([
            'status' => "ok",
            'message' => 'Update Successfully'
        ], 200);
    }

    public function destroy(Influencer $influencer)
    {
        //
    }
}
