 
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               @if($page == 'freelancer_popup')
                <h2>Work History</h2>
               @else
                  <h1>Work history</h1>
	               @if($contracts->total() >= 1 )
	               <p class="riser-scor">TheRisr score:
	               	<?php echo getUserScoreHtml($user->id, $user->therisr_score, 'workhistory');?>
	               </p>
	               @endif
               @endif
               <div class="row">
                  <div class="col-md-8 offset-md-2">
                  	@if($contracts->total() >= 1 )
                     <div class="accordion accordin-set" id="accordionExample">
                     	
	                        @foreach($contracts as $key=>$row)
	                        
	                        <div class="card">
	                           <div class="card-header" id="headingOne">
	                              <h4 class="panel-title">
	                                 <a class="btn btn-link" 
	                                 role="button" 
	                                 data-toggle="collapse" 
	                                 data-parent="#accordionExample" 
	                                 href="#collapseOne{{$row->id}}" 
	                                 aria-expanded="true" 
	                                 aria-controls="collapseOne">
	                                    <i class="more-less glyphicon glyphicon-plus"></i>
	                                    {{ $row->job_title }} -  {{ ($row->contract_type == '1') ? "Hourly Rate" : "Project Base" }}
	                                    <div class="riser-scor"> 

	                                    	<?php 
	                                    	echo !empty($row->currentUserFeedback) ? 
	                                    	getUserScoreHtml($user->id, $row->currentUserFeedback->user_score
	                                    		, 'workhistory_li') : '' ;?>
	                                       <span class="text-new-all">
	                                       	{{  dateFormat($row->contract_start_on) }} - {{  dateFormat($row->contract_end_on) }}</span>
	                                    </div>
	                                 </a>
	                              </h4>
	                           </div>
	                           <div id="collapseOne{{$row->id}}" 
	                           class="collapse {{ ($key == 0) ? 'show'  : ''}} " 
	                           aria-labelledby="headingOne" 
	                           data-parent="#accordionExample">
	                              <div class="card-body">
	                                 {{ $row->job_description }}
	                              </div>
	                           </div>
	                           <ul class="tootl-width">
	                              <li> Total project earned </li>
	                              @if($row->contract_type == '1')
	                                 <li> Total hours worked </li>
	                              @endif
	                           </ul>
	                        </div>
	                         @endforeach
                     </div>
                     <div class="txt-centr-load2">
                     	 @if($contracts->total() > 1)
					            <!-- showing record  -->
					            Showing {{($contracts->currentPage()-1)* $contracts->perPage()+($contracts->total() ? 1:0)}} to {{($contracts->currentPage()-1)*$contracts->perPage()+count($contracts)}}  of  {{$contracts->total()}}  Results
					          
					            <!-- pagination buttons -->
					           {!! $contracts->onEachSide(0)->render() !!}
                          @endif
                        <!-- <a href="#" class="load-mores"> Load More </a> -->
                     </div>
                     @else
		                   <p class="text-center">No work history yet!</p>
		            @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript">

      	$( document ).ready(function() {
			   // pagination
			  $(document).on('click', '.pagination a',function(event)
			  {
			      $('li').removeClass('active');
			      $(this).parent('li').addClass('active');
			      var myurl = $(this).attr('href');
			      get_workExperienceBOX(myurl);
			      event.preventDefault();
			  });
		});
      </script>