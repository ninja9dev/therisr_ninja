<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

 use App\Models\User;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */ 
    protected $redirectTo = 'afterVerifyRedirect';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        $email = $request->user()->email;
        if((empty($request->user()->email_verified_at) || is_null($request->user()->email_verified_at)) && 
          (!empty($request->user()->provider) && !is_null($request->user()->provider))) 
        {
            User::where('id',$request->user()->id)->update(array('email_verified_at' => date('Y-m-d H:i:s')));
            return redirect($this->redirectPath());
        }

        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('user.auth.verify',compact('email'));
    }
}
