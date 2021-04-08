@if(Auth::user()->id == $chat->freelancerId)
         @php
              $chatuser = !empty($chat->chat_client) ? $chat->chat_client : '';
         @endphp
        @else
          @php
              $chatuser = !empty($chat->chat_freelancer) ? $chat->chat_freelancer : '';
          @endphp
@endif

@if($request_type != 'paginationData')
<div class="contact-profile">
	  @php
       if(@$chatuser->image != '') 
       $image =  asset('assets/users').'/'.@$chatuser->image; 
       else 
       $image =  asset('assets/users/default.jpg'); 
     @endphp 
	    <img src="{{ $image }}" alt="" />
		<div class="person-info"> 
			<h1 class="person-name">{{ !empty($chatuser) ? $chatuser->name : '' }}</h1>
      @if(!empty($chat->chat_job))
			<p class="job_title_chat"> 
        <a href="{{ route('user.job', ['id' => encryptUrlId($chat->chat_job->id) ])}}" 
          target="_blank">
          {{ !empty($chat->chat_job) ? $chat->chat_job->job_title : ''}}
        </a>
      </p>
      @endif
		</div>
		
</div>
@endif

<div class="messages">
  <ul id="messages-list-ul">  
  	@php 
  	$chat_messages = $chat_messages->reverse();
  	@endphp
  	@forelse($chat_messages as $res) 
        <li class="sent"
        id="message-id-{{$res->id}}" 
        style="text-align:
        {{ ($res->sendByClient == '1' && Auth::user()->id == $res->clientId) 
        ? 'right'
        : (($res->sendByFreelancer == '1' && Auth::user()->id == $res->freelancerId) ? 'right' : 'left') }};">
			<p> 				
				@if($res->attach_url != '')
				    @php
				        $string = $res->message;
                        $array1  = array('.jpg', '.png', '.jpeg', '.gif');
                        $array2  = array('.psd', '.pdf', '.doc', '.docx');
                        $array3  = array('.mp3');
                        $array4  = array('.mp4', '.webm', '.mov','.wmv');
                     @endphp
                        
                    @if(Str::contains($string, $array1))
                            <a target='_blank' 
                            href="{{ asset('assets/message-attchments/')}}/{{$res->message}}">
                                <img src="{{ asset('assets/message-attchments/')}}/{{$res->message}}"  style='width:100px;height:100px;'/>
                            </a>
                    @elseif (Str::contains($string, $array2))

                            <a target='_blank' href="{{ asset('assets/message-attchments/')}}/{{$res->message}}">
                                <img src='https://icons.iconarchive.com/icons/graphicloads/long-shadow-documents/256/document-arrow-download-icon.png' style='width:100px;height:100px;'/>
                            </a>
                    @elseif (Str::contains($string, $array3))
                        
                            <audio controls>
                                <source src="{{ asset('assets/message-attchments/')}}/{{$res->message}}" type="audio/ogg">
                                <source src="{{ asset('assets/message-attchments/')}}/{{$res->message}}" type="audio/mpeg">
                            </audio>
                    @elseif (Str::contains($string, $array4))
                        
                            <video width="200" height="200" controls>
                                <source src="{{ asset('assets/message-attchments/')}}/{{$res->message}}" type="video/mp4">
                                <source src="{{ asset('assets/message-attchments/')}}/{{$res->message}}" type="video/ogg">
                            </video>
                    @else
                        {{ $string}}
                    @endif
                        
				@else
				    {{ $res->message}}
				@endif
		    </p>
		    <time>{{getMessageTime($res->created_at) }}</time>
		</li>
    @empty   
    <div class="inner-table-box">
          <div class="pt-30 text-center">
             <img src="{{ asset('assets/img/no-trans.png')}}" class="m-auto">
             <p class="no-work-yet"> 
             No messages yet
           </p>
          </div>
    </div>
    @endforelse
  </ul>
    <input type='hidden' name='chat_id' id='chat_id' value='{{$chat->chat_id}}'/>
    <input type='hidden' name='freelancerid' id='freelancerid' value='{{$chat->freelancerId}}'/>
    <input type='hidden' name='clientid' id='clientid' value='{{$chat->clientId}}'/> 
</div>
<script>
  <?php if(!empty($more_messages)) { ?>
$( document ).ready(function() {
  setTimeout(function(){
    $('#messages-list-ul').on('scroll', function() {
      var currentScroll = $(this).scrollTop();
            console.log('$(this).scrollTop()',$(this).scrollTop());
            console.log("#messages-list-ul",$("#messages-list-ul").position().top);
            if( $(this).scrollTop() <= 5){
             
                   var firstid =  $('#messages-list-ul li:first').attr('id');
                   console.log('first id'+ firstid);
                   
                    if(typeof firstid != 'undefined'){
                       var latestMessageId = firstid.replace('message-id-','');
                    
                        if(ajaxgetChatLoadMessage == null){
                             
                            var chatId  = $('#ref_chat_id').val();
                            if(chatId != '')
                            {
                               //showScreenLoader(); 
                               ajaxgetChatLoadMessage = $.ajax({
                                    url: "{{ url('loadOldMessages') }}/"+chatId+"/"+latestMessageId,
                                    type: 'GET',
                                    success: function(response)
                                    { 
                                        hideLoader();
                                        if(response != 'NA')
                                        {
                                            ajaxgetChatLoadMessage = null;
                                            if($.trim(response) != ''){
                                             $('#showChatHere ul').prepend(response);
                                              // setTimeout(function(){
                                              //     $("#messages-list-ul").animate({ 
                                              //         scrollTop: $("#"+firstid,"#messages-list-ul").position().top + 100
                                              //       }, 1000);
                                              // }, 1000);
                                            }
                                        }
                                    }            
                                });
                            }
                        }
                    }
            }
       });
  },3000);
});
<?php } ?>
  </script>