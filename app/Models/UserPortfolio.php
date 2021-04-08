<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model
{


    protected $table ="users_portfolio";

    protected $fillable = [
        'user_id', 'title', 'role', 'skills', 'description', 'link', 'images'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
