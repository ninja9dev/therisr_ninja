<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User, App\Models\Settings, App\Models\Services, App\Models\Skills, App\Models\UserSavedSearches;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DataGlobal
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
            }

        }
    

       if (Schema::hasTable('settings')) {
          $settings = Settings::first();
          view()->share('settings', @$settings);  
       }

      if (Schema::hasTable('services') && Schema::hasTable('skills')) {
        $services = Services::where('status','1')->get();
        $skills = Skills::all();
          view()->share('services', @$services);  
          view()->share('skills', @$skills);  
      }



        // share value with controller
         $request->attributes->add(
            ['settings' => @$settings, 'user' => @$user]
          );

        return $next($request);
   }
}