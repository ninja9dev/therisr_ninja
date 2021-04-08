<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserAvailable extends Model
{


    protected $table ="users_availability";

    protected $fillable = [
        'user_id', 'available','avail_for', 'nonavail_untill'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
