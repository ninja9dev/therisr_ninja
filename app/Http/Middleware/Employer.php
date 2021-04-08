<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User, App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class Employer
{
   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
  public function handle($request, Closure $next)
   {
       if (Auth::check()) {
            $userid = json_decode(Auth::user())->id;
            if (Schema::hasTable('users')){
                $user = User::find($userid);
                view()->share('user', @$user);
               
               // check if current user is employer
                if($user->user_type != '2'){
                  return redirect('/');
                }

            }
        }
      
        return $next($request);
   }
}