<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class InfluencerPost extends Model
{
     protected $table = 'posts_done';
     protected $primaryKey = 'pd_id';
      public $timestamps = false;
     

}
