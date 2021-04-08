 <ul id='listz' class="UlChatSidebar">

 <li class="contact chatClicks
    {{ ($currentopenchat ==  'chat_notification') ? 'active' : '' }}" 
    id="chat_notification"
    onclick='openNotifications()'> 
      <div class="wrap"> 
        <i class="system-notification fa fa-lg fa-star"></i>
          <!-- <img class="system-notification" src="../assets/img/Shape-6.png" alt="" /> -->
      </div>
      <div class="meta">
          <p class="name">System Notifications</p>
          <p class="preview"></p>
      </div>
      <div class="time">
          <p class="name"></p>
          <p class="badge"></p>
      </div>
  </li> 
    				    @foreach($allchats as $res)
                        <?php //echo "<pre>";
                       // print_r($res);die;?>
                        @if(Auth::user()->id == $res->freelancerId)
                         @php
                              $chatuser = !empty($res->chat_client) ? $res->chat_client : '';
                         @endphp
                        @else
                          @php
                              $chatuser = !empty($res->chat_freelancer) ? $res->chat_freelancer : '';
                          @endphp
                        @endif
                         <?php  
                        //  echo "<pre>";
                        //  echo "<h5>chat_freelancer</h5>";
                        // print_r($res->chat_freelancer);
                        //  echo "<h5>chat_client</h5>";
                        // print_r($res->chat_client);
                        //  echo "<h5>chat_messages_client_unread</h5>";
                        // print_r($res->chat_messages_client_unread);
                        //  echo "<h5>chat_job</h5>";
                        // print_r($res->chat_job);
                        // echo "<h5>chat_message_last</h5>";
                        // print_r($res->chat_message_last);
                        // die;
                        ?> 
    						 <li class="contact chatClicks
                   {{ ($currentopenchat ==  $res->chat_id) ? 'active' : '' }}" 
                              id="chat_{{ $res->chat_id }}" 
                              onclick='startChat("{{ $res->chat_id }}")'>
    							<div class="wrap">
    								<!-- <span class="contact-status online"></span> -->
                        @php
                           if(@$chatuser->image != '') 
                           $image =  asset('assets/users').'/'.@$chatuser->image; 
                           else 
                           $image =  asset('assets/users/default.jpg'); 
                        @endphp
    								    <img src="{{ $image }}" alt="" />
    							</div>
    							<div class="meta">
      								<p class="name">
                          {{ $chatuser->name }}
                      </p>
      								<p class="name jobTit">
                          {{ !empty($res->chat_job) ? substr($res->chat_job->job_title,0,20).'...' : ''}}
                      </p>
                      <p class="preview">
                          {{ !empty($res->chat_message_last) ? substr($res->chat_message_last->message,0,30).'...' : ''}}
                      </p>
    							</div>
    							<div class="time" style=''>
    								<p class="name">
                      {{ !empty($res->chat_message_last) ? getMessageTimeAgo($res->chat_message_last->created_at) : ''}}
                    </p>
                    @if($res->unreadcount > 0)
    								<p class="badge">
    								    <span 
                            id='unreadCnt_{{ $res->chat_id }}'>
                              {{ $res->unreadcount }}
                        </span>
								    </p>
                    @endif
    							</div>
    						</li> 
    					@endforeach
</ul>
          <div id="filter-sidebar-pagination" >{!! $allchats->onEachSide(0)->render() !!}</div> 