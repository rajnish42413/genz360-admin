<?php

namespace App\Http\Controllers;

use App\Influencer;
use App\Location;
use DataTables;
use Illuminate\Http\Request;

class InfluencerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = 50;
        $total = Influencer::count();
        $locations = Location::all();
        $influnceres = Influencer::orderBy('influencer_id','DESC');

        if ($request->name) {
           $influnceres->where('name', 'like', '%' . $request->name . '%');
         } 

         if ($request->email) {
           $influnceres->where('email', 'like', '%' . $request->email . '%');
         } 

         if ($request->mobile) {
           $influnceres->where('mobile_no', 'like', '%' . $request->mobile . '%');
         } 

         if ($request->city) {
           $influnceres->where('location',$request->city);
         } 

        if ($request->gender) {
           $influnceres->where('gender',$request->gender);
         } 

        if ($request->platform) {
            if ($request->platform === "fb") {
               $influnceres->where('use_facebook',1);
            }if ($request->platform === "insta") {
               $influnceres->where('use_instagram',1);
            }if ($request->platform === "tw") {
               $influnceres->where('use_twitter',1);
            }if ($request->platform === "yt") {
               $influnceres->where('use_youtube',1);
            }
         } 

         if ($request->$pagination) {
             $$pagination = $request->$pagination;
         }

         $subtotal = $influnceres->count();

        $influnceres = $influnceres->paginate($pagination);   
        return view('influencer',compact('total',"influnceres","locations","subtotal"));
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Influncer $influncer)
    {
        //
    }

    public function edit(Influncer $influncer)
    {
        //
    }


    public function update(Request $request, Influncer $influncer)
    {
        //
    }


    public function destroy(Influncer $influncer)
    {
        //
    }
}
