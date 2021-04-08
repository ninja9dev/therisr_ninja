<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User, App\Models\Services, App\Models\Skills, App\Models\UserPortfolio;
use DB;
   
class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    //add project/portfolio page
    function addproject(Request $request)
    {         
       if($_POST)
        { 
          $input = $request->all();
          $removeImage = explode(',', $input['removeImage']);
          $oldimages = array(); $imagesd = array(); $removeImage_f = array();
          if(!empty($input['porftId']))
          {
             $portfolio= UserPortfolio::find($input['porftId']);
             $oldimages = explode(',', $portfolio->images);
             foreach ($oldimages as $key => $value) {
                if(!in_array('old-'.$key, $removeImage))
                 $imagesd[] = $value;
                else
                 $removeImage_f[] = $value;
             }
          }
          if($request->hasfile('imagesfinal')){
             foreach ($request->file('imagesfinal') as $key=>$file) {
                
                    $name = $file->getClientOriginalName();
                    $filename = time() .  '-' . $name;
                    $file->move('assets/project_images/',$filename);
                    $imagesd[] = $filename;
                    
            }
          }
          $imagesd = array_filter($imagesd);

          foreach ($removeImage_f as $key => $oldphoto) {
               if($oldphoto != '' && $oldphoto != 'no-image.jpg')
                { 
                    $image = 'assets/project_images/'.$oldphoto;
                    if(\File::exists($image)) {
                        \File::delete($image);
                    }
                }
          }

            // skills create new if not exist
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


            $input['images'] = implode(',', $imagesd);
            unset($input['_token']);
            $match_s = array(
                'user_id' => Auth::user()->id,
                'id'      => !empty($input['porftId']) ? $input['porftId'] : 0
            );
            UserPortfolio::updateOrCreate($match_s,$input); 
           echo json_encode(array('code'=>200,'message'=>'Saved successfully!'));    
        }else{
           $data['skills'] = Skills::all();
           return view('user.freelancer.project.addproject')->with($data);
        }
    }

      //edit project/portfolio page
    function editproject($id = '')
    { 

        $data['portfolio'] = UserPortfolio::find($id);
        $data['skills'] = Skills::all();
        return view('user.freelancer.project.editproject')->with($data);
    }



    //portfolio ajax
    function portfolio_ajax(){
        $data['user'] = User::find(Auth::user()->id);
        $data['skills'] = Skills::all();
        $data['route'] = !empty($_GET['route']) ? $_GET['route'] : '';
        return view('user.freelancer.ajax.portfolioSection')->with($data);
    }




    // get single portfolio
    function get_portfolio($id = ''){
       $data['portfolio'] =  UserPortfolio::findOrFail($id);
       $data['user'] = !empty($data['portfolio']) ? User::find($data['portfolio']->user_id) : array();
       $data['skills'] = Skills::all();
        return view('user.freelancer.project.viewproject')->with($data);
   }

   // delete project
   function delete_portfolio($id){
    $portfolio =  UserPortfolio::findOrFail($id);
       if($portfolio)
       {
         $portfolio->delete();
         echo json_encode(array('code'=>200,'data'=>'Deleted successfully!'));
       }else{
        echo json_encode(array('code'=>500,'data'=>'Record not found!'));
       }
    }

}

