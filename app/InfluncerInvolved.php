<?php

namespace App;

use App\Influencer;
use Illuminate\Database\Eloquent\Model;

class InfluncerInvolved extends Model
{
     protected $table = 'influencers_involved';

    public function influencer()
    {
    	return $this->belongsTo(Influencer::class,'influencer_id','influencer_id');
    }
}
