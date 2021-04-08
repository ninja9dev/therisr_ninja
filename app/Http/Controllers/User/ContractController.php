<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\User, App\Models\Services, App\Models\Skills, App\Models\Jobs, App\Models\JobProposals, App\Models\JobContract, App\Models\JobContractMilestones, App\Models\JobContractTimesheet, App\Models\JobContractEarnings, App\Models\JobContractEnd;
use DB;
   
class ContractController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $per_page_data = 6;
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

    // single contarct
    function contract($cid)
    {
      try{
          $cId = decryptUrlId($cid);
          $data['contract'] = JobContract::findOrFail($cId);
          $data['skills'] = Skills::all();
          $data['services'] = Services::all();
          $user = User::find(Auth::user()->id);
          if($user->user_type == '2'){// if user is employer
            return view('user.common.contracts.single_contract_employer')->with($data);
          }else{
            return view('user.common.contracts.single_contract_freelancer')->with($data);
          }
      }catch(ModelNotFoundException $e){
        return redirect(url()->previous());
      }
    }

    // allcontracts
    function allcontracts(){
        return view('user.employer.contracts.all_contracts');
    }
    
    // active contracts
    function activecontracts(){
        return view('user.employer.contracts.active_contracts');
    }
    
    // ended contracts
    function endedcontract()
    {
        return view('user.freelancer.contracts.ended_contract');
    }
    
    // employee ended contracts
    function e_endedcontract()
    {
        return view('user.employer.contracts.ended_contract');
    }

    // archivedcontracts
    function archivedcontracts(){
        return view('user.employer.contracts.archived_contracts');
    }

      // get job basic part 
    function get_contractBasic($id){  
        $job = JobContract::withTrashed()->find($id);
        $data['contract'] = $job;
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        return view('user.common.contracts.contract_single_area')->with($data);
    }

       // emp my jobs
    function get_contract_area_ajax($page){

        $sortby = !empty($_GET['sortby']) ? $_GET['sortby'] : 'contract_start_on';
        $order = !empty($_GET['order']) ? $_GET['order'] : 'desc';
        
        if($page == 'activecontracts'){
           $contracts =  JobContract::where(array(
                            'user_by' => Auth::user()->id,
                            'contract_status' => '2'
                            ))->orderBy($sortby, $order)->paginate($this->per_page_data);    
        }
        else if($page == 'endedcontract' || $page == 'e_endedcontract')
        {
           $contracts =  JobContract::where(array(
                            'user_by' => Auth::user()->id,
                            'contract_status' => '6'
                            ))->orderBy($sortby, $order)->paginate($this->per_page_data);    
        }else if($page == 'archivedcontracts'){
           $contracts =  JobContract::withTrashed()->where(array(
                            'user_by' => Auth::user()->id,
                            'contract_status' => '3'
                            ))->orderBy($sortby, $order)->paginate($this->per_page_data);    
        }else{
          $contracts = JobContract::where(array(
                            'user_by' => Auth::user()->id
                            ))
                           ->whereIn('contract_status',['2','5','6'])->orderBy($sortby, $order)->paginate($this->per_page_data);
        }
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        $data['currentpage'] = $page;
        $data['contracts'] = $contracts;
        $data['sorting'] = array(
                          'sortby' => $sortby,
                          'order'  => $order
                          ); 
        return view('user.employer.contracts.contract_details.contract_area_ajax')->with($data);
    }
    
    function get_contract_area_ajaxfreelancer($page)
    {
        $sortby = !empty($_GET['sortby']) ? $_GET['sortby'] : 'contract_start_on';
        $order = !empty($_GET['order']) ? $_GET['order'] : 'desc';
        
        $contracts =  JobContract::where(array(
                            'user_to' => Auth::user()->id
                            ))
                      ->whereIn('contract_status',['2','5','6'])
                      ->orderBy($sortby, $order)->paginate($this->per_page_data); 
        
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        $data['currentpage'] = $page;
        $data['contracts'] = $contracts;
        $data['sorting'] = array(
                          'sortby' => $sortby,
                          'order'  => $order
                          ); 
        return view('user.freelancer.contracts.contract_details.contract_area_ajax')->with($data);
    }


    // get milesstones area
    function get_milestones($cid){
        $job = JobContract::find($cid);
        $data['contract'] = $job;
        $data['milestones'] = JobContractMilestones::where('contract_id', $cid)->paginate(100);
        $data['milestone_sum'] = JobContractMilestones::where('contract_id', $cid)->sum('amount');
        // echo "<pre>";
        // print_r($data);die;
        return view('user.common.milestones.milestones_area')->with($data);
    }
     // get timesheets area
    function get_timesheets($cid){
        $job = JobContract::find($cid);
        $data['contract'] = $job;
        $data['timesheets'] = JobContractTimesheet::where('contract_id', $cid)->paginate(100);
        $data['timesheets_sum'] = JobContractTimesheet::where('contract_id', $cid)->sum('amount');
        $data['timesheets_time_sum'] = getLoggedHours($cid);
        return view('user.common.timesheets.timesheet_area')->with($data);
    }

    // get payments area
    function get_payments($cid){
        $job = JobContract::find($cid);
        $data['contract'] = $job;
        $data['payments'] = JobContractEarnings::where('contract_id', $cid)->paginate(100);
        $data['payments_sum'] = JobContractEarnings::where('contract_id', $cid)->sum('amount');
        return view('user.common.payments.payments_area')->with($data);
    }
    // get feedbacks area
    function get_feedbacks($cid){
        $job = JobContract::find($cid);
        $data['contract'] = $job;
        return view('user.common.feedbacks.feedbacks_area')->with($data);
    }
    // save milestone
    function saveMilestones($cid, Request $request){
        $job = JobContract::find($cid);
        $job_id = !empty($job) ? $job->job_id : '';
        if(!empty($_POST['allRecord'])){
             foreach ($_POST['allRecord'] as $key => $value) {
                    $saveData = array(
                        'contract_id'  => $cid,
                        'job_id'       => $job_id,
                        'milestone'   => $value['milestone'],
                        'due_date'     => $value['due_date'],
                        'amount'       => $value['amount'],
                        'status'       => !empty($value['status']) ? (($value['status'] == 'Completed' || $value['status'] == '2') ? 2 : 1) : 1
                    );
                   $match_s = array(
                        'contract_id' => $cid,
                        'id'  => !empty($value['id']) ? $value['id'] : 0
                    );
                    $contract = JobContractMilestones::updateOrCreate($match_s,$saveData); 
             }

            // create notification
              if($job->user_by == Auth::user()->id) //end by employer
              {
                createNotification($job,'on_contract_milestone_add_edit_by_employer');
              }else{
                createNotification($job,'on_contract_milestone_add_edit_by_freelancer');
              }

            echo json_encode(array(
                'code'=>200,
                'message'=>'Data saved successfully!'
            ));
        }else{
            echo json_encode(array(
                    'code'=>500,
                    'message'=>'No data found!'
                ));
        }
    }

        // save timesheets
    function saveTimesheets($cid, Request $request){
        $job = JobContract::find($cid);
        $job_id = !empty($job) ? $job->job_id : '';
        if(!empty($_POST['allRecord'])){
            $monday = strtotime("last monday");
            $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
            $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
            $this_week_sd = date("Y-m-d",$monday);
            $this_week_ed = date("Y-m-d",$sunday);

            $this_Week_hrs = 0;
            $timein_mins = 0;
            foreach ($_POST['allRecord'] as $key => $value) {
              if($value['due_date'] >= $this_week_sd && $value['due_date'] <= $this_week_ed)
              {
                 $timesplit = explode(':', $value['time']);
                 $min = ($timesplit[0] * 60) + $timesplit[1];
                 $timein_mins = $timein_mins + $min;
              }
             }
            $hours = floor($timein_mins / 60);
            $min = $timein_mins - ($hours * 60);

            if($hours > $job->weekly_limit){
              echo json_encode(array(
                    'code'=>500,
                    'message'=>'Logged hours are more than the weekly hours limit!'
                ));
            }else{
                 foreach ($_POST['allRecord'] as $key => $value) {
                    // echo "<pre>";
                    // print_r($_POST['allRecord']);
                    $amount = calculateTimeSheetAmount($value['time'], $job->hourly_rate);
                        $saveData = array(
                            'contract_id'  => $cid,
                            'job_id'       => $job_id,
                            'description'  => $value['description'],
                            'due_date'     => $value['due_date'],
                            'time'         => $value['time'],
                            'amount'       => $amount,
                            'status'       => !empty($value['status']) ? (($value['status'] == 'Completed' || $value['status'] == '2') ? 2 : 1) : 1
                        );
                       $match_s = array(
                            'contract_id' => $cid,
                            'id'  => !empty($value['id']) ? $value['id'] : 0
                        );
                        $contract = JobContractTimesheet::updateOrCreate($match_s,$saveData); 
                 }
                
                // create notification
                createNotification($job,'on_timesheet_add_edit_by_freelancer');

                echo json_encode(array(
                    'code'=>200,
                    'message'=>'Data saved successfully!'
                ));
            }
        }else if($_POST['status']){
            $saveData = array(
               'status'  => ($_POST['status'] == 2) ? 2 : 1
            );
           $match_s = array(
                'id'  => !empty($_POST['id']) ? $_POST['id'] : 0
            );
            $contract = JobContractTimesheet::updateOrCreate($match_s,$saveData); 
            // create notification
            if($_POST['status'] == 2){
              createNotification($job,'on_timesheet_approved_by_employer');
            }else{
              createNotification($job,'on_timesheet_unapproved_by_employer');
            }
            
            echo json_encode(array(
                    'code'=>200,
                    'message'=>'Timesheet updated successfully!'
                ));
        }
        else{
            echo json_encode(array(
                    'code'=>500,
                    'message'=>'No data found!'
                ));
        }
    }
    // delete milestone
    function delete_milestone($id){
        $milestones = JobContractMilestones::find($id);
        $contract = JobContract::find($milestones->contract_id);
        if ($milestones->forceDelete()) {

          // create notification
          if($contract->user_by == Auth::user()->id) //end by employer
          {
            createNotification($contract,'on_contract_milestone_delete_by_employer');
          }else{
            createNotification($contract,'on_contract_milestone_delete_by_freelancer');
          }

          echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'id' => $milestones->id));
        }else{
         echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
        }
    }
    // delete timesheet
    function delete_timesheet($id){
        $timesheet = JobContractTimesheet::find($id);
        if ($timesheet->forceDelete()) {
          echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'id' => $timesheet->id));
        }else{
         echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
        }
    }
    


    // freelancer part

    //myjobs page
    function myjobs(){
         return view('user.freelancer.contracts.myjobs');
    }
   
   
     //activecontract page
    function activecontract(){
         return view('user.freelancer.contracts.active_contract');
    }

    //archivedcontract page
    function archivedcontract(){
         return view('user.freelancer.contracts.archived_contract');
    }

    //jobreports page
    function jobreports(){
      if(Auth::user()->user_type == '2'){
        return view('user.employer.jobs.jobreports');
      }else{
        return view('user.freelancer.contracts.jobreports');
      }
    }

    // job report ajax
    function get_job_report_area_ajax($page){
      $sortby = !empty($_GET['sortby']) ? $_GET['sortby'] : 'created_at';
      $order = !empty($_GET['order']) ? $_GET['order'] : 'desc';
      $sortmain = $sortby;
      if($sortby == 'oldest'){
        $sortby = 'created_at';  
        $order = "asc";
      }

      if(Auth::user()->user_type == '2'){
        $contracts_ids = JobContract::where('user_by', Auth::user()->id)->pluck('id');
      }else{
        $contracts_ids = JobContract::where('user_to', Auth::user()->id)->pluck('id');
      }
      $reports = JobContractEarnings::whereIn('contract_id',$contracts_ids)
                         ->where('status', '2')
                         ->orderBy($sortby, $order)
                         ->paginate($this->per_page_data);
      $data['currentpage'] = $page;
      $data['reports'] = $reports;
      $data['sorting'] = array(
                        'sortby' => $sortmain,
                        'order'  => $order
                        ); 
      if(Auth::user()->user_type == '2'){
        return view('user.employer.jobs.job_details.job_report_ajax')->with($data);
      }else{
        return view('user.freelancer.contracts.contract_details.job_report_ajax')->with($data);
      }
    }


     // get job basic part 
    function get_contractOfferBasicF($id){  
        $job = JobContract::withTrashed()->find($id);
        $data['contract'] = $job;
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        return view('user.freelancer.job_ajax.contract_offer_basic')->with($data);
    }

        // contract status change
    function statuschange_contract($type, $cid){
          $contract = JobContract::withTrashed()->find($cid);
                  $match_s = array(
                      'user_to' => $contract->user_to,
                      'job_id'  => $contract->job_id,
                      'id'  => $contract->id
                  );
          if($type == 'reject')
          {
              $input = array(
                'contract_status' => '4',
                'rejected_at' => Date::now()
              );
              $done = JobContract::updateOrCreate($match_s,$input); 
              if ($done) {
                  // create notification
                  if($contract->user_to == Auth::user()->id) //end by employer
                  {
                    createNotification($contract,'on_contract_rejected_by_freelancer');
                  }
                echo json_encode(array('code'=>200,'message'=>'Rejected successfully!', 'id' => $contract->id));
              }else{
               echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
              }
          }else if($type == 'accept'){

              $input = array(
                'contract_status' => '2',
                'contract_start_on' => Date::now()
              );
              $done = JobContract::updateOrCreate($match_s,$input); 
              if ($done) {
                  // create notification
                  if($contract->user_by == Auth::user()->id) //end by employer
                  {
                    createNotification($contract,'on_contract_activated_by_employer');
                  }else{
                    createNotification($contract,'on_contract_accepted_by_freelancer');
                  }
                echo json_encode(array('code'=>200,'message'=>'Accepted successfully!', 'id' => $contract->id));
              }else{
               echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
              }
          }else if($type == 'active'){

              $input = array(
                'contract_status' => '2'
              );
              $done = JobContract::updateOrCreate($match_s,$input); 
              if ($done) {
                  // create notification
                  if($contract->user_by == Auth::user()->id) //end by employer
                  {
                    createNotification($contract,'on_contract_activated_by_employer');
                  }
                echo json_encode(array('code'=>200,'message'=>'Activated successfully!', 'id' => $contract->id));
              }else{
               echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
              }
          }else if($type == 'pause'){
              $input = array(
                'contract_status' => '5',
                'contract_paused_on' => Date::now()
              );
              $done = JobContract::updateOrCreate($match_s,$input); 
              if ($done) {
                  // create notification
                  if($contract->user_by == Auth::user()->id) //end by employer
                  {
                    createNotification($contract,'on_contract_paused_by_employer');
                  }
                echo json_encode(array('code'=>200,'message'=>'Paused successfully!', 'id' => $contract->id));
              }else{
               echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
              }
          }else if($type == 'delete'){
                $contract->contract_status = '3';
                $contract->save(); //save status
                $contract->delete(); // now delete (it will just update date in deleted_at column)
                if ($contract->trashed()) {
                  echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'id' => $contract->id));
                }else{
                 echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
                }
          }else if($type == 'restore'){
                $contract->contract_status = '2';
                $contract->save(); //save status
                if ($contract->restore()) {
                  echo json_encode(array('code'=>200,'message'=>'Restored successfully!', 'id' => $contract->id));
                }else{
                 echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
                }
          }else{

          }
    }


     function contract_area_ajax_F($page)
     { 
        $sortby = !empty($_GET['sortby']) ? $_GET['sortby'] : 'contract_start_on';
        $order = !empty($_GET['order']) ? $_GET['order'] : 'desc';
        
        if($page == 'activecontracts')
        {
           $data['contracts'] = JobContract::where(
                            array(
                                'user_to' => Auth::user()->id,
                                'contract_status' => '2'
                            ))->orderBy($sortby, $order)->paginate($this->per_page_data);    
        }else if($page == 'archivedcontracts'){
           $data['contracts'] = JobContract::withTrashed()->where(array(
                            'user_to' => Auth::user()->id,
                            'contract_status' => '3'
                            ))->orderBy($sortby, $order)->paginate($this->per_page_data);    
        }else{
          $data['contracts'] = JobContract::where(array(
                            'user_to' => Auth::user()->id))
                             ->whereIn('contract_status',['2','5','6'])
                             ->orderBy($sortby, $order)
                             ->paginate($this->per_page_data);
        }
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        $data['currentpage'] = $page;
        $data['sorting'] = array(
                          'sortby' => $sortby,
                          'order'  => $order
                    );  
        return view('user.freelancer.contracts.contract_details.contract_area_ajax')->with($data);
    }

    
     function f_workhistory_ajax($fid = '',$page = ''){ 
        $sortby = !empty($_GET['sortby']) ? $_GET['sortby'] : 'contract_end_on';
        $order = !empty($_GET['order']) ? $_GET['order'] : 'desc';

        $userId = !empty($fid) ? $fid : Auth::user()->id;
        $data['user'] = User::find($userId);
        $data['contracts'] = JobContract::where(array(
                            'user_to' => $userId,
                            'contract_status' => '6'
                            ))
                          ->whereNotNull('contract_end_on')
                          ->orderBy($sortby, $order)->paginate($this->per_page_data);  
        $data['page'] = $page;  
        return view('user.common.workhistory.workhistory_section')->with($data);
     }

    // end contract
    function end_contract($id)
    {
        try
        {
            $user = User::find(Auth::user()->id);
            $id = decryptUrlId($id);
            $data['loginUserType'] = $user->user_type;
            $data['contract'] = JobContract::findOrFail($id);
            return view('user.employer.contracts.end_contract')->with($data);
        }
        catch(ModelNotFoundException $e)
        {
            return redirect(url()->previous());
        }
    }

    function endContractSubmit(Request $request)
    {
        $match_s = array(
            'user_by'      => Auth::user()->id,
            'contract_id'  => $request->contract_id
        );
        $input = $request->all();
        $input['all_ratings'] = json_encode($input['all_ratings']);

        $done = JobContractEnd::updateOrCreate($match_s,$input); 
        if ($done)
        {
          try
          {
              $contract = JobContract::withTrashed()->find($request->contract_id);
              
              if($contract->contract_status != '6')
              {
                  $match_s = array(
                      'id'        => $request->contract_id
                  );
                  
                  $input = array(
                      'contract_status' => '6',
                      'contract_end_on' => Date::now()
                  );
                  $done = JobContract::updateOrCreate($match_s,$input); 
              }

              // create notification
              if($contract->user_by == Auth::user()->id) //end by employer
              {
                  createNotification($contract,'on_contract_end_by_employer');
              }else{
                  createNotification($contract,'on_contract_end_by_freelancer');
              }
          }catch(ModelNotFoundException $e)
          {
            //return redirect(url()->previous());
          }
            
            
            // calculate user score
            $userScore = calculateUserScore($request->user_to);
             

            $match_s = array( 
                'id'  =>$request->user_to
            );

            $input = array(
                'therisr_score' => $userScore,
            );
            $done = User::updateOrCreate($match_s,$input);

            echo json_encode(array('code'=>200,'message'=>'Your contract has ended.'));
        }else{
            echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
        }
    }

 }