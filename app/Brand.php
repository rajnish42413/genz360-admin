<?php

namespace App;

use App\Campaign;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
     protected $table = 'brand_details';

  public function campaigns()
  {
  	return $this->hasMany(Campaign::class, 'campaign_id');
  }
}
