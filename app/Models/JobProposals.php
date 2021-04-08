<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobProposals extends Model
{

   use SoftDeletes;

    protected $table ="jobs_proposals";

    protected $fillable = [
        'user_id', 'job_id', 'job_type', 'proposal_status', 'like_status', 'introduce', 'interview_questions', 'hourly_rate', 'total_cost'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function jobs()
    {
        return $this->belongsTo('App\Models\Jobs','job_id','id');
    }

  
    public function myJobContract()
    {  
        return $this->hasOne('App\Models\JobContract','proposal_id','id');
    }

    public function userBasicDetail()
    { 
        return $this->hasOne('App\Models\User','id','user_id');
    }

     public function jobDetail()
    { 
        return $this->hasOne('App\Models\Jobs','id','job_id');
    }
}
