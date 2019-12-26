<?php

namespace App\Http\Controllers;

use App\Interest;
use Illuminate\Http\Request;
use DataTables;
class InterestController extends Controller
{
    
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Interest::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                          $btn = '<div class="badge badge-primary small">Add</div>';
                           return $btn;                        
                      })
                    ->rawColumns(['action'])
                    ->make(true);
              }
            
        return view('interest.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Location $location)
    {
        //
    }

    public function edit(Location $location)
    {
        //
    }


    public function update(Request $request, Location $location)
    {
        //
    }

    public function destroy(Location $location)
    {
        //
    }
}
