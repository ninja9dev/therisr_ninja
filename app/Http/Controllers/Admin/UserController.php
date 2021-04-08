<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
class UserController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
    }


    function users($type = '', Request $request){
        $data['type'] = (!empty($type) && $type != 'all') ? (($type == 'freelancers' || $type == 1) ? 1 : 2) 
                        : 'all'; 
        if($request->ajax())
        {
           return view('admin.user.ajax_user_area')->with($data);
        }
        return view('admin.user.listing')->with($data);
    }

    // users ajax call
    function get_users(Request $request)
    {
        //::select(['id','name','email','user_type','status','therisr_score','created_at', 'image']);
        $data = User::with(['countryName', 'userProfile', 'userEmpProfile']);
 
        if (!empty($_POST['user_type']) and 
            $_POST['user_type'] != 'all') {
            $user_type = $_POST['user_type'];
            $data = $data->where("user_type", $user_type);
        }

        if (!empty($_POST['query']['status']) and 
            $_POST['query']['status'] != 'all') {
            $status = $_POST['query']['status'];
            $data = $data->where("status", $status);
        }
        if (!empty($_POST['query']['user_type']) and 
            $_POST['query']['user_type'] != 'all') {
            $user_type = $_POST['query']['user_type'];
            $data = $data->where("user_type", $user_type);
        }
        if (!empty($_POST['query']['generalSearch'])) {
            $generalSearch = $_POST['query']['generalSearch'];
            $data = $data->where('name', 'like', "%{$generalSearch}%");
            $data = $data->orWhere('email', 'like', "%{$generalSearch}%");
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
                  // print_r($users[0]->);
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
