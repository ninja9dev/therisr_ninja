<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User,App\Models\Countries;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
   

     public function showRegistrationForm()
    {
         if (Session::has('userLinkedinData')){
            $data['data'] = Session::get('userLinkedinData');
         }
        $data['countries'] = Countries::all();
        return view('user.auth.register')->with($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^(?=.*?[a-z])(?=.*?[#?!@$%^&*-_]).{8,}$/'],
        ],[
             'password.regex' => 'The :attribute format is invalid. It should be 8 characters minimum, atleast 1 letter & symbol. ',
         ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = array(
            'name' => $data['name'],
            'username' => generateUsername($data['email']),
            'email' => $data['email'],
            'user_type' => isset($data['user_type']) ? trim($data['user_type']) : '1',
            'country' => isset($data['country']) ? trim($data['country']) : null
            
        );
        if(!empty($data['provider'])){
            $user['email_verified_at'] = (@$data['emaillinkedin'] == 'autoverify' )  
                                          ? date('Y-m-d H:i:s') : ''; 
            $user['provider'] = $data['provider'];
            $user['provider_id'] = $data['provider_id'];
            $user['password'] = Hash::make($data['password']);
            $user['setpassword'] = 'no';
        }else{
            $user['password'] = Hash::make($data['password']);
        }
        return User::create($user);
    }
}
