<?php
namespace App\Http\Controllers\Api;

use App\Influencer;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfluencerController extends Controller
{ 

     public function index()
    {
        return Influencer::take(10)->get();
    }


    public function show(Request $request,$influencer)
    {
        if (!$influencer) {
            abort(404);
        }
        return $influencer = Influencer::find($influencer);
    }

    public function update(Request $request, $influencer)
    {
       $influencer = Influencer::find($influencer);
       if (!$influencer) {
          return response()->json([
            'message' => 'Influencer not found'
            ], 404);
       }
       $influencer->c_tokken = $request->device_token ?? "";
       $influencer->save();
        return response()->json([
            'status' => 'ok',
            'message' => 'Influencer not found'
           ], 200);
    }

    public function destroy(Influencer $influencer)
    {
        //
    }
}
