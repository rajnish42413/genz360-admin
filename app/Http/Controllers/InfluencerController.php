<?php

namespace App\Http\Controllers;

use App\Influencer ;
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
       if ($request->ajax()) {
            $data = Influncer::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                      })
                    ->rawColumns(['action'])
                    ->make(true);
              }
            
        return view('brand');
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
