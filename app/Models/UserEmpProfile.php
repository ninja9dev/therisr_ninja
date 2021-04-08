<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserEmpProfile extends Model
{


    protected $table ="users_empprofile";

    protected $fillable = [
        'user_id', 'background_image','company_name', 'website', 'phone_Code', 'phone', 'timezone', 'city'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function timezoneName()
    { 
        return $this->hasOne('App\Models\Timezone','id','timezone');
    }

}
