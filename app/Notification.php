<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'not_id';

   public $timestamps = false;

   protected $fillable = ['subject','message'];

}
