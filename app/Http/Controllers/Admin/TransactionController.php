<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jobs, App\Models\Transactions;
class TransactionController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
    }

    function transactions(Request $request){
        if($request->ajax()) 
        {
           return view('admin.transactions.ajax_transactions_area');
        }
        return view('admin.transactions.listing');
    }

    // get_tran ajax call
    function get_tran(Request $request)
    {
        //::select(['id','name','email','user_type','status','therisr_score','created_at', 'image']);
        $data = Transactions::with(['users', 'contract', 'contract.userToBasicDetail']);

        // search by freelancer name email or employer name email
        if (!empty($_POST['query']['generalSearch'])) {
            $generalSearch = $_POST['query']['generalSearch'];
            $data = $data->whereHas('users', function($q) use($generalSearch)
                {
                     $q->where('name', 'like', "%{$generalSearch}%")
                        ->orWhere('email', 'like', "%{$generalSearch}%");
                });

            $data = $data->orWhereHas('contract.userToBasicDetail', function($q) use($generalSearch)
                {
                     $q->where('name', 'like', "%{$generalSearch}%")
                        ->orWhere('email', 'like', "%{$generalSearch}%");
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
