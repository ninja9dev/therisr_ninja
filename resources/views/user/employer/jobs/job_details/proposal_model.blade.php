

<div class="modal-header">
            <a class="view-pro-btn" 
            href="{{ route('user.f_profile', ['id' => $proposal->user_id])}}">
              View full profile
            </a>
            <ul class="vew-pfle-ul">
               @if(empty($proposal->myJobContract))
                 @if($proposal->proposal_status != '2')
                  <a 
                   class="modl-dlt-btn archive_proposal{{$proposal->id}}"
                   data-placement="right"
                   data-toggle="confirmation"
                   data-id="{{ $proposal->id }}"
                   href="javascript:void(0);"
                   title="Do you want to archive the proposal?"
                   ><i class="fa fa-trash-o"></i></a>
                 @endif

                 @if($proposal->proposal_status == '2')
                  <a 
                   class="modl-dlt-btn restore_proposal{{$proposal->id}}"
                   data-placement="right"
                   data-toggle="confirmation"
                   data-id="{{ $proposal->id }}"
                   href="javascript:void(0);"
                   title="Do you want to restore the proposal?"
                   ><i class="fa fa-undo"></i></a>
                 @endif


                 @if($proposal->like_status == '2')
                   <a 
                   class="modl-wst-btn unlike_proposal{{$proposal->id}}"
                   data-placement="right"
                   data-toggle="confirmation"
                   data-id="{{ $proposal->id }}"
                   href="javascript:void(0);"
                   title="Do you want to unlike the proposal?"
                   ><i class="fa fa-heart"></i></a>
                 @else
                   <a 
                   class="modl-wst-btn like_proposal{{$proposal->id}}"
                   data-placement="right"
                   data-toggle="confirmation"
                   data-id="{{ $proposal->id }}"
                   href="javascript:void(0);"
                   title="Do you want to like the proposal?"
                   ><i class="fa fa-heart-o"></i></a>
                 @endif
              @endif
                
                <?php 
                    $jobId = $proposal->jobDetail->id;
                    $freelancerId = $proposal->userBasicDetail->id;
                ?> 
               
               <a class="modl-msg-btn" id='messagesBtnn' onclick='goToMessage("<?php echo $jobId; ?>","<?php echo $freelancerId; ?>",{{ Auth::user()->id }}, "{{ route('user.messages') }}?ids=<?php echo $jobId; ?>,<?php echo $freelancerId; ?>,{{ Auth::user()->id }}")'>Message</a>
               
                @if(empty($proposal->myJobContract))
                   <a class="modl-hre-btn" 
                    href="javascript:void(0);"
                    onclick="return get_HirePopupView('{{ $proposal->user_id }}','{{$proposal->id }}','{{$proposal->job_id }}');" 
                   >Hire</a>
                @elseif(!empty($proposal->myJobContract) && $proposal->myJobContract->contract_status == '2' )
                 <a class="modl-hre-btn" 
                    href="javascript:void(0);"
                    onclick="return get_contractView('{{ $proposal->myJobContract->id }}');" 
                   >Hired - View Contract</a>
                @else
                <a class="modl-hre-btn" 
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
            </ul>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="onModalClose();">
                <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="media vew-prfle-img">
                @php
                   if(@$proposal->userBasicDetail->image != '') $image =  asset('assets/users').'/'.@$proposal->userBasicDetail->image; 
                   else $image =  asset('assets/users/default.jpg'); 
                @endphp

               <img src="{{ $image }}" alt="" class="mr-3 prof rounded-circle">
               <div class="media-body">
                  <div class="vew-prfle-rate">
                     
                     <h4>{{ !empty($proposal->userBasicDetail) ? $proposal->userBasicDetail->name : ''}}</h4>
                     <ul>
                         <?php echo getUserScoreHtml($proposal->userBasicDetail->id, $proposal->userBasicDetail->therisr_score, 'user');?>
                        
                        <li>
                        <!-- user hourly rate -->
                        {{ (!empty($settings->currency)  ? $settings->currency  : '$').$proposal->userBasicDetail->userProfile->hourly_rate.'/hr' }}
                       </li>

                        <li>
                           <img src="../assets/img/location-cream.png"> {{ !empty($proposal->userBasicDetail->countryName['country_name'] ) ? $proposal->userBasicDetail->countryName['country_name']  : ''}}
                        </li>
                     </ul>
                  </div>
                  <ul class="vew-prfle-prim">
                     <li>{{ !empty($proposal->userBasicDetail->userProfile) ? $proposal->userBasicDetail->userProfile->prim_title : ''}},</li>

                     <li>{{ !empty($proposal->userBasicDetail->userProfile) ? $proposal->userBasicDetail->userProfile->sec_title : ''}}</li>
                  </ul>
               </div>
            </div>
            <div class="modl-cvr-ltr">
               <h2>Cover Letter</h2>
               <p>{{ !empty($proposal->introduce) ? $proposal->introduce : '' }} </p>
            </div>

            <div class="modl-intr-qus">
               <h2>Interview questions</h2>
               @php
                 $answers = !empty($proposal->interview_questions) ?json_decode($proposal->interview_questions) : array();
               @endphp
                @foreach(json_decode($job->interview_questions) as $key=>$inter)
                  <ul>
                     <li class="modl-port-rel">{{ $inter }}</li>
                     <li class="modl-port-head">{{ !empty($answers[$key]) ? $answers[$key] : ''}}</li>
                  </ul>
               @endforeach
            </div>

            <div class="modl-propsd-trms">
               <h2>Proposed terms</h2>
               <p>  <!-- proposal hourly rate -->
                     @if(!empty($proposal->hourly_rate))
                         {{ (!empty($settings->currency)  ? $settings->currency  : '$').$proposal->hourly_rate.'/hr' }}
                        @else
                         {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $proposal->total_cost }}
                        @endif
               </p>
            </div>

            <div class="modl-qulfs">
               <h2>Qualifications</h2>
               <ul>
                  <li class="modl-port-rel">English level 
                     <i class="fa fa-thumbs-o-up thumb-bage" aria-hidden="true"></i>
                     <span>{{ !empty($proposal->userBasicDetail->userProfile) ? englishLevel($proposal->userBasicDetail->userProfile->english_prof) : ''}}</span>
                  </li>
                  <li class="modl-port-rel">TheRisr score 
                     <i class="fa fa-thumbs-o-up thumb-bage" aria-hidden="true"></i>
                     <span>{{ !empty($proposal->userBasicDetail->therisr_score) ? ($proposal->userBasicDetail->therisr_score) : ''}} </span>
                  </li>
                  <li class="modl-port-rel">Experience level 
                     <span>{{ !empty($proposal->userBasicDetail->userProfile) ? expertLevel($proposal->userBasicDetail->userProfile->exp_level) : ''}}
                     </span>
                  </li>
               </ul>
            </div>
         </div>


                <script type="text/javascript">
                
                function goToMessage(jobId,freelancerId,clientId,url)
                {
                    // alert(jobId+'--'+freelancerId+'--'+clientId);
                    showScreenLoader(); 
                    $.ajax({
                        url: "{{ url('initiateChat') }}/"+jobId+'/'+freelancerId+'/'+clientId,
                        type: 'GET',
                        success: function(response)
                        {
                            hideLoader();
                            
                        }            
                    });
                    $("#messagesBtnn").prop("href", url);
                    return true;
                }
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
                         proposal_statusChange("{{ url('statuschange_proposal') }}/restore/"+$pid,'model');
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
                         proposal_statusChange("{{ url('statuschange_proposal') }}/delete/"+$pid,'model');
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
                         proposal_statusChange("{{ url('statuschange_proposal') }}/like/"+$pid,'model');
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
                         proposal_statusChange("{{ url('statuschange_proposal') }}/unlike/"+$pid,'model');
                        },
                     });
            </script>