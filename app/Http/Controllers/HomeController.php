<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Influencer;
use App\Campaign;
use App\Brand;
use App\CampaignPost;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $influencers = Influencer::count();
        $active_influencers = Influencer::whereNotNull('not_token')->get()->count();
        $campaigns_done = Campaign::where('status',2)->count();
        $campaigns = Campaign::count();
        $brands = Brand::count();
        $posts = CampaignPost::count();
        return view('home',compact('influencers','campaigns','posts','brands','active_influencers','campaigns_done'));
    }
}
