<?php


namespace App\Http\Controllers\Api;

use App\Influencer;
use DataTables;
use Illuminate\Http\Request;

class InfluencerController extends Controller
{


    public function show(Request $request,$influncer)
    {
        if (!$influncer) {
            abort(404);
        }

        return $influncer = Influncer::find($influncer);
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
