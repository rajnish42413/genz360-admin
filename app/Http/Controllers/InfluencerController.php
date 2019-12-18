<?php

namespace App\Http\Controllers;

use App\Influencer;
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
        $total = Influencer::count();
        $dummy = Influencer::orderBy('influencer_id','DESC');
        if ($request->page) {
           $dummy->skip($request->page*1000)
                 ->take(1000)
                 ->get();
         }else{
           $dummy->get();
         }

       if ($request->ajax()) {
        $data = $dummy;
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                     if ($row['not_token']) {
                         $btn = '<a href="/user/notification/'.$row['not_token'].'" class="edit btn btn-primary btn-sm">send notification</a>';                            
                          } else {
                            $btn = '<div class="badge badge-warning small">Not Login</div>';
                          }
                           return $btn;                        
                      })
                ->rawColumns(['action'])
                ->make(true);
          }
            
        return view('influencer',compact('total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Influncer  $influncer
     * @return \Illuminate\Http\Response
     */
    public function show(Influncer $influncer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Influncer  $influncer
     * @return \Illuminate\Http\Response
     */
    public function edit(Influncer $influncer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Influncer  $influncer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Influncer $influncer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Influncer  $influncer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Influncer $influncer)
    {
        //
    }
}
