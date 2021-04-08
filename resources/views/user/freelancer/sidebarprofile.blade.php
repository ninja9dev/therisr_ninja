<div class="col-xl-3 col-lg-4 col-md-4 col-sm-8 offset-md-0  offset-sm-2">
   <div class="inner-profile text-center main-border inr-prfle-wd">
        @php
            if(@$user->image != '') $image =  asset('assets/users').'/'.@$user->image; 
            else $image =  asset('assets/users/default.jpg'); 
         @endphp
      <img  class="img-preview" src="{{ $image }}">
      <h3>{{ Auth::user()->name}}</h3>
      <h4>{{ !empty($user->userProfile['prim_title']) ? $user->userProfile['prim_title'] : '' }}</h4>
      <h5> 
         <span class="icon-location">
            <img class="mt-0" src="{{ asset('assets/img/location.png')}}">
         </span>{{ !empty($user->userProfile['city']) ? $user->userProfile['city'] : '' }}{{ (!empty($user->userProfile['city']) && !empty($user->countryName['country_name'])) ? ', ' : ''}}
                        {{ !empty($user->countryName['country_name'] ) ? $user->countryName['country_name']  : ''}}
      </h5>
      <p class="available text-center">
         {{ (!empty($user->userAvailable['available']) &&  
          $user->userAvailable['available'] == '2' ) 
          ? 'Not Availble' 
          : 'Available' }}
      </p>
      <a href="{{ route('user.editprofile') }}">
          <button class="update-pro" type="submit" class="btn btn-primary">Update profile</button>
      </a>
      <div class="hr-border"></div> 
      <ul class="main-menus">
         <li><a class="find-jobs">Find jobs</a></li>

         <li><a class="menu-links {{ (Route::current()->getName() == 'user.alljobs') ? 'active' : '' }}" 
             href="{{ route('user.alljobs') }}">Browse Jobs</a></li>

         <li><a class="menu-links {{ (Route::current()->getName() == 'user.likedjobs') ? 'active' : '' }}" 
            href="{{ route('user.likedjobs') }}">Liked Jobs</a></li>

         <li><a class="menu-links {{ (Route::current()->getName() == 'user.appliedjobs') ? 'active' : '' }}"  
            href="{{ route('user.appliedjobs') }}">Applied Jobs</a></li>

         <li><a class="menu-links {{ (Route::current()->getName() == 'user.skippedjobs') ? 'active' : '' }}" 
          href="{{ route('user.skippedjobs') }}">Skipped Jobs</a></li>

          <li><a class="menu-links {{ (Route::current()->getName() == 'user.offerjobs') ? 'active' : '' }}" 
          href="{{ route('user.offerjobs') }}">Offers</a></li>

      </ul>
   </div> 
</div>