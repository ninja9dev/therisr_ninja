<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\User, App\Models\Timezone, App\Models\UserEmpProfile;
use DB;
   
use App\Mail\ChangePassword;
class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */ 
    private $settings;
    public function __construct()
    {
        $this->middleware('auth');
        $this->settings = \Request::get('settings'); 
    }

    // gen_settings page
    function gen_settings(){ 

      $user = User::find(Auth::user()->id);
        $data['user'] = $user;
        if($user->user_type == '2'){// if user is employer
           $data['timezones'] = Timezone::all();
            return view('user.common.settings.gen_emp_settings')->with($data);
        }else{
            return view('user.common.settings.gen_settings');
        }

    }

    // pass_settings page
    function pass_settings(){
        return view('user.common.settings.pass_settings');
    }

    // pay_settings page
    function pay_settings(){
        return view('user.common.settings.pay_settings');
    }

    // not_settings page
    function not_settings(){
        return view('user.common.settings.not_settings');
    }

   
    // gen_settings page submit
    function gen_update(Request $request, $id = ''){
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],            
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);
        if ($validator->fails()) {
          return redirect(route('user.gen_settings'))->withErrors($validator)->withInput();
        } 

        $input = $request->all();
        // check if form submit by employer or freelancer
        if(!empty($input['userType']) && $input['userType'] == '2'){
          unset($input['username']);
          $inputBasic = array();
          // image update 
          $oldphoto  = $user['image']; 
            if($request->hasfile('profileImage')){
              $file = $request->file('profileImage');
              $nfile = $file->getClientOriginalName();
              $filename = time() .  '.' . $nfile;
              $file->move('assets/users/',$filename);
              $inputBasic['image'] = $filename;
              if($oldphoto != '' && $oldphoto != 'default.jpg')
              { 
                  $image = 'assets/users/'.$oldphoto;
                  if(\File::exists($image)) {
                      \File::delete($image);
                  }
              } 
          }

          $inputBasic['name'] = $input['name'];
          $inputBasic['email'] = $input['email'];
          $user->update($inputBasic);

          // now update profile table
            unset($input['_token']);
            $match_s = array(
                'user_id' => Auth::user()->id
            );
             UserEmpProfile::updateOrCreate($match_s,$input);
           echo json_encode(array('code'=>200,'message'=>'Data saved successfully!'));
        }else{
          unset($input['username']);
          $user->update($input);
          Session::flash('message', 'Your Profile has been updated successfully!');
          return redirect(route('user.gen_settings'));
        }

    }

    // pass_update page
    function pass_update(Request $request, $id)
    { 
        $user = User::findOrFail($id);
          $validator = Validator::make($request->all(), [ 
                'password' => ['required', 'string', 'min:8', 'max:12', 'confirmed','regex:/^(?=.*?[a-z])(?=.*?[#?!@$%^&*-_]).{8,}$/'],
             ],[
                'password.regex' => 'The :attribute format is invalid. It should be 8 characters minimum, atleast 1 letter & symbol. ',
            ]);
        if ($validator->fails()) {
          return redirect(route('user.pass_settings'))->withErrors($validator);
        }

        $input['password'] = ""; 
          if (Hash::check($request->cpass, $user->password) || $user->setpassword == 'no')
          {
                 $input['password'] = Hash::make($request->password);
                 $input['setpassword'] = 'yes';
                 $user->update($input); 
                 // send email to user 
                  try{
                      Mail::to($user->email)
                            ->send(new ChangePassword($user,$this->settings));
                  }
                  catch(\Exception $e){
                      // Never reached
                  }
                 Session::flash('message', 'Your password has been updated successfully!');
          }
          else
          {
            Session::flash('error', 'Current Password Does not match');
          }
        return redirect(route('user.pass_settings'));
    }


    // not_update page
    function not_update(Request $request, $id){
       $user = User::findOrFail($id);
        $input = $request->all();
        unset($input['_token']);
        $user->notifications =  json_encode($input);
        $user->update($input);
        Session::flash('message', 'Your notifications settings has been updated successfully!!');
        return redirect(route('user.not_settings'));
    }
}