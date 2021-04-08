  <?php   
      if(!empty($settings->stripe_mode) &&
       (!empty($settings->stripe_test_pub_key) || !empty($settings->stripe_live_pub_key)) ){
        $stripekey = ($settings->stripe_mode == 'SANDBOX') ? $settings->stripe_test_pub_key : 
          $settings->stripe_live_pub_key;
      }else{
         $stripekey = ( env('stripe_mode') == 'SANDBOX') ? env('STRIPE_TEST_PUB_KEY') : env('STRIPE_LIVE_PUB_KEY');
      }
      ?>
<h1 class="timesheet">Milestones</h1>
  <div class="table-responsive">
      <table class="table report-main-table milestonesTable" >
         <thead>
            <tr>
              @if(Auth::user()->user_type == '2' &&  $contract->contract_status  == '2')
               <th scope="col"></th>
              @endif
               <th scope="col">Status</th>
               <th scope="col">Milestone</th>
               <th scope="col">Due date</th>
               <th scope="col">Amount</th>
            </tr>
         </thead>
         <tbody>
          @if($milestones->total() >= 1 )
            @foreach($milestones as $row)
              @if($contract->contract_status == '2')
              
               <tr id="milestone-row-{{$row->id}}">
                  @if(Auth::user()->user_type == '2' &&  $contract->contract_status  == '2')
                   <td>
                     @if($row->status == 1 )
                       <input class="form-control" 
                       type="checkbox" 
                       name="checkbox_pay">
                     @endif
                  </td>
                  @endif
                  <td>
                      <span class="{{ ($row->status == 2 ) ? 'text-green'  : 'text-orange' }}"> 
                        @if($row->status == 1 )
                           Pending
                         @else
                           Completed
                         @endif
                      </span>

                      <!-- Manually Edit status pending/ completed -->
                      <!--<span class="{{ ($row->status == 2 ) ? 'text-green'  : 'text-orange' }}"> 
                      @if($row->status == 1 )
                         Pending
                       @else
                         Completed
                       @endif
                      </span>
                    <select class="edit hide" name="status" >
                      <option value="Pending" {{ ($row->status == 1 )? "selected='selected'" : ''}} >Pending</option>
                      <option value="Completed" {{ ($row->status == 2 )? "selected='selected'" : ''}} >Completed</option>
                    </select> -->
                  </td>
                  <td>
                     <span class="view"> {{ $row->milestone }}</span>
                     <input class="edit hide" 
                     type="text" 
                     data-row="old" 
                     name="milestone" 
                     value="{{ $row->milestone }}"
                     onfocusout="focusOutInput(this)">
                  </td>
                  <td>
                     <span class="view">{{ $row->due_date }}</span>
                     <input class="edit hide" 
                     type="date" 
                     data-row="old" 
                     name="due_date" 
                     value="{{ $row->due_date }}"
                     onfocusout="focusOutInput(this)">
                  </td>
                  <td>
                     <span class="view"> {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ $row->amount }}</span>
                     <input 
                        type="rate" data-row="old" 
                        name="amount" 
                        class="form-control rate edit hide" 
                        placeholder="00.00"
                        onkeypress="return isAmountValidate(event,this);" 
                        onfocusout="return isAmountValidate_default('amount');" 
                        min="0.01" max="9999999.00"  data-maxamount="9999999.99"
                        onchange="validateFloatKeyPress(this);"
                        id="amount"
                        value="{{ $row->amount }}" 
                        >
                       <span class="help-block invalid-feedback"></span>
                       <input type="hidden" name="id" value="{{ $row->id }}">
                  </td>
                  <td>
                    @if($row->status == 1 )
                     <a class="btn-close btn-badge btn delete_milestone{{$row->id}}"
                         data-placement="right"
                         data-toggle="confirmation"
                         data-id="{{ $row->id }}"
                         href="javascript:void(0);">
                        <i class="fa fa-close"></i>
                     </a>
                     <script type="text/javascript">
                            //toggle confirmation
                           $('.delete_milestone{{$row->id}}').confirmation({
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
                                  delete_milestone($jid,"{{ url('delete_milestone') }}/"+$jid);
                                },
                             });
                     </script>
                     @endif
                  </td>
               </tr>
              @else
               <tr id="milestone-row-{{$row->id}}">
                  <td>
                      <span class=" {{ ($row->status == 2 ) ? 'text-green'  : 'text-orange' }}"> 
                      @if($row->status == 1 )
                         Pending
                       @else
                         Completed
                       @endif
                      </span>
                  </td>
                  <td>
                     <span class=""> {{ $row->milestone }}</span>
                  </td>
                  <td>
                     <span class="">{{ $row->due_date }}</span>
                  </td>
                  <td>
                     <span class=""> 
                      {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ amountFormat($row->amount) }}
                    </span>
                  </td>
               </tr>
              @endif
            @endforeach

          @endif
         </tbody>
      </table>
   </div>
   @if($milestones->total() == 0 )
      <div class="click-log-time-below big-size noMilestones">
          You have no active milestones
      </div>
   @endif

   <div class="log-btn-rep milst-btn">
     <div class="btn-area">

      @if($contract->contract_status == '2')
      <a class="btn-logn addMilestones" href="javascript:void(0);">
         <i class="fas fa-plus"></i> Add Milestones
      </a>
      @endif

      @if($milestones->total() >= 1 &&  $contract->contract_status  == '2')
         <a 
            onclick="saveMilestones();"
            class="btn-logn btn-fill saveMilestones" 
            href="javascript:void(0)">
            Save Changes
         </a>
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
                style="display: none;"
                > 
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
            <b>{{ (!empty($settings->currency)  ? $settings->currency  : '$').amountFormat($milestone_sum) }}</b>
      </p>
   </div>

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
    $('.milestonesTable > tbody  > tr').each(function(index, tr) { 
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
         text: "Please select atleast one milestone to pay",
         showHideTransition: 'slide',
         icon: 'error'
      })
    }
  }

$(document).ready(function() {



     // remove error tr
     $('.saveMilestones').focusout(function(){
         $('.errorTr').remove();
      });
      // amount focus out
      $('.rate').focusout(function(){
        focusOutInput(this);
        $('.edit').addClass('hide');
         $('.view').removeClass('hide');
      });
       // on click show edit and hide view
       $('.milestonesTable .edit').on('focusout', function() {
         focusOutInput(this);
            $('.edit').addClass('hide');
            $('.view').removeClass('hide');
         });
       $('.milestonesTable .view').on('click', function(){
            $('.edit').addClass('hide');
            $('.view').removeClass('hide');
            $(this).parent('td').find('.edit').toggleClass('hide');
            $(this).parent('td').find('.view').toggleClass('hide');
       });

         // add new milestone
         $('.addMilestones').on('click', function(){
        
         $('.edit').addClass('hide');
         $('.view').removeClass('hide');

             if($('.milestonesTable .addField').length == 0){
               $('.noMilestones').remove();// remove no milesstones div
               var addRow = ' <tr class="addField">';
                  <?php if(Auth::user()->user_type == '2'){?>
                    addRow +='<td>'+
                     '<input class="form-control" type="checkbox" name="checkbox_pay">'+
                  '</td>';
                  <?php } ?>

                  addRow +='<td>Pending</td>'+
                  '<td><input type="text" data-row="new" name="milestone"></td>'+
                  '<td><input type="date" data-row="new" name="due_date"></td>'+
                  '<td> <input type="rate" data-row="new" name="amount" class="form-control rate" placeholder="00.00"'+
                        'onkeypress="return isAmountValidate(event,this);"  '+
                        'onfocusout="return isAmountValidate_default(\'amount\');" '+
                        'min="0.01" max="9999999.00"  data-maxamount="9999999.99"'+
                        'onchange="validateFloatKeyPress(this);"'+
                        'id="amount"'+
                        ' >'+
                       '<span class="help-block invalid-feedback"></span>'+
                       '<input type="hidden" name="id" value="0">'+
                  '</td>'+
                  '<td>'+
                     '<a href="javascript:void(0);" onclick="deleteAddedRow()" class="btn-close btn-badge btn" >'+
                        '<i class="fa fa-close"></i>'+
                     '</a>'+
                  '</td> '+
               '</tr>';
                $('.milestonesTable tbody').append(addRow);
             }

             // add save button if not exist
             if($('.saveMilestones').length == 0){
                $('.milst-btn').append('<a '+
                      'onclick="saveMilestones();"'+
                     'class="btn-logn btn-fill saveMilestones"'+ 
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
            // save milesstone
   function saveMilestones() {

      showScreenLoader();
         $('.edit').addClass('hide');
         $('.view').removeClass('hide');
         console.log('saveMilestones');
         var allRecords = [];
         var error = 0;
          $('.milestonesTable > tbody  > tr').each(function(index, tr) { 
               var id = $(this).find('input[name="id"]').val();
               var milestone = $(this).find('input[name="milestone"]').val();
               var due_date = $(this).find('input[name="due_date"]').val();
               var amount = $(this).find('input[name="amount"]').val();
               var status = $(this).find('select[name="status"]').val();
               if(id != '' && milestone != '' && due_date != '' && amount != '' && status != ''){
                 var arr = { "id": id, "milestone": milestone, "due_date": due_date, "amount" : amount, "status" : status  }; 
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
                  url: "{{ route('user.saveMilestones', ['id' => $contract->id]) }}",
                  type: 'POST',
                  data: {
                    "_token": "{{ csrf_token() }}",
                     "allRecord" : allRecords,
                  },
                  dataType: 'json',
                  success: function(response) {
                   console.log(response.data);
                  get_milestones("{{$contract->id}}", "{{ route('user.get_milestones', ['id' => $contract->id]) }}");
                  hideLoader();
                     $.toast({
                               heading: (response.code == 200) ? 'Success' : 'Error',
                               text: response.message,
                               showHideTransition: 'slide',
                               icon: (response.code == 200) ? 'success' : 'error'
                           })
                  }            
              });
         }
   }


   function focusOutInput(thisv){
      console.log('foc');
      if($(thisv).attr('id') == 'amount'){
       $(thisv).parent('td').find('.view').html("{{ !empty($settings->currency)  ? $settings->currency  : '$'}}"+$(thisv).val());
      }else{
        $(thisv).parent('td').find('.view').html($(thisv).val());
      }
   }


function delete_milestone($id,$url)
{ 
   showScreenLoader();
   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
         $('#milestone-row-'+$id).remove();
         get_milestones("{{$contract->id}}", "{{ route('user.get_milestones', ['id' => $contract->id]) }}");
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
