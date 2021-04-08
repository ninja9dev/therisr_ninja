<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserSocialLinks extends Model
{


    protected $table ="users_sociallinks";

    protected $fillable = [
        'user_id', 'github','medium', 'codepen', 'behance', 'dribbble', 'youtube', 'linkedin', 'instagram', 'twitter', 'pinterest', 'facebook', 'website'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
