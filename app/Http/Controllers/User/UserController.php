<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User, App\Models\UserProfile, App\Models\Services, App\Models\Skills, App\Models\UserWorkExp, App\Models\UserEducation, App\Models\UserSocialLinks, App\Models\UserAvailable;
use DB;
use Illuminate\Support\Facades\Session;
   
class UserController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    function index()
    {         
        Session::forget('userLinkedinData');
         Session::save();

        $user = User::find(Auth::user()->id);
        $data['user'] = $user;
        $data['services'] = Services::all();
        $data['skills'] = Skills::all();

        if($user->user_type == '2'){// if user is employer
            return redirect(route('user.e_myjobs'));
            //return view('user.employer.home')->with($data);
        }else{
           if(empty($user->userProfile)){
               return redirect(route('user.editprofile'));
            }else{
                return view('user.freelancer.home')->with($data);
            } 
        }
    }


    // profile page
    function profile(){
        return view('user.freelancer.profile');
    }

   // user profile update
    function user_profile(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        $input = $request->all();
        $oldphoto  = $user['image'];
          if($request->hasfile('profileImage')){
            $file = $request->file('profileImage');
            $nfile = $file->getClientOriginalName();
            $filename = time() .  '.' . $nfile;
            $file->move('assets/users/',$filename);
            $input['image'] = $filename;
            if($oldphoto != '' && $oldphoto != 'default.jpg')
            { 
                $image = 'assets/users/'.$oldphoto;
                if(\File::exists($image)) {
                    \File::delete($image);
                }
            } 
        }
        unset($input['_token']);
        $user->update($input);
        echo json_encode(array('code'=>200,'message'=>'Image has been updated successfully!'));
    }



    //edit profile page
    function editprofile(Request $request){
         
         if($_POST)
         {
            $user = UserProfile::where(array('user_id' => Auth::user()->id))->first();

            $input = $request->all();
            // services create new if not exist
           if(!empty($input['services']))
           {
            $services = array();
            $ex_Ser = explode(',', $input['services']);
            foreach ($ex_Ser as $key => $value) {
               if(str_starts_with($value, 'new:')){
                $service = Services::create(array(
                    'name' => trim(str_replace('new:', '', $value)),
                    'status' => '0',
                    'added_by' =>'0'
                ));
                $services[] = $service->id;
               }else{
                $services[] = $value;
               }
            }
            $input['services'] = implode(',', $services);
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


           //cover image
           $oldphoto  = !empty($user->background_image) ? $user->background_image : '';
          if($request->hasfile('coverImage')){
            $file = $request->file('coverImage');
            $nfile = $file->getClientOriginalName();
            $filename = time() .  '.' . $nfile;
            $file->move('assets/users_cover/',$filename);
            $input['background_image'] = $filename;
            if($oldphoto != '' && $oldphoto != 'uploadimage.png')
            { 
                $image = 'assets/users_cover/'.$oldphoto;
                if(\File::exists($image)) {
                    \File::delete($image);
                }
            } 
         }

         // remove cover if coverImageHidden is delete
         if(!empty($input['coverImageHidden']) && $input['coverImageHidden'] == 'delete')
         {
            $input['background_image'] = null;
            unset($input['coverImageHidden']);
         }

            unset($input['_token']);
            $match_s = array(
                'user_id' => Auth::user()->id
            );
             UserProfile::updateOrCreate($match_s,$input); 

            echo json_encode(array('code'=>200,'message'=>'Data saved successfully!'));
         }else{
            $data['user'] = User::find(Auth::user()->id);
            $data['services'] = Services::all();
            $data['skills'] = Skills::all();
            return view('user.freelancer.editprofile')->with($data);
         }

    }

    // get work exp box with ajax
    function workExp_ajax(){
        $data['user'] = User::find(Auth::user()->id);
        return view('user.freelancer.ajax.workExp')->with($data);
    }

    // work experience
    function workExp(Request $request){
            $input = $request->all();
            if(!isset($input['currently_working'])){
             $input['currently_working'] = 'off';
            }
            unset($input['_token']);
            $match_s = array(
                'user_id' => Auth::user()->id,
                'id'      => !empty($input['workId']) ? $input['workId'] : 0
            );
             UserWorkExp::updateOrCreate($match_s,$input); 

            echo json_encode(array('code'=>200,'message'=>'Data saved successfully!'));
    }

   // get single work exp
    function get_workExp($wid = ''){
       $workexp =  UserWorkExp::findOrFail($wid);
       echo json_encode(array('code'=>200,'data'=>$workexp));
    }

    //delete work history
    function delete_workExp($wid = ''){
       $workexp =  UserWorkExp::findOrFail($wid);
       if($workexp)
       {
         $workexp->delete();
         echo json_encode(array('code'=>200,'data'=>'Deleted successfully!'));
       }else{
        echo json_encode(array('code'=>500,'data'=>'Record not found!'));
       }
       
    }


    //education form submit
    function education_sub(Request $request){
            $input = $request->all();
            unset($input['_token']);
            $match_s = array(
                'user_id' => Auth::user()->id,
                'id'      => !empty($input['eduId']) ? $input['eduId'] : 0
             );
             UserEducation::updateOrCreate($match_s,$input); 
            echo json_encode(array('code'=>200,'message'=>'Data saved successfully!'));
    }

   // get single education
    function get_education($wid = ''){
       $education =  UserEducation::findOrFail($wid);
       echo json_encode(array('code'=>200,'data'=>$education));
    }

    //delete education
    function delete_education($wid = ''){
       $education =  UserEducation::findOrFail($wid);
       if($education)
       {
         $education->delete();
         echo json_encode(array('code'=>200,'data'=>'Deleted successfully!'));
       }else{
        echo json_encode(array('code'=>500,'data'=>'Record not found!'));
       }
    }
     // get education box with ajax
    function edu_ajax(){
        $data['user'] = User::find(Auth::user()->id);
        return view('user.freelancer.ajax.schoolEduc')->with($data);
    }


    //social ajax
    function social_ajax(){
        $data['user'] = User::find(Auth::user()->id);
       // echo "<pre>";
        //print_r($data['user']->userSocialLinks);die;
        return view('user.freelancer.ajax.socialLinks')->with($data);
    }

    //social form submit
    function social_sub(Request $request){
        $input = $request->all();
        unset($input['_token']);
        $match_s = array(
            'user_id' => Auth::user()->id
         );
         UserSocialLinks::updateOrCreate($match_s,$input); 
        echo json_encode(array('code'=>200,'message'=>'Data saved successfully!'));
    }

    // update status avaliable
    function updateAvailable(Request $request){
        $input = $request->all();
        unset($input['_token']);
         $match_s = array(
            'user_id' => Auth::user()->id
         );
         UserAvailable::updateOrCreate($match_s,$input); 
        echo json_encode(array('code'=>200,'message'=>'Data saved successfully!'));
    }
}

