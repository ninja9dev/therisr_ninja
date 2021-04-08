
<?php   
      if(!empty($settings->stripe_mode) &&
       (!empty($settings->stripe_test_pub_key) || !empty($settings->stripe_live_pub_key)) ){
        $stripekey = ($settings->stripe_mode == 'SANDBOX') ? $settings->stripe_test_pub_key : $settings->stripe_live_pub_key;
      }else{
         $stripekey = ( env('stripe_mode') == 'SANDBOX') ? env('STRIPE_TEST_PUB_KEY') : env('STRIPE_LIVE_PUB_KEY');
      }
      ?>
<h1 class="timesheet">Timesheet</h1>
  <div class="table-responsive">
      <table class="table report-main-table timesheetsTable" >
         <thead>
            <tr>
               @if(Auth::user()->user_type == '2')
               <th scope="col"></th>
               @endif
               <th scope="col">Status</th>
               <th scope="col">Description</th>
               <th scope="col">Date</th>
               <th scope="col">Time</th>
               @if(Auth::user()->user_type == '2')
               <th scope="col">Amount</th>
               @endif
               @if(Auth::user()->user_type == '1' &&  $contract->contract_status == '2')
               <th scope="col"></th>
               @endif
            </tr>
         </thead> 
         <tbody>
            @if($timesheets->total() >= 1 )
             @foreach($timesheets as $row)

              @if($contract->contract_status  == '2')
               <tr id="timesheet-row-{{$row->id}}" class="{{ ($row->status == 1 ) ? 'pending' : 'approved' }}">
                  @if(Auth::user()->user_type == '2')
                  <td>
                     <input type="hidden" name="id" value="{{ $row->id }}">
                     <input type="hidden" name="amount" value="{{number_format($row->amount,2)}}"/>
                     @if($row->status == 1 )
                       <input class="form-control" 
                       type="checkbox" 
                       name="checkbox_pay">
                     @endif

                    <!-- @if(Auth::user()->user_type == '2' )
                     <input class="form-control" 
                     type="checkbox" 
                     name="checkbox_pay"
                     data-id="{{ $row->id }}"
                     {{ ($row->status == 2 ) ? "checked='checked'" : '' }}
                     onchange="timesheetApproveChange(this);">
                    @else
                      <span class="{{ ($row->status == 2 ) ? 'text-green'  : 'text-orange' }}"> 
                          @if($row->status == 1 )
                             Pending
                           @else
                             Approved
                           @endif
                      </span>
                    @endif -->
                  </td>
                  @endif
                  <td>
                     <span class="{{ ($row->status == 2 ) ? 'text-green'  : 'text-orange' }}"> 
                          @if($row->status == 1 )
                             Pending
                           @else
                             Paid
                           @endif
                     </span>
                  </td>
                  <td>
                    @if(Auth::user()->user_type == '2' || $row->status == 2)
                     {{ $row->description }}
                    @else
                       <span class="view"> {{ $row->description }}</span>
                       <input class="edit hide" 
                       type="text" 
                       data-row="old" 
                       name="description" 
                       value="{{ $row->description }}"
                       onfocusout="focusOutInput(this)">
                    @endif
                  </td>
                  <td>
                    @if(Auth::user()->user_type == '2'  || $row->status == 2)
                     {{ $row->due_date }}
                    @else
                      <span class="view">{{ $row->due_date }}</span>
                       <input class="edit hide" 
                       type="date" 
                       data-row="old" 
                       name="due_date" 
                       value="{{ $row->due_date }}"
                       onfocusout="focusOutInput(this)">
                    @endif
                  </td>
                  <td>
                    @if(Auth::user()->user_type == '2'  || $row->status == 2)
                      {{ $row->time }} hrs
                    @else
                      @php 
                        $timesplit = explode(':', $row->time);
                      @endphp
                      <span class="view"> {{ $row->time }} hrs</span>
                      <select class="edit hide" name="hrs" id="hrs">
                          @for($i=0; $i<=23; $i++)
                          <option value="{{ $i }}" {{ ($timesplit[0] == $i ) ? "selected='selected'" : ''}}> {{ $i }} hrs</option>
                          @endfor
                      </select>
                       <span class="edit hide">  : </span>
                      <select class="edit hide" name="min" id="min">
                          @for($m=0; $m<=59; $m++)
                          <option value="{{ $m }}" {{ (@$timesplit[1] == $m ) ? "selected='selected'" : ''}}> {{ $m }} min</option>
                          @endfor
                      </select>

                    @endif
                  </td>

                  @if(Auth::user()->user_type == '2' )
                  <td>
                     {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ amountFormat($row->amount) }}
                  </td>
                  @endif

                  <td>
                    @if(Auth::user()->user_type == '1' && $row->status != 2)
                     <a class="btn-close btn-badge btn delete_timesheet{{$row->id}}"
                         data-placement="right"
                         data-toggle="confirmation"
                         data-id="{{ $row->id }}"
                         href="javascript:void(0);">
                        <i class="fa fa-close"></i>
                     </a>
                        <script type="text/javascript">
                          //toggle confirmation
                         $('.delete_timesheet{{$row->id}}').confirmation({
                            template: '<div class="popover">' +
                               '<div class="arrow"></div>' +
                               '<h3 class="popover-title">Are you sure?</h3>' +
                               '<div class="popover-content text-center">' +
                               '<div class="btn-group">' +
                               '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$row->id}}">Yes</a>' +
                               '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                               '</div>' +
                               '</div>' +
                               '</div>',
                             onConfirm: function(event, element) { 
                               $jid= $(this).attr('data-id');
                                delete_timesheet($jid,"{{ url('delete_timesheet') }}/"+$jid);
                              },
                           });
                        </script>
                     @endif
                  </td>
               </tr>
               @else
               <tr>
                  <td>
                      <span class="{{ ($row->status == 2 ) ? 'text-green'  : 'text-orange' }}"> 
                          @if($row->status == 1 )
                             Pending
                           @else
                             Paid
                           @endif
                      </span>
                  </td>
                  <td>
                     {{ $row->description }}
                  </td>
                  <td>
                     {{ $row->due_date }}
                  </td>
                  <td>
                    @if(Auth::user()->user_type == '2'  || $row->status == 2)
                      {{ $row->time }} hrs
                    @else
                      @php 
                        $timesplit = explode(':', $row->time);
                      @endphp
                      <span class="view"> {{ $row->time }} hrs</span>
                    @endif
                  </td>

                  @if(Auth::user()->user_type == '2' )
                  <td>
                     {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ amountFormat($row->amount) }}
                  </td>
                  @endif

               </tr>
               @endif
               @endforeach

            @endif
         </tbody>
      </table>
   </div>
   @if($timesheets->total() == 0 )
      <div class="click-log-time-below big-size noTimesheets">
        @if(Auth::user()->user_type == '2') 
             No time logs yet
        @else
           Click log time below to add your first time'
        @endif
      </div>
   @endif

@if(Auth::user()->user_type == '2')
   <div class="log-btn-rep milst-btn">
       @if($timesheets->total() >= 1 )
       <div class="btn-area">
         @if($timesheets->total() >= 1 &&  $contract->contract_status  == '2')
            @if(Auth::user()->user_type == '2')
                  <a  
                     class="btn-logn btn-fill" 
                     href="javascript:void(0)"
                     onclick="checkpayNow('{{ $contract->id }}');">
                     Pay Now
                  </a> 
                  @if(Auth::user()->stripe_customer_id != null && Auth::user()->stripe_customer_id != '')
                  <form method="POST" 
                  action="{{ route('user.stripe_connect') }}" 
                  id="{{ $contract->id }}-form" 
                  style="display: none;">
                     {{ csrf_field() }}
                     
                     <input type="hidden" value="{{ Auth::user()->stripe_customer_id }}"  name="customerId"/>
                     <button type="submit" class="stripe-payment-submit">Pay</button>
                  </form>
                  @else
                  <form method="POST" 
                  action="{{ route('user.stripe_connect') }}" 
                  id="{{ $contract->id }}-form" 
                  style="display: none;">
                     {{ csrf_field() }}
                           <script
                                 id="stripeScript"
                                 src="https://checkout.stripe.com/checkout.js" 
                                 class="stripe-button connect"
                                 data-key="{{ $stripekey }}"
                                 data-name="Connect to Stripe"
                                 data-description="TheRisr Stripe account connect"
                                 data-image="{{ asset('assets/img/logo.png')}}"
                                 data-locale="auto"
                                 data-label="Pay Now"
                                 data-currency="{{ (!empty($settings->currency_code)  ? $settings->currency_code  : 'USD') }}">
                           </script> 
                  </form>
               @endif
            @endif
         @endif 
       </div>
         <p class="total pull-right">IN TOTAL: 
            <b>{{ (!empty($settings->currency)  ? $settings->currency  : '$').amountFormat($timesheets_sum) }}</b>
         </p>
      @endif

   </div>
@else
  <div class="log-btn-rep">
     <div class="btn-area milst-btn">
       @if($contract->contract_status == '2')
            <a class="btn-logn addTimesheet" href="javascript:void(0);">
               <i class="fas fa-plus"></i> Log Time
            </a>
            @if($timesheets->total() >= 1 )
            <a 
              onclick="saveTimesheets();"
              class="btn-logn btn-fill saveTimesheets" 
              href="javascript:void(0)">Save</a>
            @endif
       @endif
     </div>   
     @if($timesheets->total() >= 1 )
       <p class="total">IN TOTAL:
         <b>{{ $timesheets_time_sum }} hrs</b>
       </p>
     @endif
  </div>
@endif


<script type="text/javascript">
   function paymentConfirmation($formid) {
      swal({
      title: "Are you sure you want to process the payment?",
      text: "Note: We'll automatically deduct your payment from the saved payment method, you don't need to do any checkout.",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0
      }).then((result) => {
         if (result.value) {
            $('#'+ $formid).find('.stripe-payment-submit').click(); 
            return true;
         } else if (result.dismiss) {
           return false;
         }
      })
   }
</script>

<script>
    // pay now function
    function checkpayNow(contractId){
    var countPayCheck = 0; var payAmount = 0;var pay_ids = [];
    $('.timesheetsTable > tbody  > tr').each(function(index, tr) { 
        var checked = $(this).find('input[name="checkbox_pay"]:checked').length > 0;
        if(checked){
          var currentAmount = $(this).find('input[name="amount"]').val();
          countPayCheck += 1;
          pay_ids.push($(this).find('input[name="id"]').val());
          payAmount += Number(currentAmount);
        }
    });
 
    if(countPayCheck > 0){
      $('#'+contractId+'-form').append('<input type="hidden" value="'+payAmount+'" name="amount_to_pay"/><input type="hidden" value="'+contractId+'" name="contract_id"/><input type="hidden" value="'+pay_ids+'" name="pay_ids"/>');


      <?php if(Auth::user()->stripe_customer_id != null && Auth::user()->stripe_customer_id != ''){ ?>
       
         paymentConfirmation(contractId+'-form');
      
      <?php }else{ ?>
       
        $('#'+contractId+'-form').find('.stripe-button-el').click();
        $('#'+contractId+'-form').find('script').attr('data-amount',payAmount);
      
      <?php } ?>

       
    }else{
      $.toast({
         heading: 'Error',
         text: "Please select atleast one Timesheet to pay",
         showHideTransition: 'slide',
         icon: 'error'
      })
    }
  }


$(document).ready(function() {

     // remove error tr
     $('.saveTimesheets').focusout(function(){
         $('.errorTr').remove();
      });
      // amount focus out
      $('.rate').focusout(function(){
        focusOutInput(this);
        $('.edit').addClass('hide');
         $('.view').removeClass('hide');
      });
       // on click show edit and hide view
       $('.timesheetsTable .edit').on('focusout', function() {
         focusOutInput(this);
            $('.edit').addClass('hide');
            $('.view').removeClass('hide');
         });
       $('.timesheetsTable .view').on('click', function(){
            $('.edit').addClass('hide');
            $('.view').removeClass('hide');
            $(this).parent('td').find('.edit').toggleClass('hide');
            $(this).parent('td').find('.view').toggleClass('hide');
       });

         // add new timesheet
         $('.addTimesheet').on('click', function(){
        
         $('.edit').addClass('hide');
         $('.view').removeClass('hide');

          var hrsSelect = '';
          for(var i=0; i<=23; i++)
          {
            hrsSelect += '<option value="'+i+'">'+i+'hrs</option>';
          }

          var minSelect = '';
          for(var m=0; m<=59; m++)
          {
            minSelect += '<option value="'+m+'">'+m+'min</option>';
          } 
             if($('.timesheetsTable .addField').length == 0){
               $('.noTimesheets').remove();// remove no timessheet div
                $('.timesheetsTable tbody').append(' <tr class="addField">'+
                  '<td>Pending</td>'+
                  '<td><input type="text" data-row="new" name="description"></td>'+
                  '<td><input type="date" data-row="new" name="due_date"></td>'+
                  '<td> <select name="hrs">'+
                       hrsSelect+
                     '</select>'+
                        ' : '+
                     '<select name="min">'+
                       minSelect+
                     '</select>'+
                       '<input type="hidden" name="id" value="0">'+
                  '</td>'+
                  '<td>'+
                     '<a href="javascript:void(0);" onclick="deleteAddedRow()" class="btn-close btn-badge btn" >'+
                        '<i class="fa fa-close"></i>'+
                     '</a>'+
                  '</td> '+
               '</tr>');
             }

             // add save button if not exist
             if($('.saveTimesheets').length == 0){
                $('.milst-btn').append('<a '+
                      'onclick="saveTimesheets();"'+
                     'class="btn-logn btn-fill saveTimesheets"'+ 
                     'href="javascript:void(0)">'+
                       'Save'+
                    '</a>');
             }
         });


      
       
});

   function deleteAddedRow(){
      $('.addField').remove();
      $(this).parent('td').parent('tr').remove();
   }  
            // save timesheets
   function saveTimesheets() {
     showScreenLoader();
         $('.edit').addClass('hide');
         $('.view').removeClass('hide');
         console.log('saveTimesheets');
         var allRecords = [];
         var error = 0;
          $('.timesheetsTable > tbody  > tr:not(.approved)').each(function(index, tr) { 
               var id = $(this).find('input[name="id"]').val();
               var description = $(this).find('input[name="description"]').val();
               var due_date = $(this).find('input[name="due_date"]').val();
               var hrs = $(this).find('select[name="hrs"]').val();
               var min = $(this).find('select[name="min"]').val();
               var time = hrs+':'+min;
               var status = $(this).find('select[name="status"]').val();
               if(id != '' && description != '' && due_date != '' && time != '' && status != ''){
                 var arr = { "id": id, "description": description, "due_date": due_date, "time": time, "status" : status  }; 
               }else{
                  error = error + 1;
                  $(this).parent('tbody').append('<tr class="errorTr"><td colspan="5"><span class="error">Please fill required field!</span></td></tr>');
               }
              allRecords.push(arr);
         });
         console.log(allRecords);
         if(error == 0){
            $('.errorTr').remove();
               $.ajax({
                  url: "{{ route('user.saveTimesheets', ['id' => $contract->id]) }}",
                  type: 'POST',
                  data: {
                    "_token": "{{ csrf_token() }}",
                     "allRecord" : allRecords,
                  },
                  dataType: 'json',
                  success: function(response) {
                   console.log(response.data);
                  get_timesheets("{{$contract->id}}", "{{ route('user.get_timesheets', ['id' => $contract->id]) }}");
                  get_jobBasicF("{{$contract->id}}","{{ route('user.get_contractBasic', ['id' => $contract->id]) }}","allcontracts","{{$contract->contract_status}}")
                     $.toast({
                               heading: (response.code == 200) ? 'Success' : 'Error',
                               text: response.message,
                               showHideTransition: 'slide',
                               icon: (response.code == 200) ? 'success' : 'error'
                           })
                  }            
              });
         }
         hideLoader();
   }


   function focusOutInput(thisv){
      console.log('foc');
      if($(thisv).attr('id') == 'hrs' || $(thisv).attr('id') == 'min'){
         var hrs = $(thisv).parent('td').find('select[name="hrs"]').val();
         var min = $(thisv).parent('td').find('select[name="min"]').val();
         var time = hrs+':'+min;
         $(thisv).parent('td').find('.view').html(time + 'hrs');
         //calculateAmount(time, hourlyRate);
      }else{
        $(thisv).parent('td').find('.view').html($(thisv).val());
      }
   }


function delete_timesheet($id,$url)
{ 
   showScreenLoader();
   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
         $('#timesheet-row-'+$id).remove();
         get_timesheets("{{$contract->id}}", "{{ route('user.get_timesheets', ['id' => $contract->id]) }}");
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
               });
         hideLoader();
      }            
  });
}

function timesheetApproveChange(thisv){
   showScreenLoader();
  console.log($(thisv).is(":checked"));
  var approved = ($(thisv).is(":checked") == true) ? 2 : 1;
  var id = $(thisv).attr('data-id');
   $.ajax({
      url: "{{ route('user.saveTimesheets', ['id' => $contract->id]) }}",
      type: 'POST',
      data: {
        "_token": "{{ csrf_token() }}",
         "status" : approved,
         "id" : id
      },
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
      get_timesheets("{{$contract->id}}", "{{ route('user.get_timesheets', ['id' => $contract->id]) }}");
      get_jobBasicF("{{$contract->id}}","{{ route('user.get_contractBasic', ['id' => $contract->id]) }}","allcontracts","{{$contract->contract_status}}")
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
               })
      }            
  });
   hideLoader();
}
</script>
   