<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User, App\Models\Jobs, App\Models\JobProposals, App\Models\Services, App\Models\Skills, App\Models\JobContract, App\Models\Notifications;
use DB;
   
class ProposalController extends Controller
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

    // freelancer public profile page
    function f_profile($fid)
    {         
        $user = User::find($fid);
        $data['user'] = $user;
        $data['services'] = Services::all();
        $data['skills'] = Skills::all(); 
        if(!empty($user) && $user->user_type == '2'){// if user is employer
            return redirect(route('user.e_myjobs'))->with('error', 'User not exist!');
        }else{
            return view('user.employer.freelancer.public_profile')->with($data);
        }
    }

     // freelancer portfolio ajax
    function f_portfolio_ajax($fid){
        $data['user'] = User::find($fid);
        $data['skills'] = Skills::all();
        $data['route'] = !empty($_GET['route']) ? $_GET['route'] : '';
        return view('user.employer.freelancer.ajax.portfolioSection')->with($data);
    }
    
    // get proposals tabs
    function get_proposals_area_ajax($page,$jid){ 
    	$data['job'] = Jobs::find($jid);
        if($page == 'liked'){
           $data['proposals'] = JobProposals::where(array('like_status'=>'2', 'job_id' => $jid))->get();
        }else if($page == 'archived'){
           $data['proposals'] = JobProposals::onlyTrashed()->where(array('job_id' => $jid))->get();
        }else{
          $data['proposals'] = JobProposals::where(array('job_id' => $jid))->get();
        }
        $data['currentlikepage'] = $page;
        return view('user.employer.jobs.job_details.proposals_area_ajax')->with($data);
    }

    // all proposals
    // show draft jobs listing
    function allproposals(){
        return view('user.employer.jobs.all_proposals');
    }

     // get proposals tabs
    function get_alljobs_proposals_area_ajax($page){  
        if($page == 'liked'){
           $data['proposals'] = JobProposals::where(array('like_status'=>'2'))
                                ->whereNotIn('id', JobContract::select('proposal_id')
                                      ->where('contract_status','!=','3') // means hire archived nhi hai
                                      ->get()->toArray()
                                )->paginate($this->per_page_data);
        }else if($page == 'archived'){
           $data['proposals'] = JobProposals::onlyTrashed()->paginate($this->per_page_data);
        }else if($page == 'hired'){
          $data['proposals'] = JobProposals::whereIn('id', JobContract::select('proposal_id')
                                      ->where('contract_status','!=','3') // means hire archived nhi hai
                                      ->get()->toArray()
                                )->paginate($this->per_page_data);
        }else{
          $data['proposals'] = JobProposals::whereNotIn('id', JobContract::select('proposal_id')
                                      ->where('contract_status','!=','3') // means hire archived nhi hai
                                      ->get()->toArray()
                                )->paginate($this->per_page_data);
       }
        $data['currentlikepage'] = $page;
       
        return view('user.employer.jobs.job_details.all_proposals_area_ajax')->with($data);
    }

    // get proposal popupd data
    function get_proposal_content($id){
    	 $proposal = JobProposals::withTrashed()->find($id);
    	 $data['job'] = Jobs::find($proposal->job_id);
    	 $data['proposal'] = $proposal;
        return view('user.employer.jobs.job_details.proposal_model')->with($data);
    }

    //change proposal status
    function statuschange_proposal($type, $jid){
        $proposal = JobProposals::withTrashed()->find($jid);
        if($type == 'delete')
        { 
            $proposal->proposal_status = '2';
            $proposal->save(); //save status
            $proposal->delete(); // now delete (it will just update date in deleted_at column)
            if ($proposal->trashed()) {
              echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'id' => $proposal->id));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'restore'){

            $proposal->proposal_status = '1';
            $proposal->save(); //save status
            $proposal->restore(); // now delete (it will just update date in deleted_at column)
            if ($proposal->wasChanged()) {
              echo json_encode(array('code'=>200,'message'=>'Restored successfully!', 'id' => $proposal->id));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }

        }else if($type == 'like'){
           
            $proposal->like_status = '2';
            $proposal->save(); //save status
            if ($proposal->wasChanged()) {
              echo json_encode(array('code'=>200,'message'=>'Proposal liked successfully!', 'id' => $proposal->id));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'unlike'){
            
            $proposal->like_status = '1';
            $proposal->save(); //save status
            if ($proposal->wasChanged()) {
              echo json_encode(array('code'=>200,'message'=>'Proposal unliked successfully!', 'id' => $proposal->id));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else{

        }
    }

    // job apply popup data get
    function get_applypopup_content($jobid){
        $job = Jobs::withTrashed()->find($jobid);
        $data['job'] = $job;
        return view('user.freelancer.job_ajax.job_apply_popup')->with($data);
    }
      // job apply submit
    function job_apply(Request $request)
    {
        $input = $request->all(); 
        unset($input['_token']);
        if(isset($input['interview_questions']))
           {
            $input['interview_questions'] = json_encode(array_unique($input['interview_questions']));
           }

        $match_s = array(
            'user_id' => Auth::user()->id,
            'job_id'  => !empty($input['job_id']) ? $input['job_id'] : 0
        );
        $proposal = JobProposals::updateOrCreate($match_s,$input); 
     
         // create notification
        $job = Jobs::withTrashed()->find(!empty($input['job_id']) ? $input['job_id'] : 0);
        if($job){
          createNotification($job,'on_job_proposal', 'proposal_apply', $proposal->id);
        }

        echo json_encode(array(
            'code'=>200,
            'message'=>'Data saved successfully!',
            'proposalId' => $proposal->id,
            'job_id'=> $input['job_id']
        ));
    }
    
    // job proposal undo/delete
    function job_proposaldelete($proposalid){

        $proposal = JobProposals::withTrashed()->find($proposalid);
        $proposal->delete(); // now delete (it will just update date in deleted_at column)
        if ($proposal->trashed()) {
            
            
            // delete notification
            $job = Jobs::withTrashed()->find($proposal->job_id);
            if($job){ 
              deleteNotification($job,'on_job_proposal_undo', 'proposal_apply', $proposal->id);
            }

            $proposal->forceDelete();

          echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'id' => $proposal->id));
        }else{
         echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
        }
    }

}