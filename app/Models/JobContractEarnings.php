<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class JobContractEarnings extends Model
{

    protected $table ="jobs_contracts_earnings";


    protected $fillable = [
        'contract_id', 'contract_type', 'job_id', 'earning_for', 'charge_id', 'status', 'amount'
    ];


     public function contractDetail()
    { 
        return $this->hasOne('App\Models\JobContract','id','contract_id');
    }

    public function jobDetail()
    { 
        return $this->hasOne('App\Models\Jobs','id','job_id');
    }

}
