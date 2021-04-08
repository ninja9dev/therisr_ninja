  <div class="col-xl-3 col-lg-4 col-md-4 col-sm-8 offset-md-0  offset-sm-2">
      <div class="report-inner text-center">
         <h6 class="monthly-earnings">Monthly Spent</h6>
         <h4 class="numn">
         {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ getMonthlySpent(Auth::user()->id) }}
         </h4>
         <h5 class="usd">{{ !empty($settings->currency_code)  ? $settings->currency_code  : 'USD'}}
         </h5>
      </div>
      <div class="report-inner menus-report">
         <ul class="main-menus"> 
            <li><a class="find-jobs">My jobs</a></li>
            <li><a class="menu-links all-contracts {{ (Route::current()->getName() == 'user.allcontracts') ? 'active' : '' }}" 
                           href="{{ route('user.allcontracts') }}">All contracts</a></li>

            <li><a class="menu-links {{ (Route::current()->getName() == 'user.activecontracts') ? 'active' : '' }}" 
                           href="{{ route('user.activecontracts') }}">Active contracts</a></li>
                           
            <li><a class="menu-links {{ (Route::current()->getName() == 'user.e_endedcontract') ? 'active' : '' }}" 
                           href="{{ route('user.e_endedcontract') }}">Ended contracts</a></li>

            <li><a class="menu-links {{ (Route::current()->getName() == 'user.archivedcontracts') ? 'active' : '' }}" 
                           href="{{ route('user.archivedcontracts') }}">Archived</a></li>

            <li><a class="menu-links {{ (Route::current()->getName() == 'user.jobreports') ? 'active' : '' }}" 
                           href="{{ route('user.jobreports') }}">Report</a></li>

            <li><a class="menu-links" 
                           href="javascript:void(0);">Payment Settings</a></li>
         </ul>
      </div>
   </div>