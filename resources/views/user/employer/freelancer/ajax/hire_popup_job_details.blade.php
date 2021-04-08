<div class="modl-terms">
               <!-- Nav tabs -->
               <h1>Terms</h1>
               <h4>Project type:</h4> 

               <input type="hidden" name="user_to" 
               value="{{ $user->id}}" 
               id="user_to">
               <input type="hidden" name="proposal_id" 
                     value="{{ !empty($proposal->id) ? @$proposal->id : 0 }}" 
                     id="proposal_id">
               


               <input type="hidden" name="job_type" 
               value="{{ (!empty($proposal->job_type) ) ? $proposal->job_type : (!empty($job->job_type) ? $job->job_type : '1')}}" 
               id="job_type">
               <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link job_type_box 
                     {{( (!empty($proposal->job_type) && $proposal->job_type == '1' ) 
                          || (!empty($job->job_type) && $job->job_type == '1' ) ) 
                          ? 'activeexp active show' : '' }}" 
                      data-toggle="tab" 
                      href="#hourly" 
                      onclick="jobType(this,'1');">Hourly</a>
                  </li>
                  <li class="nav-item">
                     <a 
                     class="nav-link job_type_box 
                     {{ ( (!empty($proposal->job_type) && $proposal->job_type == '2' ) 
                          || (!empty($job->job_type) && $job->job_type == '2' ) ) 
                         ? 'activeexp active show' 
                         : '' }}" 
                        data-toggle="tab" 
                        href="#fixed"  
                        onclick="jobType(this,'2');">Fix cost</a>
                  </li>
               </ul>
               <!-- Tab panes -->
                <div class="tab-content">
                    <div id="hourly" 
                    class="tab-pane 
                    {{ ( (!empty($proposal->job_type) && $proposal->job_type == '1' ) 
                         || (!empty($job->job_type) && $job->job_type == '1' ) ) ? 'active show' : '' }}">
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
                                     <input type="rate" 
                                       name="hourly_rate" 
                                       class="form-control rate" 
                                       placeholder="00.00"
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
                                   <input type="rate" 
                                       name="weekly_limit" 
                                       class="form-control rate" 
                                       placeholder="60"
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
                    <div 
                    id="fixed" 
                    class="tab-pane fade 
                    {{ ( (!empty($proposal->job_type) && $proposal->job_type == '2' ) 
                         || (!empty($job->job_type) && $job->job_type == '2' ) ) 
                         ? 'active show' : '' }}">
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
                                     <input 
                                       type="rate" 
                                       name="total_cost" 
                                       class="form-control rate" 
                                       placeholder="00.00"
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