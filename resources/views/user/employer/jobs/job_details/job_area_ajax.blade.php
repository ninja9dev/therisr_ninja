 @if(!empty($jobs) && count($jobs) > 0)
 <?php 
 //echo "<pre>";
 //print_r($jobs->total());
// die;?>
   <div class="left-right actve-drop-sec"> 
          <a class="25-jobs" href="javascript:void(0);">
            {{ $jobs->total() }} {{ ($jobs->total() > 1) ? 'jobs' : 'job' }} found</a>
           <span class="span-main right-menu">
                Sort by: 
                <select class="form-group sortingSelect" name="sorting_on" onchange="applySorting();">
                  <option 
                   value="posted_at"
                   {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'posted_at') ? 'selected="selected"' : '' }}
                   >Newest</option>
                  <option 
                   value="oldest"
                   {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'oldest') ? 'selected="selected"' : '' }}
                   >Oldest</option>
                  <option 
                     value="total_cost"
                     {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'total_cost') ? 'selected="selected"' : '' }}
                    >Budget</option>
                </select>
          </span>
        </div>
        @endif
       <div class="accordion report-accordion clientjobs" 
         id="accordionExample">
        @forelse($jobs as $key=>$job)
       
         @php
            $pareaajax_path = route('user.get_proposals_area_ajax', ['page' => 'allpoposals', 'jid' => $job->id ]);
            $pcurrentPage = 'allpoposals';
         @endphp

           <div class="card first_card"  
            id="job-block-{{ $job->id }}">
              <div class="card-header" 
              id="headingOne">
             <!--  <h6>
                 @if($job->job_status == '1')
                    DRAFT
                 @elseif($job->job_status == '2')
                    ACTIVE
                 @elseif($job->job_status == '3')
                    ARCHIVED
                 @elseif($job->job_status == '4')
                    PAUSED
                 @endif
              </h6> -->
                 <div class="jobTitle">
                    <div class="dropdown">
                      <button class="moreOptnDropdwn_custom moreOptnDropdwn dropdown-toggle" 
                      type="button" 
                      aria-haspopup="true" 
                      aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                       <div class="dropdown-menu dropdown-menu-custom" 
                          aria-labelledby="dropdownMenuButton" 
                          >
                        @if($job->job_status != '3')
                            @if($job->job_status != '1') 
                            <a class="dropdown-item" 
                               href="javascript:void(0);"
                               onclick='job_areaGet("{{$pareaajax_path}}", "{{$pcurrentPage}}")'
                               >View Proposal</a>
                            @endif

                            <a class="dropdown-item"  
                                href="{{ route('user.editjob', ['id' => encryptUrlId($job->id)]) }}">Edit Post</a>

                            @if($job->job_status != '1')     
                             <a class="dropdown-item" href="#">Invite</a>
                            @endif

                            @if($job->job_status == '2') 
                             <a 
                                class="dropdown-item deleteoption btn link pause_job{{$job->id}}"
                                data-placement="right"
                                data-toggle="confirmation"
                                data-id="{{ $job->id }}"
                                href="javascript:void(0);">Pause</a>

                            @elseif($job->job_status == '4') 
                              <a 
                                class="dropdown-item deleteoption btn link activate_job{{$job->id}}"
                                data-placement="right"
                                data-toggle="confirmation"
                                data-id="{{ $job->id }}"
                                href="javascript:void(0);">Active</a>
                            @endif
                          @if(getJobHiredCount($job->id) <= 0)
                            <a 
                                class="dropdown-item deleteoption btn link delete_job{{$job->id}}"
                                data-placement="right"
                                data-toggle="confirmation"
                                data-id="{{ $job->id }}"
                                href="javascript:void(0);"
                                >Delete</a>
                          @endif
                        @else
                          <a 
                            class="dropdown-item deleteoption btn link restore_job{{$job->id}}"
                            data-placement="right"
                            data-toggle="confirmation"
                            data-id="{{ $job->id }}"
                            href="javascript:void(0);"
                            >Restore</a>
                           <a 
                            class="dropdown-item deleteoption btn link complete_delete{{$job->id}}"
                            data-placement="right"
                            data-toggle="confirmation"
                            data-id="{{ $job->id }}"
                            href="javascript:void(0);"
                            >Delete Completely</a>
                                
                        @endif

                      </div>
                    </div>
                    
                    @if($job->job_status != '1') 
                    <div class="btn-viewPropo">
                       <a 
                        href="javascript:void(0);"
                        onclick='job_areaGet("{{$pareaajax_path}}", "{{$pcurrentPage}}");'
                        type="submit" 
                        class="btn btn-primary btn-postjob">
                         View proposal
                       </a>
                    </div>
                    @endif
                    <h6>&nbsp;</h6>
                    <h4 class="panel-title" 
                      onclick='get_jobBasicF("{{$job->id}}","{{ route('user.get_jobBasic', ['id' => $job->id]) }}","alljobs","{{$job->job_status}}")' >
                       <a class="btn btn-link front-end-developer first_accordian" 
                       role="button" data-toggle="collapse" 
                       data-parent="#accordionExample" 
                       href="#collapseOne{{$job->id}}" 
                       aria-expanded="true" 
                       aria-controls="collapseOne">
                          
                          {{ $job->job_title }} -  {{ ($job->job_type == '1') ? "Hourly Rate" : "Project Base" }}
                          <div class="riser-scor pointer" title="{{ ($job->job_status == '2') 
                         ? dateFormat($job->posted_at) 
                         : ( ($job->job_status == '3') ? dateFormat($job->deleted_at) : dateFormat($job->updated_at) )  }}">
                             <span class="hired-by-company-us ">
                              <i class="fa fa-clock-o" aria-hidden="true"></i> 
                             {{ ($job->job_status == '2') 
                                     ? getDateAgo($job->posted_at, 'posted') 
                                     : ( ($job->job_status == '3') ? getDateAgo($job->deleted_at, 'archived') : getDateAgo($job->updated_at, 'updated') )  }}
                            </span>
                          </div>
                       </a>
                    </h4>
                    @if($job->job_status != '1')   
                    <ul class="tootl-width">
                       <li><img src="{{ asset('assets/img/proposalIcon.png')}}" alt=""> {{ $job->job_proposals_count }} Proposals</li>
                       <li><img src="{{ asset('assets/img/hiredIcon.png')}}" alt=""> {{ getJobHiredCount($job->id) }} Hired</li>
                    </ul>
                    @endif
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
           </div>
             <script type="text/javascript">
             //toggle confirmation
             var templateAll = '<div class="popover">' +
                        '<div class="arrow"></div>' +
                        '<h3 class="popover-title">Are you sure?</h3>' +
                        '<div class="popover-content text-center">' +
                        '<div class="btn-group">' +
                        '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$job->id}}">Yes</a>' +
                        '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                 $('.restore_job{{$job->id}}').confirmation({
                  singleton:true,
                     popout: true,
                     template: templateAll,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                        job_statusChange($jid,"{{ url('statuschange_job') }}/restore/"+$jid);
                       },
                    });
                 $('.complete_delete{{$job->id}}').confirmation({
                  singleton:true,
                     popout: true,
                     template: templateAll,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                        job_statusChange($jid,"{{ url('statuschange_job') }}/complete_delete/"+$jid);
                       },
                    });
                  $('.delete_job{{$job->id}}').confirmation({
                     singleton:true,
                     popout: true,
                     template: templateAll,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                        job_statusChange($jid,"{{ url('statuschange_job') }}/delete/"+$jid);
                       },
                    });
                  $('.pause_job{{$job->id}}').confirmation({
                    singleton:true,
                     popout: true,
                     template: templateAll,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                         job_statusChange($jid,"{{ url('statuschange_job') }}/pause/"+$jid);
                       },
                    });
                  $('.activate_job{{$job->id}}').confirmation({
                    singleton:true,
                     popout: true,
                     template: templateAll,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                         job_statusChange($jid,"{{ url('statuschange_job') }}/active/"+$jid);
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
                    No post yet.
                 @endif
               </p>
              </div>
           </div>
        @endforelse

        @if($jobs->total() > 1)
            <!-- showing record  -->
            Showing {{($jobs->currentPage()-1)* $jobs->perPage()+($jobs->total() ? 1:0)}} to {{($jobs->currentPage()-1)*$jobs->perPage()+count($jobs)}}  of  {{$jobs->total()}}  Results
          
            <!-- pagination buttons -->
          <div id="listing-pagination" > {!! $jobs->onEachSide(0)->render() !!}</div>
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
              $('.moreOptnDropdwn_custom').parent().find('.popover').removeClass('in');
          }
      });

      $('a[data-toggle="confirmation"]').click(function(event) {
          $(this).siblings().removeClass('in');
          console.log('popover remove class');
      });
});

function applySorting(){
  var sorting_on = $('select[name="sorting_on"]').val();
  jobareaajax_path2 = jobareaajax_path+'?sortby='+sorting_on;
  console.log(jobareaajax_path2);
  job_areaGet(jobareaajax_path2, currentPage);
}



    </script>