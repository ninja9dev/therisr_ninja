<div class="modal-header">

    <ul class="vew-pfle-ul">
        <input type="hidden" name="contractId" id="contractId" value="{{ $contract->id }}"/>
       @if(!empty($contract) && $contract->contract_status == '1' )
        <a type="button" 
            class="modl-msg-btn pointer delete_hire"
            data-placement="right"
            data-toggle="confirmation"
            data-id=""
            href="javascript:void(0);"
            title="Do you want to delete this Offer?"
            id="undo_button">Delete Offer</a>
        @endif
        @if(!empty($contract) && $contract->contract_status == '4' )
          Your offer is rejected.
        @elseif(!empty($contract) && $contract->contract_status == '2' )
          Your offer accepted {{ getDateAgo($contract->contract_start_on, '') }} 
        @endif
    </ul>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
     <div class="media vew-prfle-img">
       @php
           if(@$user->image != '') $image =  asset('assets/users').'/'.@$user->image; 
           else $image =  asset('assets/users/default.jpg'); 
       @endphp

         <img src="{{$image}}" class="mr-3 prof rounded-circled">

          <div class="media-body">
             <div class="vew-prfle-rate">
                <h4>{{ $user->name}}</h4>
                <ul>
                  <?php echo getUserScoreHtml($user->id, $user->therisr_score, 'user');?>
                   
                   <li>{{ (!empty($settings->currency)  ? $settings->currency  : '$').  (!empty($user->userProfile) ? $user->userProfile->hourly_rate : '').'/hr' }}</li>

                   <li>
                      <img src="../assets/img/location-cream.png"> 
                      {{ !empty($user->countryName['country_name'] ) ? $user->countryName['country_name']  : ''}}
                   </li>
                </ul>
             </div>
             <ul class="vew-prfle-prim">
                <li>
                   {{ !empty($user->userProfile['prim_title']) ? $user->userProfile['prim_title'] : '' }},
                </li>
                <li>
                   {{ !empty($user->userProfile['sec_title']) ? $user->userProfile['sec_title'] : '' }} 
                </li>
             </ul>
          </div>
       </div>
    <div class="offer-details-box"> 
      <h1 class="timesheet">Offer details</h1>
      <div class="jobdetailsCon">
         <ul>
            @if($contract->contract_type == '1')
               <li>
                  <h5>Hourly : {{ !empty($contract->hourly_rate) ? 
                    (!empty($settings->currency)  ? $settings->currency  : '$').$contract->hourly_rate.'/hr': 'N/A' }}</h5>

                  <p>{{ !empty($contract->weekly_limit) ? 'Less than '.$contract->weekly_limit.'  hr/week': 'N/A' }}</p>
               </li>
               <li>
                  <h5>Length</h5>
                  <p>{{ !empty($contract->project_length) ? 'More than '.$contract->project_length.' months' : 'N/A' }} </p>
               </li>
            @else
               <li>
                  <h5>Fix Cost</h5>
                  <p>{{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $contract->total_cost }}</p>
               </li>

            @endif
            <li>
               <h5>Experience Level</h5>
               <p> {{ !empty($contract->exp_level) ? expertLevel($contract->exp_level) : 'N/A' }} </p>
            </li>
            <li>
               <h5>English Level</h5>
               <p> {{ !empty($contract->english_prof) ? englishLevel($contract->english_prof) : 'N/A' }} </p>
            </li>
         </ul>
      </div>
   </div>

    <div class="offer-details-box"> 
      <h1 class="timesheet">Job Description</h1>
      <p>{{ !empty($contract->job_description) ? $contract->job_description : 'No Description added yet!' }}</p>
   </div>
 

   <div class="inner-table-box postedDate pointer" title="{{ ($contract->contract_status == '2') 
                         ? dateFormat($contract->contract_start_on) 
                         : ( ($contract->contract_status == '3') ? dateFormat($contract->deleted_at) : dateFormat($contract->updated_at) )  }}">
      <span class="hired-by-company-us "><i class="fa fa-clock-o" aria-hidden="true"></i> 
         {{ ($contract->contract_status == '2') 
             ? getDateAgo($contract->contract_start_on, 'posted') 
             : ( ($contract->contract_status == '3') ? getDateAgo($contract->deleted_at, 'archived') : getDateAgo($contract->updated_at, 'updated') )  }}
      </span>
   </div>
</div>

<script type="text/javascript">
  
     $('.delete_hire').confirmation({
      template: '<div class="popover">' +
         '<div class="arrow"></div>' +
         '<h3 class="popover-title">Are you sure?</h3>' +
         '<div class="popover-content text-center">' +
         '<div class="btn-group">' +
         '<a class="btn btn-small" href="javascript:void(0);" data-id="">Yes</a>' +
         '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
         '</div>' +
         '</div>' +
         '</div>',
       onConfirm: function(event, element) { 
         $pid= $('#contractId').val();
         job_hiredelete("{{ url('job_hiredelete') }}/"+$pid);
        },
   }); 



</script>