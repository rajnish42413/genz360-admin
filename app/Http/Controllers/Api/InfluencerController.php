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

    public function show(Request $request,$influencer)
    {
        if (!$influencer) {
             return response()->json([
                 'error' => 'Influencer not found'
             ], 404);
        }

        return Influencer::find($influencer);
    }


    public function update(Request $request, $influencer)
    {
        if (!$influencer) {
            return response()->json([
                'error' => 'Influencer not found'
            ], 404);
        }

        $influencer = Influencer::find($influencer);

        $influencer->c_tokken = $request->device_token;
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
