<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User, App\Models\UserAvailable, App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

class Freelancer
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
               
               // check if current user is not freelancer
                if($user->user_type != '1'){
                  return redirect('/');
                }

                // if profile not added yet
                 if (! $request->expectsJson()) {
                    $route = Route::getRoutes()->match($request);
                    $currentroute = $route->getName();
                     if((empty(@$user->userProfile) || (@$user->userProfile->services == null  && @$user->userProfile->skills == null ) ) && $currentroute != 'user.editprofile' && $currentroute != 'user.addproject' && $currentroute != 'user.editproject'){
                      return redirect('editprofile');
                     }
                }

                // set data to user availability if not exist 
                if(empty(@$user->userAvailable)){
                  $input = array(
                     'available'  => '1',
                     'avail_for'  => '30'
                  );
                  $match_s = array(
                      'user_id' => $userid
                   );
                   UserAvailable::updateOrCreate($match_s,$input); 
                }

            }
        }
      
        return $next($request);
   }
}