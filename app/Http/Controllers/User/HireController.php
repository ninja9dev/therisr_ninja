<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Models\User, App\Models\Services, App\Models\Skills, App\Models\Jobs, App\Models\JobLikeSkip, App\Models\JobReports, App\Models\JobProposals, App\Models\JobContract;
use DB;
   
class HireController extends Controller
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
 
  
    // get_hirePopup
    function get_hirePopup($userId,$proposalId,$jobid){
        $data['user'] = User::findOrFail($userId);
        if($jobid != 0){
         $data['job'] = Jobs::find($jobid);
        }else{ 
            // fetch jobs listing active jobs and current freelnacer have not hired and if hired then it should be in archived
          $data['jobs_list'] = Jobs::where(array(
                            'user_id' => Auth::user()->id,
                            'job_status' => '2'
                            ))->whereNotIn('id', JobContract::select('job_id')
                                      ->where(array(
                                            'user_to' => $userId,
                                        ))
                                      ->where('contract_status','!=','3') // means hire archived nhi hai
                                      ->where('contract_status','!=','4') // means hire not rejected
                                      ->get()->toArray()
                        )->get(); 
        }

        $data['proposalId'] = $proposalId;
        if($proposalId != 0){
          $data['proposal'] = JobProposals::find($proposalId);
        }
        return view('user.employer.freelancer.ajax.hire_popup')->with($data);;
    }

    // job hire popup for dropdwon change
    function job_hire_jobBasic($jobId,$userId){
        $data['user'] = User::findOrFail($userId);
        $data['job'] = Jobs::find($jobId);
        $data['proposal'] = JobProposals::where(array(
                            'user_id' => $data['user']->id,
                            'job_id' => $data['job']->id
                            ))->first(); 
        // echo "<pre>";
        // print_r($data);die;
        return view('user.employer.freelancer.ajax.hire_popup_job_details')->with($data);
    }

    // job hire 
    function job_hire(Request $request)
    {
        $input = $request->all(); 
        unset($input['_token']);
        $job  = Jobs::find($input['job_id']);
        if($job){
            $contract  = array();
            $contract['proposal_id']    = $input['proposal_id'];
            $contract['user_to']        = $input['user_to'];
            $contract['job_id']         = $input['job_id'];
            $contract['contract_type']  = $input['job_type'];
            $contract['hourly_rate']    = $input['hourly_rate'];
            $contract['weekly_limit']   = $input['weekly_limit'];
            $contract['project_length'] = $job->project_length;
            $contract['total_cost']     = $input['total_cost'];
            $contract['due_date']       = $job->due_date;
            $contract['job_title']      = $job->job_title;
            $contract['job_description']= $input['job_description'];
            $contract['expertise']      = $job->expertise;
            $contract['skills']         = $job->skills;
            $contract['exp_level']      = $job->exp_level;
            $contract['english_prof']   = $job->english_prof;
            $contract['therisr_score']  = $job->therisr_score;
            $contract['interview_questions']= $job->interview_questions;
            $contract['offer_sent_on']    =  Date::now();
          
            // if(isset($contract['interview_questions']))
            // {
            //     $contract['interview_questions'] = json_encode(array_unique($contract['interview_questions']));
            // }

            $match_s = array(
                'user_by' => Auth::user()->id,
                'user_to' => $input['user_to'],
                'job_id'  => !empty($input['job_id']) ? $input['job_id'] : 0
            );
            $contract = JobContract::updateOrCreate($match_s,$contract); 
            // create notification
            createNotification($contract,'on_job_offer_receive', 'job_hire', $contract->id);

            echo json_encode(array(
                'code'=>200,
                'message'=>'Data saved successfully!',
                'contractId' => $contract->id,
                'job_id'=> $input['job_id']
            ));
      }
    }

     // job proposal undo/delete
    function job_hiredelete($contractId){

        $contract = JobContract::withTrashed()->find($contractId);
        $contract->delete(); // now delete (it will just update date in deleted_at column)
        if ($contract->trashed()) {

            // delete notification
            deleteNotification($contract,'on_job_offer_undo', 'job_hire', $contract->id);
            
            $contract->forceDelete();
          echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'id' => $contract->id));
        }else{
         echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
        }
    }


    // contract view
    function get_contractView($contractId){
        $data['contract'] = JobContract::withTrashed()->find($contractId);
        $data['user'] = User::findOrFail($data['contract']->user_to);
        return view('user.employer.freelancer.ajax.contract_popup')->with($data);;
    }


   
   


    // all offers listing
    function alloffers(){
        return view('user.employer.jobs.all_offers');
    }

    function get_alloffer_area_ajax($page){
        if($page == 'pending'){
           $data['jobs'] = JobContract::where(array(
                                'user_by' => Auth::user()->id,
                                'contract_status' => '1'
                                ))->paginate($this->per_page_data);
        }else if($page == 'rejected'){
           $data['jobs'] = JobContract::where(array(
                                'user_by' => Auth::user()->id,
                                'contract_status' => '4'
                                ))->paginate($this->per_page_data);
        }else{
           $data['jobs'] = JobContract::where(array(
                                'user_by' => Auth::user()->id,
                                ))
                                ->whereIn('contract_status', ['1', '4'])
                                ->paginate($this->per_page_data);
        }

        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        $data['currentpage'] = $page;
        return view('user.employer.jobs.job_details.all_offers_area_ajax')->with($data);
    }
     // get job basic part 
    function get_offerBasic($id){  
        $job = JobContract::withTrashed()->find($id);
        $data['contract'] = $job;
        $data['skills'] = Skills::all();
        $data['services'] = Services::all();
        return view('user.employer.jobs.job_details.offer_basic')->with($data);
    }


}