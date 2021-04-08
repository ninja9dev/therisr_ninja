<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User, App\Models\ChatAll, App\Models\ChatMessages, App\Models\Notifications; 
use DB;
use DateTime; 
use Illuminate\Support\Str;
   
class MessagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     protected $per_page_data = 6;
     protected $per_pagemessage_data = 6;
    public function __construct()
    {
        $this->middleware('auth');
        // get global settings
        $this->middleware(function ($request, $next) {
          $this->settings = $request->get('settings');
          $this->per_page_data = !empty($this->settings->per_page_data) ? $this->settings->per_page_data : 6;
         return $next($request);
       });
    }

   // global countr
    function getGlobalMessageUnreadCount(){
        $response = 0;
        if(Auth::user()->user_type == '2') //-- Employer
        { 
           $response = ChatMessages::global_messages_client_unread();
        }else{
           $response = ChatMessages::global_messages_freelancer_unread();
        }
        $notiCount = Notifications::where(array('user_to' => Auth::user()->id, 'read_status' => '0'))
                     ->count();
        
        $response = $response + $notiCount;
        return $response;
       // return Auth::user()->id;
    }

    
    //messages page
    function messages($jobId='') 
    { 
        $sortby = "created_at";
        $order = "desc";
        //$user = User::find(Auth::user()->id);
 
        if(Auth::user()->user_type == '2') //-- Employer
        { 
            $data['allchats'] = ChatAll::withCount('chat_messages_client_unread as unreadcount')->where(array(
                        'clientId' => Auth::user()->id
                        ))->orderBy($sortby, $order)
                   ->paginate($this->per_page_data);
        }
        else //-- Freelancer
        {
            $data['allchats'] = ChatAll::withCount('chat_messages_freelancer_unread as unreadcount')->where(array(
                        'freelancerId' => Auth::user()->id
                        ))->orderBy($sortby, $order)
                   ->paginate($this->per_page_data);
        }
        

        if(!empty( $_GET['ids'])){
           $get_ids = explode(',' , $_GET['ids']);
           $data['jobId'] = !empty($get_ids[0]) ? $get_ids[0] : '';
           $data['freelancerId'] = !empty($get_ids[1]) ? $get_ids[1] : '';
           $data['clientId'] = !empty($get_ids[2]) ? $get_ids[2] : '';

           if(!empty($data['jobId']) && !empty($data['freelancerId']) && !empty($data['clientId'])){
                $openChat = ChatAll::where(array(
                        'freelancerId' => $data['freelancerId'],
                        'clientId' => $data['clientId'],
                        'jobId' => $data['jobId']
                    ))->first();
            }
            $data['openChat'] = !empty($openChat) ? $openChat->chat_id : '';
        }
        return view('user.common.messages.messages_base',$data);
    }

    //messages  getChatSidebar page 
    function getChatSidebar($chatid='') 
    {
        $sortby = "created_at";
        $order = "desc";
        //$user = User::find(Auth::user()->id);
 
        if(Auth::user()->user_type == '2') //-- Employer
        { 
            $data['allchats'] = ChatAll::withCount('chat_messages_client_unread as unreadcount')->where(array(
                        'clientId' => Auth::user()->id
                        ))
                    //->orderByJoin('chat_messages.msg_status_client', $order)
                   // ->orderBy('unreadcount', $order)
                   ->paginate($this->per_page_data);
        }
        else //-- Freelancer
        {
            $data['allchats'] = ChatAll::withCount('chat_messages_freelancer_unread as unreadcount')->where(array(
                        'freelancerId' => Auth::user()->id
                        ))
                    //->orderByJoin('chat_messages.msg_status_freelancer', $order)
                   //->orderBy('unreadcount', $order)
                   ->paginate($this->per_page_data);
        }
        $data['currentopenchat'] = $chatid;
        return view('user.common.messages.messages_sidebar',$data);
    }
    function getFullChat($chatId)
    {
        $data['chat'] = ChatAll::where('chat_id',$chatId)->first();
        $chat_messages = ChatMessages::where(array('chatId' => $chatId))
                        ->orderBy('created_at', 'desc')
                        ->paginate($this->per_pagemessage_data); 
        $data['chat_messages']  = $chat_messages;
        //--update status to read of all unread messages------------
        if(Auth::user()->user_type == '2') //-- Employer
        {
          $updatedata = array('msg_status_client' => 1);
        }else{
          $updatedata = array('msg_status_freelancer' => 1);
        }
        $status_update = ChatMessages::where(array('chatId' => $chatId))
                            ->update($updatedata);

                  // echo "<pre>";
                   //print_r($data['chat']);die;
        $data['request_type'] = !empty($_GET['request_type'])? $_GET['request_type'] : '';
        $data['more_messages'] = ChatMessages::where(array('chatId' => $chatId))
                        ->skip($this->per_pagemessage_data)
                        ->take(1)
                        ->get();
        return view('user.common.messages.messages_chatarea',$data);
    }

    function initiateChat($jobid,$freelancerid,$clientid)
    {
        $match_s = array(
                'clientId' => $clientid,
                'freelancerId'  => $freelancerid,
                'jobId' => $jobid
        );
        $input =  array(
                'clientId' => $clientid,
                'freelancerId'  => $freelancerid,
                'jobId' => $jobid
        );
        $done = ChatAll::updateOrCreate($match_s,$input); 
    }
    

    // get new messages
    function getNewMessages($chatId, $lastMessageId){
        $data['chat_messages'] = ChatMessages::where(array('chatId' => $chatId))
                        ->whereRaw(' id > '.$lastMessageId)
                        ->orderBy('created_at', 'desc')
                        ->get();
        //--update status to read of all unread messages------------
        if(Auth::user()->user_type == '2') //-- Employer
        {
          $updatedata = array('msg_status_client' => 1);
        }else{
          $updatedata = array('msg_status_freelancer' => 1);
        }
        $status_update = ChatMessages::where(array('chatId' => $chatId))
                            ->update($updatedata);
         return view('user.common.messages.messages_single_box',$data);
    }
 

      // get new messages
    function loadOldMessages($chatId, $latestMessageId){
        $data['chat_messages'] = ChatMessages::where(array('chatId' => $chatId))
                        ->whereRaw(' id < '.$latestMessageId)
                        ->orderBy('created_at', 'desc')
                        ->limit($this->per_pagemessage_data)
                        ->get();
        $data['more_messages'] = ChatMessages::where(array('chatId' => $chatId))
                        ->whereRaw(' id < '.$latestMessageId)
                        ->orderBy('created_at', 'desc')
                        ->skip($this->per_pagemessage_data)
                        ->take(1)
                        ->get();
                     
         return view('user.common.messages.messages_single_box',$data);
    }
    
    //--- send message
    function sendMessage()
    {
        if(trim($_POST['message']) != '')
        {
            if(Auth::user()->user_type == '2') //-- Employer
            {
                $sendByClient       = '1';
                $sendByFreelancer   = '0';
                $msg_status_client  = '1';
                $msg_status_freelancer = '0';
            }
            else
            {
                $sendByClient       = '0';
                $sendByFreelancer   = '1';
                $msg_status_client  = '0';
                $msg_status_freelancer = '1';
            }
            $values = array(
                'chatId'                => $_POST['chat_id'],
                'attach_url'            => $_POST['attach_url'],
                'message'               => $_POST['message'],
                'sendByClient'          => $sendByClient,
                'sendByFreelancer'      => $sendByFreelancer,
                'clientId'              => $_POST['clientid'],
                'freelancerId'          => $_POST['freelancerid'],
                'DateTime'              => date("Y/m/d h:i:s"),
                'msg_status_client'     => $msg_status_client,
                'msg_status_freelancer' => $msg_status_freelancer
            );
            //echo "<pre>";
            //print_r($values);die;
            ChatMessages::create($values); 
        }
    }
    
    function uploadAttachment()
    {
        if (!empty($_FILES['image']['name']))
        {
	        $fileName = $_FILES['image']['name'];
    	    $fileExt    = explode('.', $fileName);
    	    $fileActExt = strtolower(end($fileExt));
    	    $fileNew    = rand() . "." . $fileActExt;  // rand function create the rand number 
    	    $filePath   = 'assets/message-attchments/'.$fileNew; 
	        if ($fileActExt)
	        {
        	    if ($_FILES['image']['size'] > 0  && $_FILES['image']['error']==0)
        	    {
        	        move_uploaded_file($_FILES['image']['tmp_name'], $filePath);
        		    echo $fileNew;
    	        }
        	    else
        	    {
        	        return false;
    	        }
    	    }
    	    else{	
    	        return false;
	        }
        }
    }

    // notifications
    function getNotifications(){
        $chat_notifications = Notifications::where(array('user_to' => Auth::user()->id))
                        ->orderBy('created_at', 'desc')
                        ->paginate($this->per_pagemessage_data); 
        $data['chat_notifications']  = $chat_notifications;
        //--update status to read of all unread notifications------------
        $updatedata = array('read_status' => '1');
        $status_update = Notifications::where(array('user_to' => Auth::user()->id))
                            ->update($updatedata);

        $data['request_type'] = !empty($_GET['request_type'])? $_GET['request_type'] : '';
        $data['more_notifications'] = Notifications::where(array('user_to' => Auth::user()->id))
                        ->skip($this->per_pagemessage_data)
                        ->take(1)
                        ->get();
        return view('user.common.messages.messages_notifications',$data);
    }

    // get old notifications
    function loadOldNotifications($latestId){
        $data['chat_notifications'] = Notifications::where(array('user_to' => Auth::user()->id))
                        ->whereRaw(' id < '.$latestId)
                        ->orderBy('created_at', 'desc')
                        ->limit($this->per_pagemessage_data)
                        ->get();
        $data['more_notifications'] = Notifications::where(array('user_to' => Auth::user()->id))
                        ->whereRaw(' id < '.$latestId)
                        ->orderBy('created_at', 'desc')
                        ->skip($this->per_pagemessage_data)
                        ->take(1)
                        ->get();
        
        $data['request_type'] = 'paginationData';
                     
         return view('user.common.messages.messages_notifications',$data);
    }


    //delete notification
    function deleteNotification($id = ''){
        $notification = Notifications::find($id);
        if ($notification->forceDelete()) {
          echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'id' => $notification->id));
        }else{
         echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
        }
    }
}

