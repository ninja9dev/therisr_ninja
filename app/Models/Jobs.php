<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Jobs extends Model
{

   use SoftDeletes;

    protected $table ="jobs";

    protected $fillable = [
        'user_id', 'uniq_job_id', 'job_status','job_type', 'hourly_rate', 'weekly_limit', 'project_length', 'total_cost', 'due_date', 'job_title', 'job_description', 'expertise', 'skills', 'exp_level', 'english_prof', 'therisr_score', 'interview_questions', 'posted_at'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function jobProposals()
    { 
        return $this->hasMany('App\Models\JobProposals','job_id','id');
    }

     public function jobContracts()
    { 
        return $this->hasMany('App\Models\JobContract','job_id','id');
    }

    public function myJobProposal()
    { 
        return $this->hasOne('App\Models\JobProposals','job_id','id')->where(array('user_id' => Auth::user()->id));
    }
 
 
    
    public function myJobReport()
    { 
        return $this->hasOne('App\Models\JobReports','job_id','id')->where(array('user_id' => Auth::user()->id));
    }



    public function jobLikeSkip()
    { 
        return $this->hasOne('App\Models\JobLikeSkip','job_id','id')->where(array('user_id' => Auth::user()->id));
    }

     public function userBasicDetail()
    { 
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
