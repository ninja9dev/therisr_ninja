<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Transactions, App\Models\Admin, App\Models\Settings;
class AdminController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
         // get global settings
        $this->middleware(function ($request, $next) {
          $this->settings = $request->get('settings');
          return $next($request);
       });
    }
  
    public function index()
    {
        $data = array();
        return view('admin.dashboard');
    }

    // dashboard stats
    function get_stats(Request $request) { 
        $date_range = explode(' / ', $request->get('date_filter'));
        $start_d = !empty($date_range[0]) ? trim($date_range[0]) : '';
        $end_d =!empty($date_range[1]) ? trim($date_range[1]) : '';
        if(!empty($start_d) && !empty($end_d))
        {
            $start_date = date('Y-m-d',strtotime($start_d));
            $end_date = date('Y-m-d',strtotime($end_d));
        }

        $transactions = Transactions::where('created_at','>=',$start_date)->where('created_at','<=',$end_date)->sum('amount');
        $json_data = array(
            'total_transactions' => !empty($this->settings->currency)  ? $this->settings->currency  : '$'.$transactions,
            'total_commission' => !empty($this->settings->currency)  ? $this->settings->currency  : '$'.$transactions
        );
        return json_encode($json_data);
    }


    // setting pages view
    public function settings($type = '')
    {
        $data = array();
        $data['type'] = $type;
        $id = Auth::user()->id;
        $data['admin'] = Admin::findOrFail($id);

        if($type == 'profile') {

          return view('admin.settings.profile_settings')->with($data);

        }else if($type == 'change_password') {

          return view('admin.settings.change_password')->with($data);

        }else if($type == 'site') {

          return view('admin.settings.site_settings')->with($data);
            
        }else if($type == 'payment') {

            return view('admin.settings.payment_settings')->with($data);

        }else{

          return view('admin.settings.profile_settings')->with($data);
        }
    }

       // pass_update page
    function pass_update(Request $request)
    { 
        $user = Admin::findOrFail(Auth::user()->id);
          $validator = Validator::make($request->all(), [ 
                'password' => ['required', 'string', 'min:8', 'max:12', 'confirmed','regex:/^(?=.*?[a-z])(?=.*?[#?!@$%^&*-_]).{8,}$/'],
             ],[
                'password.regex' => 'The :attribute format is invalid. It should be 8 characters minimum, atleast 1 letter & symbol. ',
            ]);
        if ($validator->fails()) {
          return redirect(route('admin.settings', ['type' => 'change_password']))->withErrors($validator);
        }

        $input['password'] = ""; 
          if (Hash::check($request->cpass, $user->password) || $user->setpassword == 'no')
          {
                 $input['password'] = Hash::make($request->password);
                 $input['setpassword'] = 'yes';
                 $user->update($input);
                 Session::flash('message', 'Your password has been updated successfully!');
          }
          else
          {
            Session::flash('error', 'Current Password Does not match');
          }
        return redirect(route('admin.settings', ['type' => 'change_password']));
    }

     // profile settings update
    function updateprofile(Request $request)
    {
        $id = Auth::user()->id;
        $admin = Admin::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admin,email,'.$id]
        ]);
        if ($validator->fails()) {
          return redirect(route('admin.settings', ['type' => 'profile']))->withErrors($validator);
        }
 
        $oldphoto = $admin['admin_image'];
        $input = $request->all();
        if($request->hasfile('admin_image')){
            $file = $request->file('admin_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() .  '.' . $extension;
            $file->move('assets/admin/users/',$filename);
            $input['admin_image'] = $filename;
            if($oldphoto != '' && $oldphoto != 'default.jpg')
            { 
                $image = 'assets/admin/users/'.$oldphoto;
                // $filename = str_replace('app\Http\Controllers\Admin', '', __DIR__).$image;
                // unlink($filename);
                 if(\File::exists($image)) {
                   \File::delete($image);
               }
            }
        } 
        $admin->update($input);
       Session::flash('message', 'Your Profile Updated Successfully!!');
       return redirect(route('admin.settings', ['type' => 'profile']));
    }


    // site settings update
    function update_settings(Request $request)
    {
        $id = trim($request->id);
        $settings = Settings::findOrFail($id);
        $input = $request->all();
        $input = array_map('trim', $input);
        if($input['stripe_settings']){
          unset($input['stripe_settings']);
          $input['stripe_mode'] = (!empty($input['stripe_mode']) && $input['stripe_mode'] == 'on') ? 'SANDBOX' : 'LIVE';
        }
        $settings->update($input);

        Session::flash('message', 'Settings Updated Successfully!!');
        return redirect()->back();
    }
}
