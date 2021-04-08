<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSavedSearches extends Model
{

    use SoftDeletes;

    protected $table ="users_saved_searches";

    protected $fillable = [
        'user_id', 'search_name', 'search_filters', 'alert_on'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
