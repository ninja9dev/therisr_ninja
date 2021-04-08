<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobLikeSkip extends Model
{


    protected $table ="freelancer_lk_skip_jobs";

    protected $fillable = [
        'user_id', 'job_id', 'like_status', 'skip_status'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function jobProposals()
    { 
        return $this->hasMany('App\Models\JobProposals','job_id','job_id');
    }

    public function jobs()
    {
        return $this->belongsTo('App\Models\Jobs','job_id','id');
    }
    public function jobDetail()
    { 
        return $this->hasOne('App\Models\Jobs','id','job_id');
    }

    public function userBasicDetail()
    { 
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
