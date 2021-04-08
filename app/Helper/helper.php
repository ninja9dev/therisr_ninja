<?php 
use App\Models\Services, App\Models\Skills, App\Models\JobProposals, App\Models\JobContract;
use App\Models\JobContractMilestones, App\Models\JobContractTimesheet, App\Models\JobContractEnd, App\Models\Notifications, App\Models\JobContractEarnings;
use Illuminate\Support\Facades\Auth;


// monthly spent
function getMonthlySpent($uid){
  $this_month_sd = date("Y-m")."-01";
  $this_month_ed = date("Y-m-t");
  $contracts_ids = JobContract::where('user_by', $uid)->pluck('id');
  $spents =  JobContractEarnings::whereIn('contract_id',$contracts_ids)
            ->where('status',2)
            ->where('created_at', '>=' , $this_month_sd)
            ->where('created_at', '<=' , $this_month_ed)->sum('amount');
  $amount = amountFormat($spents);
  return $amount;
}

// monthly earnings
function getMonthlyEarnings($uid){
  $this_month_sd = date("Y-m")."-01";
  $this_month_ed = date("Y-m-t");
  $contracts_ids = JobContract::where('user_to', $uid)->pluck('id');
  $earnings =  JobContractEarnings::whereIn('contract_id',$contracts_ids)
            ->where('status',2)
            ->where('created_at', '>=' , $this_month_sd)
            ->where('created_at', '<=' , $this_month_ed)->sum('amount');
  $amount = amountFormat($earnings);
  return $amount;
}

function getMilestoneNames($ids){
  $milestone_names = [];
  $ids = explode(',', $ids);
  for($i=0; $i<count($ids); $i++){
    $milestone = JobContractMilestones::findOrFail($ids[$i]);
    $milestone_names[] = !empty($milestone->milestone) ?  $milestone->milestone : '';
  }
  return implode(', ', $milestone_names);
}

function getTimesheetNames($ids){
  $timesheets_names = [];
  $ids = explode(',', $ids);
  for($i=0; $i<count($ids); $i++){
    $timesheet = JobContractTimesheet::findOrFail($ids[$i]);
    $timesheets_names[] = !empty($timesheet->description) ?  $timesheet->description : '';
  }
  return implode(', ', $timesheets_names);
}

function createNotification($data, $type, $action ='', $mainTableId= '')
{
  if($type == 'on_job_proposal'){ 
   
    $user_to = $data->user_id;
    $notification = 'You received an proposal on your job: <a href="'.route('user.job', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ';

  }elseif($type == 'on_new_job_match'){ 
   
    $user_to = $data->user_id;
    $notification = 'You have new job match: <a href="'.route('user.job', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ';
  
  }elseif($type == 'on_job_offer_receive'){
   
    $user_to = $data->user_to;
    $notification = 'You received an offer on job: <a href="'.route('user.offerjobs').'" target="_blank">'.$data->job_title.'</a> ';
  
  }elseif($type == 'on_contract_end_by_employer'){

    $user_to = $data->user_to;
    $notification = 'Contract( <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ) is ended by the employer.';

  }elseif($type == 'on_contract_end_by_freelancer'){

    $user_to = $data->user_by;
    $notification = 'Contract( <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ) is ended by the freelancer.';
 
  }elseif($type == 'on_contract_paused_by_employer'){

    $user_to = $data->user_to;
    $notification = 'Contract( <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ) is paused by the employer.';

  }elseif($type == 'on_contract_activated_by_employer'){

    $user_to = $data->user_to;
    $notification = 'Contract( <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ) is activated by the employer.';

  }elseif($type == 'on_contract_accepted_by_freelancer'){

    $user_to = $data->user_by;
    $notification = 'Your offer ( <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ) is accepted by the freelancer.';
 
  }elseif($type == 'on_contract_rejected_by_freelancer'){

    $user_to = $data->user_by;
    $notification = 'Your offer ( <a href="'.route('user.alloffers').'" target="_blank">'.$data->job_title.'</a> ) is rejected by the freelancer.';
 
  }elseif($type == 'on_timesheet_add_edit_by_freelancer'){    

    $user_to = $data->user_by;
    $notification = 'Timesheet updated by freelancer on contract: <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a>';

  }elseif($type == 'on_timesheet_approved_by_employer'){

    $user_to = $data->user_to;
    $notification = 'Timesheet approved by employer on contract:  <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a>';

  }elseif($type == 'on_timesheet_unapproved_by_employer'){

    $user_to = $data->user_to;
    $notification = 'Timesheet approval removed by employer on contract:   <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ';
    
  }elseif($type == 'on_contract_milestone_add_edit_by_employer'){

    $user_to = $data->user_to;
    $notification = 'Milestone changes made by employer on contract:   <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ';


  }elseif($type == 'on_contract_milestone_add_edit_by_freelancer'){

    $user_to = $data->user_by;
    $notification = 'Milestone changes made by freelancer on contract:   <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ';
    
  }elseif($type == 'on_contract_milestone_delete_by_employer'){

    $user_to = $data->user_to;
    $notification = 'Milestone deleted by employer on contract:   <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ';


  }elseif($type == 'on_contract_milestone_delete_by_freelancer'){

    $user_to = $data->user_by;
    $notification = 'Milestone deleted by freelancer on contract:   <a href="'.route('user.contract', ['id' => encryptUrlId($data->id) ]).'" target="_blank">'.$data->job_title.'</a> ';
    
  }

  $message = new Notifications;
  $message->setAttribute('user_to', $user_to);
  $message->setAttribute('notification', $notification);
  $message->setAttribute('notification_data',$data);
  $message->setAttribute('action', $action);
  $message->setAttribute('mainTableId', $mainTableId);
  $message->save();
}

function deleteNotification($data, $type, $action ='', $mainTableId= '') {

  if($type == 'on_job_proposal_undo'){
    $user_to = $data->user_id;
  }else if($type == 'on_job_offer_undo'){
    $user_to = $data->user_to;
  }
  
  $mainTableId = $mainTableId;
  $proposal = Notifications::withTrashed()->where(array(
                 'user_to' =>  $user_to,
                 'action'  => $action,
                 'mainTableId' => $mainTableId
              ))->forceDelete();
}


function calculateUserScore($userid){
  $contracts = JobContractEnd::where('user_to',$userid)->get();
  $totalscore = 0;
  $totalTime = count($contracts);
  foreach ($contracts as $key => $value) {
    $totalscore = $totalscore + $value->user_score;
  }
  return ($totalTime == 0) ? $totalscore : $totalscore/$totalTime;
}

function getUserScoreHtml($userid, $score, $from=''){ 
  $contractCounts = JobContractEnd::where('user_to',$userid)->count();
  if($from == 'workhistory'){
    $html = ' <span class="zero">'.number_format($score,1).'</span><span class="star-icon"><a href="#">'.addClass($score, 0, $from).'</a><a href="#">'.addClass($score, 1, $from).'</a><a href="#">'.addClass($score, 2, $from).'</a><a href="#">'.addClass($score, 3, $from).'</a><a href="#">'.addClass($score, 4, $from).'</a></span><span class="zero pl-0">('.$contractCounts.')</span>';
 }else if($from == 'workhistory_li'){
   $html = '<span class="zero">'.number_format($score,1).'</span>
               <ul class="star-icon">
                  <li>'.addClass($score, 0, $from).'</li>
                  <li>'.addClass($score, 1, $from).'</li>
                  <li>'.addClass($score, 2, $from).'</li>
                  <li>'.addClass($score, 3, $from).'</li>
                  <li>'.addClass($score, 4, $from).'</li>
               </ul>';
 }else if($from  == 'user'){
  $html = '<li>'.number_format($score,1).' <span>
         <i class="fa '.addClass($score, 0).'"></i>
         <i class="fa '.addClass($score, 1).'"></i>
         <i class="fa '.addClass($score, 2).'"></i>
         <i class="fa '.addClass($score, 3).'"></i>
         <i class="fa '.addClass($score, 4).'"></i>
         </span> ('.$contractCounts.')</li>';
 }else{
    $html = '<span class="freelanrate"><p>'.number_format($score,1).' </p>
          <i class="fa '.addClass($score, 0).'"></i>
          <i class="fa '.addClass($score, 1).'"></i>
          <i class="fa '.addClass($score, 2).'"></i>
          <i class="fa '.addClass($score, 3).'"></i>
          <i class="fa '.addClass($score, 4).'"></i>
          <p>('.$contractCounts.')</p></span>';
  }
  return $html;
}
function addClass($score, $thisscore, $from=''){
  if($from == 'workhistory' || $from == 'workhistory_li')
  return ($score >= $thisscore) ? '<img src="../assets/img/Shape-6.png">' : '<img src="../assets/img/star-blank.svg">';
  else
  return ($score > $thisscore) 
             ? ( ($score > $thisscore && $score < $thisscore+1) ? 'fa-star-half-o' : 'fa-star') 
             : 'fa-star-o';
  }

function calculateYears($endDate, $startDate){
	$diff = abs(strtotime($endDate)-strtotime($startDate));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    echo $years.' years ';
}

function calculateTimeSheetAmount($time, $hourlyRate){
    $amount = 0;
    $timesplit = explode(':', $time);
    $amountHour = $timesplit[0] * $hourlyRate;
    $amountMin = $timesplit[1] * ($hourlyRate / 60);
    $amount = $amountHour + $amountMin;
    return $amount;
}

// encypt id for url
function encryptUrlId($id){
    $number =  str_replace(' ','',$id);
    $arr = array('0' => 'z',
                 '1' => 'a',
                 '2' => 'b' ,
                 '3' => '3' ,
                 '4' => 'd' ,
                 '5' => 'e' ,
                 '6' => 'f' ,
                 '7' => '7' ,
                 '8' => 'h' ,
                 '9' => 'i');
    $retunNumber = strtr($number,$arr);
    return $retunNumber;
    
}

// decypt id for url
function decryptUrlId($id){
  $arr = array('z' => '0',
               'a' => '1',
               'b' => '2' ,
               '3' => '3' ,
               'd' => '4' ,
               'e' => '5' ,
               'f' => '6' ,
               '7' => '7' ,
               'h' => '8' ,
               'i' => '9');
  $id = strtr($id,$arr);
  return $id;
}



function getJobProposalsCount($jid){
  // proposal should not be archived
  return JobProposals::where('job_id',$jid)->where('proposal_status','!=','2')->count();
}
function getJobHiredCount($jid){
  // contract should not be draft and not be in arched
  return JobContract::where('job_id',$jid)->whereNotIn('contract_status',['3','1'])->count();
}

// milesstones count
function getContractMilestonesCount($cid, $type){
    if($type == 'pending'){
      return JobContractMilestones::where('contract_id',$cid)->where('status','1')->count();
    }else if($type == 'completed'){
      return JobContractMilestones::where('contract_id',$cid)->where('status','2')->count();
    }else{
      return JobContractMilestones::where('contract_id',$cid)->count();
    }
}

// get logged hours
function getLoggedHours($cid, $timePeriod = ''){

  if($timePeriod == 'thisweek'){
    $monday = strtotime("last monday");
    $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
    $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
    $this_week_sd = date("Y-m-d",$monday);
    $this_week_ed = date("Y-m-d",$sunday);

    $times =  JobContractTimesheet::where('contract_id',$cid)
              ->where('due_date', '>=' , $this_week_sd)
              ->where('due_date', '<=' , $this_week_ed)->get();
  }else if($timePeriod == 'thismonth'){
    $this_month_sd = date("Y-m")."-01";
    $this_month_ed = date("Y-m-t");

    $times =  JobContractTimesheet::where('contract_id',$cid)
              ->where('due_date', '>=' , $this_month_sd)
              ->where('due_date', '<=' , $this_month_ed)->get();
  }else{
    $times =  JobContractTimesheet::where('contract_id',$cid)->get();
  }
  $timein_mins = 0;
  foreach ($times as $key => $row) {
     $timesplit = explode(':', $row->time);
     $min = ($timesplit[0] * 60) + $timesplit[1];
     $timein_mins = $timein_mins + $min;
  }
  $hours = floor($timein_mins / 60);
  $min = $timein_mins - ($hours * 60);
  return $hours.":".$min;
}


// get logged hours
function getLoggedHoursAmount($cid, $timePeriod = ''){

  if($timePeriod == 'thisweek'){
    $monday = strtotime("last monday");
    $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
    $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
    $this_week_sd = date("Y-m-d",$monday);
    $this_week_ed = date("Y-m-d",$sunday);

    $times =  JobContractTimesheet::where('contract_id',$cid)
              ->where('status', 2)
              ->where('due_date', '>=' , $this_week_sd)
              ->where('due_date', '<=' , $this_week_ed)->sum('amount');
  }else if($timePeriod == 'thismonth'){
    $this_month_sd = date("Y-m")."-01";
    $this_month_ed = date("Y-m-t");

    $times =  JobContractTimesheet::where('contract_id',$cid)
              ->where('status', 2)
              ->where('due_date', '>=' , $this_month_sd)
              ->where('due_date', '<=' , $this_month_ed)->sum('amount');
  }else{
    $times =  JobContractTimesheet::where('contract_id',$cid)->where('status', 2)->sum('amount');
  }
  $amount = amountFormat($times);
  return $amount;
}

// amount format
function amountFormat($amount){
  return (is_numeric($amount)) ? number_format($amount, 2) : $amount;
}

// get paid amount on project type contract
function getPaidAmount($cid){
  $times =  JobContractEarnings::where('contract_id',$cid)
             ->where('status','2')->sum('amount');
  $amount = amountFormat($times);
  return $amount;
}

// get remaining amount on project type contract
function getRemainingAmount($cid, $total_cost){
  $times =  JobContractEarnings::where('contract_id',$cid)
             ->where('status','2')->sum('amount');
   $amount = $times;
   $amount = amountFormat($total_cost - $amount);
   return $amount;
}

function getMessageTime($datetime){

  if(Session::has('current_time_zone')){
       $current_time_zone = Session::get('current_time_zone');
       $utc = strtotime($datetime)-date('Z'); // Convert the time zone to GMT 0. If the server time is what ever no problem.
       $attr = $utc+$current_time_zone; // Convert the time to local time
       $datetime = date("Y-m-d H:i:s", $attr);
    }

  return date('h:i a', strtotime($datetime));
}

function getMessageTimeAgo($datetime){

    $timeago='';  
    $starttime = date('Y-m-d H:i:s');
    if($starttime != $datetime)
    {
        $now = new DateTime($starttime);
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $days = $diff->days;
        $hours = $diff->h;
        $min = $diff->i;
        $sec = $diff->s;
        if($ago > $now)
        {
            $last = '';
        }
        else
        {
           $last = ' ago';
        }
        if($sec != 0)
         $timeago = ' ' .$sec .' sec'.($sec > 1 ? 's' : '');
        if($min != 0)
         $timeago = ' ' .$min .' min'.($min > 1 ? 's' : '');
        if($hours != 0)
         $timeago = ' ' .$hours .' hour'.($hours > 1 ? 's' : '');
        if($days != 0)
        {
              $timeago = ' ' .$days .' day'.($days > 1 ? 's' : '');
             if($ago > $now)
             {    
                 if($hours != 0)
                     $timeago .= ' ' .$hours .' hour'.($hours > 1 ? 's' : '');
             }
        }
        $timeago =  trim($timeago).$last;
    }else{
        $timeago = 'a sec ago';
    }
     return $timeago;
}


function getDateAgo($date, $type = 'posted'){
    $timeago='';  
    $datetime = $date;
    $starttime = date('Y-m-d H:i:s');
    if($starttime != $datetime)
    {
        $now = new DateTime($starttime);
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $days = $diff->days;
        $hours = $diff->h;
        $min = $diff->i;
        $sec = $diff->s;
        if($ago > $now)
        {
            $last = '';
        }
        else
        {
           $last = ' ago';
        }
        if($sec != 0)
         $timeago = ' ' .$sec .' sec'.($sec > 1 ? 's' : '');
        if($min != 0)
         $timeago = ' ' .$min .' min'.($min > 1 ? 's' : '');
        if($hours != 0)
         $timeago = ' ' .$hours .' hour'.($hours > 1 ? 's' : '');
        if($days != 0)
        {
              $timeago = ' ' .$days .' day'.($days > 1 ? 's' : '');
             if($ago > $now)
             {    
                 if($hours != 0)
                     $timeago .= ' ' .$hours .' hour'.($hours > 1 ? 's' : '');
             }
        }
        $timeago =  trim($timeago).$last;
    }else{
        $timeago = 'a sec ago';
    }

  if($type == 'posted'){
     return 'Posted '.$timeago;
  }else if($type == 'archived'){
     return 'Archived '.$timeago;
  }else if($type == 'updated'){
     return 'Updated '.$timeago;
  }else{
     return $timeago;
  }

}

function expertLevel($exp){
	$expertLevel = 'Entry Level';
	if(!empty($exp) && $exp ==1){
      $expertLevel = 'Entry Level';
	}else if(!empty($exp) && $exp ==2){
      $expertLevel = 'Advanced';
	}else if(!empty($exp) && $exp ==3){
      $expertLevel = 'Expert';
	}
	echo $expertLevel;
}

function englishLevel($eng){
	$level = 'Native or Billingual';
	if(!empty($eng) && $eng =='native'){
      $level = 'Native or Billingual';
	}else if(!empty($eng) && $eng =='fluent'){
      $level = 'Fluent';
	}else if(!empty($eng) && $eng =='conversational'){
      $level = 'Conversational';
	}
	echo $level;
}

function getServiceName($skillId){
  echo Services::getById($skillId);
}

function getSkillName($skillId){
  echo Skills::getById($skillId);
}

function createSocilLinks($link, $type){
	$link = $link;
	if($type == 'github'){
       if(strpos( $link, 'github') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://github.com/'.$lastElement;
       }
	}else if($type == 'medium'){
       if(strpos($link, 'medium') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://medium.com/'.$lastElement;
       }
	}else if($type == 'codepen'){
       if(strpos( $link, 'codepen') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://codepen.io/'.$lastElement;
       }
	}else if($type == 'behance'){
       if(strpos( $link, 'behance') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://behance.com/'.$lastElement;
       }
	}else if($type == 'dribbble'){
       if(strpos( $link, 'dribbble') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://dribbble.com/'.$lastElement;
       }
	}else if($type == 'youtube'){
       if(strpos($link, 'youtube') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://youtube.com/'.$lastElement;
       }
	}else if($type == 'linkedin'){
       if(strpos( $link, 'linkedin') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://linkedin.com/'.$lastElement;
       }
	}else if($type == 'instagram'){
       if(strpos( $link, 'instagram') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://instagram.com/'.$lastElement;
       }
	}else if($type == 'twitter'){
       if(strpos( $link, 'twitter') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://twitter.com/'.$lastElement;
       }
	}else if($type == 'pinterest'){
       if(strpos( $link, 'pinterest') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://pinterest.com/'.$lastElement;
       }
	}else if($type == 'facebook'){
       if(strpos( $link, 'facebook') == false){
       	   $strArray = explode('/',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://facebook.com/'.$lastElement;
       }
	}else if($type == 'website'){
       if(strpos( $link, 'http') == false && strpos( $link, 'www') !== false ){
       	   $strArray = explode('www.',$link);
           $lastElement = !empty(end($strArray))? end($strArray) : $strArray[count($strArray)-1];
          $link = 'http://'.$lastElement;
       }
	}else{

	}
	return $link;
}


function dateFormat($date){
  return date('M d, Y', strtotime($date));
}

function generateUsername($email)
{
    $usern = explode('@', $email);
    $username = !empty($usern)?$usern[0]:$user->email;

    $exist = 0;$try=0;
    while($exist == 0)
    {
      $username = $username.'-'.$try;
      $table_exist = DB::table('users')->where('username',$username)->first();
      if(empty($table_exist)) $exist =1;
      $try++;
    }  
    return $username;
}

  function uniqueNumber($minnum,$table,$columnname,$prefix='')
  {
      $exist = 0;$try=0;
        while($exist == 0)
        {
          $characters = '0123456789';
          $charactersLength = strlen($characters);     
          $randomString = !empty($prefix)? $prefix : '';
          $len = $minnum+$try;
          for ($i = 0; $i < $len; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          $table_exist = DB::table($table)->where($columnname,$randomString)->first();
          if(empty($table_exist)) $exist =1;
          $try++;
        }  
        return $randomString;
  }