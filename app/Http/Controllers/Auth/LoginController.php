<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;use Socialite, App\Models\Countries;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
   
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest')->except('logout');
    }
    
     public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function login()
    {
         return view('user.auth.login');
    }
     /**
     * Redirect the user to the Linkedin authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
     // echo env('ASSET_URL');die;
        return Socialite::driver($provider)->scopes(['r_liteprofile', 'r_emailaddress'])->redirect();
    }
   
    /**
     * Obtain the user information from Linkedin.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        /**
         * If a user has registered before using social auth, return the user
         * else, create a new user object.
        */ 

        $email = !empty($user->email) ? $user->email :  $user->id.'noemail@gmail.com';
        $authUser = User::where('provider_id', $user->id)->orWhere('email', $email)->first();
        if ($authUser) {
          if(empty($authUser->provider)){
            $userup = User::findOrFail($authUser->id);
            $userup->update(array('provider' => $provider, 'provider_id' => $user->id));
          }
          Auth::login($authUser, true);
          return redirect(route('/'));
        }else{
          $data = array(
            'name'     => $user->name, 
            'email'    => $email,
            'provider' => $provider,
            'provider_id' => $user->id
           );
           Session::put('userLinkedinData',$data);
           
           return redirect(route('register'));
        }

    }



    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username()))
            ->withErrors($errors);
    }
    

    public function loginUser(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      // Attempt to log the user in
      if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) 
      {  
             if (Auth::guard()->user()->status != '1') {
                Auth::guard()->logout();
                if(isset($request->ajax))
                {
                     echo json_encode(array('code'=>500,'message'=>'Your Account is Suspended. Please Contact With Administrator!'));
                }else{
                     return redirect()->back()
                    ->with('error','Your Account is Suspended. Please Contact With Administrator!');
                }
            }else{
                if(isset($request->ajax))
                {
                     echo json_encode(array('code'=>200,'message'=>'Login successfully!'));
                }else{
                     // if successful, then redirect to their intended location
                    return redirect()->intended(route('/'));
                }
            }
      }else{
      // if unsuccessful, then redirect back to the login with the form data
        return $this->sendFailedLoginResponse($request);
       }
    }

    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('login')->with('success','Logout successfully!');
    }
    public function username()
    {
        return 'email';
    }

}

