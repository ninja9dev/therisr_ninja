
@extends('user.layouts.main')

@section('content')


 <div class="end-cotrct-sec">
<div class="container">
	<div class="row">
		 <div class="col-lg-8 col-md-10 offset-lg-2 offset-md-1">
		     <?php 
		        //echo "<pre>"; print_r($contract); echo "</pre>";
		        //echo "<pre>"; print_r($loginUserType); echo "</pre>";
		     ?>
		 	<form name="endjob_type" method="POST">
             @csrf

            <input type="hidden" name="contract_id" id="contract_id" value="{{ (!empty($contract->id) ) ? $contract->id : '' }}">
            <?php if($loginUserType == '2'){ ?>
                <input type="hidden" name="user_to" id="user_to" value="{{ (!empty($contract->user_to) ) ? $contract->user_to : '' }}">
            <?php } else { ?>
                <input type="hidden" name="user_to" id="user_to" value="{{ (!empty($contract->user_by) ) ? $contract->user_by : '' }}">
            <?php } ?>
            
			<div class="end-cotrct-bck">
			    <a href="{{ url()->previous() }}">
			    	<i class="fa fa-angle-left" aria-hidden="true"></i> Back
			    </a>
			</div>	
			<div class="end-cotrct-mn">
				<div class="end-head">
					<h1>End contract</h1>
			    </div>
			   
					<div class="end-body">
						<div class="row mb-4">
							<div class="col-lg-12">
							    <div class="project-name">
								    <h4>Project Name</h4>
									<p>{{ $contract->job_title }}</p>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-lg-12">
							    <div class="contract-review">
								    <h4>Reviews</h4>
								    <?php if($loginUserType == '2'){ ?>
									    <ul id="starRatingUl">
    									    <li id="skillsli">
    									    	<input type="hidden" name="all_ratings[skillsli]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('skillsli',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('skillsli',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('skillsli',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('skillsli',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('skillsli',5);"></i>
    											<span>Skills</span>
    										</li>
    									    <li id="quality">  
    									    	<input type="hidden" name="all_ratings[quality]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('quality',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('quality',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('quality',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('quality',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('quality',5);"></i>
    											<span>Quality of works</span>
    										</li>
    									    <li id="comm">
    									    	<input type="hidden" name="all_ratings[comm]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('comm',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('comm',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('comm',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('comm',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('comm',5);"></i>
    											<span>Communication</span>
    										</li>
    									    <li id="ontime">
    									    	<input type="hidden" name="all_ratings[ontime]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('ontime',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('ontime',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('ontime',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('ontime',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('ontime',5);"></i>
    											<span>On time</span>
    										</li>
    									</ul>
									<?php } else { ?>
									    <ul id="starRatingUl1">
    									    <li id="skillsli1">
    									    	<input type="hidden" name="all_ratings[skillsli1]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('skillsli1',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('skillsli1',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('skillsli1',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('skillsli1',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('skillsli1',5);"></i>
    											<span>Skills</span>
    										</li>
    									    <li id="quality1">  
    									    	<input type="hidden" name="all_ratings[quality1]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('quality1',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('quality1',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('quality1',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('quality1',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('quality1',5);"></i>
    											<span>Quality of works</span>
    										</li>
    									    <li id="avail">
    									    	<input type="hidden" name="all_ratings[avail]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('avail',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('avail',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('avail',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('avail',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('avail',5);"></i>
    											<span>Availability</span>
    										</li>
    									    <li id="reasDead">
    									    	<input type="hidden" name="all_ratings[reasDead]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('reasDead',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('reasDead',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('reasDead',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('reasDead',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('reasDead',5);"></i>
    											<span>Set Reasonable Deadlines</span>
    										</li>
    									    <li id="commu">
    									    	<input type="hidden" name="all_ratings[commu]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('commu',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('commu',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('commu',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('commu',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('commu',5);"></i>
    											<span>Communication</span>
    										</li>
    									    <li id="cooperat">
    									    	<input type="hidden" name="all_ratings[cooperat]" value="0">
    										    <i class="fa fa-star-o star1" aria-hidden="true" onclick="saveStar('cooperat',1);"></i>
    										    <i class="fa fa-star-o star2" aria-hidden="true" onclick="saveStar('cooperat',2);"></i>
    										    <i class="fa fa-star-o star3" aria-hidden="true" onclick="saveStar('cooperat',3);"></i>
    										    <i class="fa fa-star-o star4" aria-hidden="true" onclick="saveStar('cooperat',4);"></i>
    										    <i class="fa fa-star-o star5" aria-hidden="true" onclick="saveStar('cooperat',5);"></i>
    											<span>Cooperation</span>
    										</li>
    									</ul>
									<?php } ?>
								    <span class="radioRating_Error error"></span>
									<h4>
										{{ !empty($settings->app_name) ? $settings->app_name : 'TheRisr' }} score: 
										<span id="overall_Score_count">0</span></h4>
									<input type="hidden" name="user_score" id="user_score" value="0">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="contract-fedbck">
								    <h4>Feedback</h4> 
									<textarea class="form-control autoHightTextarea" 
									  rows="5" 
									  id="comment_for_user"
									  name="comment_for_user" 
									  maxlength="100" 
									  onkeyup="return isLimitValidate(this);" ></textarea>
	                                <span class="chara-data" id="comment_limit"> 5000 characters left</span>
								</div>									
							</div>
						</div>	
				    </div>
				
			</div>

			<div class="end-cotrct-mn">
				<div class="end-head">
					<h1>Rate {{ !empty($settings->app_name) ? $settings->app_name : 'TheRisr' }} experience </h1>
			    </div>
				<div class="end-body">
					<div class="row mb-4">
						<div class="col-xl-8 col-lg-9">
						    <div class="project-name rate-experince">
							    <h4>How likely would you be recommend {{ !empty($settings->app_name) ? $settings->app_name : 'TheRisr' }} to others? </h4>
								<h5>Not at all <span>Of Course!</span></h5>
								<ul>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										     value="1">
										    <span class="checkmark"></span>
										</label>
										<p>1</p>
									</li>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										    value="2">
										    <span class="checkmark"></span>
										</label>
										<p>2</p>
									</li>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										    value="3">
										    <span class="checkmark"></span>
										</label>
										<p>3</p>
									</li>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										    value="4">
										    <span class="checkmark"></span>
										</label>
										<p>4</p>
									</li>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										    value="5">
										    <span class="checkmark"></span>
										</label>
										<p>5</p>
									</li>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										    value="6">
										    <span class="checkmark"></span>
										</label>
										<p>6</p>
									</li>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										    value="7">
										    <span class="checkmark"></span>
										</label>
										<p>7</p>
									</li>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										    value="8">
										    <span class="checkmark"></span>
										</label>
										<p>8</p>
									</li>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										    value="9">
										    <span class="checkmark"></span>
										</label>
										<p>9</p>
									</li>
								    <li>
										<label class="cotrct-rdio">
										    <input type="radio" name="therisr_score"
										    value="10">
										    <span class="checkmark"></span>
										</label>
										<p>10</p>
									</li>
								</ul>
								<span class="radio_Error error"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="contract-fedbck">
							    <h4>Tell us anything 🤓 </h4>
							    <textarea class="form-control autoHightTextarea" 
									  rows="5" 
									  id="comment_for_therisr"
									  name="comment_for_therisr" 
									  maxlength="100" 
									  onkeyup="return isLimitValidate(this);" ></textarea>
	                            <span class="chara-data" id="comment_limit"> 5000 characters left</span>
							</div>									
						</div>
					</div>	
			    </div>
			</div>
			<div class="end-cotrct-btn">
			    <ul>
				    <li>
					    <button type="submit" class="end-btn" href="javascript:void(0)">End contract</button>
					</li>
				    <li>
					    <a class="end-cancel-btn" href="{{ url()->previous() }}">Cancel</a>
					</li>
				</ul>
			</div>
		</form>
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
function saveStar($type, $star){
	 $('input[name="all_ratings['+$type+']"]').val($star);

	$('#'+$type).find('i').each(function(index, li){
		if(index < $star){
			$(this).removeClass('fa-star-o').addClass('fa-star');
		}else{
			$(this).addClass('fa-star-o').removeClass('fa-star');
		}	
        console.log(index, li);
    });

    var calculated_Score = 0;
    <?php if($loginUserType == '2') { ?>
        $('#starRatingUl').find('li').each(function()
        {
        	var thisScore = 0;
    		$(this).find('i').each(function(index, li){
    			if($(this).hasClass('fa-star')){
    				thisScore++;
    			}	
    	    });
    	    console.log('thisli',thisScore);
    	    calculated_Score  = calculated_Score + thisScore;
        });
        var ratingTypeLength = $('#starRatingUl').find('li').length;
        console.log(calculated_Score, ratingTypeLength);
        var finalRating  = calculated_Score / ratingTypeLength;
        var finalRating  = (finalRating).toFixed(2);
        $('#overall_Score_count').html(finalRating);
        $('#user_score').val(finalRating);
    <?php } else { ?>
        $('#starRatingUl1').find('li').each(function()
        {
        	var thisScore = 0;
    		$(this).find('i').each(function(index, li)
    		{
    			if($(this).hasClass('fa-star')){
    				thisScore++;
    			}	
    	    });
    	    console.log('thisli',thisScore);
    	    calculated_Score  = calculated_Score + thisScore;
        });
    
        var ratingTypeLength1 = $('#starRatingUl1').find('li').length;
        console.log(calculated_Score, ratingTypeLength1);
        var finalRating1  = calculated_Score / ratingTypeLength1;
        var finalRating1  = (finalRating1).toFixed(2);
        $('#overall_Score_count').html(finalRating1);
        $('#user_score').val(finalRating1);
    <?php } ?>

}


$("form[name='endjob_type'").validate({
      rules: { 
         comment_for_user: {
            required: true
         },
         comment_for_therisr: {
            required: true
         }
      }, 
    submitHandler: function(form) { 
	        var therisr_score = 0;  
	         var group = document.endjob_type.therisr_score;
				for (var i=0; i<group.length; i++) {
				    if (group[i].checked){
					   therisr_score = group[i].value;
					   break;
					}
				}
				if (i==group.length){
				 $('.radio_Error').html('This field is required!');
				}
				
	    	if($('#user_score').val() == 0){
	    		$('.radioRating_Error').html('Please add your ratings!');
	    		return false;
	    	}else if(therisr_score == 0){
	           return false;
	    	}else{
	    		$('.radioRating_Error').html('');
	    		$('.radio_Error').html('');
	           showScreenLoader();
	           var formData = new FormData($('form[name="endjob_type"]')[0]);
	           formData.append('therisr_score', therisr_score );
	            $.ajax({ 
	               url: "{{ route('user.endContractSubmit') }}",
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
	                    <?php if($loginUserType == '2') { ?>
	                        window.location.href="{{ route('user.allcontracts') }}";
                        <?php } else { ?>
                            window.location.href="{{ route('user.myjobs') }}";
                        <?php } ?>
	               }            
	            });
	          return false; // <- last item inside submitHandler function
	        }
       }
   });
   
</script>
@endsection