<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

use App\Notifications\PushNotification;
use App\Influencer ;
use App\Notification ;
use App\InfluncerInvolved;
Use App\Campaign;
use GuzzleHttp\Client;

class NotificationController extends Controller
{

    public function user($token)
    { 
        if (!$token) {
         abort(404);
        }

        return view('notification.user',compact('token'));
    }

 
    public function create()
    {
       $brands = Brand::all();
       $users = Influencer::all();
       $campaigns = Campaign::where('status',1)->get();

       return view('notification.create',compact('brands','campaigns','users'));
    }


    public function send(Request $request)
    {

        $validatedData = $request->validate([
        'title' => 'max:100',
        'message' => 'required|max:250',
        ]);


      $tokens =array();
       if ($request->allusers === "all") {
         $users =  Influencer::whereNotNull('not_token')->get();
         foreach ($users as $user) {
           $user->notify(new PushNotification($request->message,$request->title));
         }
        return back()->with('success', "success");
       }

      else{
         if ($request->campaign) {
             $users  = InfluncerInvolved::where('campaign_id',$request->campaign)->with(['influencer' =>                           function ($query) {
                                          $query->whereNotNull('not_token');
                                        }])->get();

            foreach ($users as $user) {
               $$user->influencer->notify(new PushNotification($request->message,$request->title));
             }
          return back()->with('success', "success");
          }else{
             return back()->with('error', "error no user found");
          }
      }

  }

    public function sendToUser(Request $request,$id)
    {
       $user =  Influencer::find($id);

        if (!$user) {
          return back()->with('error', "Device token is missing");
        }

       $validatedData = $request->validate([
          'title' => 'max:100',
          'message' => 'required|max:250',
        ]);

       $user->notify(new PushNotification($request->message,$request->title));

      return back()->with('success', "success");
    }

}
