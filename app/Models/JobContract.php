<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class JobContract extends Model
{

   use SoftDeletes;

    protected $table ="jobs_contracts";


    protected $fillable = [
        'user_by', 'user_to', 'proposal_id' ,'job_id', 'contract_type', 'contract_status', 'hourly_rate', 'weekly_limit', 'project_length', 'total_cost', 'due_date', 'job_title', 'job_description', 'expertise', 'skills', 'exp_level', 'english_prof', 'therisr_score', 'interview_questions', 'offer_sent_on','contract_paused_on', 'contract_end_on','contract_start_on', 'rejected_at'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function jobs()
    {
        return $this->belongsTo('App\Models\Jobs','job_id','id');
    }

    public function userByBasicDetail()
    { 
        return $this->hasOne('App\Models\User','id','user_by');
    }

    public function userToBasicDetail()
    {
         return $this->hasOne('App\Models\User','id','user_to');
    }
    
    public function contractJobProposal()
    { 
        return $this->hasOne('App\Models\JobProposals','id','proposal_id');
    }

    public function contractEnd()
    { 
        return $this->hasMany('App\Models\JobContractEnd','contract_id','id');
    }

    public function currentUserFeedback(){
         return $this->hasOne('App\Models\JobContractEnd','contract_id','id')
                     ->where(array('user_to' => Auth::user()->id));
    }


    public function jobDetail()
    { 
        return $this->hasOne('App\Models\Jobs','id','job_id');
    }

}
