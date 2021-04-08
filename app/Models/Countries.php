<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
   protected $fillable = [
        'country_name'
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User','id','country');
    }
}
