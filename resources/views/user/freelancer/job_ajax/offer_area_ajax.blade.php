 @if(!empty($jobs) && count($jobs) > 0)
  <div class="left-right actve-drop-sec"> 
      <a class="25-jobs" href="javascript:void(0);">
            {{ $jobs->total() }} {{ ($jobs->total() > 1) ? 'offers' : 'offer' }} found
      </a>
  </div>
        @endif
       <div class="accordion report-accordion clientjobs" 
         id="accordionExample">
        @forelse($jobs as $key=>$job)

           <div class="card first_card"  
            id="job-block-{{ $job->id }}">
              <div class="card-header" 
              id="headingOne">
                 <div class="jobTitle">
                    <div class="dropdown">
                      <button class="moreOptnDropdwn_custom moreOptnDropdwn dropdown-toggle" 
                      type="button" 
                      aria-haspopup="true" 
                      aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                       <div class="dropdown-menu dropdown-menu-custom" 
                          aria-labelledby="dropdownMenuButton">
                      
                        <a 
                            class="dropdown-item deleteoption btn link accept_job{{$job->id}}"
                            data-placement="right"
                            data-toggle="confirmation"
                            data-id="{{ $job->id }}"
                            href="javascript:void(0);"
                            >Accept Offer</a>
                        <a 
                            class="dropdown-item deleteoption btn link reject_job{{$job->id}}"
                            data-placement="right"
                            data-toggle="confirmation"
                            data-id="{{ $job->id }}"
                            href="javascript:void(0);"
                            >Reject Offer</a>

                      </div>
                    </div>
                     
                    <h6>&nbsp;</h6> 
                    <h4 class="panel-title" 
                     onclick='get_jobBasicF("{{$job->id}}","{{ route('user.get_contractOfferBasicF', ['id' => $job->id]) }}","offerjobs","{{$job->job_status}}")'>                      
                       <a class="btn btn-link front-end-developer first_accordian" 
                       role="button" data-toggle="collapse" 
                       data-parent="#accordionExample" 
                       href="#collapseOne{{$job->id}}" 
                       aria-expanded="true" 
                       aria-controls="collapseOne"> 
                          
                          {{ $job->job_title }} -  {{ ($job->job_type == '1') ? "Hourly Rate" : "Project Base" }}
                          <div class="riser-scor">
                            <span class="hired-by-company-us">
                              Offer sent by 
                              [{{ !empty($job->userByBasicDetail->userEmpProfile ) ? $job->userByBasicDetail->userEmpProfile->company_name : '' }}/{{ $job->userByBasicDetail->name }}] 
                              on {{  dateFormat($job->created_at) }}
                            </span>
                          </div>
                          
                       </a>
                    </h4>
                 </div>
              </div>

              <div id="collapseOne{{$job->id}}" 
                class="collapse" 
                aria-labelledby="headingOne" 
                data-parent="#accordionExample">
                 <div class="card-body" id="job_basic_box{{$job->id}}">
                    <!-- JOb basic here get with ajax -->
                 </div>
              </div>
              <ul class="tootl-width"> 
                 @if($job->contract_type == '1')
                   <li>
                      Hourly Rate:
                      {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ !empty($job->hourly_rate) ? $job->hourly_rate.'/hr' : '' }}
                   </li>
                   <li>
                      {{ !empty($job->weekly_limit) ? 'Less than '.$job->weekly_limit.'  hr/week': 'N/A' }}
                   </li>
                   <li>
                      Length:
                      {{ !empty($job->project_length) ? 'More than '.$job->project_length.' months' : 'N/A' }} 
                   </li>
                 @else
                   <li>
                         Est. Budget:{{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $job->total_cost }}
                   </li>
                  @endif
              </ul>
           </div>
             <script type="text/javascript">
             //toggle confirmation
                  $('.accept_job{{$job->id}}').confirmation({
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
                        $jid= $(this).attr('data-id');
                        job_statusChange($jid,"{{ url('statuschange_contract') }}/accept/"+$jid);
                       },
                    });
                  $('.reject_job{{$job->id}}').confirmation({
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
                        $jid= $(this).attr('data-id');
                         job_statusChange($jid,"{{ url('statuschange_contract') }}/reject/"+$jid);
                       }, 
                    }); 
            </script>
              



         @empty
           <div class="inner-table-box">
              <div class="pt-30 text-center">
                 <img src="{{ asset('assets/img/no-trans.png')}}" class="m-auto">
                 <p class="no-work-yet"> 
                 @if(!empty($currentpage) && $currentpage == 'draftjobs' )
                       No Drafts yet.
                 @elseif(!empty($currentpage) && $currentpage == 'archivedjobs' )
                       No Archived yet.
                 @else
                    No Offers yet.
                 @endif
               </p>
              </div>
           </div>
        @endforelse

        @if($jobs->total() > 1)
          <!-- showing record  -->
          Showing {{($jobs->currentPage()-1)* $jobs->perPage()+($jobs->total() ? 1:0)}} to {{($jobs->currentPage()-1)*$jobs->perPage()+count($jobs)}}  of  {{$jobs->total()}}  Results
        
          <!-- pagination buttons -->
         <div id="listing-pagination"> {!! $jobs->onEachSide(0)->render() !!}</div>
        @endif
         </div>

 <script type="text/javascript">
$( document ).ready(function() {
      $('.moreOptnDropdwn_custom ').on('click', function (event) {
        $(this).parent().toggleClass('show'); $(this).parent().find('.dropdown-menu').toggleClass('show');
    });
      $('body').on('click', function (e) {
          if (!$('.moreOptnDropdwn_custom').is(e.target) && $('.moreOptnDropdwn_custom').has(e.target).length === 0 && $('.show').has(e.target).length === 0) {
              $('.moreOptnDropdwn_custom ').parent().removeClass('show');
              $('.moreOptnDropdwn_custom ').parent().find('.dropdown-menu').removeClass('show');
          }
      });
});


    </script>
<script src="{{ asset ('assets/js/function/functions.js') }}"></script>

<script type="text/javascript">


   var currentPath = "{{ route('user.get_job_ajax_frlncr', ['page' => 'offerjobs'])}}";
   var currentPagep = "all";


function job_likeskip($url,$from = '')
{ 

   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
          job_areaGet(currentPath,currentPagep);
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