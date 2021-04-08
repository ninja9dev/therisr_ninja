
     <div class="col-xl-3 col-lg-4 col-md-4 col-sm-8 offset-md-0  offset-sm-2">
         <div class="inner-profile text-center main-border">
              @php
                if(@$user->image != '') $image =  asset('assets/users').'/'.@$user->image; 
                else $image =  asset('assets/users/default.jpg'); 
             @endphp
             <img  class="img-preview" src="{{ $image }}">

             <h3>{{ Auth::user()->name }}</h3>
             <h4>{{ !empty($user->userEmpProfile['company_name'] ) ? $user->userEmpProfile['company_name']  : ''}}</h4>

             <h5>
                 <span class="icon-location">
                  <img class="mt-0" src="../assets/img/location.png">
                 </span> {{ !empty($user->userEmpProfile['city']) ? $user->userEmpProfile['city'] : '' }}{{ (!empty($user->userEmpProfile['city']) && !empty($user->countryName['country_name'])) ? ', ' : ''}}
                  {{ !empty($user->countryName['country_name'] ) ? $user->countryName['country_name']  : ''}}
            </h5>
            
             <a href="{{ route('user.gen_settings') }}">
               <button class="update-pro" type="submit" class="btn btn-primary">Update profile</button>
             </a>
              <div class="hr-border"></div>
              <ul class="main-menus">
                <!--  <li><a class="find-jobs">MY TEAM</a></li> -->
                 <li><a class="menu-links {{ (Route::current()->getName() == 'user.e_myjobs') ? 'active' : '' }}" 
                           href="{{ route('user.e_myjobs') }}">All Postings</a></li>

                <li><a class="menu-links {{ (Route::current()->getName() == 'user.allproposals') ? 'active' : '' }}" 
                           href="{{ route('user.allproposals') }}" >All Proposals</a></li>
                
                <li><a class="menu-links {{ (Route::current()->getName() == 'user.alloffers') ? 'active' : '' }}" 
                           href="{{ route('user.alloffers') }}" >All Offers</a></li>

                 <li><a class="menu-links {{ (Route::current()->getName() == 'user.activecontracts') ? 'active' : '' }}" 
                           href="{{ route('user.activecontracts') }}">Active contracts</a></li>

                  <li><a class="menu-links {{ (Route::current()->getName() == 'user.myfreelancer') ? 'active' : '' }}" 
                          href="{{ route('user.myfreelancer') }}">My freelancers</a></li>

                  <li><a class="menu-links {{ (Route::current()->getName() == 'user.draftjobs') ? 'active' : '' }}" 
                           href="{{ route('user.draftjobs') }}" >Draft Jobs</a></li>

                  <li><a class="menu-links {{ (Route::current()->getName() == 'user.archivedjobs') ? 'active' : '' }}" 
                           href="{{ route('user.archivedjobs') }}">Archived Jobs</a></li>

                  <li><a class="menu-links {{ (Route::current()->getName() == 'user.jobreports') ? 'active' : '' }}" 
                                 href="{{ route('user.jobreports') }}">Report</a></li>

                  <li><a class="menu-links" 
                           href="javascript:void(0);">Payment Settings</a></li>
              </ul>
         </div>
      </div>
