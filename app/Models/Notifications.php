<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;

class Notifications extends Model
{

    use SoftDeletes;

    protected $table ="notifications";

    protected $fillable = [
        'user_to', 'read_status', 'notification', 'notification_data', 'action', 'mainTableId'
    ];
}
