<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Influencer ;
use App\InfluncerInvolved;
Use App\Campaign;
use GuzzleHttp\Client;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user($token)
    { 
        if (!$token) {
         abort(404);
        }

        return view('notification.user',compact('token'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $brands = Brand::all();
       $users = Influencer::all();
       $campaigns = Campaign::where('status',1)->get();

       return view('notification.create',compact('brands','campaigns','users'));
    }


    public function store(Request $request)
    {
        //
    }


    public function send(Request $request)
    {

        $validatedData = $request->validate([
        'title' => 'required|max:150',
        'message' => 'required',
        ]);


      $tokens =array();
      if ($request->allusers === "all") {
         $t1 =  Influencer::whereNotNull('not_token')->pluck('not_token');
         $t1_array = (array) $t1;
         array_merge($tokens, $t1_array);
      }


      if ($request->campaign) {
         $users  = InfluncerInvolved::where('campaign_id',$request->campaign)->with(['influencer' =>                           function ($query) {
                                      $query->whereNotNull('not_token');
                                    }])->get();
        $temp_token = [];
        foreach ($users as $user) {
          if ($user->influencer && $user->influencer->not_token) {
            $search = 'ExponentPushToken';             
            if (preg_match("/{$search}/i", $user->influencer->not_token)) {          
               $temp_token[] = $user->influencer->not_token;
            }
          }
        }
        $tokens  = array_merge($tokens, $temp_token);
       }


      if ($request->brands) {
        $brands = Brand::whereIn('brand_id',$request->brands)->whereNotNull('not_token')->pluck('not_token');
        if ($brands) {
         $t1_array = (array) $brands;
         $tokens  =  array_merge($tokens, $t1_array);
        }
      }

      $client = new Client();
      $total = count($tokens);

      
      $tokens = array_filter($tokens,function($value){
                 $search = 'ExponentPushToken'; 
                  return preg_match("/{$search}/i", $value);
                });

      return $tokens;
      if ($total > 0) {
        $response = $client->post("https://exp.host/--/api/v2/push/send", ['json' => [
            "to" => $tokens,
            "sound" =>  "default",
            "title" => $request->title,
            "message" => $request->message
        ] ]);
      }
      


      return back()->with('success', "Send Successfully to {$total}");

    }

    public function sendToUser(Request $request,$token)
    {
        if (!$token) {
          return back()->with('error', "Device token is missing");
        }

       $validatedData = $request->validate([
        'title' => 'required|max:150',
        'message' => 'required',
        ]);

       $client = new Client();

      $response = $client->post("https://exp.host/--/api/v2/push/send", ['json' => [
            "to" => $token,
            "sound" =>  "default",
            "title" => $request->title,
            "message" => $request->message
        ] ]);

      return back()->with('success', "Send Successfully");
    }


}
