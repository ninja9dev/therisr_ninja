<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;

class UserProfile extends Model
{

    use EloquentJoin;

    protected $table ="users_profile";

    protected $fillable = [
        'user_id', 'background_image','prim_title', 'sec_title', 'overview', 'exp_level', 'start_year', 'hourly_rate', 'english_prof', 'city', 'services', 'skills', 'clients'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
