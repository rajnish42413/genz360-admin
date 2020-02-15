<?php

namespace App\Http\Controllers\Api;

use App\Influencer;
use App\Campaign;
use App\InfluencerPost;
use App\InfluncerInvolved;
use App\Brand;
use App\Spoc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    
    public function index()
    {
       return Brand::all();
    }

    public function storeSopc(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contact_no' => 'required',
            'designation' => 'required',
            'token' => 'required',
        ]);

        // return $request->all();
       $brand = Brand::where("c_tokken",$request->token)->first();
        if (!$brand) {
             return response()->json([
                 'error' => 'Brand id is missing'
             ], 404);
        }

        $spoc = Spoc::create([
                'brand_id' => $brand->brand_id,
                'name' => $request->name,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
                'designation' => $request->designation,
            ]);

          return response()->json([
            'status' => "ok",
            'message' => 'Update Successfully'
        ], 200);
    }


    public function show($token)
    {
        return Brand::where("c_tokken",$request->token)->first();
    }

    public function update(Request $request, $token)
    {
        $brand = Brand::where("c_tokken",$request->token)->first();
         if (!$brand) {
              return response()->json([
                  'error' => 'Brand id is missing'
              ], 404);
         }
        $brand->company_type=$request->type;
        $brand->company_turnover=$request->turnover;
        $brand->company_size=$request->size;
        $brand->headquarter=$request->hq;
        $brand->website_url=$request->url;
        $brand->gst_no=$request->gst;
        $brand->save();
         return response()->json([
            'status' => "ok",
            'message' => 'Update Successfully'
        ], 200);
    }

}
