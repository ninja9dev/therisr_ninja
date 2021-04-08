<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jobs, App\Models\JobReports;
class JobController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
    }

    function job_reports(Request $request){
        if($request->ajax()) 
        {
           return view('admin.job_reports.ajax_jobreport_area');
        }
        return view('admin.job_reports.listing');
    }

    // reports ajax call
    function get_reports(Request $request)
    {
        //::select(['id','name','email','user_type','status','therisr_score','created_at', 'image']);
        $data = JobReports::with(['userBasicDetail', 'jobDetail']);

        // search by job title
        if (!empty($_POST['query']['generalSearch'])) {
            $generalSearch = $_POST['query']['generalSearch'];
            $data = $data->whereHas('jobDetail', function($q) use($generalSearch)
                {
                    $q->where('job_title', 'like', "%{$generalSearch}%");

                });
        }

        $totalData = $data->count();
            
        $totalFiltered = $totalData; 

        $limit = $request->pagination['perpage'];
        $start = ($request->pagination['perpage'] * $request->pagination['page'] ) - $request->pagination['perpage'];
            
        $users = $data
                ->offset($start)
                ->limit($limit)
                ->orderBy($request->sort['field'], $request->sort['sort'])
                ->get();
                  // echo "<pre>";
                 // print_r($users[0]->jobs->users);
                // die;
        $data = $users;
        $json_data = array(
               "meta" => array(
                    "page"=> $request->pagination['page'],
                    "pages"=> !empty($request->pagination['pages']) ? $request->pagination['pages'] 
                               : (intval($totalData) / $request->pagination['perpage']),
                    "perpage"=> $request->pagination['perpage'],
                    "total"=> intval($totalData),
                    "sort"=> $request->sort['sort'],
                    "field"=> $request->sort['field']
                ),
                "data" => $data   
        );
            
        return json_encode($json_data);
    }
}
