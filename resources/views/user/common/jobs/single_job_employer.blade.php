
@extends('user.layouts.main')

@section('content')

 
  @php
    $pareaajax_path = route('user.get_proposals_area_ajax', ['page' => 'allpoposals', 'jid' => $job->id ]);
    $pcurrentPage = 'allpoposals';
 @endphp
<div class="reports-info reprt-resp-sec freelancing-pro-info clentjoblisting">
   <div class="paddin-btms">
      <div class="container"> 
         <div>
            <div class="padding-ser">
                 @include('user.employer.jobs.topbar_jobs')
               <div class="row">
                  
                 @include('user.employer.jobs.sidebar_jobs')

                <div class="col-xl-9 col-lg-8 col-md-8 pl-5 jb-pd-l  pd-l0">
                  <div class="inner-report-cont" id="page-area-job">
                    <div class="accordion report-accordion clientjobs">
                        <div class="card first_card viewzeroHired"  
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
                                              href="{{ route('user.editjob', ['id' => $job->id]) }}">Edit Post</a>

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
                                     <li><img src="{{ asset('assets/img/proposalIcon.png')}}" alt=""> 
                                      {{ getJobProposalsCount($job->id) }} Proposals</li>
                                     <li><img src="{{ asset('assets/img/hiredIcon.png')}}" alt=""> 
                                      {{ getJobHiredCount($job->id) }} Hired</li>
                                  </ul>
                                  @endif
                               </div>
                          </div>
                          <div class="card-body" id="job_basic_box{{$job->id}}">
                                              <!-- JOb basic here get with ajax -->
                          </div>
                      </div>
                    </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection


 

@section('footer') 
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
             template: templateAll,
              onConfirm: function(event, element) { 
                $jid= $(this).attr('data-id');
                job_statusChange($jid,"{{ url('statuschange_job') }}/restore/"+$jid);
               },
            });
         $('.complete_delete{{$job->id}}').confirmation({
             template: templateAll,
              onConfirm: function(event, element) { 
                $jid= $(this).attr('data-id');
                job_statusChange($jid,"{{ url('statuschange_job') }}/complete_delete/"+$jid);
               },
            });
          $('.delete_job{{$job->id}}').confirmation({
             template: templateAll,
              onConfirm: function(event, element) { 
                $jid= $(this).attr('data-id');
                job_statusChange($jid,"{{ url('statuschange_job') }}/delete/"+$jid);
               },
            });
          $('.pause_job{{$job->id}}').confirmation({
             template: templateAll,
              onConfirm: function(event, element) { 
                $jid= $(this).attr('data-id');
                 job_statusChange($jid,"{{ url('statuschange_job') }}/pause/"+$jid);
               },
            });
          $('.activate_job{{$job->id}}').confirmation({
             template: templateAll,
              onConfirm: function(event, element) { 
                $jid= $(this).attr('data-id');
                 job_statusChange($jid,"{{ url('statuschange_job') }}/active/"+$jid);
               },
            });
    </script>

<script type="text/javascript">
  
  var jobareaajax_path = "{{ route('user.get_jobBasic', ['id' => $job->id]) }}";
  var currentId = '{{$job->id}}';
</script>
<!-- This file is important to include some functions
 -->
 <script src="{{ asset ('assets/js/function/jobs_functions.js') }}"></script>
 <script>
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

$( document ).ready(function() {

  //get page data
 get_jobBasicSingle(currentId, jobareaajax_path);
  // pagination

});
</script>


@endsection