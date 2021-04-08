<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobContractEnd extends Model
{

   use SoftDeletes;

    protected $table ="jobs_contracts_end";


    protected $fillable = [
        'user_by', 'user_to', 'contract_id', 'all_ratings', 'user_score', 'comment_for_user', 'therisr_score', 'comment_for_therisr'
    ];

     public function contractDetail()
    { 
        return $this->hasOne('App\Models\JobContract','id','contract_id');
    }
}