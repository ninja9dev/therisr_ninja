<?php 
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
class ChatAll extends Model
{
   
    use EloquentJoin;
   use SoftDeletes;
   public $timestamps = true;


    protected $table ="chats_all";

    protected $fillable = [
        'chat_id', 'clientId', 'freelancerId','jobId', 'remember_token'
    ];


    public function chat_freelancer() 
    {
        return $this->hasOne('App\Models\User','id','freelancerId');
    }

    public function chat_client()
    {
        return $this->hasOne('App\Models\User','id','clientId');
    }

    public function chat_job()
    {
        return $this->hasOne('App\Models\Jobs','id','jobId');
    }
    public function chat_messages()
    {
        return $this->hasMany('App\Models\ChatMessages','chatId','chat_id');
    }

    public function chat_message_last()
    {
    	return $this->hasOne('App\Models\ChatMessages', 'chatId','chat_id')->orderBy('created_at', 'desc')->latest();
    }

    public function chat_messages_client_unread()
    {
    	return $this->hasMany('App\Models\ChatMessages','chatId','chat_id')->where('msg_status_client','0');
    }

    public function chat_messages_freelancer_unread()
    {
        return $this->hasMany('App\Models\ChatMessages','chatId','chat_id')->where('msg_status_freelancer','0');
    }

}