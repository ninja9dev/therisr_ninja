

 <form name="job_hire" method="POST">
   @csrf
         <div class="modal-header mdl-hdr-pd-y"> 
            <a class="mdl-bckbtn" 
            @if($proposalId != 0)
               onclick='getProposalModel("{{$proposalId}}","{{ route('user.get_proposal_content', ['id' => $proposalId ])}}");' href="javascript:void(0);"
            @else
               href="{{ (url()->previous() != url()->current() ) ? url()->previous() : route('/') }}"
            @endif
            >
               <i class="fa fa-angle-left" aria-hidden="true"></i> Back
            </a>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="mdl-lke-hre">
               <h1>You would like to hire:</h1>
               <div class="media vew-prfle-img">
               @php
                   if(@$user->image != '') $image =  asset('assets/users').'/'.@$user->image; 
                   else $image =  asset('assets/users/default.jpg'); 
               @endphp

                 <img src="{{$image}}" class="mr-3 prof rounded-circled">

                  <div class="media-body">
                     <div class="vew-prfle-rate">
                        <h4>{{ $user->name}}</h4>
                        <ul>
                            <?php echo getUserScoreHtml($user->id, $user->therisr_score, 'user');?>
                           
                           <li>{{ (!empty($settings->currency)  ? $settings->currency  : '$').  (!empty($user->userProfile) ? $user->userProfile->hourly_rate : '').'/hr' }}</li>

                           <li>
                              <img src="../assets/img/location-cream.png"> 
                              {{ !empty($user->countryName['country_name'] ) ? $user->countryName['country_name']  : ''}}
                           </li>
                        </ul>
                     </div>
                     <ul class="vew-prfle-prim">
                        <li>
                           {{ !empty($user->userProfile['prim_title']) ? $user->userProfile['prim_title'] : '' }},
                        </li>
                        <li>
                           {{ !empty($user->userProfile['sec_title']) ? $user->userProfile['sec_title'] : '' }} 
                        </li>
                     </ul>
                  </div>
               </div>
               @if(!empty($jobs_list))
               <div class="mdl-dopdn">
                  <h1>For the job:</h1>
                   <div class="form-group">
                       <select class="form-control select2" name="job_id"
                            id="job_select">
                            <option value="">Choose Job</option>
                           @foreach($jobs_list as $job)
                            <option value="{{$job->id}}"
                                {{ ( old('country') == $job->id )? 'selected' : '' }}>
                                {{ $job->job_title }}
                            </option>
                            @endforeach
                        </select>
                    </div> 
               </div>
               @else
                <input type="hidden" name="job_id" 
                   value="{{ @$proposal->job_id}}" 
                   id="job_id">
                
               @endif
            </div>
            <div id="jobBasics">
               <div class="modl-terms">
               <!-- Nav tabs -->
               <h1>Terms</h1>
               <h4>Project type:</h4> 

               <input type="hidden" name="user_to" 
               value="{{ $user->id}}" 
               id="user_to">
               <input type="hidden" name="proposal_id" 
                     value="{{ @$proposal->id}}" 
                     id="proposal_id">
               


               <input type="hidden" name="job_type" 
               value="{{ (!empty($proposal->job_type) ) ? $proposal->job_type : '1' }}" 
               id="job_type">
               <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link job_type_box {{ ((!empty($proposal->job_type) && $proposal->job_type == '1' ) || empty($proposal->job_type) ) ? 'activeexp active show' : '' }}" data-toggle="tab" href="#hourly" onclick="jobType(this,'1');">Hourly</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link job_type_box {{ (!empty($proposal->job_type) && $proposal->job_type == '2' ) ? 'activeexp active show' : '' }}" data-toggle="tab" href="#fixed"  onclick="jobType(this,'2');">Fix cost</a>
                  </li>
               </ul>
               <!-- Tab panes -->
                <div class="tab-content">
                    <div id="hourly" class="tab-pane {{ ((!empty($proposal->job_type) && $proposal->job_type == '1' ) || empty($proposal->job_type)) ? 'active show' : '' }}">
                        <br>
                        <div class="row mb-4">
                           <div class="col-md-4">
                              <label class="tbl-st"> Hourly Rate </label>
                           </div>
                           <div class="col-md-7">
                              <div class="dropdown drop-show-all diff-drop rating">
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text dollar">
                                       <img src="../assets/img/dollar.png">
                                       </span> 
                                    </div>
                                     <input type="rate" name="hourly_rate" class="form-control rate" placeholder="00.00"
                                       onkeypress="return isAmountValidate(event,this);"  
                                       onfocusout="return isAmountValidate_default('hourly_rate');" 
                                       min="0.02" max="90.00"  data-maxamount="99.99"
                                       onchange="validateFloatKeyPress(this);"
                                       value="{{ !empty($proposal->hourly_rate) ? $proposal->hourly_rate : (!empty($job->hourly_rate) ? $job->hourly_rate : '') }}"
                                       id="hourly_rate"
                                        >
                                      <span class="help-block invalid-feedback"></span>
                                 </div>
                              </div>
                              <span class="main-sp">/hr</span> 
                           </div>
                        </div>
                        <div class="row mb-4">
                           <div class="col-md-4">
                              <label class="tbl-st"> Weekly limit </label>
                           </div>
                           <div class="col-md-7">
                              <div class="dropdown drop-show-all diff-drop">
                                 <div class="input-group mb-3">
                                   <input type="rate" name="weekly_limit" class="form-control rate" placeholder="60"
                                       onkeypress="return isAmountValidate(event,this);"  
                                       onfocusout="return isWeeklyLimit('weekly_limit');" 
                                       min="1" max="60"  data-maxamount="60"
                                       value="{{ !empty($job->weekly_limit) ? $job->weekly_limit : '' }}"
                                       id="weekly_limit"
                                        >
                                      <span class="help-block invalid-feedback"></span>
                                 </div>
                              </div>
                              <span class="main-sp">hrs</span> 
                           </div>
                        </div>
                    </div>
                    <div id="fixed" class="tab-pane fade {{ (!empty($proposal->job_type) && $proposal->job_type == '2' ) ? 'active show' : '' }}">
                        <br>
                        <div class="row mb-4">
                           <div class="col-md-4">
                              <label class="tbl-st"> Total cost </label>
                           </div>
                           <div class="col-md-7">
                              <div class="dropdown drop-show-all diff-drop">
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text dollar">
                                       <img src="../assets/img/dollar.png">
                                       </span>
                                    </div>
                                     <input type="rate" name="total_cost" class="form-control rate" placeholder="00.00"
                                       onkeypress="return isAmountValidate(event,this);"  
                                       onfocusout="return isAmountValidate_default('total_cost');" 
                                       min="0.02" max="999999.99"
                                       onchange="validateFloatKeyPress(this);"
                                       value="{{!empty($proposal->total_cost) ? $proposal->total_cost : (!empty($job->total_cost) ? $job->total_cost : '')}}"
                                       id="total_cost"
                                        >
                                      <span class="help-block invalid-feedback"></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
               </div>
            </div>
            <div class="modl-dlvr-descp">
               <h1>Deliverables & job description</h1>
               <div class="form-group mdl-msg-txt">
                 <textarea class="form-control" 
                 rows="5" 
                 name="job_description" 
                 maxlength="5000" 
                 onkeyup="return isLimitValidate(this);" >{{ !empty($job->job_description) ? $job->job_description : '' }}
                 </textarea>
               </div>
            </div>
          </div>
         </div>
          <div class="modal-footer mdl-ftr-pb">
            <button type="button" class="btn btn-secondary closeHire Cancel" 
              data-dismiss="modal">Cancel</button>
            <button type="submit"
             href="javascript:void(0)" 
             class="btn btn-primary save" >Hire</button>
         </div>
</form>

<script>
     // multi select
       $('#job_select').select2({
           placeholder: "Select Job",
           //maximumSelectionLength: 1
       }).on('change', function (e) {
          console.log(this.value);
          getJobDetails(this.value);
          //this.value
      });
function getJobDetails($jobId){

    showScreenLoader();
    $.ajax({
         url:"{{ url('job_hire_jobBasic') }}/"+$jobId+"/{{ $user->id}}",
         success:function(response)
         {
            hideLoader();
            $('#jobBasics').html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
}

$( function() {


  $("form[name='job_hire'").validate({
      rules: { 
        job_id: "required",
         hourly_rate: {
            validOnHourly: true
         },
         weekly_limit: {
            validOnHourly: true
         },
         project_length: {
            validOnHourly:true
         },
         total_cost: {
            validOnFixed: true
         },
         introduce: "required",
    },  
    submitHandler: function(form) {   
 
           showScreenLoader();
           var formData = new FormData($('form[name="job_hire"]')[0]);
            $.ajax({ 
               url: "{{ route('user.job_hire') }}", 
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
                 $('#hireFreelancer').modal('hide');
                 $('#successHirePopup').modal('show');
                 $('#freelancerName').html('{{ $user->name}}');
                 $('#undo_button').attr('data-id',response.contractId);
                 $('#contractId').val(response.contractId);
               }            
            });
          return false; // <- last item inside submitHandler function
     }
   });
});


   $.validator.addMethod("validOnHourly", function(value, element) {
     if ($("#job_type").val() === "1" && (value === 0 || value === '' )) {
       return false;
     } 
       return true;
   }, "Please add something!");


   $.validator.addMethod("validOnFixed", function(value, element) {
     if ($("#job_type").val() === "2" && (value === 0 || value === '' )) {
       return false;
      } 
       return true;
   }, "Please enter something!");



</script>