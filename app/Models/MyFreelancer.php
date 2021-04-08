<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyFreelancer extends Model
{

   use SoftDeletes;

    protected $table ="users_my_freelancers"; 

    protected $fillable = [
        'user_id', 'freelancer_id', 'like_status'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}