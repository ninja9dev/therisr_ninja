 @if(!empty($contracts) && count($contracts) > 0)
 <?php 
 //echo "<pre>";
 //print_r($contracts->total()); 
// die;?>
   <div class="left-right actve-drop-sec"> 
          <a class="25-contracts" href="javascript:void(0);">
            {{ $contracts->total() }} {{ ($contracts->total() > 1) ? 'contracts' : 'contract' }} found</a>
              <span class="span-main right-menu">
                Sort by:
                <select class="form-group sortingSelect" name="sorting_on" onchange="applySorting();">
                   <option 
                   value="contract_start_on"
                   {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'decontract_start_onsc') ? 'selected="selected"' : '' }}
                   >Start Date</option>
                   <option 
                   value="contract_end_on"
                    {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'contract_end_on') ? 'selected="selected"' : '' }}
                    >End Date</option>
                    <option 
                     value="job_title"
                     {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'job_title') ? 'selected="selected"' : '' }}
                     >Contract Name</option>
                </select>
                <button 
                    class="btn btn-default btn-circle btn-sm m-sm-right m-0-bottom p-0-left-right sortingButton"  
                    type="button" 
                    onclick="applySorting('change_sorting_by');">
                    <i class="fa 
                      {{ (!empty($sorting['order']) && $sorting['order'] == 'desc') ? 'fa-sort-desc' : 'fa-sort-asc' }}"
                      >
                    </i>
                     <input 
                     type="hidden" 
                     name="sorting_by" 
                     value="{{ !empty($sorting['order']) ? $sorting['order'] : 'asc' }}">
                </button>
          </span>
        </div>
        @endif
       <div class="accordion report-accordion clientcontracts" 
         id="accordionExample">
        @forelse($contracts as $key=>$contract)
            <div class="card first_card"  
            id="contract-block-{{ $contract->id }}">
              <div class="card-header" 
              id="headingOne">
               <h6>
                 @if($contract->contract_status == '1')
                    DRAFT
                 @elseif($contract->contract_status == '2')
                    ACTIVE
                 @elseif($contract->contract_status == '3')
                    ARCHIVED
                 @elseif($contract->contract_status == '4')
                    REJECTED
                 @elseif($contract->contract_status == '5')
                    PAUSED
                 @elseif($contract->contract_status == '6')
                    ENDED
                 @endif
              </h6>
                 <div class="contractTitle">
                   
                    @if($contract->contract_status == '6')
                          @if(empty($contract->currentUserFeedback))
                            <div class="dropdown">
                                <button class="moreOptnDropdwn_custom moreOptnDropdwn dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-custom" 
                                  aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item deleteoption btn" data-id="{{ $contract->id }}" href="{{ route('user.end_contract', ['id' => encryptUrlId($contract->id)]) }}">
                                        Give FeedBack
                                    </a> 
                                </div>
                            </div>
                         @endif
                    @endif
                     
                    @if($contract->contract_status != '6')
                        <div class="dropdown">
                            <button class="moreOptnDropdwn_custom moreOptnDropdwn dropdown-toggle" 
                            type="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-custom" 
                              aria-labelledby="dropdownMenuButton">
                           
                                @if($contract->contract_status != '3')
                                      @if($contract->contract_status == '5')
                                        <a 
                                            class="dropdown-item deleteoption btn active_contract{{$contract->id}}"
                                            data-placement="right"
                                            data-toggle="confirmation"
                                            data-id="{{ $contract->id }}"
                                            href="javascript:void(0);"
                                            >Active Contract</a>
                                        @elseif($contract->contract_status == '2')
                                        <a 
                                            class="dropdown-item deleteoption btn pause_contract{{$contract->id}}"
                                            data-placement="right"
                                            data-toggle="confirmation"
                                            data-id="{{ $contract->id }}"
                                            href="javascript:void(0);"
                                            >Pause Contract</a>
                                        @endif 
                                  <a 
                                    class="dropdown-item deleteoption btn delete_contract{{$contract->id}}"
                                    data-placement="right"
                                    data-toggle="confirmation"
                                    data-id="{{ $contract->id }}"
                                    href="javascript:void(0);"
                                    >Delete Contract</a>
                                  <a 
                                    class="dropdown-item deleteoption btn"
                                    data-id="{{ $contract->id }}"
                                    href="{{ route('user.end_contract', ['id' => encryptUrlId($contract->id)]) }}"
                                    >End Contract</a>
                                @else
                                 <a 
                                  class="dropdown-item deleteoption btn restore_contract{{$contract->id}}"
                                  data-placement="right"
                                  data-toggle="confirmation"
                                  data-id="{{ $contract->id }}"
                                  href="javascript:void(0);"
                                  >Restore</a>
                                @endif
                            </div>
                        </div>
                    @endif
                    <h6>&nbsp;</h6> 
                    <h4 class="panel-title" 
                      @if($contract->contract_status != '4') 
                        onclick='get_jobBasicF("{{$contract->id}}","{{ route('user.get_contractBasic', ['id' => $contract->id]) }}","allcontracts","{{$contract->contract_status}}")' 
                      @endif
                     >
                       <a class="btn btn-link front-end-developer first_accordian" 
                       @if($contract->contract_status != '4') 
                         role="button" data-toggle="collapse" 
                         data-parent="#accordionExample" 
                         href="#collapseOne{{$contract->id}}" 
                         aria-expanded="true" 
                         aria-controls="collapseOne"
                       @endif
                       >
                          
                          {{ $contract->job_title }} -  {{ ($contract->contract_type == '1') ? "Hourly Rate" : "Project Base" }}
                           <div class="riser-scor">
                            <span class="hired-by-company-us">
                              You hired  
                              [{{  $contract->userToBasicDetail->name }}] 
                              since {{  dateFormat($contract->contract_start_on) }}
                            </span>
                          </div>
                       </a>
                    </h4>
                    @if($contract->contract_status != '1')    
                    <ul class="tootl-width">

                      @if($contract->contract_type == '1') 

                         <li>
                           {{  (!empty($settings->currency)  ? $settings->currency  : '$').getLoggedHoursAmount($contract->id) }} spent | 
                          {{ (!empty($settings->currency)  ? $settings->currency  : '$').$contract->hourly_rate.'/hr' }}
                         </li>

                          <li>
                            {{ getLoggedHours($contract->id) }} hrs logged
                          </li>

                      @else

                         <li>
                          {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ getPaidAmount($contract->id) }}

                           of 
                           
                          {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ amountFormat($contract->total_cost) }} spent
                         </li>

                          <li>
                            {{ getContractMilestonesCount($contract->id,'pending') }} of {{ getContractMilestonesCount($contract->id,'all') }} milestones left
                          </li> 

                      @endif                       
                    </ul>
                    @endif
                 </div>
              </div>

              <div id="collapseOne{{$contract->id}}" 
                class="collapse" 
                aria-labelledby="headingOne" 
                data-parent="#accordionExample">
                 <div class="card-body" id="job_basic_box{{$contract->id}}">
                    <!-- contract basic here get with ajax -->
                 </div>
              </div>
           </div>
             <script type="text/javascript">
             //toggle confirmation
             var templateHtml  ='<div class="popover">' +
                        '<div class="arrow"></div>' +
                        '<h3 class="popover-title">Are you sure?</h3>' +
                        '<div class="popover-content text-center">' +
                        '<div class="btn-group">' +
                        '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$contract->id}}">Yes</a>' +
                        '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                  $('.restore_contract{{$contract->id}}').confirmation({
                     template: templateHtml,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                         contract_statusChange($jid,"{{ url('statuschange_contract') }}/restore/"+$jid);
                       },
                    });
                  $('.delete_contract{{$contract->id}}').confirmation({
                     template: templateHtml,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                         contract_statusChange($jid,"{{ url('statuschange_contract') }}/delete/"+$jid);
                       },
                    });
                  $('.pause_contract{{$contract->id}}').confirmation({
                     template: templateHtml,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                         contract_statusChange($jid,"{{ url('statuschange_contract') }}/pause/"+$jid);
                       },
                  });
                  $('.active_contract{{$contract->id}}').confirmation({
                     template: templateHtml,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                         contract_statusChange($jid,"{{ url('statuschange_contract') }}/active/"+$jid);
                       },
                  });
             
            </script>
              
         @empty
           <div class="inner-table-box">
              <div class="pt-30 text-center">
                 <img src="{{ asset('assets/img/no-trans.png')}}" class="m-auto">
                 <p class="no-work-yet"> 
                 @if(!empty($currentpage) && $currentpage == 'draftcontracts' )
                       No Drafts yet.
                 @elseif(!empty($currentpage) && $currentpage == 'archivedcontracts' )
                       No Archived yet.
                 @else
                    No contracts yet.
                 @endif
               </p>
              </div>
           </div>
        @endforelse
    
        @if($contracts->total() > 1)
            <!-- showing record  -->
            Showing {{($contracts->currentPage()-1)* $contracts->perPage()+($contracts->total() ? 1:0)}} to {{($contracts->currentPage()-1)*$contracts->perPage()+count($contracts)}}  of  {{$contracts->total()}}  Results
          
            <!-- pagination buttons -->
          <div id="listing-pagination" > {!! $contracts->onEachSide(0)->render() !!}</div>
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

function applySorting($sorting_by_change = ''){
  var sorting_by = $('input[name="sorting_by"]').val();
  if($sorting_by_change != ''){
   sorting_by =  (sorting_by == 'asc') ? 'desc' : 'asc';
    $('input[name="sorting_by"]').val(sorting_by);
  }
  var sorting_on = $('select[name="sorting_on"]').val();

  jobareaajax_path2 = jobareaajax_path+'?sortby='+sorting_on+'&order='+sorting_by;
  console.log(jobareaajax_path2);
  job_areaGet(jobareaajax_path2, currentPage);
}


    </script>