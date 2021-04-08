
 <form name="job_apply" method="POST">
   @csrf
   <input type="hidden" name="job_id" value="{{$job->id}}"/>
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Apply for [{{$job->job_title}}]</h5>
      </div>
      <div class="modal-body">
            <div class="form-group">
               <label for="recipient-name" class="col-form-label introduce-yourself">Introduce yourself</label>
               <textarea class="form-control"  
               placeholder="Introduce yourself to the employer why you are best fit for this position"
               rows="5" 
               name="introduce"
               maxlength="1000" 
               onkeyup="return isLimitValidate(this);" ></textarea>
              <span class="help-block invalid-feedback"></span>
              <span class="chara-data" id="description_limit"> 1000 characters left</span>
            </div>

            @if(!empty($job->interview_questions))
              @foreach(json_decode($job->interview_questions) as $key=>$inter)
                <div class="form-group">
                  <label class="col-form-label introduce-yourself">{{ $inter }}</label>
                  <textarea class="form-control interview_questions" name="interview_questions[]"></textarea>
                     <span class="help-block invalid-feedback"></span>
               </div>
              @endforeach
            @endif

            <input type="hidden" name="job_type" 
               value="{{ $job->job_type }}" 
               id="job_type">
            
            @if(!empty($job->job_type) && $job->job_type == '1' )
            <div class="main-content">
               <label for="Rate" class="col-form-label your-propose-hourly">Your Propose Hourly Rate</label>
               <br>
               <div class="row">
                  <div class="col-md-5">
                     <label for="rate" class="col-form-label hourly-rate">Hourly Rate</label>
                  </div>
                  <div class="col-md-6"> 
                     <div class="row">
                        <div class="col-10">
                           <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                 <div class="input-group-text noun-dollar-2001842">$</div>
                              </div>
                               <input type="rate" name="hourly_rate" class="form-control rate" placeholder="00.00"
                                 onkeypress="return isAmountValidate(event,this);"  
                                 onfocusout="return calculateFee('hourly_rate','{{ $settings->service_fee }}');" 
                                 min="0.02" max="99.99"    
                                 data-maxamount="99.99"
                                 onchange="validateFloatKeyPress(this);"
                                value="{{ !empty($job->hourly_rate) ? $job->hourly_rate : '' }}"
                                 id="hourly_rate" required>
                                <span class="help-block invalid-feedback"></span>
                           </div>
                        </div>
                        <div class="col-2">
                           <label for="hours" class="col-form-label hr">/hr</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <label for="rate" class="col-form-label hourly-rate">{{ $settings->service_fee }}% {{ $settings->app_name }} Service Fee</label>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-10">
                           <div class="jb-dtl-fil-rmclass input-group">
                              {{ !empty($settings->currency)  ? $settings->currency  : '$'}}<p id="calculatedFee">  00.00</p>
                           </div>
                        </div>
                        <div class="col-2">
                           <label for="hours" class="col-form-label hr">/hr</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <label for="rate" class="col-form-label hourly-rate">You'll Receive</label>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-10">
                           <div class="input-group mb-2">
                              <!-- <div class="input-group-prepend">
                                 <div class="input-group-text noun-dollar-2001842">$</div>
                              </div> -->
                              {{ !empty($settings->currency)  ? $settings->currency  : '$'}}<p id="receiveAmt">  00.00</p>
                           </div>
                        </div>
                        <div class="col-2">
                           <label for="hours" class="col-form-label hr">/hr</label>
                        </div>
                     </div>
                  </div>
               </div>
         </div>
         @else

          <div class="main-content">
               <label for="Rate" class="col-form-label your-propose-hourly">Your Propose Fixed Cost</label>
               <br>
               <div class="row">
                  <div class="col-md-5">
                     <label for="rate" class="col-form-label hourly-rate">Fixed Cost</label>
                  </div>
                  <div class="col-md-6"> 
                     <div class="row">
                        <div class="col-12">
                           <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                 <div class="input-group-text noun-dollar-2001842">$</div>
                              </div>
                                <input type="rate" name="total_cost" class="form-control rate" placeholder="00.00"
                                  onkeypress="return isAmountValidate(event,this);"  
                                   onfocusout="return calculateFee('total_cost','{{ $settings->service_fee }}');" 
                                  min="0.02" max="999999.99"
                                  onchange="validateFloatKeyPress(this);"
                                  value="{{ !empty($job->total_cost) ? $job->total_cost : '' }}"
                                  id="total_cost"
                                  required
                                   >
                                <span class="help-block invalid-feedback"></span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <label for="rate" class="col-form-label hourly-rate">{{ $settings->service_fee }}% {{ $settings->app_name }} Service Fee</label>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-12">
                           <div class="jb-dtl-fil-rmclass input-group">
                              {{ !empty($settings->currency)  ? $settings->currency  : '$'}}<p id="calculatedFee">  00.00</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <label for="rate" class="col-form-label hourly-rate">You'll Receive</label>
                  </div>
                  <div class="col-md-6">
                     <div class="row">                        
                        <div class="col-12">
                           <div class="input-group mb-2">
                              <!-- <div class="input-group-prepend">
                                 <div class="input-group-text noun-dollar-2001842">$</div>
                              </div> --> 
                               {{ !empty($settings->currency)  ? $settings->currency  : '$'}}<p id="receiveAmt">  00.00</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </div>


         @endif
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary closeApply Cancel" 
              data-dismiss="modal">Cancel</button>
            <button type="submit"
             href="javascript:void(0)" 
             class="btn btn-primary save" >Apply now</button>
         </div>
   </form>
<script>
   $( function() {
    <?php if(!empty($job->job_type) && $job->job_type == '1' ){?>
       calculateFee('hourly_rate','{{ $settings->service_fee }}');
    <?php }else{ ?>
     calculateFee('total_cost','{{ $settings->service_fee }}');
    <?php  } ?>


  $("form[name='job_apply'").validate({
      rules: { 
         introduce: "required",
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
                  $('.openSuccessApplyModel').show();
                  $('.openSuccessApplyModel').click();
               }            
            });
          return false; // <- last item inside submitHandler function
      }else{
         return false;
      }
    }
   });
});

</script>
    
