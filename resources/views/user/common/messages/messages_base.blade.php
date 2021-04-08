
@extends('user.layouts.main')

@section('content')
<style>
    
	.image-upload > input {
      visibility:hidden;
      width:0;
      height:0
    }
</style>
        <div id="frame">
			<div id="sidepanel">
				<div id="profile">
					<div class="wrap">
						<h1 class="inbox">Inbox	
                            <span class="msg">
                            ({{ $allchats->total() }} {{ ($allchats->total() > 1) ? 'conversations' : 'conversation' }} )
                            </span>
                        </h1>
                        <!-- <div class="dropdown drop-show-all mb-3 ">
                            <button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Recent</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div> -->
						
					</div>
				</div>
				<?php
				    // echo "<pre>";
				    // print_r($records['allchats']);
				    // echo "</pre>";
				?>
				<div id="contacts" class="UlChatSidebar">
					
                        <!-- chat sidebar -->
					

				</div>
				
			</div>

             <!-- BELOW IS A CONTENT PLACEHOLDER --> 
            <input type='hidden' name='ref_chat_id' id='ref_chat_id' value='{{ @$openChat }}'/>
            
            <div class="content">
                <div id='showChatHere'> 
                    <!--- Messages list here-->
                </div>
                
                <div class="message-input" id="inputArea" style="display: none;">
                    <div class="wrap">
                        <input 
                        type="text" 
                        id='msgPart' 
                        placeholder="Type a message..." 
                        class="msg-box" 
                        style="margin: 0 0 20px 0;"/>
                        
                        <form id="submitForm" 
                        class='attachform' 
                        style="float: left;width: 93%;text-align: left;border: ;height: 40px;">
                            @csrf                            
                            <div class="form-group">
                                <div class="custom-file mb-3">
                                    <div class="image-upload">
                                        <input 
                                        type="file" 
                                        class="custom-file-input" 
                                        name="image" 
                                        id="file-input" 
                                        style='width:20px;float:right'>
                                        <label for="file-input" float:left;>
                                            <i class="fa fa-paperclip attachment" 
                                            for="file-input" 
                                            aria-hidden="true" 
                                            style='margin:8px 0 0 10px!important;'>
                                            </i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <button class="submit" 
                        onclick='sendMessage()' 
                        style='margin-top: -7px;'>
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                    </div>
                </div>
            </div>

        </div>
@endsection

@section('footer') 
<script src="{{ asset('assets/js/chat.js')}}"></script>
 
<script type="text/javascript">
    var sidebarUrl = '';
    var ajaxFetchSidebar = null; 
    var ajaxgetChatAfterLastMessage = null; 
    var ajaxgetChatLoadMessage = null;
    var ajaxNotifications = null;
    $(document).ready(function()
    {
        var chatId = $('#ref_chat_id').val();
        if(chatId != '') {
          startChat();
        }

        getSidebar();
        getChatAfterLastMessage();
        setInterval(function()
        { 
            if(ajaxFetchSidebar == null){
              
               if(sidebarUrl != ''){
                 getSidebar(sidebarUrl);
               }
            }
            if(ajaxgetChatAfterLastMessage == null && ajaxgetChatLoadMessage == null){
                getChatAfterLastMessage();
            }
            
        }, 2000);

        $("#submitForm").on("change", function()
        {
            var formData = new FormData(this);
            showScreenLoader(); 
            $.ajax({
                url  : "{{ url('uploadAttachment') }}",
                type : "POST",
                cache: false,
                contentType : false,
                processData: false,
                data: formData,
                success:function(response)
                {
                    // SEND ATTACHMENT IN CHAT--------------------
                    var message     = response;
                    
                    $.ajax({
                        url: "{{ url('sendMessage') }}",
                        type: 'POST',
                        data: { 
                            'message'       : message, 
                            'attach_url'    : "<?php echo config('app.url'); ?>", 
                            'chat_id'       : $('#chat_id').val(),
                            'clientid'      : $('#clientid').val(),
                            'freelancerid'  : $('#freelancerid').val(),
                            '_token'        : $('[name=_token]').val()
                        },
                        success: function(response)
                        {
                             getChatAfterLastMessage();
                            $("#submitForm #image").val(null);

                            var chatIDD = $('#chat_id').val();
                            $("#messages-list-ul").animate({ scrollTop: $('#messages-list-ul').prop("scrollHeight")}, 1000);
                        }            
                    });
                    hideLoader();
                }
            });
        });
    });

    function getChatAfterLastMessage(){
       var id =  $('#messages-list-ul li:last').attr('id');
       console.log('last id'+ id);
       
        if(typeof id != 'undefined'){
           var lastMessageId = id.replace('message-id-','');
        }else{
           var lastMessageId = 0;
        }
        if(ajaxgetChatAfterLastMessage == null && ajaxgetChatLoadMessage == null){
            var chatId  = $('#ref_chat_id').val();
            if(chatId != '')
            {
               ajaxgetChatAfterLastMessage = $.ajax({
                    url: "{{ url('getNewMessages') }}/"+chatId+"/"+lastMessageId,
                    type: 'GET',
                    success: function(response)
                    {
                        if(response != 'NA')
                        {
                                 
                            ajaxgetChatAfterLastMessage = null;
                            if($.trim(response) != ''){
                            (lastMessageId == 0) ? $('#showChatHere ul').html(response) : $('#showChatHere ul').append(response) 
                             $("#messages-list-ul").animate({ 
                                scrollTop: $('#messages-list-ul').prop("scrollHeight")}, 100);
                            }
                        }
                    }            
                });
            }
        }
    }

    function getSidebar(url = ''){
        var chatId = $('#ref_chat_id').val();
        if(url != ''){
          $url = url;
        }else{
          $url ="{{ url('getChatSidebar') }}/"+chatId;
        }
      if(ajaxFetchSidebar == null){
           ajaxFetchSidebar = $.ajax({
                url: $url,
                type: 'GET',
                success: function(response)
                {
                    if(response != 'NA')
                    {
                        $('.UlChatSidebar').html(response);  
                        console.log('chatId',chatId);
                        if(chatId != ''){
                           $('#chat_'+chatId).addClass('active');
                           //$('#chat_'+chatId).click();
                           $('#ref_chat_id').val(chatId);
                           $('#inputArea').show();
                        }else{
                            console.log('oprn .UlChatSidebar li:nth-child(2)');
                            openNotifications();
                            //$('.UlChatSidebar li:nth-child(2)').click();
                            $("#messages-list-ul").animate({ 
                                scrollTop: $('#messages-list-ul').prop("scrollHeight")}, 1000);
                        }  
                       ajaxFetchSidebar = null;
                    }
                }            
            });
       }
    }

     function startChat(chatId='', url = '')
    {
       (ajaxFetchSidebar != null) ? ajaxFetchSidebar.abort() : '';
       ajaxFetchSidebar = 'stoptillthiscomplete';
      // var chatId = $('#ref_chat_id').val();
        if(url != ''){
            
            $url = url+'&request_type=paginationData';
        }else{
            $url = "{{ url('getFullChat') }}/"+chatId;
        }
        sidebarUrl = $('#filter-sidebar-pagination .pagination a:first').attr('href');
        if(sidebarUrl){
            currentpage = $('#filter-sidebar-pagination .pagination li.active').find('span').html();
            if(typeof currentpage == 'undefined'){
                currentpage = 1;
            }
            var pieces = sidebarUrl.split("?page=");
           // console.log(pieces);
           // var page = (pieces[1]) ? pieces[1] - 1 : 1;
            sidebarUrl = pieces[0]+ "?page="+ currentpage;
            console.log(sidebarUrl);
        }else{
          sidebarUrl ="{{ url('getChatSidebar') }}/"+chatId;
        }
        $('.chatClicks').removeClass('active');
        $('#chat_'+chatId).addClass('active');
        showScreenLoader(); 
        $.ajax({
            url: $url,
            type: 'GET',
            success: function(response)
            {
                ajaxFetchSidebar = null;
                hideLoader();
                // console.log(chatId+'and'+personName);
                $('#ref_chat_id').val(chatId);
                $('#inputArea').show();
                if(url != ''){
                  $('#showChatHere').prepend(response);
                }
                else{
                  $('#showChatHere').html(response);
                }
                $("#messages-list-ul").animate({ scrollTop: $('#messages-list-ul').prop("scrollHeight")}, 100);

            }            
        });
    }
    
    function sendMessage()
    {
        var message     = $('#msgPart').val();
        var loginType   = $('#loginType').val();
        var loginUser   = $('#loginUser').val();
        var personName  = $('#personName').val();
        
        showScreenLoader(); 
        $.ajax({
            url: "{{ url('sendMessage') }}",
            type: 'POST',
            data: { 
                'message'       : message, 
                'attach_url'    : "", 
                'loginType'     : loginType,
                'loginUser'     : loginUser,
                'personName'    : personName,
                'chat_id'       : $('#chat_id').val(),
                'clientid'      : $('#clientid').val(),
                'freelancerid'  : $('#freelancerid').val(),
                '_token'        : $('[name=_token]').val()
            },
            success: function(response)
            {
                getChatAfterLastMessage();
                $('#msgPart').val('');
                hideLoader();
                var chatIDD = $('#chat_id').val();
                $("#messages-list-ul").animate({ scrollTop: $('#messages-list-ul').prop("scrollHeight")}, 100);
            }            
        });
    }


    function openNotifications(url = ''){
        (ajaxFetchSidebar != null) ? ajaxFetchSidebar.abort() : '';
       ajaxFetchSidebar = 'stoptillthiscomplete';
        console.log('openNotifications')
        if(url != ''){ 
          $url = url;
        }else{
          $url ="{{ url('getNotifications') }}";
        }
      if(ajaxNotifications == null){
           ajaxNotifications = $.ajax({
                url: $url,
                type: 'GET', 
                success: function(response)
                {
                    if(response != 'NA')
                    {
                         $('#inputArea').hide();
                        ajaxFetchSidebar = null;
                        hideLoader();
                        // console.log(chatId+'and'+personName);
                        if(url != ''){
                          $('#showChatHere').prepend(response);
                        }
                        else{
                          $('#showChatHere').html(response);
                        }
                        $("#messages-list-ul").animate({ scrollTop: $('#messages-list-ul').prop("scrollHeight")}, 100);

                        $('#chat_notification').addClass('active');
                        ajaxNotifications = null;
                    }
                }            
            });
       }
    }


    function deleteNotification(id = ''){
       (ajaxgetChatLoadMessage != null) ? ajaxgetChatLoadMessage.abort() : '';
       ajaxgetChatLoadMessage = 'stoptillthiscomplete';
       showScreenLoader(); 
       $.ajax({
                url: "{{ url('deleteNotification') }}/"+ id,
                type: 'GET',
                success: function(response)
                {
                    hideLoader();
                    $('#message-id-'+id).fadeOut(900, function(){ $(this).remove();});
                    ajaxgetChatLoadMessage = null;
                }            
            });

    }
</script>
<script >
$(".messages").animate({ scrollTop: $(document).height() }, "fast");
    

$("#profile-img").click(function() {
    $("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
    $("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
    $("#profile-img").removeClass();
    $("#status-online").removeClass("active");
    $("#status-away").removeClass("active");
    $("#status-busy").removeClass("active");
    $("#status-offline").removeClass("active");
    $(this).addClass("active");
    
    if($("#status-online").hasClass("active")) {
        $("#profile-img").addClass("online");
    } else if ($("#status-away").hasClass("active")) {
        $("#profile-img").addClass("away");
    } else if ($("#status-busy").hasClass("active")) {
        $("#profile-img").addClass("busy");
    } else if ($("#status-offline").hasClass("active")) {
        $("#profile-img").addClass("offline");
    } else {
        $("#profile-img").removeClass();
    };
    
    $("#status-options").removeClass("active");
});



$(window).on('keydown', function(e) {
  if (e.which == 13) {
    sendMessage();
    return false;
  }
}); 

$( document ).ready(function() {
   // pagination
    $(document).on('click', '#filter-pagination .pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var myurl = $(this).attr('href');
        startChat('',myurl);
        event.preventDefault();
    });

    // pagination
    $(document).on('click', '#filter-sidebar-pagination .pagination a',function(event)
    {
        (ajaxFetchSidebar != null) ? ajaxFetchSidebar.abort() : '';
        ajaxFetchSidebar = null;
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var myurl = $(this).attr('href');
        sidebarUrl = myurl;
        getSidebar(myurl);
        event.preventDefault();
    });
});


</script>

@endsection