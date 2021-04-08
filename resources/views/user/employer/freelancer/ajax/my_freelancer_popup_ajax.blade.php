

        <div class="modal-header">
            <a class="view-pro-btn" 
            href="{{ route('user.f_profile', ['id' => $user->id])}}">
              View full profile
            </a>
            <ul class="vew-pfle-ul">
                <a href="" class="modl-msg-btn" data-toggle="modal" data-target="#invitebtn">Invite</a>
                 <a 
                 href="javascript:void(0);"
                 onclick="return get_HirePopupView('{{$user->id}}',0,0);" 
                 class="modl-hre-btn">Hire</a>
            </ul>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="onModalClose();">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
         <div class="modal-body">
            <div class="media vew-prfle-img">
            @php
               if(@$user->image != '') $image =  asset('assets/users').'/'.@$user->image; 
               else $image =  asset('assets/users/default.jpg'); 
            @endphp

               <img src="{{ $image }}" alt="" class="mr-3 prof rounded-circle">
               <div class="media-body">
                  <div class="vew-prfle-rate">
                     
                     <h4>{{ $user->name }}</h4>
                     <ul>
                         <?php echo getUserScoreHtml($user->id, $user->therisr_score, 'user');?>
                        
                        <li>
                         {{ (
                          !empty($settings->currency)  ? $settings->currency  : '$').(
                          !empty($user->hourly_rate) 
                          ? $user->hourly_rate.'/hr' 
                          : (!empty($user->userProfile['hourly_rate']) 
                                 ? $user->userProfile['hourly_rate'].'/hr' : '') 
                        ) }}
                       </li>

                        <li>
                           <img src="../assets/img/location-cream.png">
                           {{ !empty($user->countryName['country_name'] ) ? $user->countryName['country_name']  : ''}}
                        </li>
                     </ul>
                  </div> 
                  <ul class="vew-prfle-prim">
                     <li> {{ (
                      !empty($user->prim_title) 
                      ? $user->prim_title 
                      : (!empty($user->userProfile['prim_title']) ? $user->userProfile['prim_title'] : '') 
                    ) }},</li>

                     <li> {{ (
                      !empty($user->sec_title) 
                      ?  $user->sec_title 
                      :  (!empty($user->userProfile['sec_title']) ? $user->userProfile['sec_title'] : '')
                    ) }}</li>
                  </ul>
               </div>
            </div>
            <div class="">
               <p>{{ (
                  !empty($user->introduce) 
                  ?$user->introduce
                  :  (!empty($user->userProfile['introduce']) ? $user->userProfile['introduce'] : '')
                ) }} 
               </p>

                   <div class="inner-table-box skillreuqired mt-3 modl-cvr-ltr">
                       <ul class="mb-0">
                         @if(!empty($user->userProfile['services'] ) || !empty($user->services)) 
                          @php 
                           $services = array();
                          $services = explode(',', !empty($user->userProfile['services']) ? $user->userProfile['services'] : $user->services)
                          @endphp
                      

                            @forelse($services as $key=>$ser)
                              <li> {{ getServiceName($ser) }}</li>
                            @empty
                            @endforelse
                          @else
                             No service added!
                          @endif
                       </ul>
                    </div>
            </div>


            <div class="modl-cvr-ltr modl-qulfs">
               <h2>Qualifications</h2>
               <ul>
                  <li class="modl-port-rel">English level 
                     <i class="fa fa-thumbs-o-up thumb-bage" aria-hidden="true"></i>
                     <span>
                      {{ (
                        !empty($user->english_prof) 
                        ? englishLevel($user->english_prof) 
                        : (!empty($user->userProfile) ? englishLevel($user->userProfile['english_prof']) : '' )
                      )}}</span>
                  </li>
                  <li class="modl-port-rel">TheRisr score 
                     <i class="fa fa-thumbs-o-up thumb-bage" aria-hidden="true"></i>
                     <span>3.0 +</span>
                  </li>
                  <li class="modl-port-rel">Experience level 
                     <span>
                      {{(
                        !empty($user->exp_level) 
                        ? englishLevel($user->exp_level) 
                        : (!empty($user->userProfile) ? englishLevel($user->userProfile['exp_level']) : '' )
                      )}}

                     </span>
                  </li>
               </ul>
            </div>

            <div class="modl-wrk-hstry" id="workExperienceBOX">
               <h2>Work history</h2>
            </div> 

         </div>
<script>
  $(document).ready(function(){
     //get work experience section
     get_workExperienceBOX("{{ route('user.f_workhistory_ajax', ['id' => $user->id, 'page' => 'freelancer_popup'])}}"); 

   });
 

function get_workExperienceBOX($url){
   showScreenLoader();
    $.ajax({
         url: $url,
         success:function(response)
         {
            hideLoader();
            $('#workExperienceBOX').html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
}