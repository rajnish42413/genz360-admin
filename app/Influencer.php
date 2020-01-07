<?php

namespace App;
use App\InfluncerInvolved ;
use App\Campaign;
use DB;
use App\Social\Facebook;
use App\Social\Instagram;
use App\Social\Twitter;
use App\Social\Youtube;
use Illuminate\Database\Eloquent\Model;

class Influencer  extends Model
{
  protected $table = 'influencer_details';
  protected $primaryKey = 'influencer_id';

   public $timestamps = false;


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

  public function facebook()
  {
    return $this->hasOne(Facebook::class,'influencer_id')->orderBy("follower_count","desc");
  }

  public function youtube()
  {
     return $this->hasOne(Youtube::class,'influencer_id')->orderBy("subscriber_count","desc");
  }

  public function instagram()
  {
      return $this->hasOne(Instagram::class,'influencer_id')->orderBy("follower_count","desc");
  }

  public function twitter()
  {
      return $this->hasOne(Twitter::class,'influencer_id')->orderBy("follower_count","desc");
  }

}
