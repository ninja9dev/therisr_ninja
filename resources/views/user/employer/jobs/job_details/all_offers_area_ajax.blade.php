
<div class="otherLinks vew-propsl-ul">
  
   <ul id="myTab" role="tablist" class="nav">
      <li>
         <a class="nav-link {{ ( (!empty($currentlikepage) && $currentlikepage == 'all' )) ? 'active' : '' }}" id="home-tab" 
         data-toggle="tab" href="#getproposalLists_ajax" role="tab" 
         aria-controls="home" 
         aria-selected="true"
         onclick='job_areaGet("{{ route('user.get_alloffer_area_ajax', ['page' => 'all'])}}", "all")'>
            All Offers
         </a>
      </li>
      <li>
         <a class="nav-link {{ (!empty($currentlikepage) && $currentlikepage == 'pending' ) ? 'active' : '' }}" id="home-tab" 
         data-toggle="tab" href="#getproposalLists_ajax" role="tab" 
         aria-controls="home" 
         aria-selected="true"
         onclick='job_areaGet("{{ route('user.get_alloffer_area_ajax', ['page' => 'pending'])}}", "pending")'>
           Pending
         </a>
      </li>
      <li>
         <a class="nav-link {{ (!empty($currentlikepage) && $currentlikepage == 'rejected' ) ? 'active' : '' }}" id="home-tab" 
         data-toggle="tab" href="#getproposalLists_ajax" role="tab" 
         aria-controls="getproposalLists_ajax" 
         aria-selected="true"
         onclick='job_areaGet("{{ route('user.get_alloffer_area_ajax', ['page' => 'rejected' ])}}", "rejected")'>
            Rejected
         </a>
      </li>
   </ul>
</div>

<div class="allproposal-card-header tab-content" id="myTabContent">
   <!-- tab1 -->
   <div class="tab-pane fade show active" id="getproposalLists_ajax" role="tabpanel" aria-labelledby="home-tab">
       <div class="accordion report-accordion clientjobs" 
         id="accordionExample">
        @forelse($jobs as $key=>$job)
        <div class="card first_card"  
            id="job-block-{{ $job->id }}">
            <div class="card-header" 
                id="headingOne">
                  <h6>
                   @if($job->contract_status == '1')
                      DRAFT
                   @elseif($job->contract_status == '2')
                      ACTIVE
                   @elseif($job->contract_status == '3')
                      ARCHIVED
                   @elseif($job->contract_status == '4')
                      REJECTED
                   @elseif($job->contract_status == '5')
                      PAUSED
                   @endif
                 </h6>
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
                              class="dropdown-item deleteoption btn link delete_hire{{$job->id}}"
                              data-placement="right"
                              data-toggle="confirmation"
                              data-id="{{ $job->id }}"
                              href="javascript:void(0);"
                              >Delete Offer</a>

                        </div>
                      </div>
                       
                      <h6>&nbsp;</h6> 
                      <h4 class="panel-title" 
                       onclick='get_jobBasicF("{{$job->id}}","{{ route('user.get_offerBasic', ['id' => $job->id]) }}","offerjobs","{{$job->job_status}}")'>                      
                         <a class="btn btn-link front-end-developer first_accordian" 
                         role="button" 
                         data-toggle="collapse" 
                         data-parent="#accordionExample" 
                         href="#collapseOne{{$job->id}}" 
                         aria-expanded="true" 
                         aria-controls="collapseOne"> 
                            
                            {{ $job->job_title }} -  {{ ($job->job_type == '1') ? "Hourly Rate" : "Project Base" }}
                            <div class="riser-scor">
                              <span class="hired-by-company-us">
                                Offer sent to  
                                [{{ !empty($job->userToBasicDetail ) ? $job->userToBasicDetail->name : '' }}] 
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
                $('.delete_hire{{$job->id}}').confirmation({
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
                     job_hiredelete("{{ url('job_hiredelete') }}/"+$jid);
                    },
               });
            </script>

        @empty
         <div class="inner-table-box">
            <div class="pt-30 text-center">
               <img src="{{ asset('assets/img/no-trans.png')}}" class="m-auto">
               <p class="no-work-yet"> 
                 @if(!empty($currentlikepage) && $currentlikepage == 'rejected' )
                    No rejected offers yet.
                 @elseif(!empty($currentlikepage) && $currentlikepage == 'pending' )
                    No pending offers yet.
                 @else
                    No offers found.
                 @endif
               </p>
            </div>
         </div>

        @endforelse 
        @if($jobs->total() > 1)
          <!-- showing record  -->
          Showing {{($jobs->currentPage()-1)* $jobs->perPage()+($jobs->total() ? 1:0)}} to {{($jobs->currentPage()-1)*$jobs->perPage()+count($jobs)}}  of  {{$jobs->total()}}  Results
        
          <!-- pagination buttons -->
           <div id="listing-pagination" >{!! $jobs->onEachSide(0)->render() !!}</div>
        @endif
      </div>
 
   </div>

</div>



<!-- Modal -->
<div class="modal fade modl-jb-lst2" 
   id="contractView" data-backdrop="static" 
   tabindex="-1" 
   role="dialog" 
   aria-labelledby="staticBackdropLabel" 
   aria-hidden="true" 
   data-dismiss="modal">
   <div class="modal-dialog modal-lg modal-dialog-centered"  
      role="document">
      <div class="modal-content">
         
      </div>
   </div>
</div>
<!-- modal css -->



<!-- This file is important to include some functions
 -->
 <script src="{{ asset ('assets/js/function/functions.js') }}"></script>
 <script src="{{ asset ('assets/js/function/jobs_functions.js') }}"></script>
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
<script>

   <?php 
   if(!empty($currentlikepage) && $currentlikepage == 'pending' ){ ?>
   var currentPath = "{{ route('user.get_alloffer_area_ajax', ['page' => 'pending' ])}}";
   var currentPagep = "pending";
   <?php }else if(!empty($currentlikepage) && $currentlikepage == 'rejected' ){?>
   var currentPath = "{{ route('user.get_alloffer_area_ajax', ['page' => 'rejected' ])}}";
   var currentPagep = "rejected";
  <?php  }else{?>
   var currentPath = "{{ route('user.get_alloffer_area_ajax', ['page' => 'all' ])}}";
   var currentPagep = "all";
  <?php }?>





function job_hiredelete($url)
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