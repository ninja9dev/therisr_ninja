
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
						<h1 class="inbox">Inbox	<span class="msg">(98 messages)</span></h1>
                        <div class="dropdown drop-show-all mb-3 ">
                            <button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Recent</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
						
					</div>
				</div>
				<?php
				    // echo "<pre>";
				    // print_r($records['allchats']);
				    // echo "</pre>";
				?>
				<div id="contacts">
					<ul id='listz'>
                        <li class="contact">
                            <div class="wrap"> 
                                <img class="system-notification" src="../assets/img/Shape-6.png" alt="" />
                            </div>
                            <div class="meta">
                                <p class="name">System Notifications</p>
                                <p class="preview">You just got LITT up, Mike.</p>
                            </div>
                            <div class="time">
                                <p class="name">2m</p>
                                <p class="badge">3</p>
                            </div>
                        </li> 
    				    <?php foreach($records['allchats'] as $res) { ?>
    						<li class="contact chatClicks" id='chat_<?php echo $res['chat_id']; ?>' onclick='startChat("<?php echo $res['chat_id']; ?>","<?php echo $res['name'];?>")'>
    							<div class="wrap">
    								<span class="contact-status online"></span>
                                    @php
                                       if(@$res['image'] != '') $image =  asset('assets/users').'/'.@$res['image']; 
                                       else $image =  asset('assets/users/default.jpg'); 
                                    @endphp
    								    <img src="{{ $image }}" alt="" />
    							</div>
    							<div class="meta">
    								<p class="name"><?php echo $res['name'];?></p>
    								<p class="name jobTit"><?php echo $res['job_title'];?></p>
                                    <p class="preview"><?php echo $res['job_title'];?></p>
    							</div>
    							<div class="time" style=''>
    								<p class="name">&nbsp;</p>
    								<p class="badge">
    								    <span id='unreadCnt_<?php echo $res['chat_id']; ?>'><?php echo $res['unreads']; ?></span>
    								    <script>
                                            var ajaxFetchCount = null;
    								        $(document).ready(function(){
    								           setInterval(function()
                                                { 
                                                    if(ajaxFetchCount == null){
                                                        var chatId = "<?php echo $res['chat_id']; ?>";
                                                        ajaxFetchCount =  $.ajax({
                                                            url: "{{ url('fetchUnreadCounts') }}/"+chatId,
                                                            type: 'GET',
                                                            success: function(response)
                                                            {
                                                                $('#unreadCnt_'+chatId).text(response);
                                                                ajaxFetchCount = null;
                                                            }            
                                                        });
                                                    }
                                                    
                                                }, 1000); 
    								        });
    								    </script>
    								    
								    </p>
    							</div>
    						</li>
    					<?php } ?>
					</ul>
				</div>
				
			</div>
			<!--@csrf-->
			<?php
			    //echo "<pre>"; print_r($records); echo "<pre>";
			?>
			
            
			<input type='hidden' name='loginType' id='loginType' value='<?php echo $records['userType'];?>'/>
			<input type='hidden' name='loginUser' id='loginUser' value='<?php echo $records['loginUser'];?>'/>

            <!-- BELOW IS A CONTENT PLACEHOLDER -->
            <input type='hidden' name='ref_chat_id' id='ref_chat_id' value=''/>
            <input type='hidden' name='ref_person_name' id='ref_person_name' value=''/>
            
		    <div class="content">
		        <div id='showChatHere'> </div>
		        
		        <div class="message-input">
    				<div class="wrap">

    					<input type="text" id='msgPart' placeholder="Type a message..." class="msg-box" style="margin: 0 0 20px 0;"/>
    					
    					<!--<i class="fa fa-paperclip attachment" aria-hidden="true"></i>-->
    					<form id="submitForm" class='attachform' style="float: left;width: 93%;text-align: left;border: ;height: 40px;">
    					    @csrf                            
    					    <div class="form-group">
                                <div class="custom-file mb-3">
                                    <div class="image-upload">
                                        <input type="file" class="custom-file-input" name="image" id="file-input" style='width:20px;float:right'>
                                        
                                        <label for="file-input" float:left;>
                                            <i class="fa fa-paperclip attachment" for="file-input" aria-hidden="true" style='margin:8px 0 0 10px!important;'></i>
                                        </label>
                                    </div>
            
                                    
                                    <!--<label class="custom-file-label" for="image">Choose Image to Upload</label>-->
                                    
                                </div>
                            </div>
                        </form>
                        
    					<!--<i class="fa fa-smile-o smile-icon" aria-hidden="true"></i>-->
    					<button class="submit" onclick='sendMessage()' style='margin-top: -7px;'><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
    				</div>
    			</div>
		    </div>

			
		</div>
		<div class="clearfix"></div>


@endsection

@section('footer') 
<script src="{{ asset('assets/js/chat.js')}}"></script>

<script type="text/javascript">
    var ajaxFetchFullChat = null;
    $(document).ready(function()
    {
        //-- Open first chat by default------------------------------------
        <?php if(!empty($openChat)) { ?>
            console.log('{{ $openChat }}');
            $('#chat_{{ $openChat }}').click();
        <?php }else{ ?>
           $('#chat_1').click();
        <?php } ?> 

        $("#showChatHere .messages").animate({ 
            scrollTop: $('#showChatHere .messages').prop("scrollHeight")}, 
        1000);
        
        //-- Ref Chat------------------------------------------------------
        setInterval(function()
        { 
            if(ajaxFetchFullChat == null){
                var chatId      = $('#ref_chat_id').val();
                var personName  = $('#ref_person_name').val();
                console.log(chatId+'--'+personName);
                if(chatId != '' && personName != '')
                {
                   ajaxFetchFullChat = $.ajax({
                        url: "{{ url('getFullChatUnread') }}/"+chatId+"/"+personName,
                        type: 'GET',
                        success: function(response)
                        {
                            if(response != 'NA')
                            {
                                // $('#ref_chat_id').val(chatId);
                                // $('#ref_person_name').val(personName);
                                $('#showChatHere ul').append(response);    
                                ajaxFetchFullChat = null;
                            }
                        }            
                    });
                }
            }
            
        }, 1000);
        
        
        //-- Img Upload------------------------------------

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
                    //alert(response);
                    // SEND ATTACHMENT IN CHAT--------------------
                    var message     = response;
                    var loginType   = $('#loginType').val();
                    var loginUser   = $('#loginUser').val();
                    var personName  = $('#personName').val();
                    
                    $.ajax({
                        url: "{{ url('sendMessage') }}",
                        type: 'POST',
                        data: { 
                            'message'       : message, 
                            'attach_url'    : "<?php echo config('app.url'); ?>", 
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
                            $("#submitForm #image").val(null);

                            var chatIDD = $('#chat_id').val();
                            $("#showChatHere .messages").animate({ scrollTop: $('#showChatHere .messages').prop("scrollHeight")}, 1000);
                        }            
                    });
                    hideLoader();
                }
            });
        });

    });
    
    function startChat(chatId,personName)
    {
        $('.chatClicks').removeClass('active');
        
        $('#chat_'+chatId).addClass('active');
        // console.log(chatId);
        // alert(chatId);
        showScreenLoader(); 
        $.ajax({
            url: "{{ url('getFullChat') }}/"+chatId+"/"+personName,
            type: 'GET',
            success: function(response)
            {
                hideLoader();
                // console.log(chatId+'and'+personName);
                $('#ref_chat_id').val(chatId);
                $('#ref_person_name').val(personName);
                
                $('#showChatHere').html(response);
                $("#showChatHere .messages").animate({ scrollTop: $('#showChatHere .messages').prop("scrollHeight")}, 1000);

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
                $('#msgPart').val('');
                hideLoader();
                var chatIDD = $('#chat_id').val();
                $("#showChatHere .messages").animate({ scrollTop: $('#showChatHere .messages').prop("scrollHeight")}, 1000);
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

function newMessage() {
	message = $(".message-input input").val();
	if($.trim(message) == '') {
		return false;
	}
	// $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul')); 
	$('.message-input input').val(null);
	//$('.contact.active .preview').html('<span>You: </span>' + message);
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
};

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    sendMessage();
    newMessage();
    return false;
  }
}); 
//# sourceURL=pen.js
</script>

@endsection