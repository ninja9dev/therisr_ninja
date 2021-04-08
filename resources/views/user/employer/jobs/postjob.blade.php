
@extends('user.layouts.main')

@section('content')

 
 <input type="hidden" name="jobId" id="jobId" value="{{ (!empty($job->id) ) ? $job->id : '' }}">

 <input type="hidden" name="uniq_job_id" id="uniq_job_id" value="{{ (!empty($job->uniq_job_id) ) ? $job->uniq_job_id : '' }}">
 
<div class="profile-info">
<div class="paddin-btms">
   <div class="container">
      <div>
            <div class="padding-ser pl-0">
               <div class="row">
                  <div class="col-lg-8 col-md-10 offset-lg-2 offset-md-1">
                     <div class="pst-topsave-sec" type="submit">
                        <a class="pst-topsave-btn" onclick="saveAndExit();" href="javascript:void(0);">
                           <i class="fa fa-angle-left" aria-hidden="true"></i> Save & Exit</a>
                     </div>
                     <div class="post-job-cont">
                        <div class="accordion tabs-fll-w" id="accordionExample">
                           <div class="card">
                              <div class="card-header" id="headingOne">
                                 <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Project type & budget
                                    </button>
                                 </h2>
                              </div>
                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                             <form name="jobpost_type" method="POST">
                                @csrf
                                 <div class="card-body">
                                    <div class="modl-terms"> 
                                       <!-- Nav tabs -->
                                       <h4>What's the project type?</h4>
                                        <input type="hidden" name="job_type" value="{{ (!empty($job->job_type) ) ? $job->job_type : '1' }}" id="job_type">
                                       <ul class="nav nav-tabs" role="tablist">
                                          <li class="nav-item">
                                             <a class="nav-link job_type_box {{ ((!empty($job->job_type) && $job->job_type == '1' ) || empty($job->job_type) ) ? 'activeexp active show' : '' }}" data-toggle="tab" href="#hourly" onclick="jobType(this,'1');">Hourly</a>
                                          </li>
                                          <li class="nav-item">
                                             <a class="nav-link job_type_box {{ (!empty($job->job_type) && $job->job_type == '2' ) ? 'activeexp active show' : '' }}" data-toggle="tab" href="#fixed"  onclick="jobType(this,'2');">Fix cost</a>
                                          </li>
                                       </ul>
                                       <!-- Tab panes -->
                                       <div class="tab-content">
                                          <div id="hourly" class="tab-pane {{ ((!empty($job->job_type) && $job->job_type == '1' ) || empty($job->job_type)) ? 'active show' : '' }}">
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
                                                            value="{{ !empty($job->hourly_rate) ? $job->hourly_rate : '' }}"
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
                                             <div class="row mb-4">
                                                <div class="col-md-4">
                                                   <label class="tbl-st">Project length</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="project_length" id="project_length">
                                                      <option></option>
                                                      <option value="1" {{ (!empty($job->project_length) &&   $job->project_length == '1' ) ? 'selected="selected"' : '' }}>
                                                      More than a month</option>
                                                      <option value="3" {{ (!empty($job->project_length) &&   $job->project_length == '3' ) ? 'selected="selected"' : '' }}>
                                                      More than 3 months</option>
                                                      <option value="6" {{ (!empty($job->project_length) &&   $job->project_length == '6' ) ? 'selected="selected"' : '' }}>
                                                      More than 6 months</option> 
                                                      <option value="9" {{ (!empty($job->project_length) &&   $job->project_length == '9' ) ? 'selected="selected"' : '' }}>
                                                      More than 9 months</option>
                                                      <option value="12" {{ (!empty($job->project_length) &&   $job->project_length == '12' ) ? 'selected="selected"' : '' }}>
                                                      More than 12 months</option>
                                                    </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div id="fixed" class="tab-pane fade {{ (!empty($job->job_type) && $job->job_type == '2' ) ? 'active show' : '' }}">
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
                                                            value="{{ !empty($job->total_cost) ? $job->total_cost : '' }}"
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
                                    <div class="col-sm-12 p-0 save-btn-lg">
                                       <button type="submit" class="btn btn-primary btnSubmit">Save & Continue</button>
                                    </div>
                                 </div>
                              </form>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header" id="headingTwo">
                                 <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Job details
                                    </button>
                                 </h2>
                              </div>
                              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <form name="jobpost_jobdetails" method="POST">
                                @csrf
                                 <div class="card-body">
                                    <div class="post-jb-fld">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <label class="tbl-st"> Enter the name of the job post </label>
                                          </div>
                                          <div class="col-md-12">
                                             <textarea class="form-control autoHightTextarea" rows="2" name="job_title" maxlength="100" onkeyup="return isLimitValidate(this);" >{{ !empty($job->job_title) ? $job->job_title : '' }}</textarea>
                                              <span class="chara-data" id="job_title_limit"> 100 characters left</span>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                             <label class="tbl-st"> Deliverables & job description </label>
                                          </div>
                                          <div class="col-md-12">
                                            <textarea class="form-control" rows="5" name="job_description" maxlength="5000" onkeyup="return isLimitValidate(this);" >{{ !empty($job->job_description) ? $job->job_description : '' }}</textarea>
                                           <span class="chara-data" id="description_limit"> 5000 characters left</span>
                                          </div>
                                       </div>
                                       <div class="row mb-4">
                                          <div class="col-md-4">
                                             <label class="tbl-st"> Due date <span>(optional) </span></label>
                                          </div>
                                          <div class="col-md-7">
                                             <div class="form-group mdl-time mb-0">
                                                <input id="due_date" class="form-control radius-right-0" type="text"  name="due_date" value="{{ !empty($job->due_date) ? $job->due_date  : ''  }}">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 p-0 save-btn-lg">
                                       <button type="submit" class="btn btn-primary btnSubmit">Save & Continue</button>
                                    </div>
                                 </div>
                              </form>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header" id="headingThree">
                                 <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Qualifications
                                    </button>
                                 </h2>
                              </div>
                              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                 
                               <form name="jobpost_qualifications" method="POST">
                                @csrf
                                 <div class="card-body">
                                    <div class="post-jb-qufns">
                                       <div class="row mb-4">
                                          <div class="col-md-12">
                                             <label class="tbl-st">What expertise are you looking for?</label>
                                          </div>
                                          <div class="col-md-9 inp">
                                              <?php $job_expertise =  !empty($job->expertise ) ? explode(',',$job->expertise) : array();
                                              ?>
                                             <select class="form-control select2" name="expertise"  id="services"
                                               multiple style="width: 100%">
                                                 <option value=""></option>
                                                 @foreach($services as $service)
                                                  <option value="{{ $service->id }}" 
                                                    {{ in_array( $service->id, $job_expertise) ? 'selected="selected"'  : ''}} >
                                                   {{ $service->name }}</option>
                                                 @endforeach
                                              </select>
                                          </div>
                                       </div>
                                       <div class="row mb-4">
                                          <div class="col-md-12">
                                             <label class="tbl-st">What skills are required to complete the work?</label>
                                          </div>
                                          <div class="col-md-9 inp">
                                              <?php $job_skills =  !empty($job->skills ) ? explode(',',$job->skills) : array(); ?>

                                             <select class="form-control select2" name="skills"  id="skills"
                                               multiple style="width: 100%">
                                                 <option value=""></option>
                                                 @foreach($skills as $skill)
                                                  <option value="{{ $skill->id }}"  
                                                   {{ in_array( $skill->id, $job_skills) ? 'selected="selected"'  : ''}} >
                                                   {{ $skill->name }}</option>
                                                 @endforeach
                                              </select>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                             <label class="tbl-st">Your experience level? </label>
                                          </div>
                                            <div class="col-md-12">
                                               <input type="hidden" name="exp_level" value="{{ !empty($job->exp_level) ? $job->exp_level : '1' }}" 
                                               id="exp_level">
                                                <a class="left-side misc-field exp_level_w 
                                                {{ (!empty($job->exp_level) && $job->exp_level == 1) ? 'activeexp' : '' }} "
                                                 href="javascript:void(0)"  onclick="exp_level(this,'1');">
                                                Entry Level</a>
                                                <a class="left-side misc-field exp_level_w
                                                {{ (!empty($job->exp_level) && $job->exp_level == 2) ? 'activeexp' : '' }} "
                                                 href="javascript:void(0)"  onclick="exp_level(this,'2');">
                                                Advanced</a>
                                                <a class="left-side misc-field exp_level_w
                                                {{ (!empty($job->exp_level) && $job->exp_level == 3) ? 'activeexp' : '' }} " 
                                                href="javascript:void(0)"  onclick="exp_level(this,'3');">
                                                Expert</a>
                                             </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                             <label class="tbl-st mt-15">Preferred English proficiency? </label>
                                          </div>
                                          <div class="col-md-12">
                                            <select class="form-control" name="english_prof">
                                                <option value="">Select your proficiency</option>
                                                <option value="native"
                                                  {{ (!empty($job->english_prof) && $job->english_prof == 'native') ? 'selected="selected"' : '' }}>
                                                   Native or Billingual</option>
                                                <option value="fluent"  
                                                 {{ (!empty($job->english_prof) && $job->english_prof ==  'fluent') ? 'selected="selected"' : '' }}>
                                                   Fluent</option>
                                                <option value="conversational"
                                                  {{ (!empty($job->english_prof) && $job->english_prof ==  'conversational') ? 'selected="selected"' : '' }}>
                                                 Conversational</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                             <label class="tbl-st mt-15"> {{ !empty($settings->app_name) ? $settings->app_name : 'TheRisr' }}  score </label>
                                          </div>
                                          <div class="col-md-12">
                                             <select class="form-control" name="therisr_score">
                                                <option value="">Select {{ !empty($settings->app_name) ? $settings->app_name : 'TheRisr' }} score</option>
                                                <option value="any"
                                                   {{ (!empty($job->therisr_score) && $job->therisr_score ==  'any') ? 'selected="selected"' : '' }}>
                                                  Any Score</option>
                                                <option value="1"
                                                   {{ (!empty($job->therisr_score) && $job->therisr_score ==  '1-2') ? 'selected="selected"' : '' }}>
                                                  1-2</option>
                                                <option value="2"  
                                                    {{ (!empty($job->therisr_score) && $job->therisr_score ==  '2-3') ? 'selected="selected"' : '' }}>
                                                   2-3</option>
                                                <option value="3"
                                                    {{ (!empty($job->therisr_score) && $job->therisr_score == '3-4') ? 'selected="selected"' : '' }}>
                                                 3-4</option>
                                                <option value="4"
                                                    {{ (!empty($job->therisr_score) && $job->therisr_score == '4-5') ? 'selected="selected"' : '' }}>
                                                 4-5</option>
                                             </select>
                                          </div>
                                       </div>
                                        <div class='element mt-15' id='div_1'>
                                          
                                           @if(!empty($job->interview_questions))
                                           @foreach(json_decode($job->interview_questions) as $key=>$inter)
                                              <div class="divblock">
                                                <div class="row">
                                                   <div class="col-md-12">
                                                      <div class="post-qufns-dlte">
                                                         <label class="tbl-st mt-15 questionNumber"> Interview question {{ $key+1 }}</label>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                      <textarea class="form-control autoHightTextarea interview_questions" rows="2" name="interview_questions[]" maxlength="100" onkeyup="return isLimitValidate(this);" required="required">{{ $inter }}</textarea>
                                                       <span class="chara-data"> 100 characters left</span>
                                                              <span class="help-block invalid-feedback"></span>
                                                   </div>
                                                </div>
                                              </div>
                                             @endforeach
                                             @else
                                             <div class="divblock">
                                                 <div class="row">
                                                   <div class="col-md-12">
                                                      <div class="post-qufns-dlte">
                                                         <label class="tbl-st mt-15 questionNumber"> Interview question 1</label>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                      <textarea class="form-control autoHightTextarea interview_questions" rows="2" name="interview_questions[]" maxlength="100" onkeyup="return isLimitValidate(this);" required="required"></textarea>
                                                       <span class="chara-data"> 100 characters left</span>
                                                              <span class="help-block invalid-feedback"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             @endif
                                       </div>
                                          <div class="row">
                                             <div class="col-md-12">
                                                 <div class="add-quston">
                                                    <a class='add pointer' onclick='addFunction();'><span>+</span> Add Question</a>
                                                 </div>
                                             </div>
                                          </div>

                                       <div class="col-sm-12 p-0 save-btn-lg"><button type="submit" class="btn btn-primary">Save & Continue</button></div>
                                    </div>
                                 </div>
                               </form>
                              </div>
                           </div>
                        </div>
                        <div class="post-fish-sec">
                           <a class="post-sve-ext" onclick="saveAndExit();" href="javascript:void(0)">Save & Exit</a>
                           @if(!empty($job->job_status) && $job->job_status == '2')
                           @else
                             <a class="post-jobnow-btn btnSubmit" onclick="saveAndPublish();" href="javascript:void(0)">Post job now</a>
                           @endif
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      </div>
   </div>
</div>
</div>

<button class="openSuccessModel" style="display: none; color: white;opacity: 0;" data-toggle="modal" data-target="#successful">open modal success</button>

   <div class="modal post-suces-modal" id="successful">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">

           <!-- Modal body -->
            <div class="modal-body pb-0">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="post-suces-img text-center">
                         <img class="sucessful-img" src="../assets/img/successful.png" alt="">
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="post-suces-text">
                         <h1>Successful!</h1>
                        <h4>Your job has been successfully posted. Share it now to get maximum exposure!</h4>
                        <p>
                           <a href="" id="jobPath" target="_blank">
                              https://therisr.com/job/ID84541
                           </a>
                        </p>
                        <ul>
                            <li><a onclick="shareJobLink('facebook');" href="javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a onclick="shareJobLink('twitter');" href="javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a onclick="shareJobLink('linkedin');" href="javascript:void(0)"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="right-hiring-txt">
                  <a  class="btn btn-primary" href="{{ route('user.e_myjobs') }}" >Close</a>
               </div>
            </div>
          
         </div>
      </div>
   </div>

@endsection


 

@section('footer') 
<!-- This file is important to include some functions
 -->
 <script src="{{ asset ('assets/js/function/functions.js') }}"></script>

  <script>


   function shareJobLink(platform){
      $link = $('#jobPath').html();

      if(platform == 'facebook'){

       window.open('http://facebook.com/sharer/sharer.php?u='+encodeURIComponent($link), '', 'left=0,top=0,width=650,height=420,personalbar=0,toolbar=0,scrollbars=0,resizable=0');

      }else if(platform == 'twitter'){

       window.open('https://twitter.com/intent/tweet?url='+encodeURIComponent($link), '', 'left=0,top=0,width=650,height=420,personalbar=0,toolbar=0,scrollbars=0,resizable=0');

      }else if(platform == 'linkedin'){

       window.open('https://www.linkedin.com/sharing/share-offsite/?url='+encodeURIComponent($link), '', 'left=0,top=0,width=650,height=420,personalbar=0,toolbar=0,scrollbars=0,resizable=0');

      }
   }

   $( function() {
      $( "#due_date" ).datepicker({
          minDate: 0, 
         dateFormat: 'yy-mm-dd',
         setDate : "{{ !empty($job->due_date) ? $job->due_date  : ''  }}"
      });
   });

   
   $("form[name='jobpost_type'").validate({
      rules: { 
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
      }, 
    submitHandler: function(form) {   
           showScreenLoader();
           var formData = new FormData($('form[name="jobpost_type"]')[0]);
           formData.append('jobId', $('#jobId').val() );
           formData.append('uniq_job_id', $('#uniq_job_id').val());
            $.ajax({ 
               url: "{{ route('user.jobpost') }}",
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
                  hideLoader();
                  $('#jobId').val(response.jobId);
                  $('#uniq_job_id').val(response.uniq_job_id);
                $('#headingTwo').find('button').click();
               }            
            });
          return false; // <- last item inside submitHandler function
       }
   });
   



   $("form[name='jobpost_jobdetails'").validate({
      rules: { 
         job_title: "required",
         job_description: "required",
      }, 
    submitHandler: function(form) {   
           showScreenLoader();
           var formData = new FormData($('form[name="jobpost_jobdetails"]')[0]);
            formData.append('jobId', $('#jobId').val() );
           formData.append('uniq_job_id', $('#uniq_job_id').val());
            $.ajax({ 
               url: "{{ route('user.jobpost') }}",
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
                  hideLoader();
                  $('#jobId').val(response.jobId);
                  $('#uniq_job_id').val(response.uniq_job_id);
                $('#headingThree').find('button').click();
               }            
            });
          return false; // <- last item inside submitHandler function
       }
   });



   $("form[name='jobpost_qualifications'").validate({
      rules: { 
         expertise: "required",
         skills:"required",
         english_prof:"required",
         therisr_score:"required"
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

           var formData = new FormData($('form[name="jobpost_qualifications"]')[0]);
           formData.append('skills' ,$('#skills').val().join(','));
           formData.append('expertise' ,$('#services').val().join(','));
            formData.append('jobId', $('#jobId').val() );
           formData.append('uniq_job_id', $('#uniq_job_id').val());

            $.ajax({ 
               url: "{{ route('user.jobpost') }}",
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
                  hideLoader();
                  
                  $('#jobId').val(response.jobId);
                  $('#uniq_job_id').val(response.uniq_job_id);
               }            
            });
          return false; // <- last item inside submitHandler function
       }else{
         return false;
       }
    }
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




function saveAndPublish(){
   showScreenLoader();
   var errors_all = 0;
   if($("#job_type").val() === "1" && $("input[name='hourly_rate']").val() === ""){
      errors_all++;
   }else if($("#job_type").val() === "1" && $("input[name='weekly_limit']").val() === ""){
      errors_all++;
   }else if($("#job_type").val() === "1" && $("input[name='project_length']").val() === ""){
      errors_all++;
   }else if($("#job_type").val() === "2" && $("input[name='total_cost']").val() === ""){
      errors_all++;
   }else if($("input[name='job_title']").val() === "" || $("input[name='job_description']").val() === ""){
      errors_all++;
   }else if($("input[name='expertise']").val() === "" || $("input[name='skills']").val() === ""){
      errors_all++;
   }else if($("input[name='english_prof']").val() === "" || $("input[name='therisr_score']").val() === ""){
      errors_all++;
   }else{

   }

   $( ".interview_questions" ).each(function( index ) {
         if($.trim($(this).val()) == ''){
            errors_all = errors_all+1;
            $(this).parent().find('span.help-block').html('This is required!');
            $(this).parent().find('span.help-block').show();
         }
      });

   if(errors_all == 0){
      var formData = new FormData($('form[name="jobpost_qualifications"]')[0]);
        formData.append('skills' ,$('#skills').val().join(','));
        formData.append('expertise' ,$('#services').val().join(','));
        formData.append('jobId', $('#jobId').val() );
        formData.append('uniq_job_id', $('#uniq_job_id').val());
        formData.append('job_status','2' );// post job now

        $.ajax({ 
            url: "{{ route('user.jobpost') }}",
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
                  $('#jobId').val(response.jobId);
                  $('#uniq_job_id').val(response.uniq_job_id);
                  $('#jobPath').html('{{ url("/job/")}}/'+response.uniq_job_id);
                  $('#jobPath').attr('href',('{{ url("/job/")}}/'+response.uniq_job_id));
                  $('.openSuccessModel').show();
                  $('.openSuccessModel').click();
            }            
         });
  }else{
      $.toast({
          heading: 'Error',
          text: 'Please fill the form completly!',
          showHideTransition: 'slide',
          icon: 'error'
      });
  }
  hideLoader();
}

function saveAndExit(){
   showScreenLoader();
      var formData = new FormData($('form[name="jobpost_qualifications"]')[0]);
      let formDataType = new FormData($('form[name="jobpost_type"]')[0]);
      for (var pair of formDataType.entries()) {
          formData.append(pair[0], pair[1]);
      }
      let formDataPrecios = new FormData($('form[name="jobpost_jobdetails"]')[0]);
      for (var pair of formDataPrecios.entries()) {
          formData.append(pair[0], pair[1]);
      }
    
        formData.append('skills' ,$('#skills').val().join(','));
        formData.append('expertise' ,$('#services').val().join(','));
        formData.append('jobId', $('#jobId').val() );
        formData.append('uniq_job_id', $('#uniq_job_id').val());

        $.ajax({ 
            url: "{{ route('user.jobpost') }}",
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
                  $('#jobId').val(response.jobId);
                  $('#uniq_job_id').val(response.uniq_job_id);
                window.location.href= "{{ route('user.e_myjobs') }}";
            }            
         });

       hideLoader();
}

</script>  
<script type="text/javascript">
 // Add new element
 function addFunction(){

  // Finding total number of elements added
  var total_element = $(".divblock").length;
  var max = 5;
   if(total_element < max ){
    var questionNumber = total_element+1;

      $(".divblock:last").clone().appendTo(".element");
      $('.divblock:last').find('.questionNumber').html('Interview Question '+questionNumber);
      $(".divblock:last").find('.post-qufns-dlte').find("#rmove-btn").remove();
      $(".divblock:last").find('textarea').val('');
      $(".divblock:last").find('.post-qufns-dlte').append('<a id="rmove-btn" onclick="removeFunction(this);"" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a>');
   }else{
      $.toast({
             heading: 'Error',
             text:'Oops! You can add up to 5 questions only.',
             showHideTransition: 'slide',
             icon: 'error'
         });
   }   
 
 }

 // Remove element
 function removeFunction(thisv){
  $(thisv).closest('.divblock').remove();
  var total_element = $(".divblock").length;

    $( ".divblock" ).each(function( index ) {
      var number = index+1;
         $(this).find('.questionNumber').html('Interview Question '+number);
      });
 }


</script> 

@endsection