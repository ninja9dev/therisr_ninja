
@php
 if(empty($contract->job_proposals_count)){
            $contract->job_proposals_count = getJobProposalsCount($contract->id); 
         }
@endphp

 <div class="details-all-show jb-dtl-skip">
    <div class="body-dtlds">
        <div class="bordr-frts jb-dtl-pd">
          <h1> Offer Terms: </h1>
          <div class="">
       
                <ul>
                   @if($contract->contract_type == '1')
                   <li>
                      <h5>Hourly Rate</h5>
                      <p>
                       {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ !empty($contract->hourly_rate) ? $contract->hourly_rate.'/hr' : '' }}</p>
                   </li>
                   <li>
                      <h5>Weekly Limit</h5>
                      <p>{{ !empty($contract->weekly_limit) ? 'Less than '.$contract->weekly_limit.'  hr/week': 'N/A' }}</p>
                   </li>
                   <li>
                      <h5>Length</h5>
                      <p>{{ !empty($contract->project_length) ? 'More than '.$contract->project_length.' months' : 'N/A' }} </p>
                   </li>
                 @else
                   <li>
                         Est. Budget:{{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $contract->total_cost }}
                   </li>
                  @endif
                </ul>
          </div>
       </div>
      @if(!empty($contract->contractJobProposal))
       <div class="bordr-frts jb-dtl-pd">
          <h1> Your Proposed Terms: </h1>
          <div class="">

                <ul>
                   @if($contract->contractJobProposal->job_type == '1')
                   <li>
                      <h5>Hourly Rate</h5>
                      <p>
                       {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ !empty($contract->contractJobProposal->hourly_rate) ? $contract->contractJobProposal->hourly_rate.'/hr' : '' }}</p>
                   </li>
                   
                 @else
                   <li>
                         Est. Budget:{{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $contract->contractJobProposal->total_cost }}
                   </li>
                  @endif
                </ul>
          </div>
       </div>
      @endif
    </div> 
    <div class="body-dtlds">
       <div class="bordr-frts jb-dtl-pd">
          <h1>Job details</h1>
             <ul> 
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
    <div class="body-dtlds">
       <div class="bordr-frts jb-despt">
          <h1>Job description</h1>
          <p>{{ !empty($contract->job_description) ? $contract->job_description : 'No Description added yet!' }}</p>
       </div>
    </div>
     <div class="body-dtlds">
       <div class="bordr-frts jb-tgs">
        <h1 class="timesheet">Expertise</h1>
        <ul>
           @if(!empty($contract->expertise )) 
                @php  
                $expertise = array();
                $expertise = explode(',', $contract->expertise)
                @endphp
            

              @forelse($expertise as $key=>$service)
                  <span class="badge badge-primary">  {{ getServiceName($service) }}</span>
              @empty
              @endforelse
           @else
               No expertise added!
           @endif
        </ul>
      </div>
    </div>

    <div class="body-dtlds">
       <div class="bordr-frts jb-tgs">
          <h1>Skill requirements</h1>
            <div class="tags">
                @if(!empty($contract->skills )) 
                    @php 
                    $skills = array();
                    $skills = explode(',', $contract->skills)
                    @endphp
                
                  @forelse($skills as $key=>$skill)
                     <span class="badge badge-primary"> {{ getSkillName($skill) }}</span>
                  @empty
                  @endforelse
               @else
                   No skills added!
               @endif
            </div>
       </div>
    </div>
 </div>


