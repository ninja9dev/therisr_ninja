
@extends('user.layouts.main')

@section('content')

 

<div class="reports-info reprt-resp-sec freelancing-pro-info clentjoblisting">
   <div class="paddin-btms">
      <div class="container"> 
         <div>
            <div class="padding-ser">
               <div class="row">
                  
                 @include('user.freelancer.contracts.sidebar_jobs')
 
                 <div class="col-xl-9 col-lg-8 col-md-8 pl-5 jb-pd-l  pd-l0">
                    <div class="accordion report-accordion clientcontracts">
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
                                    @if(empty($contract->currentUserFeedback))
                                        @if($contract->contract_status == '2')
                                            <div class="dropdown">
                                                <button class="moreOptnDropdwn_custom moreOptnDropdwn dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-custom" 
                                                aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item deleteoption btn" data-id="{{ $contract->id }}" href="{{ route('user.end_contract', ['id' => encryptUrlId($contract->id)]) }}">
                                                        End Contract
                                                    </a> 
                                                </div>
                                            </div>
                                        @elseif($contract->contract_status == '6')
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
                                    
                                    <h6>&nbsp;</h6> 
                                    <h4 class="panel-title"  
                                    onclick='get_jobBasicF("{{$contract->id}}","{{ route('user.get_contractBasic', ['id' => $contract->id]) }}","allcontracts","{{$contract->contract_status}}")' >
                                    <a class="btn btn-link front-end-developer first_accordian" 
                                    role="button" data-toggle="collapse" 
                                    data-parent="#accordionExample" 
                                    href="#collapseOne{{$contract->id}}" 
                                    aria-expanded="true" 
                                    aria-controls="collapseOne">
                                        
                                        {{ $contract->job_title }} -  {{ ($contract->contract_type == '1') ? "Hourly Rate" : "Project Base" }}
                                        <div class="riser-scor">
                                            <span class="hired-by-company-us">
                                            Hired by 
                                            [{{ !empty($contract->userByBasicDetail->userEmpProfile ) ? $contract->userByBasicDetail->userEmpProfile->company_name : '' }}/{{ $contract->userByBasicDetail->name }}] 
                                            since {{  dateFormat($contract->contract_start_on) }}
                                            </span>
                                        </div>
                                    </a>
                                    </h4>
                                    @if($contract->contract_status != '1')    
                                    <ul class="tootl-width">

                                    @if($contract->contract_type == '1') 

                                        <li>
                                        {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ getLoggedHoursAmount($contract->id) }} earned | 
                                        {{ (!empty($settings->currency)  ? $settings->currency  : '$').$contract->hourly_rate.'/hr' }}
                                        </li>

                                        <li>
                                            {{ getLoggedHours($contract->id) }} hrs logged
                                        </li>

                                    @else

                                        <li> 
                                        {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{getPaidAmount($contract->id) }}
                                            of 

                                        {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $contract->total_cost }} earned
                                        </li>

                                        <li>
                                            {{ getContractMilestonesCount($contract->id,'pending') }} of {{ getContractMilestonesCount($contract->id,'all') }} milestones left
                                        </li> 

                                    @endif                       
                                    </ul>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body" id="job_basic_box{{$contract->id}}">
                                              <!-- JOb basic here get with ajax -->
                            </div>
                        </div>
                        <script type="text/javascript">
                        //toggle confirmation
                            $('.pause_contract{{$contract->id}}').confirmation({
                                template: '<div class="popover">' +
                                    '<div class="arrow"></div>' +
                                    '<h3 class="popover-title">Are you sure?</h3>' +
                                    '<div class="popover-content text-center">' +
                                    '<div class="btn-group">' +
                                    '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$contract->id}}">Yes</a>' +
                                    '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>',
                                onConfirm: function(event, element) { 
                                    $jid= $(this).attr('data-id');
                                    contract_statusChange($jid,"{{ url('statuschange_contract') }}/pause/"+$jid);
                                },
                                });
                            $('.end_contract{{$contract->id}}').confirmation({
                                template: '<div class="popover">' +
                                    '<div class="arrow"></div>' +
                                    '<h3 class="popover-title">Are you sure?</h3>' +
                                    '<div class="popover-content text-center">' +
                                    '<div class="btn-group">' +
                                    '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$contract->id}}">Yes</a>' +
                                    '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>',
                                onConfirm: function(event, element) { 
                                    $jid= $(this).attr('data-id');
                                    contract_statusChange($jid,"{{ url('statuschange_contract') }}/end/"+$jid);
                                },
                                });
                        
                        </script>
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
  
  var jobareaajax_path = "{{ route('user.get_contractBasic', ['id' => $contract->id]) }}";
  var currentId = '{{$contract->id}}';
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