<?php

namespace App;
use App\Brand;
use App\InfluncerInvolved ;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
     protected $table = 'campaign';
      protected $primaryKey = 'campaign_id';

  public function brands()
  {
  	 return $this->belongsTo(Brand::class);
  }

  public function involves()
  {
  	 return $this->belongsTo(InfluncerInvolved::class,'campaign_id','campaign_id');
  }

}
