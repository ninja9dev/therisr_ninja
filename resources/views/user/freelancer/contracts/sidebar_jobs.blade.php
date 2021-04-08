  <div class="col-xl-3 col-lg-4 col-md-4 col-sm-8 offset-md-0  offset-sm-2">
      <div class="report-inner text-center">
         <h6 class="monthly-earnings">Monthly earnings</h6>
         <h4 class="numn">
         {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ getMonthlyEarnings(Auth::user()->id) }}
         </h4>
         <h5 class="usd">{{ !empty($settings->currency_code)  ? $settings->currency_code  : 'USD'}}
         </h5>
      </div>
      <div class="report-inner menus-report">
         <ul class="main-menus"> 
            <li><a class="find-jobs">My jobs</a></li>
            <li><a class="menu-links all-contracts {{ (Route::current()->getName() == 'user.myjobs') ? 'active' : '' }}" 
                           href="{{ route('user.myjobs') }}">All contracts</a></li>

            <li><a class="menu-links {{ (Route::current()->getName() == 'user.activecontract') ? 'active' : '' }}" 
                           href="{{ route('user.activecontract') }}">Active contracts</a></li>
                           
           <li><a class="menu-links {{ (Route::current()->getName() == 'user.endedcontract') ? 'active' : '' }}" 
                           href="{{ route('user.endedcontract') }}">Ended contracts</a></li>

            <li><a class="menu-links {{ (Route::current()->getName() == 'user.archivedcontract') ? 'active' : '' }}" 
                           href="{{ route('user.archivedcontract') }}">Archived</a></li>

            <li><a class="menu-links {{ (Route::current()->getName() == 'user.jobreports') ? 'active' : '' }}" 
                           href="{{ route('user.jobreports') }}">Report</a></li>

            <li><a class="menu-links" 
                           href="javascript:void(0);">Payment Settings</a></li>
         </ul>
      </div>
   </div>