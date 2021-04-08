<!-- code for budget type contract -->
@if($contract->contract_type == '2') 
   <div class="listin-under">
      <ul class="main-pad small-mrg"> 
         <li>
            <a class="this-week" href="javascript:void(0);">Budget</a>
         </li>
         <li>
            <a class="hrs" href="javascript:void(0);">
              {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ amountFormat($contract->total_cost) }}
            </a>
         </li>
      </ul>
      <ul class="main-pad">
         <li><a class="this-week" href="javascript:void(0);">Paid</a></li>
         <li> 
            <a class="hrs" href="javascript:void(0);">
             {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ getPaidAmount($contract->id) }}
            </a>
         </li> 
      </ul>
      <ul class="main-pad">
         <li><a class="this-week" href="javascript:void(0);">Remaining</a></li>
         <li>
            <a class="hrs" href="javascript:void(0);">
               @php 
                  $remaining = getRemainingAmount($contract->id, $contract->total_cost);
               @endphp
               @if($remaining < 0 )
                  Over {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ abs($remaining)}}
               @else
                 {{ !empty($settings->currency)  ? $settings->currency  : '$'}} {{ $remaining }}
               @endif
            </a>
         </li>
      </ul>
   </div>
   @if($contract->contract_status == '6')
   <div class="border-hr"></div>
   <div class="inner-table-box"  id="feedbacks_box{{$contract->id}}">
      <!-- Feedback area -->
   </div>
   @endif
   <div class="border-hr"></div>
   <div class="inner-table-box"  id="milestones_box{{$contract->id}}">
      <!-- milestones area -->
   </div>
   <div class="border-hr"></div>
   <div class="inner-table-box"  id="payments_box{{$contract->id}}">
      <!-- payments area -->
   </div>

   <script>
      $(document).ready(function() {
         get_milestones("{{$contract->id}}", "{{ route('user.get_milestones', ['id' => $contract->id]) }}");
         get_payments("{{$contract->id}}", "{{ route('user.get_payments', ['id' => $contract->id]) }}");
         <?php if($contract->contract_status == '6'){ ?>
            get_feedbacks("{{$contract->id}}", "{{ route('user.get_feedbacks', ['id' => $contract->id]) }}");
         <?php } ?>
      });
   </script>


   <!-- code for  hourly contract -->
@elseif($contract->contract_type == '1') 
<div class="listin-under">
   <ul class="main-pad">
      <li><span class="this-week" href="javascript:void(0);">This week</span></li>
      <li>
         <span class="hrs" href="javascript:void(0);">
           {{ getLoggedHours($contract->id, 'thisweek') }}  <span>hrs</span>
         </span>
      </li>
      <li>
         <span class="up-to-hrs-limit" href="javascript:void(0);">
            up to [{{ $contract->weekly_limit}} hrs] limit
         </span>
      </li>
   </ul>
   <ul class="main-pad">
      <li><span class="this-week" href="javascript:void(0);">This month</span></li>
      <li>
         <span class="hrs" href="javascript:void(0);">
            {{ getLoggedHours($contract->id, 'thismonth') }}  <span>hrs</span>
         </span>
      </li>
      <li>
         <span class="up-to-hrs-limit" href="javascript:void(0);">
            {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ getLoggedHoursAmount($contract->id, 'thismonth') }}
         </sspan>
      </li>
   </ul>
   <ul class="main-pad">
      <li>
         <span class="this-week" href="javascript:void(0);">Since start</span>
      </li>
      <li>
         <span class="hrs" href="javascript:void(0);">
            {{ getLoggedHours($contract->id) }} <span>hrs</span>
         </span>
      </li>
      <li>
         <span class="up-to-hrs-limit" href="javascript:void(0);">
            {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ getLoggedHoursAmount($contract->id) }}
         </span>
      </li>
   </ul>
</div> 
@if($contract->contract_status == '6')
<div class="border-hr"></div>
   <div class="inner-table-box"  id="feedbacks_box{{$contract->id}}">
      <!-- Feedback area -->
   </div>
@endif

<div class="border-hr"></div>
<div class="inner-table-box"  id="timesheets_box{{$contract->id}}">
   <!-- timesheet area -->
</div>
<div class="border-hr"></div>
<div class="inner-table-box"  id="payments_box{{$contract->id}}">
   <!-- payments area -->
</div>
   <script>
      $(document).ready(function() {
         get_timesheets("{{$contract->id}}", "{{ route('user.get_timesheets', ['id' => $contract->id]) }}");
         get_payments("{{$contract->id}}", "{{ route('user.get_payments', ['id' => $contract->id]) }}");
         <?php if($contract->contract_status == '6'){ ?>
              get_feedbacks("{{$contract->id}}", "{{ route('user.get_feedbacks', ['id' => $contract->id]) }}");
         <?php } ?>
      });

   </script>
@endif