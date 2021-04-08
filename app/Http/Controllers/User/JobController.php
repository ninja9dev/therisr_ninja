<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User, App\Models\UserProfile, App\Models\Services, App\Models\Skills, App\Models\Jobs, App\Models\JobLikeSkip, App\Models\JobReports, App\Models\JobProposals, App\Models\JobContract; 
use DB;
   
class JobController extends Controller
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

  
    // alljobs
    function alljobs(){ 
        return view('user.freelancer.jobs.alljobs');
    }
     // freelancer my jobs
    function get_job_ajax_frlncr($page){
      DB::enableQueryLog(); // Enable query log

       $sortby = !empty($_GET['sortby']) 
                ? $_GET['sortby'] 
                : ( ($page == 'likedjobs' || $page == 'skippedjobs') 
                   ? 'created_at'  
                   : (($page == 'offerjobs') ? 'offer_sent_on' :'posted_at')  );
       $order = !empty($_GET['order']) ? $_GET['order'] : 'desc';
       $sortmain = $sortby;
       
       if($sortby == 'oldest'){
         $sortby = ($page == 'likedjobs' || $page == 'skippedjobs') 
                   ? 'created_at'  
                   : (($page == 'offerjobs') ? 'offer_sent_on' :'posted_at') ;
         $order = "asc";
       }

      if($page == 'offerjobs'){
        $data['jobs'] = JobContract::where(array(
                            'user_to' => Auth::user()->id,
                            'contract_status' => '1'
                            ))->orderBy($sortby, $order)
                           ->paginate($this->per_page_data);

        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        $data['currentpage'] = $page;
        return view('user.freelancer.job_ajax.offer_area_ajax')->with($data);
     }else{
          if($page == 'likedjobs'){
              $job= JobLikeSkip::withCount('jobProposals')
                  ->where(array(
                              'user_id' => Auth::user()->id,
                              'like_status' => '2'
                  ))->orderBy($sortby, $order)->paginate($this->per_page_data);
              $data['jobs'] = $job;
          }else if($page == 'skippedjobs'){
              $data['jobs'] = JobLikeSkip::withCount('jobProposals')->where(array(
                              'user_id' => Auth::user()->id,
                              'skip_status' => '2'
                              ))->orderBy($sortby, $order)->paginate($this->per_page_data);
          }else if($page == 'appliedjobs'){
              // get jobs which are not skipped
              $pro_Query = Jobs::withCount('jobProposals')
                       ->whereIn('id', JobProposals::select('job_id')
                                      ->where(array('user_id' => Auth::user()->id))
                                      ->get()->toArray()
                        );
              $data['jobs'] = $pro_Query->where(array('jobs.job_status'=>'2'))
                             ->orderBy($sortby, $order)->paginate($this->per_page_data);
          }else if($page == 'activejobs'){
            $data['jobs'] = JobContract::where(array(
                            'user_to' => Auth::user()->id,
                            'contract_status' => '2'
                            ))->orderBy($sortby, $order)->paginate($this->per_page_data);                 
          }else{
             
            $myExpertise = !empty(Auth::user()->userProfile) ? Auth::user()->userProfile->services : [];
            $mySkills = !empty(Auth::user()->userProfile) ? Auth::user()->userProfile->skills : [];
              // get jobs which are not skipped
              $pro_Query = Jobs::withCount('jobProposals');
                // filter jobs acording to my skills or services
              $orwhere = [];
              $services = explode(',', $myExpertise);
              $skills = explode(',', $mySkills);
              if(!empty($services) ||  !empty($skills))
              {
                 if(!empty($services) &&  $myExpertise != '')
                  {
                    foreach ($services as $key => $value) {
                      $orwhere[] = 'FIND_IN_SET('.$value.',expertise)';
                     } 
                  }
                  if(!empty($skills) &&  $mySkills != '')
                  {
                    foreach ($skills as $key => $value) {
                       $orwhere[] = 'FIND_IN_SET('.$value.',skills)';
                     } 
                  }
                  $orwhere = implode(' or ', $orwhere);
                 $pro_Query = $pro_Query->whereRaw('(' .$orwhere. ')'); 
              }

              
              // the score score filter
              if(Auth::user()->therisr_score != '' && Auth::user()->therisr_score != null){
                $pro_Query = $pro_Query
                ->whereRaw('( therisr_score <= '.Auth::user()->therisr_score.' or therisr_score = "any")');
              }
              
              $pro_Query = $pro_Query->whereNotIn('id', JobLikeSkip::select('job_id')
                                  ->where(array(
                                      'user_id' => Auth::user()->id,
                                      'skip_status' => '2'
                                      )) )
                              ->whereNotIn('id', JobProposals::select('job_id')
                                    ->where(array(
                                       'user_id' => Auth::user()->id)));
              $data['jobs'] = $pro_Query->where(array('jobs.job_status'=>'2'))
                              ->orderBy($sortby, $order)->paginate($this->per_page_data);
              //dd(DB::getQueryLog()); // Show results of log
          }

          $data['skills'] = Skills::all();
          $data['services'] = Services::all();
          $data['currentpage'] = $page;
          $data['sorting'] = array(
                          'sortby' => $sortmain,
                          'order'  => $order
                    ); 
          return view('user.freelancer.job_ajax.job_area_ajax')->with($data);
      }
    }
    // get job basic part 
    function get_jobBasicF($id){ 
        $job = Jobs::withTrashed()->find($id);
        $data['job'] = $job;
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        return view('user.freelancer.job_ajax.job_basic')->with($data);
    }

    // job like skip
    function job_likeskip($type, $jid){
       $job = Jobs::withTrashed()->find($jid);
            $match_s = array(
                'user_id' => Auth::user()->id,
                'job_id'  => $job->id
            );
        if($type == 'unskip')
        {
            $input = array(
              'skip_status' => '1'
            );
            $done = JobLikeSkip::updateOrCreate($match_s,$input); 
            if ($done) {
              echo json_encode(array('code'=>200,'message'=>'Unskipped successfully!', 'id' => $job->id));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'skip'){

            $input = array(
              'skip_status' => '2'
            );
            $done = JobLikeSkip::updateOrCreate($match_s,$input); 
            if ($done) {
              echo json_encode(array('code'=>200,'message'=>'Skipped successfully!', 'id' => $job->id));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'like'){
           
            $input = array(
              'like_status' => '2'
            );
            $done = JobLikeSkip::updateOrCreate($match_s,$input); 
            if ($done) {
              echo json_encode(array('code'=>200,'message'=>'Job Liked successfully!', 'id' => $job->id));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'unlike'){
            
            $input = array(
              'like_status' => '1'
            );
            $done = JobLikeSkip::updateOrCreate($match_s,$input); 
            if ($done) {
              echo json_encode(array('code'=>200,'message'=>'Job unliked successfully!', 'id' => $job->id));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else{

        }
    }

    // job report submit
    function job_report(Request $request)
    {
        $input = $request->all(); 
        $match_s = array(
                'user_id' => Auth::user()->id,
                'job_id'  => $input['job_id']
        );
        $done = JobReports::updateOrCreate($match_s,$input); 
        if ($done) {
          echo json_encode(array('code'=>200,'message'=>'Job report submitted successfully!', 'id' => $input['job_id']));
        }else{
         echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
        }
    }

    


    // jobdetail page
    function jobdetail(){
        return view('user.freelancer.jobs.jobdetail');
    }

    // appliedjobs page
    function appliedjobs(){
        return view('user.freelancer.jobs.appliedjobs');
    }
     // skippedjobs page
    function skippedjobs(){
        return view('user.freelancer.jobs.skippedjobs');
    }
     // likedjobs page
    function likedjobs(){
        return view('user.freelancer.jobs.likedjobs');
    }

    // offer jobs
    function offerjobs(){
        return view('user.freelancer.jobs.offerjobs');
      }


    // emp my jobs
    function e_myjobs(){
        return view('user.employer.jobs.myjobs');
    }
    // emp my jobs
    function get_job_area_ajax($page){ 
        $sortby = !empty($_GET['sortby']) ? $_GET['sortby'] : 'posted_at';
        $order = !empty($_GET['order']) ? $_GET['order'] : 'desc';
        $sortmain = $sortby;

        if($sortby == 'oldest'){
           $sortby = "posted_at";
           $order = "asc";
        }

        if($page == 'draftjobs'){
           $data['jobs'] = Jobs::withCount('jobProposals')->where(array(
                            'user_id' => Auth::user()->id,'job_status'=>'1'
                          ))
                           ->orderBy($sortby, $order)
                           ->paginate($this->per_page_data);
        }else if($page == 'archivedjobs'){
           $data['jobs'] = Jobs::onlyTrashed()->withCount('jobProposals')->where(array(
                            'user_id' => Auth::user()->id, 'job_status'=>'3'))
                            ->orderBy($sortby, $order)
                            ->paginate($this->per_page_data);
        }else if($page == 'activejobs'){
           $data['jobs'] = JobContract::where(array(
                            'user_by' => Auth::user()->id,
                            'contract_status' => '2'
                            ))->orderBy($sortby, $order)
                            ->paginate($this->per_page_data);    
        }else{
          $data['jobs'] = Jobs::withCount('jobProposals')
                           ->where(array(
                            'user_id' => Auth::user()->id))
                           ->where('job_status', '!=' ,'1')
                          ->orderBy($sortby, $order)
                          ->paginate($this->per_page_data);
        }
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        $data['currentpage'] = $page;
        $data['sorting'] = array(
                          'sortby' => $sortmain,
                          'order'  => $order
                    ); 
        return view('user.employer.jobs.job_details.job_area_ajax')->with($data);
    }

    //post job
    function jobpost(Request $request)
    {
       if($_POST)
         {

            $input = $request->all();
            if(!empty($input['hourly_rate']) || !empty($input['weekly_limit']) || !empty($input['project_length']) || !empty($input['total_cost']) ||!empty($input['job_title']) || !empty($input['job_description']) || !empty($input['expertise']) || !empty($input['skills']) || !empty($input['english_prof'])  || !empty($input['id']))
            {
               // echo "<pre>";
                //print_r($_POST);

                // services create new if not exist
               if(!empty($input['expertise']))
               {
                $expertise = array();
                $ex_Ser = explode(',', $input['expertise']);
                foreach ($ex_Ser as $key => $value) {
                   if(str_starts_with($value, 'new:')){
                    $service = Services::create(array(
                        'name' => trim(str_replace('new:', '', $value)),
                        'status' => '0',
                        'added_by' =>'0'
                    ));
                    $expertise[] = $service->id;
                   }else{
                    $expertise[] = $value;
                   }
                }
                $input['expertise'] = implode(',', $expertise);
               }

                 // Skills create new if not exist
               if(!empty($input['skills']))
               {
                $skills = array();
                $ex_Ser = explode(',', $input['skills']);
                foreach ($ex_Ser as $key => $value) {
                   if(str_starts_with($value, 'new:')){
                    $service = Skills::create(array(
                        'name' => trim(str_replace('new:', '', $value)),
                        'status' => '0',
                        'added_by' =>'0'
                    ));
                    $skills[] = $service->id;
                   }else{
                    $skills[] = $value;
                   }
                }
                $input['skills'] = implode(',', $skills);
               }

               if(isset($input['interview_questions']))
               {
                $input['interview_questions'] = json_encode(array_unique($input['interview_questions']));
               }
               // create unique job id if not exist
               if(!isset($input['uniq_job_id'])){
                $input['uniq_job_id'] =  uniqueNumber(6,'jobs','uniq_job_id','JB');
               }

               if(isset($input['job_status']) && $input['job_status'] == '2'){
                 $input['posted_at'] = Date::now();
               }

               unset($input['_token']);
                $match_s = array(
                    'user_id' => Auth::user()->id,
                    'id'      => !empty($input['jobId']) ? $input['jobId'] : 0
                );
                $job = Jobs::updateOrCreate($match_s,$input); 
             
                // notificaton sent to matching users
                if($job->job_status == '2'){
                   self::notificatonToMatchingUsers($job);
                }
                echo json_encode(array(
                    'code'=>200,
                    'message'=>'Data saved successfully!',
                    'jobId' => $job->id,
                    'uniq_job_id'=>$job->uniq_job_id
                ));
            }else{
                echo json_encode(array(
                    'code'=>200,
                    'message'=>'Nothing to save!'
                ));
            }
        }else{ 
           $data['skills'] = Skills::all();
           $data['services'] = Services::all();
           return view('user.employer.jobs.postjob')->with($data);
       }
    }

    function notificatonToMatchingUsers($request){

        $users_result = User::where(array('status'=> '1', 'user_type' => '1'));

        $services_query = UserProfile::select('user_id'); 
            $orwhere = [];
            $services = explode(',', $request->expertise);
            $skills = explode(',', $request->skills);
            if(!empty($services) ||  !empty($skills))
            {
               if(!empty($services))
                {
                  foreach ($services as $key => $value) {
                    $orwhere[] = 'FIND_IN_SET('.$value.',services)';
                  } 
                }
                if(!empty($skills))
                {
                  foreach ($skills as $key => $value) {
                     $orwhere[] = 'FIND_IN_SET('.$value.',skills)';
                  } 
                }
              $orwhere = implode(' or ', $orwhere);
              $services_query = $services_query->whereRaw('(' .$orwhere. ')'); 
            }
          $services_query = $services_query->get();
          $users_result = $users_result->whereIn('id', $services_query);

        $users = $users_result->paginate($this->per_page_data);
        foreach ($users as $key => $user) {
          $newarray = $request;
          $newarray['user_id'] = $user->id;
          createNotification($newarray, 'on_new_job_match');
        }
    }

   // show edit job page (this is same page which we used for add job)
    function editjob($jobId){
      try { 
        $jobId = decryptUrlId($jobId);
        $data['job'] = Jobs::findOrFail($jobId);
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        return view('user.employer.jobs.postjob')->with($data);
      }catch(ModelNotFoundException $e)
      {
        return redirect(url()->previous());
      }
    }
 
   // show draft jobs listing
    function draftjobs(){
        return view('user.employer.jobs.draft_jobs');
    }

    //archived jobs
    function archivedjobs(){
        return view('user.employer.jobs.archived_jobs');
    }

    // get job basic part 
    function get_jobBasic($id){
        $job = Jobs::withTrashed()->find($id);
        $data['job'] = $job;
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        return view('user.employer.jobs.job_details.job_basic')->with($data);
    }

    //status job
    function statuschange_job($type, $jid){
        $job = Jobs::withTrashed()->find($jid);
        if($type == 'delete')
        {
            $job->job_status = '3';
            $job->save(); //save status
            $job->delete(); // now delete (it will just update date in deleted_at column)
            if ($job->trashed()) {
              echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'action' => 'delete'));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'restore'){
          $job->job_status = '2';
          $job->save(); //save status
          if ($job->restore()) {
              echo json_encode(array('code'=>200,'message'=>'Restored successfully!', 'action' => 'delete'));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'complete_delete'){
          // delete related proposals   
          $job->jobProposals()->delete();
          $job->jobProposals()->forceDelete();

          // delete related contracts   
          $job->jobContracts()->delete();
          $job->jobContracts()->forceDelete();

          $job->delete(); //save status
          if ($job->forceDelete()) {
              echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'action' => 'delete'));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'pause'){
           
            $job->job_status = '4';
            $job->save(); //save status
            if ($job->wasChanged()) {
              echo json_encode(array('code'=>200,'message'=>'Job Paused successfully!', 'action' => 'pause'));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'active'){
            
            $job->job_status = '2';
            $job->save(); //save status
            if ($job->wasChanged()) {
              echo json_encode(array('code'=>200,'message'=>'Job Activated successfully!', 'action' => 'active'));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else{

        }
    }
   

   //view job
  function job($jid){
      try{
          if(str_starts_with($jid, 'JB')){
            $jobId = $jid;
            $data['job'] = Jobs::where(['uniq_job_id' => $jobId])->first();
          }else{
            $jobId = decryptUrlId($jid);
            $data['job'] = Jobs::findOrFail($jobId);
          } 
            $data['skills'] = Skills::all();
            $data['services'] = Services::all();
            $user = User::find(Auth::user()->id);
            if($user->user_type == '2'){// if user is employer
               return view('user.common.jobs.single_job_employer')->with($data);
            }else{
               return view('user.common.jobs.single_job_freelancer')->with($data);
            }
      }catch(ModelNotFoundException $e)
      {
        return redirect(url()->previous());
      }
  }

}

