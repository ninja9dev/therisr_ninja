<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Http\Request;
 
 use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

     public function showResetForm(Request $request, $token = null)
    {
        $user = User::where('email',$request->email)->first();
        if(empty($user->email_verified_at) || is_null($user->email_verified_at))
        {
            User::where('email',$request->email)->update(array('email_verified_at' => date('Y-m-d H:i:s')));
        }
        return view('user.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'name' => !empty($user) ? $user->name : '-']
        );
    }


   
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function rules()
    {
        return  [
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^(?=.*?[a-z])(?=.*?[#?!@$%^&*-_]).{8,}$/']
        ];
    }

    protected function validationErrorMessages()
    {
        return [
             'password.regex' => 'The :attribute format is invalid. It should be 8 characters minimum, atleast 1 letter & symbol. ',
         ];
    }



}
