<?php

namespace App;

use App\Influencer;
use App\InfluencerPost;
use App\Campaign;
use Illuminate\Database\Eloquent\Model;

class InfluncerInvolved extends Model
{
     protected $table = 'influencers_involved';
      protected $primaryKey = 'inf_inv_id';
      public $timestamps = false;

    public function influencer()
    {
    	return $this->belongsTo(Influencer::class,'influencer_id','influencer_id');
    }

    public function campaign()
    {
      return $this->belongsTo(Campaign::class,'campaign_id','campaign_id');
    }

    public function post()
    {
    	return $this->hasOne(InfluencerPost::class,'inf_inv_id');
    }

    
}
