  @php 
    $chat_notifications = $chat_notifications->reverse();
  @endphp


@if($request_type == 'paginationData')
    @forelse($chat_notifications as $res) 
        <li class="sent"
        id="message-id-{{$res->id}}" 
        style="text-align:left">
        <p>         
           <?=$res->notification;?>
           <i class="fa fa-close pull-right pointer" onclick="deleteNotification('{{ $res->id }}')"></i> 
        </p>
        <time>{{getMessageTime($res->created_at) }}</time>
    </li>
    @empty 
    @endforelse
@else
<div class="contact-profile">
     <i class="system-notification fa fa-lg fa-star"></i>
     <!-- <img class="system-notification" src="../assets/img/Shape-6.png" alt="" /> -->
     
		<div class="person-info"> 
			<h1 class="person-name">System Notifications</h1>
		</div>
</div>

<div class="messages">
  <ul id="messages-list-ul">  
  	@forelse($chat_notifications as $res) 
        <li class="sent"
        id="message-id-{{$res->id}}" 
        style="text-align:left">
			  <p> 				
				   <?=$res->notification;?>
           <i class="fa fa-close pull-right pointer" onclick="deleteNotification('{{ $res->id }}')"></i>
		    </p>
		    <time>{{getMessageTime($res->created_at) }}</time>
		</li>
    @empty   
    <div class="inner-table-box">
          <div class="pt-30 text-center">
             <img src="{{ asset('assets/img/no-trans.png')}}" class="m-auto">
             <p class="no-work-yet"> 
             No notifications yet
           </p>
          </div>
    </div>
    @endforelse
  </ul>
</div>


<script>
  <?php if(!empty($more_notifications)) { ?>
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
                       var latestId = firstid.replace('message-id-','');
                    
                        if(ajaxgetChatLoadMessage == null){
                               //showScreenLoader(); 
                               ajaxgetChatLoadMessage = $.ajax({
                                    url: "{{ url('loadOldNotifications') }}/"+latestId,
                                    type: 'GET',
                                    success: function(response)
                                    { 
                                        hideLoader();
                                        if(response != 'NA')
                                        {
                                            ajaxgetChatLoadMessage = null;
                                            if($.trim(response) != ''){
                                             $('#showChatHere ul').prepend(response); 
                                             
                                             // $("#messages-list-ul").animate({ 
                                             //  scrollTop: $("#"+firstid,"#messages-list-ul").position().top
                                             //  }, 100);

                                            }
                                        }
                                    }            
                                });
                        }
                    }
            }
       });
  },3000);
});
<?php } ?>
  </script>

@endif