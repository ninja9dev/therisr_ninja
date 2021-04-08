<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class JobContractTimesheet extends Model
{

    protected $table ="jobs_contracts_timesheet";


    protected $fillable = [
        'contract_id' ,'job_id', 'status', 'description', 'due_date', 'time', 'amount'
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
