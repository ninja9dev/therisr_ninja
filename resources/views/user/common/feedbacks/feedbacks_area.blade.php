<h1 class="timesheet">
	Feedback
</h1>
<?php //echo "<pre>";
//print_r($contract->contractEnd); die;?>
<div class="row feedback"> 
	@foreach($contract->contractEnd as $feedback)
    <div class="col-md-6">
    	<h5 class="mb-20 mt-20 mt-sm-0">
        @if($feedback->user_by == Auth::user()->id ) 
           Your Feedback to {{ (Auth::user()->user_type == '2') ? 'Freelancer' : 'Client'}}
    	@else
    	 {{ (Auth::user()->user_type == '2') ? "Freelancer's" : "Client's" }} Feedback to You
    	@endif
        </h5>
    	
    	<span class="feedback-star">
    		<p>{{ $feedback->user_score}} </p>
          @for($i = 0; $i<5; $i++)
            @if($feedback->user_score > $i && $feedback->user_score < ($i+1))
             <i class="fa fa-star-half-o"></i>
            @elseif($feedback->user_score > $i)
             <i class="fa fa-star"></i>
            @else
              <i class="fa fa-star-o"></i>
            @endif
          @endfor
        </span>


    	<p>{{ $feedback->comment_for_user}} </p>
    </div>
   @endforeach

</div>

       