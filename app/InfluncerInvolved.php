<?php

namespace App;

use App\Influencer;
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
}
