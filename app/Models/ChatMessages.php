<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;

class ChatMessages extends Model
{

    use EloquentJoin;
   use SoftDeletes;

    protected $table ="chats_messages";

    protected $fillable = [
        'chatId', 'message', 'attach_url', 'sendByClient', 'sendByFreelancer', 'clientId', 'msg_status_client', 'msg_status_freelancer', 'freelancerId', 'DateTime', 'remember_token'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public static function global_messages_client_unread()
    {
        return ChatMessages::where(array('clientId' => Auth::user()->id, 'msg_status_client'=>'0'))->count();
    }

    public static function global_messages_freelancer_unread()
    {
        return ChatMessages::where(array('freelancerId' => Auth::user()->id, 'msg_status_freelancer'=>'0'))->count();
    }
}