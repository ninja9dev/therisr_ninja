
<div class="otherLinks vew-propsl-ul">
  
   <ul id="myTab" role="tablist" class="nav">
      <li>
         <a class="nav-link {{ ( (!empty($currentlikepage) && $currentlikepage == 'all' )) ? 'active' : '' }}" id="home-tab" 
         data-toggle="tab" href="#getproposalLists_ajax" role="tab" 
         aria-controls="home" 
         aria-selected="true"
         onclick='job_areaGet("{{ route('user.get_alljobs_proposals_area_ajax', ['page' => 'all'])}}", "all")'>
            Pending Proposals 
         </a>
      </li>
      <li>
         <a class="nav-link {{ (!empty($currentlikepage) && $currentlikepage == 'liked' ) ? 'active' : '' }}" id="home-tab" 
         data-toggle="tab" href="#getproposalLists_ajax" role="tab" 
         aria-controls="home" 
         aria-selected="true"
         onclick='job_areaGet("{{ route('user.get_alljobs_proposals_area_ajax', ['page' => 'liked'])}}", "liked")'>
           Liked
         </a>
      </li>
      <li>
         <a class="nav-link {{ (!empty($currentlikepage) && $currentlikepage == 'hired' ) ? 'active' : '' }}" id="home-tab" 
         data-toggle="tab" href="#getproposalLists_ajax" role="tab" 
         aria-controls="getproposalLists_ajax" 
         aria-selected="true"
         onclick='job_areaGet("{{ route('user.get_alljobs_proposals_area_ajax', ['page' => 'hired' ])}}", "hired")'>
            Hired
         </a>
      </li>
      <li>
         <a class="nav-link {{ (!empty($currentlikepage) && $currentlikepage == 'archived' ) ? 'active' : '' }}" id="home-tab" 
         data-toggle="tab" href="#getproposalLists_ajax" role="tab" 
         aria-controls="getproposalLists_ajax" 
         aria-selected="true"
         onclick='job_areaGet("{{ route('user.get_alljobs_proposals_area_ajax', ['page' => 'archived' ])}}", "archived")'>
            Archived
         </a>
      </li>
      
   </ul>
</div>

<div class="allproposal-card-header tab-content" id="myTabContent">
   <!-- tab1 -->
   <div class="tab-pane fade show active" id="getproposalLists_ajax" role="tabpanel" aria-labelledby="home-tab">
      
         @forelse($proposals as $proposal)
        
             <!-- allproposalLists -->

            <div class="allproposalLists_newcss">  
               <div class="jobDetails"> 
                     <h4>{{ $proposal->jobDetail->job_title }}</h4>
                     <p>{{ substr($proposal->jobDetail->job_description, 0, 70) . '...'  }}
                      <br/> 
                      <a href="{{ route('user.job', ['id' => encryptUrlId($proposal->jobDetail->id) ])}}" target="_blank">
                          View job posting
                      </a>
                     </p>
                    <!--  @if($proposal->jobDetail->job_status != '1')   
                    <ul class="tootl-width">
                       <li>
                          <img src="{{ asset('assets/img/proposalIcon.png')}}" alt=""> 
                          {{ getJobProposalsCount($proposal->job_id) }} Proposals
                        </li>
                       <li>
                          <img src="{{ asset('assets/img/hiredIcon.png')}}" alt=""> 
                            {{ getJobHiredCount($proposal->job_id) }} Hired
                       </li>
                    </ul>
                    @endif -->
               </div> 
               <div class="proposalsdetails"> 
                      @php
                         if(@$proposal->userBasicDetail->image != '') $image =  asset('assets/users').'/'.@$proposal->userBasicDetail->image; 
                         else $image =  asset('assets/users/default.jpg'); 
                      @endphp

                 <div class="freelanImg">
                    <img  src="{{ $image }}" 
                    alt="{{ !empty($proposal->userBasicDetail) ? $proposal->userBasicDetail->name : ''}}">
                 </div>
                 <div class="freelanDetails">
                    <div class="nameTitle">
                       <h3>{{ !empty($proposal->userBasicDetail) ? $proposal->userBasicDetail->name : ''}}</h3>
                       
                       <?php echo getUserScoreHtml($proposal->userBasicDetail->id, $proposal->userBasicDetail->therisr_score);?>
                      
                       <p>
                          <!-- user hourly rate -->
                          {{ (!empty($settings->currency)  ? $settings->currency  : '$').(!empty($proposal->userBasicDetail->userProfile) ?
                          $proposal->userBasicDetail->userProfile->hourly_rate.'/hr' : '') }}
   
                         <!-- proposal hourly rate -->
                          <!-- @if(!empty($proposal->hourly_rate))
                           {{ (!empty($settings->currency)  ? $settings->currency  : '$').$proposal->hourly_rate.'/hr' }}
                          @else
                           {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $proposal->total_cost }}
                          @endif -->
                       </p>

                     
                       <p><img src="{{ asset('assets/img/location-cream.png')}}" alt="">
                          {{ !empty($proposal->userBasicDetail->countryName['country_name'] ) ? $proposal->userBasicDetail->countryName['country_name']  : ''}}

                       </p>
                    </div>

                    <p class="coverTxt">Cover Letter: {{ !empty($proposal->introduce) ? $proposal->introduce : '' }}</p>
                    

                    <div class="actnBtns">
                      @if(!empty($currentlikepage) && $currentlikepage != 'hired' ) 
                         @if($proposal->proposal_status != '2')
                          <a 
                           class="btn link archive_proposal{{$proposal->id}}"
                           data-placement="right"
                           data-toggle="confirmation"
                           data-id="{{ $proposal->id }}"
                           href="javascript:void(0);"
                           title="Do you want to archive the proposal?"
                           ><i class="fa fa-trash-o"></i></a>
                         @endif

                         @if($proposal->proposal_status == '2')
                          <a 
                           class="btn link restore_proposal{{$proposal->id}}"
                           data-placement="right"
                           data-toggle="confirmation"
                           data-id="{{ $proposal->id }}"
                           href="javascript:void(0);"
                           title="Do you want to restore the proposal?"
                           ><i class="fa fa-undo"></i></a>
                         @endif


                         @if($proposal->like_status == '2')
                           <a 
                           class="btn link unlike_proposal{{$proposal->id}}"
                           data-placement="right"
                           data-toggle="confirmation"
                           data-id="{{ $proposal->id }}"
                           href="javascript:void(0);"
                           title="Do you want to unlike the proposal?"
                           ><i class="fa fa-heart"></i></a>
                         @else
                           <a 
                           class="btn link like_proposal{{$proposal->id}}"
                           data-placement="right"
                           data-toggle="confirmation"
                           data-id="{{ $proposal->id }}"
                           href="javascript:void(0);"
                           title="Do you want to like the proposal?"
                           ><i class="fa fa-heart-o"></i></a>
                         @endif
                      @endif
                   
                      <a 
                      onclick='getProposalModel("{{$proposal->id}}","{{ route('user.get_proposal_content', ['id' => $proposal->id ])}}");' 
                          href="javascript:void(0);" 
                          class="btn btn-primary">View Proposal</a>

                        @if(empty($proposal->myJobContract))
                           <a class="btn btn-primary" 
                            href="javascript:void(0);"
                            onclick="return get_HirePopupView('{{ $proposal->user_id }}','{{$proposal->id }}','{{$proposal->job_id }}');" 
                           >Hire</a>
                        @elseif(!empty($proposal->myJobContract) && $proposal->myJobContract->contract_status == '2' )
                         <a class="btn btn-primary" 
                            href="javascript:void(0);"
                            onclick="return get_contractView('{{ $proposal->myJobContract->id }}');" 
                           >Hired - View Contract</a>
                        @else 
                        <a class="btn btn-primary" 
                            href="javascript:void(0);"
                            onclick="return get_contractView('{{ $proposal->myJobContract->id }}');" 
                           >
                             @if(!empty($proposal->myJobContract) && $proposal->myJobContract->contract_status == '3' )
                                Offer Archived
                             @elseif(!empty($proposal->myJobContract) && $proposal->myJobContract->contract_status == '4' )
                                Offer Rejected
                             @else
                                View Sent Offer
                             @endif
                           </a>
                        @endif                    
                    </div>
                 </div>
              </div>
            </div>
            <script type="text/javascript">
              //toggle confirmation
                   $('.restore_proposal{{$proposal->id}}').confirmation({
                      template: '<div class="popover">' +
                         '<div class="arrow"></div>' +
                         '<h3 class="popover-title">Are you sure?</h3>' +
                         '<div class="popover-content text-center">' +
                         '<div class="btn-group">' +
                         '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$proposal->id}}">Yes</a>' +
                         '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                         '</div>' +
                         '</div>' +
                         '</div>',
                       onConfirm: function(event, element) { 
                         $pid= $(this).attr('data-id');
                         proposal_statusChange("{{ url('statuschange_proposal') }}/restore/"+$pid);
                        },
                     });

                   $('.archive_proposal{{$proposal->id}}').confirmation({
                      template: '<div class="popover">' +
                         '<div class="arrow"></div>' +
                         '<h3 class="popover-title">Are you sure?</h3>' +
                         '<div class="popover-content text-center">' +
                         '<div class="btn-group">' +
                         '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$proposal->id}}">Yes</a>' +
                         '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                         '</div>' +
                         '</div>' +
                         '</div>',
                       onConfirm: function(event, element) { 
                         $pid= $(this).attr('data-id');
                         proposal_statusChange("{{ url('statuschange_proposal') }}/delete/"+$pid);
                        },
                     });
                   $('.like_proposal{{$proposal->id}}').confirmation({
                      template: '<div class="popover">' +
                         '<div class="arrow"></div>' +
                         '<h3 class="popover-title">Are you sure?</h3>' +
                         '<div class="popover-content text-center">' +
                         '<div class="btn-group">' +
                         '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$proposal->id}}">Yes</a>' +
                         '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                         '</div>' +
                         '</div>' +
                         '</div>',
                       onConfirm: function(event, element) { 
                         $pid= $(this).attr('data-id');
                         proposal_statusChange("{{ url('statuschange_proposal') }}/like/"+$pid);
                        },
                     });
                   $('.unlike_proposal{{$proposal->id}}').confirmation({
                      template: '<div class="popover">' +
                         '<div class="arrow"></div>' +
                         '<h3 class="popover-title">Are you sure?</h3>' +
                         '<div class="popover-content text-center">' +
                         '<div class="btn-group">' +
                         '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$proposal->id}}">Yes</a>' +
                         '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                         '</div>' +
                         '</div>' +
                         '</div>',
                       onConfirm: function(event, element) { 
                         $pid= $(this).attr('data-id');
                         proposal_statusChange("{{ url('statuschange_proposal') }}/unlike/"+$pid);
                        },
                     });
            </script>
         @empty
         <div class="inner-table-box">
            <div class="pt-30 text-center">
               <img src="{{ asset('assets/img/no-trans.png')}}" class="m-auto">
               <p class="no-work-yet"> 
               @if(!empty($currentlikepage) && $currentlikepage == 'liked' )
                     No liked yet.
               @elseif(!empty($currentlikepage) && $currentlikepage == 'archived' )
                     No archived yet.
               @elseif(!empty($currentlikepage) && $currentlikepage == 'hired' )
                     No hired proposal yet.
               @else
                  No proposals yet.
               @endif

               </p>
            </div>
         </div>

         @endforelse  
          @if($proposals->total() > 1)
          <!-- showing record  -->
          Showing {{($proposals->currentPage()-1)* $proposals->perPage()+($proposals->total() ? 1:0)}} to {{($proposals->currentPage()-1)*$proposals->perPage()+count($proposals)}}  of  {{$proposals->total()}}  Results
        
          <!-- pagination buttons -->
           <div id="listing-pagination" >{!! $proposals->onEachSide(0)->render() !!}</div>
        @endif
 
   </div>

</div>

<!-- Modal -->
<div class="modal fade modl-jb-lst2" 
   id="proposalViewPopup" data-backdrop="static" 
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



<!-- Modal -->
<div class="modal fade modl-jb-lst2" 
   id="hireFreelancer" data-backdrop="static" 
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



<!-- job success model -->
    <div class="modal fade mdl-jb-wdth" id="successHirePopup" data-backdrop="static" 
      tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg modal-dialog-centered"  role="document">
              <div class="modal-content">
                <div class="modal-body text-center"  >
                  <input type="hidden" name="contractId" id="contractId" value=""/>
                    <img src="{{ asset('assets/img/popup.png')}}" />
                   <h1 class="modal-title">
                      Your application for the <b id="freelancerName">[{{ !empty($job->job_title) ? $job->job_title : ''}}]</b> is on its way!  
                   </h1>
                </div>
                <div class="modal-footer" 
                style="text-align:center;margin:auto;border-top: white;margin-bottom: 74px;">
                  <button type="button" 
                    class="btn btn-outline-info undo-btn delete_hire"
                    data-placement="right"
                    data-toggle="confirmation"
                    data-id=""
                    href="javascript:void(0);"
                    title="Do you want to delete this Offer?"
                    id="undo_button">Undo</button>
                  <button type="button" class="btn btn-primary close-btn" 
                    onclick="onSuccessClode();">Close</button>
                </div>
              </div>
            </div>
        </div>

<!-- This file is important to include some functions
 -->
 <script src="{{ asset ('assets/js/function/functions.js') }}"></script>
 <script src="{{ asset ('assets/js/function/jobs_functions.js') }}"></script>

<script>

   <?php 
   if(!empty($currentlikepage) && $currentlikepage == 'liked' ){ ?>
   var currentPath = "{{ route('user.get_alljobs_proposals_area_ajax', ['page' => 'liked' ])}}";
   var currentPagep = "liked";
   <?php }else if(!empty($currentlikepage) && $currentlikepage == 'archived' ){?>
   var currentPath = "{{ route('user.get_alljobs_proposals_area_ajax', ['page' => 'archived' ])}}";
   var currentPagep = "archived";
 <?php }else if(!empty($currentlikepage) && $currentlikepage == 'hired' ){?>
   var currentPath = "{{ route('user.get_alljobs_proposals_area_ajax', ['page' => 'hired' ])}}";
   var currentPagep = "hired";
  <?php  }else{?>
   var currentPath = "{{ route('user.get_alljobs_proposals_area_ajax', ['page' => 'all' ])}}";
   var currentPagep = "all";

   <?php }?>


function get_contractView($contractId){
   showScreenLoader();
   $.ajax({
      url: "{{ url('get_contractView') }}/"+$contractId,
      type: 'GET',
      success: function(response) {
         hideLoader();
         $('#contractView').find('.modal-content').html(response);
         $('#contractView').modal('show');
         $('body').addClass('modal-open');
      }            
  });
}

function getProposalModel($pid,$url){
   showScreenLoader();
   $('#hireFreelancer').modal('hide');
   $.ajax({
      url: $url,
      type: 'GET',
      success: function(response) {
         hideLoader();
         $('#proposalViewPopup').find('.modal-content').html(response);
         $('#proposalViewPopup').modal('show');
            $('body').addClass('modal-open');
      }            
  });
}

function proposal_statusChange($url,$from = '')
{ 

   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
       if($from == 'model'){
         getProposalModel(response.id,"{{ url('get_proposal_content')}}/"+response.id);
       }else{
          job_areaGet(currentPath,currentPagep);
       }
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
               })
      }            
  });
}

function onModalClose(){
  job_areaGet(currentPath,currentPagep);
}


 
  function get_HirePopupView($userId,$proposalId,$jobId){
     showScreenLoader(); 
     $('#proposalViewPopup').modal('hide');
      $.ajax({
           url: "{{ url('get_hirePopup') }}/"+$userId+'/'+$proposalId+'/'+$jobId,
           type: 'GET',
           success: function(response) {
            $('#hireFreelancer').find('.modal-content').html(response);
            $('#hireFreelancer').modal('show');
            $('body').addClass('modal-open');
              hideLoader();
           }            
     });
  }


function onSuccessClode(){
   $('#successHirePopup').modal('hide');
   job_areaGet(currentPath,currentPagep);
}

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

function job_hiredelete($url)
{ 

   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
          $('#successHirePopup').modal('hide');
           $('#contractView').modal('hide');
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