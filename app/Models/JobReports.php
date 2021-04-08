<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobReports extends Model
{

   use SoftDeletes;

    protected $table ="reported_jobs";

    protected $fillable = [
        'user_id', 'job_id', 'reason'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function jobs()
    {
        return $this->belongsTo('App\Models\Jobs','job_id','id');
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
