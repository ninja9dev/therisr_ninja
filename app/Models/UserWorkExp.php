<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserWorkExp extends Model
{

    protected $table ="users_work_exp";

   protected $fillable = [
        'user_id', 'title' ,'company_name', 'location', 'start_month' , 'start_year', 'end_month', 'end_year' , 'currently_working'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
