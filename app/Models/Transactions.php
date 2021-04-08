<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
   protected $fillable = [ 
        'user_id', 'contract_id', 'contract_type', 'charge_id', 'amount', 'charge', 'status'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function contract()
    {
        return $this->belongsTo('App\Models\JobContract','contract_id','id');
    }

}
