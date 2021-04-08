<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class JobContractMilestones extends Model
{

    protected $table ="jobs_contracts_milestones";


    protected $fillable = [
        'contract_id' ,'job_id', 'status', 'milestone', 'due_date', 'amount'
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
