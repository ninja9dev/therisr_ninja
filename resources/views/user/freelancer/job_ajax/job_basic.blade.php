<div class="clearfix mb-4">
    <a href="javascript:void(0);" 
       type="submit" 
       class="btn btn-primary btn-postjob"
       onclick="hideJobDetail();">Back to Listing</a>
</div>
@php
 if(empty($job->job_proposals_count)){
            $job->job_proposals_count = getJobProposalsCount($job->id); 
         }
@endphp

 <div class="details-all-show jb-dtl-skip">
    <div class="header-lts">
      @if(empty($job->myJobProposal))
        @if( !empty($job->jobLikeSkip) && $job->jobLikeSkip->skip_status == '2')
           <a  
           class="skip-tct pointer unskip_job{{$job->id}}"
           data-placement="right"
           data-toggle="confirmation"
           data-id="{{ $job->id }}"
           href="javascript:void(0);"
           title="Do you want to unskip the job?"
           > Unskip</a>
        @else
           <a 
           class="skip-tct pointer skip_job{{$job->id}}"
           data-placement="right"
           data-toggle="confirmation"
           data-id="{{ $job->id }}"
           href="javascript:void(0);"
           title="Do you want to skip the job?"
           > Skip</a>
        @endif
      @endif

       <ul> 
              @if(!empty($job->jobLikeSkip) && $job->jobLikeSkip->like_status == '2')
                 <a 
                 class="like-hrt pointer unlike_job{{$job->id}}"
                 data-placement="right"
                 data-toggle="confirmation"
                 data-id="{{ $job->id }}"
                 href="javascript:void(0);"
                 title="Do you want to unlike the job?"
                 ><i class="fa fa-heart"></i> Unlike</a>
              @else
                 <a 
                 class="like-hrt pointer like_job{{$job->id}}"
                 data-placement="right"
                 data-toggle="confirmation"
                 data-id="{{ $job->id }}"
                 href="javascript:void(0);"
                 title="Do you want to like the job?"
                 ><i class="fa fa-heart-o"></i> Like</a>
              @endif
           @if(empty($job->myJobProposal))
             @if( ( !empty($job->jobLikeSkip) && $job->jobLikeSkip->skip_status != '2') || empty($job->jobLikeSkip) )
              <a class="apply-btn" href="javascript:void(0);" 
                 data-toggle="modal" data-target="#jobApplyModal" 
                 data-dismiss="modal" onclick="jobApplyPopup('{{$job->id}}');"> Apply Now </a>
              @endif
           @else
                Applied on {{ dateFormat($job->myJobProposal->created_at) }}
           @endif 
       </ul>
    </div>
    <div class="body-dtlds">
       <div class="bordr-frts">
          <h1> {{ $job->job_title }}</h1>
          <div class="money-fonts">
            
            <span class="inner-img">
               <img src="{{ asset('assets/img/money.png')}}">
              @if($job->job_type == '1')
                Hourly Rate:
                  {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ !empty($job->hourly_rate) ? $job->hourly_rate: '' }}
              @else
                 Est. Budget:{{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $job->total_cost }}
              @endif
            </span>
            
            <span class="inner-img contract">
                 <img src="{{ asset('assets/img/contract.png')}}">
                 Proposals: {{ $job->job_proposals_count }} 
            </span>
           
            <span class="inner-img location">
              <img src="{{ asset('assets/img/location-cream.png')}}">
              {{ !empty($job->userBasicDetail->countryName['country_name'] ) ? $job->userBasicDetail->countryName['country_name']  : ''}}
            </span> 

          </div>
       </div>
    </div>
    <div class="body-dtlds">
       <div class="bordr-frts jb-dtl-pd">
          <h1>Job details</h1>
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
    <div class="body-dtlds">
       <div class="bordr-frts jb-despt">
          <h1>Job description</h1>
          <p>{{ !empty($job->job_description) ? $job->job_description : 'No Description added yet!' }}</p>
       </div>
    </div>
     <div class="body-dtlds">
       <div class="bordr-frts jb-tgs">
        <h1 class="timesheet">Expertise</h1>
        <ul>
           @if(!empty($job->expertise )) 
                @php  
                $expertise = array();
                $expertise = explode(',', $job->expertise)
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
                @if(!empty($job->skills )) 
                    @php 
                    $skills = array();
                    $skills = explode(',', $job->skills)
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
       @if(!empty($job->interview_questions))
        <div class="body-dtlds">
          <div class="bordr-frts jb-dtl-qus">
             <h1 class="timesheet">Interview Questions</h1>
             <ul>
                   @foreach(json_decode($job->interview_questions) as $key=>$inter)
                     <li>{{ $inter }} </li>
                   @endforeach
              
             </ul>
          </div>
        </div>
       @endif
    <div class="body-dtlds">
       <div class="bordr-frts jb-rprt-flx">
          @if(empty($job->myJobReport))
            <div class="report-txt report-post">
               <a href="javascript:void(0)" data-toggle="modal" data-target="#reportmodal"
                onclick='return getJobReportModel("{{$job->id}}");'>  
                <img src="{{ asset('assets/img/report.png') }}">Report this post</a>
            </div>
          @else
           <div class="report-txt report-post">
                
                <img src="{{ asset('assets/img/report.png') }}">Reported on {{ dateFormat($job->myJobReport->created_at) }}
            </div>
          @endif
           <div class="watch-txt pointer" title="{{ ($job->job_status == '2') 
               ? dateFormat($job->posted_at) 
               : ( ($job->job_status == '3') ? dateFormat($job->deleted_at) : dateFormat($job->updated_at) )  }}">
              <span class="hired-by-company-us "><i class="fa fa-clock-o" aria-hidden="true"></i> 
                 {{ ($job->job_status == '2') 
                     ? getDateAgo($job->posted_at, 'posted') 
                     : ( ($job->job_status == '3') ? getDateAgo($job->deleted_at, 'archived') : getDateAgo($job->updated_at, 'updated') )  }}
              </span>
           </div>
       </div>
    </div> 
 </div>

<!-- apply job data-->
<div class="modal fade mdl-apply" id="jobApplyModal" 
tabindex="-1" 
role="dialog" 
aria-labelledby="exampleModalLabel" 
aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">

     </div>
   </div>
</div>


<!-- job success model -->
    <div class="modal fade mdl-jb-wdth" id="successfulApply" data-backdrop="static" 
      tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg modal-dialog-centered"  role="document">
              <div class="modal-content">
                <div class="modal-body text-center"  >
                  <input type="hidden" name="proposalId" id="proposalId" value=""/>
                    <img src="{{ asset('assets/img/popup.png')}}" />
               <h1 class="modal-title">
                  Your application for the [{{$job->job_title}}] is on its way!  
               </h1>
            </div>
                <div class="modal-footer" 
                style="text-align:center;margin:auto;border-top: white;margin-bottom: 74px;">
                  <button type="button" 
                    class="btn btn-outline-info undo-btn delete_proposal"
                    data-placement="right"
                    data-toggle="confirmation"
                    data-id=""
                    href="javascript:void(0);"
                    title="Do you want to delete the proposal?"
                    id="undo_button">Undo</button>
                  <button type="button" class="btn btn-primary close-btn" 
                    onclick="onSuccessClode();">Close</button>
                </div>
              </div>
            </div>
        </div>


  <button class="openSuccessApplyModel" style="display: none; color: white;opacity: 0;" data-toggle="modal" data-target="#successfulApply">open modal success</button>

        <script>

$( function() {
  $("form[name='job_apply'").validate({
      rules: { 
         introduce: "required",
         hourly_rate : "required"
    },  
    submitHandler: function(form) {   
      var inQu_error = 0 ;
       $( ".interview_questions" ).each(function( index ) {
         if($.trim($(this).val()) == ''){
            inQu_error = inQu_error+1;
            $(this).parent().find('span.help-block').html('This is required!');
            $(this).parent().find('span.help-block').show();
         }
      });
       console.log(inQu_error);
       if(inQu_error == 0){
           showScreenLoader();
           var formData = new FormData($('form[name="job_apply"]')[0]);
            $.ajax({ 
               url: "{{ route('user.job_apply') }}",
               type: "POST",
               data:formData,
               dataType: 'JSON',
               cache:false,
               contentType: false,
               processData: false,
               success: function(response) {
                  $.toast({
                      heading: 'Success',
                      text: response.message,
                      showHideTransition: 'slide',
                      icon: 'success'
                  });
                 // job_areaGet(currentPath,currentPagep);
                  hideLoader();
                  $('#jobApplyModal').find('.closeApply').click();
                  
                  $('#undo_button').attr('data-id',response.proposalId);
                  $('#proposalId').val(response.proposalId);
                  $('.openSuccessModel').show();
                  $('.openSuccessModel').click();
               }            
            });
          return false; // <- last item inside submitHandler function
      }else{
         return false;
      }
    }
   });
});

function onSuccessClode(){
       $('.openSuccessApplyModel').click();
   job_areaGet(currentPath,currentPagep);
}

   $('.delete_proposal').confirmation({
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
         $pid= $('#proposalId').val();
         job_proposaldelete("{{ url('job_proposaldelete') }}/"+$pid);
        },
   }); 

function job_proposaldelete($url)
{ 

   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
       $('.openSuccessApplyModel').click();
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
         $('.like_job{{$job->id}}').confirmation({
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
               job_likeskip("{{ url('job_likeskip') }}/like/"+$pid);
              },
           });
         $('.unlike_job{{$job->id}}').confirmation({
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
               job_likeskip("{{ url('job_likeskip') }}/unlike/"+$pid);
              },
           });
 
function jobApplyPopup($jobid){
     showScreenLoader();
     $.ajax({
        url: "{{ url('get_applypopup_content')}}/"+$jobid,
        type: 'GET',
        success: function(response) {
           hideLoader();
           $('#jobApplyModal').find('.modal-content').html(response);
        }            
    });
}

  </script>

