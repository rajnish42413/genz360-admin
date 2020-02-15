<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spoc extends Model
{
	protected $guarded = ['spoc_id']; 
     protected $table = 'spoc_details';
     protected $primaryKey = 'spoc_id';
     public $timestamps = false;
}
