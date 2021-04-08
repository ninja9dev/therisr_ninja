<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{


    protected $table ="users_education";


   protected $fillable = [
        'user_id', 'major' ,'school_name', 'start_year', 'end_year'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
