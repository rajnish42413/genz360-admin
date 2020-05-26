<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    //
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'user_data';
}
