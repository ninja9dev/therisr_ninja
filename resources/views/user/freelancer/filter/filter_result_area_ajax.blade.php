<!--  @if(!empty($users) && count($users) > 0)
<script>
  var resultList = 'resultList'; 
</script>
   <div class="otherLinks vew-propsl-ul left-right actve-drop-sec">
        <ul>
            <li>
               <a href="{{ url()->previous() }}" class="active">
                  <i class="fa fa-angle-left" aria-hidden="true"></i> Back
               </a> 
            </li>
        </ul>
          
        <span class="span-main right-menu">
            {{ $users->total() }} {{ ($users->total() > 1) ? 'freelancers' : 'freelancer' }} found
        </span>
    </div>
        @endif -->
      <div id="jobslisting">   
      @if(!empty($jobs) && count($jobs) > 0)
       <div class="otherLinks vew-propsl-ul left-right actve-drop-sec">
        <ul>
            <li>
               <a href="{{ url()->previous() }}" class="active">
                  <i class="fa fa-angle-left" aria-hidden="true"></i> Back
               </a> 
            </li>
        </ul>
          
        <span class="span-main right-menu">
            {{ $jobs->total() }} {{ ($jobs->total() > 1) ? 'jobs' : 'job' }} found
        </span>
       </div>
       
      @endif
       @forelse($jobs as $key=>$job)
       @php
       
         if(empty($job->job_proposals_count)){
            $job->job_proposals_count = getJobProposalsCount($job->id); 
         }
       @endphp
        <div class="inner-freelancing-listin"  > 
            <div class="job-listing-profile">
              <!--  <a href="{{ route('user.jobdetail') }}" class="nav-link pl-0"> -->
                 <a href="javascript:void(0);" class="nav-link pl-0" 
                  onclick='get_jobBasic_freelancer("{{ route('user.get_jobBasicF', ['id' => $job->id]) }}","alljobs","{{$job->job_status}}")'>
                     <h1>{{ $job->job_title }}</h1>
                </a> 
                <div class="money-fonts">
                  <a href="#">
                      <span class="inner-img">
                         <img src="{{ asset('assets/img/money.png')}}">
                      </span>
                      @if($job->job_type == '1')
                        Hourly Rate:
                          {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ !empty($job->hourly_rate) ? $job->hourly_rate: '' }}
                      @else
                         Est. Budget:{{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $job->total_cost }}
                      @endif
                  </a>
                  <a href="#">
                    <span class="inner-img contract">
                       <img src="{{ asset('assets/img/contract.png')}}">
                    </span>
                      Proposals: {{ $job->job_proposals_count }} 
                  </a>
                  <a href="#">
                    <span class="inner-img location">
                    <img src="{{ asset('assets/img/location-cream.png')}}"></span> 
                    {{ !empty($job->userBasicDetail->countryName['country_name'] ) ? $job->userBasicDetail->countryName['country_name']  : ''}}
                  </a>
                </div>

                <p class="sed-ut-perspiciatis">
                  {{ !empty($job->job_description) ? $job->job_description : 'No Description added yet!' }}
                </p>
             

                <div class="tags">
                  @if(!empty($job->expertise )) 
                      @php 
                        $expertise = array();
                        $expertise = explode(',', $job->expertise)
                      @endphp
                    

                      @forelse($expertise as $key=>$service)
                         <span class="badge badge-primary">{{ getServiceName($service) }}</span>
                      @empty
                      @endforelse
                  @else
                       No service added!
                  @endif
                </div>
                <div class="tags m-b-5">
                   @if(!empty($job->skills )) 
                    @php 
                      $skills = array();
                      $skills = explode(',', $job->skills)
                    @endphp
                

                      @forelse($skills as $key=>$skill)
                         <span class="badge badge-primary">{{ getSkillName($skill) }}</span>
                      @empty
                      @endforelse
                  @else
                       No skills added!
                  @endif
                </div>
                <div class="text-right watch-txt pointer" title="{{ ($job->job_status == '2') 
                           ? dateFormat($job->posted_at) 
                           : ( ($job->job_status == '3') ? dateFormat($job->deleted_at) : dateFormat($job->updated_at) )  }}">
                    <img src="{{ asset('assets/img/watch.png')}}">
                       {{ ($job->job_status == '2') 
                           ? getDateAgo($job->posted_at, 'posted') 
                           : ( ($job->job_status == '3') ? getDateAgo($job->deleted_at, 'archived') : getDateAgo($job->updated_at, 'updated') )  }}
                </div>
            </div>
      @if(empty($job->myJobProposal))
        @if( ( !empty($job->jobLikeSkip) && $job->jobLikeSkip->skip_status != '2' ) || empty($job->jobLikeSkip) )
              <div class="cross">
                      <button type="button"  
                       class="close pointer skip_job{{$job->id}}"
                       data-placement="right"
                       data-toggle="confirmation"
                       data-id="{{ $job->id }}"
                       href="javascript:void(0);">
                        <img src="{{ asset('assets/img/cross.png')}}">
                      </button>
              </div>
        @else
           <div class="cross">
                      <button type="button"  
                       class="close pointer unskip_job{{$job->id}}"
                       data-placement="right"
                       data-toggle="confirmation"
                       data-id="{{ $job->id }}"
                       href="javascript:void(0);"
                       title="Do you want to unskip the job?">
                       <i class="fa fa-undo"></i>
                      </button>
              </div>
        @endif
      @endif

              <script type="text/javascript">
              //toggle confirmation
                   $('.unskip_job{{$job->id}}').confirmation({
                      template: '<div class="popover">' +
                         '<div class="arrow"></div>' +
                         '<h3 class="popover-title">Are you sure?</h3>' +
                         '<div class="popover-content text-center">' +
                         '<div class="btn-group">' +
                         '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$job->id}}">Yes</a>' +
                         '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                         '</div>' +
                         '</div>' +
                         '</div>',
                       onConfirm: function(event, element) { 
                         $pid= $(this).attr('data-id');
                         job_likeskip("{{ url('job_likeskip') }}/unskip/"+$pid);
                        },
                     });

                   $('.skip_job{{$job->id}}').confirmation({
                      template: '<div class="popover">' +
                         '<div class="arrow"></div>' +
                         '<h3 class="popover-title">Are you sure?</h3>' +
                         '<div class="popover-content text-center">' +
                         '<div class="btn-group">' +
                         '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$job->id}}">Yes</a>' +
                         '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                         '</div>' +
                         '</div>' +
                         '</div>',
                       onConfirm: function(event, element) { 
                         $pid= $(this).attr('data-id');
                         job_likeskip("{{ url('job_likeskip') }}/skip/"+$pid);
                        },
                     });
            </script>
        </div>



      @empty
        <div class="inner-table-box">
          <div class="pt-30 text-center">
              <img src="{{ asset ('assets/img/no-trans.png')}}" class="m-auto">
              <p class="no-work-yet"> 
                  No jobs found.
              </p>
          </div>
        </div>
      @endforelse

      @if($jobs->total() > 1)
        <!-- showing record  -->
        Showing {{($jobs->currentPage()-1)* $jobs->perPage()+($jobs->total() ? 1:0)}} to {{($jobs->currentPage()-1)*$jobs->perPage()+count($jobs)}}  of  {{$jobs->total()}}  Results
      
        <!-- pagination buttons -->
       <div id="filter-pagination"> {!! $jobs->onEachSide(0)->render() !!}</div> 

      @endif

       
</div>

<div id="jobdetails"> 
 <!--  job detail area -->
</div>


<script src="{{ asset ('assets/js/function/functions.js') }}"></script>

<script type="text/javascript">
function job_likeskip($url,$from = '')
{  

   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
        applyFilter();
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
               })
      }            
  });
}




</script>