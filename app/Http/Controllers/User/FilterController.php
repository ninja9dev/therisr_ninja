<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Models\User, App\Models\UserProfile, App\Models\UserAvailable, App\Models\Services, App\Models\Skills, App\Models\MyFreelancer, App\Models\UserSavedSearches, App\Models\Jobs;
use DB;
   
class FilterController extends Controller
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

    // filter freelancer submit
    function filter_apply_free(Request $request){

      if(!empty($request->type) && $request->type == 'save'){
      
        $filters = array(
          'services'      => $request->services,
          'job_type'      => $request->job_type,
          'experience'    => $request->experience,
          'total_cost'    => $request->total_cost,
          'weekly_limit'  => $request->weekly_limit,
          'project_length'   => $request->project_length
        );
        $data = array(
           'user_id'          => Auth::user()->id,
           'search_name'      => $request->filterName,
           'search_filters'   => json_encode($filters),
           'alert_on'         => $request->alertOn
        );
        $done = UserSavedSearches::create($data);
         echo json_encode(array('code'=>200,'message'=>'Filters saved successfully!'));
      }else{
        DB::enableQueryLog();

        $query_result = Jobs::withCount('jobProposals');
         // filter jobs acording to my skills or services
          $services = explode(',', $request->services);
          if(!empty($services) &&  $request->services != '')
          {
              foreach ($services as $key => $value) {
                  $query_result = ($key == 0) 
                                    ? $query_result->whereRaw('FIND_IN_SET(?,expertise)', [$value])
                                    : $query_result->orWhereRaw('FIND_IN_SET(?,expertise)', [$value]);

               } 
          }
       
        $total_cost = explode(',', $request->total_cost);
        if(!empty($total_cost) && $request->total_cost != 'any')
        {
            foreach ($total_cost as $key => $value) {
              $range = explode('-', $value);
              if(count($range) > 1)
              {
               $query_result =  ($key == 0) 
                                ? $query_result->whereRaw('total_cost >= '.$range[0] . ' and total_cost <= '.$range[1])
                                : $query_result->orWhereRaw('total_cost >= '.$range[0] . ' and total_cost <= '.$range[1]);
              }else{
               $query_result =  ($key == 0) 
                                ? $query_result->whereRaw('total_cost '. $value)
                                : $query_result->orWhereRaw('total_cost'. $value);
              }
              if($value == '<=500'){
                $query_result = $query_result->orWhereRaw('total_cost IS NULL');
              }
            } 
        }

       $experience = explode(',', $request->experience);
        if(!empty($experience) && $request->experience != 'any')
        {
            foreach ($experience as $key => $value) {
                $query_result = ($key == 0) 
                                  ? $query_result->where('exp_level', $value)
                                  : $query_result->orWhereRaw('exp_level', $value);

             } 
        }

        $weekly_limit = explode(',', $request->weekly_limit);
        if(!empty($weekly_limit) )
        {
            if($request->weekly_limit != 'any'){
                foreach ($weekly_limit as $key => $value) {
                  $query_result =  ($key == 0) 
                                      ? $query_result->whereRaw('weekly_limit '. $value)
                                      : $query_result->orWhereRaw('weekly_limit '. $value);
                  if($value == '<=25'){
                    $query_result = $query_result->orWhereRaw('weekly_limit IS NULL');
                  }
                } 
            }
        }

        $project_length = explode(',', $request->project_length);
        if(!empty($project_length) && $request->project_length != 'any')
        {
            foreach ($project_length as $key => $value) {
              $range = explode('-', $value);
              if(count($range) > 1)
              {
               $query_result =  ($key == 0) 
                                ? $query_result->whereRaw('project_length >= '.$range[0] . ' and project_length <= '.$range[1])
                                : $query_result->orWhereRaw('project_length >= '.$range[0] . ' and project_length <= '.$range[1]);
              }else{
               $query_result =  ($key == 0) 
                                ? $query_result->whereRaw('project_length '. $value)
                                : $query_result->orWhereRaw('project_length'. $value);
                  if($value == '<=1'){
                    $query_result = $query_result->orWhereRaw('project_length IS NULL');
                  }
              }
            } 
        }

       

        $data['jobs'] = $query_result->paginate($this->per_page_data);
        //echo "<pre>";dd(DB::getQueryLog());

        return view('user.freelancer.filter.filter_result_area_ajax')->with($data); 
      }
    }

    //filter submit
    function filter_apply_emp(Request $request){

      if(!empty($request->type) && $request->type == 'save'){
      
        $filters = array(
          'services'    => $request->services,
          'skills'      => $request->skills,
          'hourly_rate' => $request->hourly_rate,
          'eng_prof'    => $request->eng_prof,
          'experience'  => $request->experience,
          'availability'=> $request->availability,
          'searchInput' => $request->searchInput
        );
        $data = array(
           'user_id'          => Auth::user()->id,
           'search_name'      => $request->filterName,
           'search_filters'   => json_encode($filters),
           'alert_on'         => $request->alertOn
        );
        $done = UserSavedSearches::create($data);
         echo json_encode(array('code'=>200,'message'=>'Filters saved successfully!'));
      }else{
        DB::enableQueryLog();

        $users_result = User::where(array('status'=> '1', 'user_type' => '1'));

        $services_query = UserProfile::select('user_id'); 
        $services = explode(',', $request->services);
        if(!empty($services) &&  $request->services != '')
        {
            foreach ($services as $key => $value) {
                $services_query = ($key == 0) 
                                  ? $services_query->whereRaw('FIND_IN_SET(?,services)', [$value])
                                  : $services_query->orWhereRaw('FIND_IN_SET(?,services)', [$value]);

             } 
            $services_query = $services_query->get();

            $users_result = $users_result->whereIn('id', $services_query);
        }


        $hourly_rate = explode(',', $request->hourly_rate);
        if(!empty($hourly_rate) && $request->hourly_rate != 'any')
        {
            $f_query = UserProfile::select('user_id'); 
                foreach ($hourly_rate as $key => $value) {
                    $range = explode('-', $value);
                    if(count($range) > 1)
                    {
                     $f_query =  ($key == 0) 
                                      ? $f_query->whereRaw('hourly_rate >= '.$range[0] . ' and hourly_rate <= '.$range[1])
                                      : $f_query->orWhereRaw('hourly_rate >= '.$range[0] . ' and hourly_rate <= '.$range[1]);
                    }else{
                     $f_query =  ($key == 0) 
                                      ? $f_query->where('hourly_rate','>=', $value)
                                      : $f_query->orWhere('hourly_rate','>=', $value);
                    }
                } 
            $f_query = $f_query->get();

            $users_result = $users_result->whereIn('id', $f_query);
        }


        $skills = explode(',', $request->skills);
        if(!empty($skills) &&  $request->skills != '')
        {
            $skills_query = UserProfile::select('user_id'); 
            foreach ($skills as $key => $value) {
                $skills_query = ($key == 0) 
                                  ? $skills_query->whereRaw('FIND_IN_SET(?,skills)', [$value])
                                  : $skills_query->orWhereRaw('FIND_IN_SET(?,skills)', [$value]);

             } 
            $skills_query = $skills_query->get();

            $users_result = $users_result->whereIn('id', $skills_query);
        }

        $eng_prof = explode(',', $request->eng_prof);
        if(!empty($eng_prof) && $request->eng_prof != 'any' && $request->eng_prof != '')
        {
            $f_query = UserProfile::select('user_id'); 
            foreach ($eng_prof as $key => $value) {
                $f_query = ($key == 0) 
                                  ? $f_query->where('english_prof', $value)
                                  : $f_query->orWhereRaw('english_prof', $value);

             } 
            $f_query = $f_query->get();

            $users_result = $users_result->whereIn('id', $f_query);
        }

        $experience = explode(',', $request->experience);
        if(!empty($experience) && $request->experience != 'any')
        {
            $f_query = UserProfile::select('user_id'); 
            foreach ($experience as $key => $value) {
                $f_query = ($key == 0) 
                                  ? $f_query->where('exp_level', $value)
                                  : $f_query->orWhereRaw('exp_level', $value);

             } 
            $f_query = $f_query->get();

            $users_result = $users_result->whereIn('id', $f_query);
        }

        $availability = explode(',', $request->availability);
        if(!empty($availability) )
        {
            $f_query = UserAvailable::select('user_id')->where('available','1'); 
            if($request->availability != 'any'){
                foreach ($availability as $key => $value) {
                    if($value == '>=25')
                    {
                     $f_query =  ($key == 0) 
                                      ? $f_query->where('avail_for','>=', '25')
                                      : $f_query->orWhereRaw('avail_for','>=', '25');
                    }else{
                     $f_query =  ($key == 0) 
                                      ? $f_query->where('avail_for','<=', '25')
                                      : $f_query->orWhereRaw('avail_for','<=', '25');
                    }
                } 
            }
            $f_query = $f_query->get();

            $users_result = $users_result->whereIn('id', $f_query);
        }

        // the risr score
        $therisr_score = explode(',', $request->therisr_score);
        if(!empty($therisr_score) )
        {
            if($request->therisr_score != 'any'){
                foreach ($therisr_score as $key => $value) {
                  $users_result =  ($key == 0) 
                            ? $users_result->where('therisr_score','>=', $value)
                            : $users_result->orWhere('therisr_score','>=', $value);
                } 
            }
        }

        // search input
        if(trim($request->searchInput) != ''){
          $users_result = $users_result->orWhere('name', 'like', '%' . $request->searchInput . '%');
            $f_query = UserProfile::select('user_id')
                          ->where('prim_title', 'like', '%' . $request->searchInput . '%')
                          ->orWhere('sec_title', 'like', '%' . $request->searchInput . '%')
                          ->get();

            $users_result = $users_result->orWhereIn('id', $f_query);

        }

        $data['users'] = $users_result->inRandomOrder()->paginate($this->per_page_data);
        //echo "<pre>";dd(DB::getQueryLog()); 

        return view('user.employer.filter.filter_result_area_ajax')->with($data); 
      }
    }

 
    //freelancer status
    function freelancer_status($type, $id){
        $match_s = array(
                'user_id' => Auth::user()->id,
                'freelancer_id'  => $id
            );
        if($type == 'like'){ 
            $input = array(
              'like_status' => '2'
            );
            $data = MyFreelancer::updateOrCreate($match_s,$input); 
            if ($data) {
              echo json_encode(array('code'=>200,'message'=>'Freelancer liked successfully!'));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else if($type == 'unlike'){
            $input = array(
              'like_status' => '1'
            );
            $data = MyFreelancer::updateOrCreate($match_s,$input); 
            if ($data) {
              echo json_encode(array('code'=>200,'message'=>'Freelancer unliked successfully!'));
            }else{
             echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
            }
        }else{

        }
    }

    // emp my jobs
    function myfreelancer(){
        return view('user.employer.freelancer.my_freelancers');
    }

    function get_myfreelancers_area_ajax($page){
        $sortby = !empty($_GET['sortby']) ? $_GET['sortby'] : 'hourly_rate';
        $order = !empty($_GET['order']) ? $_GET['order'] : 'desc';
        $sortmain = $sortby; 
       
         $users_result = User::where(array('users.status'=> '1', 'users.user_type' => '1'))
                             ->whereIn('users.id', MyFreelancer::select('freelancer_id')
                                                ->where('like_status', '2')
                                                ->get());
        if($sortby == 'hourly_rate'){
          $users_result = $users_result
                          ->orderByJoin('userProfile.'.$sortby, $order);
        }else{
          $users_result = $users_result
                          ->orderBy('users.'.$sortby, $order);
        }
                            
        $users_result = $users_result
                        ->paginate($this->per_page_data);
        $data['users'] = $users_result;
        $data['currentpage'] = $page;
        $data['sorting'] = array(
                          'sortby' => $sortmain,
                          'order'  => $order
                    ); 
        return view('user.employer.freelancer.ajax.my_freelancer_ajax')->with($data);
    }


    function get_freelancer_content($id){
      $data['user'] = $users_result = User::find($id);
       return view('user.employer.freelancer.ajax.my_freelancer_popup_ajax')->with($data);
    }

    function getSavedSearches(){
      $data['savedSearches'] = UserSavedSearches::where('user_id',Auth::user()->id)->get();
       return view('user.common.saved_search.saved_searches_ajax')->with($data);
    }

  function editSavedSearch($type,$id){
    $data = UserSavedSearches::find($id);
    if($type == 'delete'){
        if ($data->forceDelete()) {
           echo json_encode(array('code'=>200,'message'=>'Deleted successfully!', 'id' => $data->id));
        }else{
           echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
        }
    }else{
      $match_s = array(
            'id' => $id,
      );
      $input = array( 'alert_on'  => ($data->alertOn == "1") ? "2" : "1");
      $done = UserSavedSearches::updateOrCreate($match_s,$input); 
      if ($done) {
        echo json_encode(array('code'=>200,'message'=>'Updated successfully!', 'id' => $id));
      }else{
       echo json_encode(array('code'=>500,'message'=>'Oops! Something wrong.'));
      }
     
    }
  }

}