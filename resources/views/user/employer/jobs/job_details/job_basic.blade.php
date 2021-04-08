   <div class="inner-table-box">
      <h1 class="timesheet">Job details</h1>
      <div class="jobdetailsCon">
         <ul>
            @if($job->job_type == '1')
               <li>
                  <h5>Hourly</h5>
                  <p>{{ !empty($job->weekly_limit) ? 'Less than '.$job->weekly_limit.'  hr/week': 'N/A' }}</p>
               </li>
               <li>
                  <h5>Length</h5>
                  <p>{{ !empty($job->project_length) ? 'More than '.$job->project_length.' months' : 'N/A' }} </p>
               </li>
            @else
               <li>
                  <h5>Fix Cost</h5>
                  <p>{{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $job->total_cost }}</p>
               </li>

            @endif

            
            <li>
               <h5>Experience Level</h5>
               <p> {{ !empty($job->exp_level) ? expertLevel($job->exp_level) : 'N/A' }} </p>
            </li>
            <li>
               <h5>English Level</h5>
               <p> {{ !empty($job->english_prof) ? englishLevel($job->english_prof) : 'N/A' }} </p>
            </li>
         </ul>
      </div>
   </div>

   <div class="clearfix"></div>
   <div class="border-hr"></div>

   <div class="inner-table-box jobDescri">
      <h1 class="timesheet">Job Description</h1>
      <p>{{ !empty($job->job_description) ? $job->job_description : 'No Description added yet!' }}</p>
   </div>

   <div class="clearfix"></div>
   <div class="border-hr"></div>

    <div class="inner-table-box skillreuqired">
      <h1 class="timesheet">Expertise</h1>
      <ul>
         @if(!empty($job->expertise )) 
              @php  
              $expertise = array();
              $expertise = explode(',', $job->expertise)
              @endphp
          

            @forelse($expertise as $key=>$service)
               <li> {{ getServiceName($service) }}</li>
            @empty
            @endforelse
         @else
             No skills added!
         @endif
      </ul>
   </div>

   <div class="inner-table-box skillreuqired">
      <h1 class="timesheet">Skill Requirements</h1>
      <ul>
         @if(!empty($job->skills )) 
              @php 
              $skills = array();
              $skills = explode(',', $job->skills)
              @endphp
          

            @forelse($skills as $key=>$skill)
               <li> {{ getSkillName($skill) }}</li>
            @empty
            @endforelse
         @else
             No skills added!
         @endif
      </ul>
   </div>
    @if(!empty($job->interview_questions))
      <div class="clearfix"></div>
      <div class="border-hr"></div>

      <div class="inner-table-box interviewQsns">
         <h1 class="timesheet">Interview Questions</h1>
         <ul>
               @foreach(json_decode($job->interview_questions) as $key=>$inter)
                 <li>{{ $inter }} </li>
               @endforeach
          
         </ul>
      </div>
   @endif
   <div class="clearfix"></div>
   <div class="border-hr"></div> 

   <div class="inner-table-box postedDate pointer" title="{{ ($job->job_status == '2') 
                         ? dateFormat($job->posted_at) 
                         : ( ($job->job_status == '3') ? dateFormat($job->deleted_at) : dateFormat($job->updated_at) )  }}">
      <span class="hired-by-company-us "><i class="fa fa-clock-o" aria-hidden="true"></i> 
         {{ ($job->job_status == '2') 
             ? getDateAgo($job->posted_at, 'posted') 
             : ( ($job->job_status == '3') ? getDateAgo($job->deleted_at, 'archived') : getDateAgo($job->updated_at, 'updated') )  }}
      </span>
   </div>


