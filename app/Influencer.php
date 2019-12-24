<?php

namespace App;
use App\InfluncerInvolved ;
use App\Campaign;
use Illuminate\Database\Eloquent\Model;

class Influencer  extends Model
{
     protected $table = 'influencer_details';

  public function involves()
  {
  	return $this->hasMany(Brand::class,'influencer_id');
  }

  public function campaigns()
  {
  	return $this->hasMany(Campaign::class);
  }

  public function city()
  {
  	return $this->belongsTo(Location::class,'location','location_id')->value('location');
  }

}
